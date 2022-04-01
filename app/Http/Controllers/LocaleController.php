<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    //
    public function changeLang($lang)
    {
        Session::put('web_lang', $lang);

        return redirect()->back();
    }
}
