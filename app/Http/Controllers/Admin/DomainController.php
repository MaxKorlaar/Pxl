<?php

    namespace App\Http\Controllers\Admin;

    use App\Domain;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\NewDomain;
    use Illuminate\Http\Request;

    /**
     * Class DomainController
     *
     * @package App\Http\Controllers\Admin
     */
    class DomainController extends Controller {
        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getView() {
            $domainsPagination = Domain::paginate(15);
            return view('admin.domains', [
                'pagination' => $domainsPagination
            ]);

        }

        /**
         * @param Request $request
         * @param Domain  $domain
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getDeleteView(Request $request, Domain $domain) {
            return view('admin.domains.delete', [
                'domain' => $domain
            ]);
        }

        /**
         * @param NewDomain $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function newDomain(NewDomain $request) {
            $domain           = new Domain;
            $domain->domain   = $request->domain;
            $domain->protocol = $request->protocol;
            $domain->user     = $request->user()->id;
            $domain->saveOrFail();
            return back()->with('success', trans('admin.domains.added', ['domain' => $domain->domain]));
        }

        /**
         * @param Request $request
         * @param Domain  $domain
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function deleteDomain(Request $request, Domain $domain) {
            $domain->delete();
            return redirect(route('admin/domains'))->with('success', trans('admin.domains.deleted'));
        }
    }
