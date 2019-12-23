<?php

namespace App\Http\Controllers;

use App\Models\Category;

class MainPageController extends Controller
{
    function getCatagories(){
        $categories = Category::all();
        return $categories->toJson();
    }

    function index()
    {
        VisitorController::addVisitor();
        return view('mainPage');
    }
}
