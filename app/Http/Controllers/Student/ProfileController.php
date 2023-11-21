<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\UserExam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $classes = UserExam::where('child_id', $user->id)->where('status', 3)->orderBy('tier_id', 'ASC')->get();
        return view('pages.student.profile.index', compact('user', 'classes'));
    }

    public function edit($id)
    {
        $data = Student::with('user')->find($id);
        return response()->json($data);
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
                'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($request->id, 'id')],
                'phone' => 'required',
                'address' => 'required',
                'school_origin' => 'required',
                'photo' => 'image|mimes:jpg,jpeg,png|max:5120',
            ],
        );
        $validator->sometimes('password', 'min:6', function ($input) {
            return !empty($input->password);
        });
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $user = User::find($request->id);
        if (empty($request->password)) {
            $user->password = $user->password;
        } else {
            $user->password = bcrypt($request->password);
        }
        if ($request->file('photo')) {
            if ($request->photo_old) {
                Storage::delete($request->photo_old);
            }
            $user->photo =  $request->file('photo')->store('photo');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $student = Student::where('user_id', $user->id)->first();
        $student->update([
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'school_origin' => $request->school_origin,
        ]);
        $user->save();
        return response()->json([
            'status' => 1,
            'msg' => 'Profile Berhasil Diubah!'
        ]);
    }
}
