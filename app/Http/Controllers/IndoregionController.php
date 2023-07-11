<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class IndoregionController extends Controller
{
    public function form()
    {

        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = Village::all();
        return view('form', compact('provinces', 'regencies', 'districts', 'villages'));
    }
}
