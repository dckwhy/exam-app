<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.admin.profile.index', compact('user'));
    }

    public function edit($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', Rule::unique('users', 'name')->ignore($request->id, 'id')],
                'email' => ['required', Rule::unique('users', 'email')->ignore($request->id, 'id')],
                'photo' => 'image|mimes:jpg,jpeg,png|max:5120',
            ]
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
        $user->save();
        return response()->json([
            'status' => 1,
            'msg' => 'Profile Berhasil Diubah!'
        ]);
    }
}
