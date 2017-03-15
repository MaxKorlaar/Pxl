<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\DeleteYacht;
    use App\Http\Requests\NewYacht;
    use App\Http\Requests\UpdateYacht;
    use App\Yacht;
    use Illuminate\Http\Request;

    /**
     * Class YachtController
     *
     * @package App\Http\Controllers\Admin
     */
    class YachtController extends Controller {


        /**
         * Create a new controller instance.
         *
         */
        public function __construct() {

        }

        /**
         * @param UpdateYacht|Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(UpdateYacht $request) {
            /** @var Yacht $yacht */
            $yacht = Yacht::findOrFail($request->get('id'));
            $yacht->update($request->all());
            $yacht->is_visible  = $request->exists('is_visible');
            $yacht->setSlug();
            $yacht->save();
            return redirect()->route('admin/yacht_editor', ['yacht' => $yacht])->with('success', trans('admin.editor.yacht_updated'));
        }

        /**
         * @param Yacht $yacht
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getEditor(Yacht $yacht) {
            return view('admin.yacht_editor', ['yacht' => $yacht->jsonSerialize()]);
        }

        /**
         * @param DeleteYacht $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function delete(DeleteYacht $request) {
            /** @var Yacht $yacht */
            $yacht = Yacht::findOrFail($request->get('id'));
            $yacht->delete();
            return redirect()->route('admin/index')->with('success', trans('admin.yacht_deleted'));
        }

    }
