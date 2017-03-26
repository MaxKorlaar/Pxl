<?php

    namespace App\Http\Controllers\Image;

    use App\Http\Controllers\Controller;
    use App\Image;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Facades\Cache;
    use Request;

    /**
     * Class ImageController
     *
     * @package App\Http\Controllers\Image
     */
    class ImageController extends Controller {

        /**
         * @param Request $request
         * @param         $imageUrl
         *
         * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
         */
        function getImageFromUrl(Request $request, $imageUrl, $imageExtension) {
            /** @var Builder $builder */
            $builder = Image::whereUrlName($imageUrl);
            /** @var Image $image */
            $image = $builder->firstOrFail();

            return response(\Storage::get($image->file_path . '/' . $image->getBaseName()), 200, [
                'Content-Type' => $image->filetype
            ]);
        }

        /**
         * @param Request $request
         * @param         $imageUrl
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        function getPreviewPage(Request $request, $imageUrl) {

            if (Cache::has('preview.' . $imageUrl)) {
                $image  = Cache::get('preview.' . $imageUrl);
                $domain = Cache::get('domain.' . $imageUrl);
            } else {
                /** @var Builder $builder */
                $builder = Image::whereUrlName($imageUrl);
                /** @var Image $image */
                $image  = $builder->firstOrFail();
                $domain = $image->domain()->getResults();
                Cache::put('preview.' . $imageUrl, $image, 120);
                Cache::put('domain.' . $imageUrl, $domain, 120);
            }

            return view('image.preview', [
                'image'  => $image,
                'domain' => $domain
            ]);
        }

    }
