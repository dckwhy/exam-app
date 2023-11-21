<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tier;
use App\Models\Result;
use App\Models\TryOut;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TryOutController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $model = TryOut::all();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('tier', function ($model){
                    return $model->tier->name;
                })
                ->addColumn('day', function($model){
                    return json_decode($model->day);
                })
                ->addColumn('status', function ($model) {
                    if($model->status == 1){
                        $btn = '<a  class="btn btn-sm btn-success mx-1 disabled"><i class="fa fa-check"></i></a>';
                        $btn = $btn . '<a href="'.route('admin.try-out.deactivate', $model->id).'" class="btn btn-sm btn-danger mx-1"><i class="fa fa-times"></i></a>';
                    }else{
                        $btn = '<a href="'.route('admin.try-out.activate', $model->id).'" class="btn btn-sm btn-success mx-1"><i class="fa fa-check"></i></a>';
                        $btn = $btn . '<a class="btn btn-sm btn-danger mx-1 disabled"><i class="fa fa-times"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" id="edit" class="btn btn-warning btn-sm" value="' . $model->id . '"><i class="fa fa-edit"></i></button>';
                    $btn = $btn . '<button type="button" id="delete" class="btn btn-danger btn-sm" value="' . $model->id . '"><i class="fa fa-trash"></i></button>';
                    $btn = $btn . '<a href="'.route('admin.try-out.question', $model->id).'" class="btn btn-sm btn-info"><i class="fa fa-circle-question"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        $tiers = Tier::where('status', 1)->select('id', 'name')->get();
        return view('pages.admin.try-out.index', compact('tiers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', Rule::unique('try_outs', 'name')->ignore($request->id, 'id')],
                'tier' => 'required',
                'day' => 'required',
                'time_start' => 'required',
                'time_end' => 'required|after:time_start',
                'duration' => 'required|numeric'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = TryOut::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'tier_id' => $request->tier,
                    'day' => json_encode($request->day),
                    'time_start' => $request->time_start,
                    'time_end' => $request->time_end,
                    'duration' => $request->duration,
                ]
            );
            if ($query) {
                return response()->json(['status' => 1, 'msg' => 'Data Berhasil Disimpan']);
            }
        }
    }

    public function edit($id)
    {
        $try_out = TryOut::find($id);
        return response()->json($try_out);
    }

    public function destroy($id)
    {
        $query = TryOut::find($id)->delete();
        if($query){
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }
    }

    public function activate($id){
        $query = TryOut::find($id);
        if($query){
            $query->update([
                'status' => 1
            ]);
            return redirect()->route('admin.try-out.index')->with(['success' => 'Try Out Berhasil Diaktifkan']);
        }
    }

    public function deactivate($id){
        $query = TryOut::find($id);
        if($query){
            $query->update([
                'status' => 0
            ]);
            return redirect()->route('admin.try-out.index')->with(['success' => 'Try Out Berhasil Dinonaktifkan']);
        }
    }

    public function question($id){
        $questions = Question::where('try_out_id', $id)->get();
        $try_out = TryOut::find($id);
        return view('pages.admin.question.index', compact('questions', 'try_out'));
    }

    public function indexTryOut($id){
        $tier = Tier::find($id);
        $try_outs = TryOut::where('tier_id', $id)->where('status', 1)->get();
        return view('pages.admin.grade.try-out', compact('tier', 'try_outs'));
    }

    public function indexGrade($id, $try_out_id){
        $try_out = TryOut::find($try_out_id);
        $result_array = Result::groupBy('user_id')->get()->toArray();
        $results = Result::where('try_out_id', $try_out_id)->get();
        return view('pages.admin.grade.index', compact('try_out', 'results', 'result_array'));
    }
}
