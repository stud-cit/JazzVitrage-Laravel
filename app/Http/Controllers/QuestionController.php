<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function getQuestion()
    {
        $data = Question::orderBy('created_at', 'asc')->get();
        return response()->json($data);
    }
    public function postQuestion(Request $request)
    {
        $question_data = new Question;
        $question_data->name = $request->name;
        $question_data->email = $request->email;
        $question_data->question_text = $request->question_text;

        $question_data->save();
    }
    public function deleteQuestion($id)
    {
        $question = Question::find($id);
        $question->delete();
    }
}
