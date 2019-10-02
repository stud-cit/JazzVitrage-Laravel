<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }

    /** 
     * To rate
     * 
     * Illuminate\Http\Request $request 
     **/
    public function toRate(Request $request) {

        $id = Auth::id();

        $model = new Evaluation();

        // minor evaluation
        $min = Evaluation::MIN;
        $max = Evaluation::MAX;

        $validatedData = $request->validate([
            'artistic_value' => "required|numeric|min:$min|max:$max",
            'artistry' => "required|numeric|min:$min|max:$max",
            'evaluation' => "required|numeric|min:$min|max:100", // total rate 100
            'originality' => "required|numeric|min:$min|max:$max",
            'stylistic_matching' => "required|numeric|min:$min|max:$max"
        ]);

        $data = $request->all();
        
        $data['user_id'] = $id;

        $model->create($data);

        return response('ok', 200);
    }

    public function hasRecord($application_id) {
        $user_id = Auth::id();
        
        $model = Evaluation::where([['application_id', $application_id], ['user_id', $user_id]])->first();
        
        return response()->json($model);
    }

    public function toRateUpdate(Request $request, $evaluation_id) {
        $min = Evaluation::MIN;
        $max = Evaluation::MAX;

        $validatedData = $request->validate([
            'artistic_value' => "required|numeric|min:$min|max:$max",
            'artistry' => "required|numeric|min:$min|max:$max",
            'evaluation' => "required|numeric|min:$min|max:100", // total rate 100
            'originality' => "required|numeric|min:$min|max:$max",
            'stylistic_matching' => "required|numeric|min:$min|max:$max"
        ]);
        $model = Evaluation::find($evaluation_id);

        $data = $request->all();
        $model->update($data);
        return response('ok', 200);        
    }
}
