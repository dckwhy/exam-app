<?php

namespace App\Http\Controllers\Parent;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TierController extends Controller
{
    public function registered(){
        if (request()->ajax()) {
            $model = UserExam::where('parent_id', Auth::user()->id)->orderBy('tier_id','ASC')->get();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('tier', function ($model) {
                    return $model->tier->name;
                })
                ->addColumn('tier_price', function ($model) {
                    return 'Rp. ' .number_format($model->tier->price, 0);
                })
                ->addColumn('child', function ($model) {
                    return $model->child->name;
                })
                ->addColumn('status', function ($model) {
                    if($model->status == 1){
                        $str = '<span class="badge bg-warning">Menunggu Dibayar</span>';
                    }elseif($model->status == 2){
                        $str = '<span class="badge bg-info">Sudah Dibayar</span>';
                    }elseif($model->status == 3){
                        $str = '<span class="badge bg-success">Terdaftar</span>';
                    }
                    return $str;
                })
                ->addColumn('action', function ($model) {
                    if($model->proof_of_payment == null && $model->status != 3){
                        $btn = '<button type="button" id="addPayment" class="btn btn-success btn-sm" value="' . $model->id . '"><i class="fas fa-money-check-dollar"></i></button>';
                    }elseif($model->proof_of_payment && $model->status == 3){
                        $btn = '<button type="button" id="detail" class="btn btn-info btn-sm" value="' . $model->id . '"><i class="fas fa-eye"></i></button>';
                        $btn = $btn . '<a href="'.route('orang-tua.anak.proof-of-payment', $model->id).'" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>';
                    }else{
                        $btn = '<button type="button" id="detail" class="btn btn-info btn-sm" value="' . $model->id . '"><i class="fas fa-eye"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.parent.tier.index');
    }

    public function payment(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'proof_of_payment' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user_exam = UserExam::find($request->id);
            if($user_exam->proof_of_payemnt != null){
                Storage::delete($user_exam->proof_of_payemnt);
            }else{
                $user_exam->update([
                    'proof_of_payment' => $request->file('proof_of_payment')->store('payment/'.$user_exam->id),
                    'status' => 2
                ]);
                return response()->json(['status' => 1, 'msg' => 'Bukti Pembayaran Berhasil Diupload']);
            }
        }
    }

    public function detail($id){
        $model = UserExam::find($id);
        return response()->json($model);
    }

    public function indexTier($id){
        $user_exams = UserExam::where('child_id', $id)->where('status', 3)->orderBy('tier_id', 'ASC')->get();
        $user = User::find($id);
        return view('pages.parent.grade.index', compact('user_exams', 'user'));
    }

    public function proofOfPayment($id){
        $user_exam = UserExam::with('tier', 'child', 'parent')->find($id);
        $customPaper = array(0,0,400,400);
        $pdf = Pdf::loadView('pages.parent.tier.export', compact('user_exam'))->setPaper($customPaper, 'landscape');
        return $pdf->download('Bukti Pembayaran ' . $user_exam->tier->name . ' (' . Carbon::now()->translatedFormat('l, d F Y H:i:s') . ')' . '.pdf');
    }
}
