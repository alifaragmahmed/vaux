<?php

namespace App\Http\Controllers;

use App\Language;
use App\TransKey;
use App\Translation;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

use App\Utils\Util;

class TransController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        //if (!auth()->user()->can('translation.view') && !auth()->user()->can('translation.create')) {
        //    abort(403, 'Unauthorized action.');
        //}

        if (request()->ajax() && request()->content_type != 'html') {

            $translation = Translation::query();

            if (request()->language_id > 0)
                $translation->where('language_id', request()->language_id);

            if (request()->business_type_id > 0)
                $translation->where('business_type_id', request()->business_type_id);

            if (request()->language_id > 0 && request()->business_type_id > 0) {
                $this->insertKeyIfNotExists(request()->language_id, request()->business_type_id);

                // cache translations
                Translation::createTransFile(request()->language_id, request()->business_type_id);
            }

            return Datatables::of($translation)
                ->editColumn('trans', function (Translation $translation) {
                    return view("translation.datatable.trans", compact("translation"));
                })
                ->editColumn('business_type_id', function (Translation $translation) {
                    return optional($translation->businessType)->name;
                })
                ->editColumn('language_id', function (Translation $translation) {
                    return optional($translation->language)->name;
                })
                ->rawColumns(['action', 'trans'])
                ->make(true);
        }

        return view('translation.index');
    }

    public function insertKeyIfNotExists($language, $businessType)
    {
        foreach (TransKey::all() as $item) {
            $trans = Translation::query()
                ->where('language_id', $language)
                ->where('business_type_id', $businessType)
                ->where('key', $item->key)
                ->first();

            if (!$trans) {
                $languageObject = Language::find($language);

                $trans = Translation::create([
                    "language_id" => $language,
                    "business_type_id" => $businessType,
                    "key" => $item->key,
                    "trans" => trans_lang($item->key, [], $languageObject->key)
                ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!auth()->user()->can('translation.create')) {
            abort(403, 'Unauthorized action.');
        }*/


        $quick_add = false;
        if (!empty(request()->input('quick_add'))) {
            $quick_add = true;
        }

        return view('translation.create')
            ->with(compact('quick_add'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $data = json_decode($request->data);

        foreach($data as $item) {
            $translation = Translation::find($item->id);
            $translation->update([
                "trans" => $item->value
            ]);
        }

        return responseJson(1, __('done'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*if (!auth()->user()->can('translation.update')) {
            abort(403, 'Unauthorized action.');
        }*/

        $translation = Translation::find($id);

        return view('translation.edit')
            ->with(compact('translation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (!auth()->user()->can('translation.delete')) {
            abort(403, 'Unauthorized action.');
        }*/

        if (request()->ajax()) {
            try {
                $exists = Translation::findOrFail($id);

                if ($exists) {
                    $exists->delete();

                    $output = [
                        'success' => true,
                        'msg' => __("brand.deleted_success")
                    ];
                } else {
                    $output = [
                        'success' => false,
                        'msg' => __("lang_v1.translation_cannot_be_deleted")
                    ];
                }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => '__("messages.something_went_wrong")'
                ];
            }

            return $output;
        }
    }
}
