<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');
        $results = Model::where('column', 'LIKE', "%$q%")->get();
        return response()->json($results);
    }
}
