<?php

namespace Modules\Help\Http\Controllers;

use Modules\Help\Entities\Tutorial;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Modules\Help\Entities\UserTutorial;
use stdClass;

class DocumentationController extends Controller
{

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct()
    { 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $categories = [];
        $cats = [];
        $articles = [];

        $catRow = DB::table('sb_settings')->where('name', 'articles-categories')->first(); 
        if ($catRow) {
            $categories = json_decode($catRow->value);

            foreach($categories as $item) {
                $cats[$item->id] = $item;
            }
        }
        $atcRow = DB::table('sb_settings')->where('name', 'articles')->first(); 
        if ($atcRow) {
            $articles = json_decode($atcRow->value);

            foreach($articles as $article) {
                foreach($article->categories as $key => $cat) {
                    $article->categories[$key] = $cats[$cat];
                }
            }
        }
 
        return view('help::documentation.index', compact("categories", "cats", "articles"));
    }

 
}
