<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{

    public function index($page){

    $page = Cms::where('alias', $page)->first();
    return view('pages.mainLink', ['pages' => $page]);

    }
    
}
