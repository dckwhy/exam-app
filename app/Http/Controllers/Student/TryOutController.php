<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Result;
use App\Models\Tier;
use App\Models\TryOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TryOutController extends Controller
{
    public function index($id)
    {
        $try_outs = TryOut::where('tier_id', $id)->where('status', 1)->get();
        $tier = Tier::find($id);
        return view('pages.student.try-out.index', compact('tier', 'try_outs'));
    }

    public function create($id){
        $try_out = TryOut::find($id);
        $questions = Question::where('try_out_id', $id)->where('status', 1)->inRandomOrder()->get();
        
        return view('pages.student.try-out.create', compact('try_out', 'questions'));
    }

    public function store(Request $request){
        $correct_amount=0;
        $wrong_amount=0;
        $req= $request->all();
        for($i=1;$i<=$request->index;$i++){

            if(isset($req['question'.$i])){
                $question=Question::where('id',$req['question'.$i])->get()->first();
                if($question->answer==$req['answer'.$i]){
                    $correct_amount++;
                }else{
                    $wrong_amount++;
                }
            }
        }
        $query = Result::create([
            'try_out_id' => $request->try_out_id,
            'user_id' => Auth::user()->id,
            'number_of_question' => $request->index,
            'correct_amount' => $correct_amount,
            'wrong_amount' => $wrong_amount,
            'grade' => ($correct_amount/$request->index) * 100
        ]);
        if($query){
            return redirect()->route('siswa.kelas.grade')->with(['success' => 'Anda Berhasil Menyelesaikan Try Out']);
        }
    }

    public function indexTryOut($id){
        $tier = Tier::find($id);
        $try_outs = TryOut::where('tier_id', $id)->where('status', 1)->get();
        return view('pages.student.grade.try-out', compact('tier', 'try_outs'));
    }

    public function indexGrade($try_out_id){
        $try_out = TryOut::find($try_out_id);
        $results = Result::where('try_out_id', $try_out_id)->where('user_id', Auth::user()->id)->get();
        return view('pages.student.grade.detail', compact('try_out', 'results'));
    }
}
