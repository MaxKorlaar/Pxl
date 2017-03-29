<?php

    namespace App\Exceptions;

    use Exception;
    use Illuminate\Auth\AuthenticationException;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use Illuminate\Session\TokenMismatchException;
    use Illuminate\Validation\ValidationException;
    use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

    /**
     * Class Handler
     *
     * @package App\Exceptions
     */
    class Handler extends ExceptionHandler {
        /**
         * A list of the exception types that should not be reported.
         *
         * @var array
         */
        protected $dontReport = [
            \Illuminate\Auth\AuthenticationException::class,
            \Illuminate\Auth\Access\AuthorizationException::class,
            \Symfony\Component\HttpKernel\Exception\HttpException::class,
            \Illuminate\Database\Eloquent\ModelNotFoundException::class,
            \Illuminate\Session\TokenMismatchException::class,
            \Illuminate\Validation\ValidationException::class,
        ];

        /**
         * Report or log an exception.
         *
         * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
         *
         * @param  \Exception $exception
         *
         * @return void
         */
        public function report(Exception $exception) {
            parent::report($exception);
        }

        /**
         * Render an exception into an HTTP response.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Exception               $exception
         *
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function render($request, Exception $exception) {
            if ($exception instanceof TokenMismatchException) {
                return response(view('errors.400', ['error' => 'CSRF Token mismatch']), 400);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response(view('errors.400', ['error' => 'Request method not allowed']), 400);
            }

            if (app()->environment() == 'production' && !$this->isHttpException($exception) &&
                (!$exception instanceof ModelNotFoundException && !$exception instanceof ValidationException)) {
                return response(view('errors.500', ['exception' => $exception]), 500);
            }
            return parent::render($request, $exception);
        }

        /**
         * Convert an authentication exception into an unauthenticated response.
         *
         * @param  \Illuminate\Http\Request                 $request
         * @param  \Illuminate\Auth\AuthenticationException $exception
         *
         * @return \Illuminate\Http\Response
         */
        protected function unauthenticated($request, AuthenticationException $exception) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest('login');
        }
    }
