<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;

class PeriodController extends Controller
{
    public function getPeriod() {
        $model = Period::find(1);
        
        return response()->json($model);
    }

    public function updatePeriod(Request $request) {
        // make validation
        $validatedData = $request->validate([
            'start_date' => 'date',
            'expiration_date' => 'date',
            'status' => 'boolean'
        ]);
        $model = Period::where('id', 1)->update( $request->all() );
        return response('ok', 200);
    }

    public function isOpenedRegistration() {
        $model = Period::isRegistration();

        return response()->json($model);
    } 
}
