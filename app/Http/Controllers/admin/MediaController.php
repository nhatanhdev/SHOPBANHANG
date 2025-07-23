<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->prefixView = "media";

    }


    public function index(Request $request)
    {
        return view('admin.' . $this->prefixView . '.index');

    }


}
