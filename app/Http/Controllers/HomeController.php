<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slider;
use App\Category;
use App\Product;

class HomeController extends Controller {

    public function index() {
        $sliders = slider::all();
        $notification = ProductController::countProdS();
        return view('home', [
            'sliders' => $sliders,
            'notification' => $notification,
            'nav' => true
        ]);
    }
    public function redirectToHome() {
        return redirect()->route('home');
    }

}
