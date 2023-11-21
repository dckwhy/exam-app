<?php

namespace App\Http\Controllers\Parent;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ParentStudent;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChildController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $model = Student::where('oldster_id', Auth::user()->oldster->id)->get();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('name', function ($model) {
                    return $model->user->name;
                })
                ->addColumn('birth', function ($model) {
                    return $model->place_of_birth . ', ' . Carbon::parse($model->date_of_birth)->translatedFormat('d F Y');
                })
                ->addColumn('gender', function ($model) {
                    return $model->gender == 'Male' ? 'Laki Laki' : 'Perempuan';
                })
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" id="edit" class="btn btn-warning btn-sm" value="' . $model->id . '"><i class="bi bi-pencil"></i></button>';
                    $btn = $btn . '<button type="button" id="delete" class="btn btn-danger btn-sm" value="' . $model->id . '"><i class="bi bi-trash-fill"></i></button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.parent.child.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($request->user_id, 'id')],
                'phone' => 'required',
                'address' => 'required',
                'school_origin' => 'required',
            ],
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = User::updateOrCreate(
                [
                    'id' => $request->user_id
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make(strtok($request->email, '@')),
                    'role' => 'student'
                ]
            );
            $query =  Student::updateOrCreate(
                [
                    'id' => $request->student_id
                ],
                [
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'school_origin' => $request->school_origin,
                    'user_id' => $user->id,
                    'oldster_id' => Auth::user()->oldster->id
                ]
            );
            if ($query) {
                return response()->json(['status' => 1, 'msg' => 'Data Berhasil Disimpan']);
            }
        }
    }

    public function edit($id)
    {
        $user = Student::with('user')->find($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->user->delete();
        $student->delete();
        return response()->json(['success' => 'Data Berhasil Dihapus']);
    }

    public function indexChild(){
        if (request()->ajax()) {
            $model = Student::where('oldster_id', Auth::user()->oldster->id)->get();
            return Datatables()
                ->of($model)
                ->addIndexColumn()
                ->addColumn('name', function($model){
                    return $model->user->name;
                })
                ->addColumn('action', function ($model) {
                    return '<a href="'.route('orang-tua.kelas.grade', $model->user->id).'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.parent.grade.index-child');
    }
}
