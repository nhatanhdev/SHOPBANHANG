<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfrastructureCity;
use App\Models\InfrastructureDistrict;
use App\Models\InfrastructureWard;

class ProvinceController extends Controller
{

    public function city(){
        $city = InfrastructureCity::all();
        return response()->json([
            'data' => $city,
            'status' => 'code 200',
        ]);
    }
}
