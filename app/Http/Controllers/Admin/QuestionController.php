<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TryOut;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'question' => ['required', Rule::unique('questions', 'question')->ignore($request->id, 'id')],
                'answer' => ['required', Rule::in($request->options)],
                'options.*' => 'required'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query =  Question::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'try_out_id' => $request->try_out_id,
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'options' => json_encode($request->options),
                ]
            );
            if ($query) {
                return response()->json(['status' => 1, 'msg' => 'Data Pertanyaan Berhasil Ditambahkan']);
            }
        }
    }

    public function edit($id){
        $question = Question::find($id);
        return response()->json($question);
    }

    public function destroy($id){
        Question::find($id)->delete();
        return response()->json(['success' => 'Pertanyaan Berhasil Dihapus']);
    }

    public function activate($id){
        $query = Question::find($id);
        if($query){
            $query->update([
                'status' => 1
            ]);
            return response()->json(['status' => 1, 'success' => 'Pertanyaan Berhasil Diaktifkan']);
        }
    }

    public function deactivate($id){
        $query = Question::find($id);
        if($query){
            $query->update([
                'status' => 0
            ]);
            return response()->json(['status' => 1, 'success' => 'Pertanyaan Berhasil Dinonaktifkan']);

        }
    }
}
