<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\LogPrice;
use App\Models\Student;
use App\Models\TryOut;
use App\Models\UserExam;
use Illuminate\Support\Facades\Validator;

class TierController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $model = Tier::all();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('price', function($model){
                    return 'Rp. ' . number_format($model->price, 0);
                })
                ->addColumn('status', function ($model) {
                    if($model->status == 1){
                        $btn = '<a  class="btn btn-sm btn-success mx-1 disabled"><i class="fa fa-check"></i></a>';
                        $btn = $btn . '<a href="'.route('admin.tingkat.deactivate', $model->id).'" class="btn btn-sm btn-danger mx-1"><i class="fa fa-times"></i></a>';
                    }else{
                        $btn = '<a href="'.route('admin.tingkat.activate', $model->id).'" class="btn btn-sm btn-success mx-1"><i class="fa fa-check"></i></a>';
                        $btn = $btn . '<a class="btn btn-sm btn-danger mx-1 disabled"><i class="fa fa-times"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" id="edit" class="btn btn-warning btn-sm" value="' . $model->id . '"><i class="fa fa-edit"></i></button>';
                    // $btn = $btn . '<button type="button" id="delete" class="btn btn-danger btn-sm" value="' . $model->id . '"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.admin.tier.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'price' => 'required',
                'reason' => 'required'
            ],
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $tier = Tier::find($request->id);
            $query =  Tier::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'price' => $request->price,
                ]
            );
            if ($query) {
                $logprice = new LogPrice();
                $logprice->old_price = $tier->price;
                $logprice->new_price = $request->price;
                $logprice->reason = $request->reason;
                $logprice->tier_id = $request->id;
                $logprice->save();
                return response()->json(['status' => 1, 'msg' => 'Data Berhasil Disimpan']);
            }
        }
    }

    public function edit($id)
    {
        $tier = Tier::find($id);
        return response()->json($tier);
    }

    public function destroy($id)
    {
        $try_out = TryOut::where('tier_id', $id)->first();
        if($try_out){
            return response()->json(['error' => 'Tidak bisa menghapus data tingkat, dikarenakan data ini memiliki relasi di data Try Out']);
        }else{
            Tier::find($id)->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }
    }

    public function activate($id){
        $query = Tier::find($id);
        if($query){
            $query->update([
                'status' => 1
            ]);
            return redirect()->route('admin.tingkat.index')->with(['success' => 'Tingkatan Berhasil Diaktifkan']);
        }
    }

    public function deactivate($id){
        $query = Tier::find($id);
        if($query){
            $query->update([
                'status' => 0
            ]);
            return redirect()->route('admin.tingkat.index')->with(['success' => 'Tingkatan Berhasil Dinonaktifkan']);
        }
    }

    public function registered(){
        if (request()->ajax()) {
            $model = UserExam::where('status', 2)->orWhere('status', 3)->orderBy('tier_id','ASC')->get();
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
                    if($model->status == 2){
                        $str = '<span class="badge bg-warning">Menunggu Validasi</span>';
                    }elseif($model->status == 3){
                        $str = '<span class="badge bg-success">Tervalidasi</span>';
                    }
                    return $str;
                })
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" id="detail" class="btn btn-info btn-sm" value="' . $model->id . '"><i class="fas fa-eye"></i></button>';
                    if($model->status !=3){
                        $btn = $btn.'<button type="button" id="agreed" class="btn btn-success btn-sm" value="' . $model->id . '"><i class="fas fa-check"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.admin.tier.registered');
    }

    public function financial(){
        if (request()->ajax()) {
            $model = UserExam::where('status', 3)->orderBy('tier_id','ASC')->get();
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
                ->addColumn('period', function ($model) {
                    return $this->bulan(date('n', strtotime($model->created_at)));
                })
                ->make(true);
        }
        $students = Student::all();
        $tiers = Tier::all();
        return view('pages.admin.financial.index', ['students' => $students, 'tiers'=> $tiers]);
    }

    public function detail($id){
        $model = UserExam::find($id);
        return response()->json($model);
    }

    public function agreed($id){
        $query = UserExam::find($id);
        $query->update([
            'status' => 3
        ]);
        if($query){
            return response()->json(['success' => 'Pembayaran Berhasil Tervalidasi']);
        }
    }

    public function indexTier(){
        if (request()->ajax()) {
            $model = Tier::where('status', 1)->get();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return '<a href="'. route('admin.tingkat.try-out', $model->id).'" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.admin.grade.tier');
    }

    public function historyTier(){
        if (request()->ajax()) {
            $model = LogPrice::all();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('old_price', function ($model) {
                    return 'Rp. ' .number_format($model->old_price, 0);
                })
                ->addColumn('new_price', function ($model) {
                    return 'Rp. ' .number_format($model->new_price, 0);
                })
                ->addColumn('tier', function ($model) {
                    return $model->tier->name;
                })
                ->addColumn('updated_at', function ($model) {
                    return date('d-m-Y H:i:s', strtotime($model->tier->updated_at));
                })
                ->make(true);
        }
        return view('pages.admin.history.index');
    }

    public function bulan($month){
        $months = ['','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return $months[$month];
    }
}
