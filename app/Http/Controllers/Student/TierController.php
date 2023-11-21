<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Tier;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TierController extends Controller
{
    public function index(){
        $classes = Tier::where('status', 1)->get();
        return view('pages.student.tier.index', compact('classes'));
    }

    public function store(Request $request){
        $user_exam = UserExam::where('tier_id', $request->id)->where('child_id', Auth::user()->id)->first();
        if($user_exam){
            return response()->json(['error' => 'Anda Sudah Mendaftar Di Kelas Ini']);
        }else{
            $user = Auth::user();
            $query = UserExam::create([
                'parent_id' => $user->student->oldster->user->id,
                'child_id' => $user->id,
                'tier_id' => $request->id,
                'status' => 1
            ]);
            if($query){
                return response()->json(['success' => 'Anda Berhasil Mendaftar Ke Kelas Ini, Harap Segera Melakukan Pembayaran']);
            }
        }
    }

    public function indexRegistered(){
        $user_exams = UserExam::where('child_id', Auth::user()->id)->orderBy('tier_id', 'ASC')->get();
        return view('pages.student.tier.registered', compact('user_exams'));
    }

    public function indexTier(){
        if (request()->ajax()) {
            $model = UserExam::where('child_id', Auth::user()->id)->where('status', 3)->orderBy('tier_id', 'ASC')->get();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('name', function ($model) {
                    return $model->tier->name;
                })
                ->addColumn('action', function ($model) {
                    return '<a href="'.route('siswa.kelas.grade.try-out', $model->tier->id).'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.student.grade.index');
    }
}
