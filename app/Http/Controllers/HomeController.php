<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Display the welcome.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        return view('welcome');
    }
}
