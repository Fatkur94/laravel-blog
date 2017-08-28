<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{   
    //add single variable
    public function index() {
        $title = 'welcome to homepage';
        return view('pages.index')->with('title', $title);
    }
    //add single varible different way
    public function about() {
        $title = 'wellcome to about page';
        return view('pages.about', compact('title'));
    }

    //add mutiple variable
    public function services() {
        $data = array(
            'title'=> 'Services',
            'instance' =>'Wellcome to services channel'
        );
        return view('pages.services')->with($data);
    }

    //add list inside variable
    public function menu() {
        $data = array(
            'title'=> 'menu makanan',
            'makanan'=> ['nasi goreng', 'mie ayam', 'sego pecel']
        );
        return view('pages.menu')->with($data);
    }
}
