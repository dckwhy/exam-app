<?php

namespace App\Http\Controllers\Parent;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ParentStudent;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Oldster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.parent.profile.index', compact('user'));
    }

    public function edit($id)
    {
        $data = Oldster::with('user')->find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', Rule::unique('users', 'name')->ignore($request->id, 'id')],
                'email' => ['required', Rule::unique('users', 'email')->ignore($request->id, 'id')],
                'phone' => 'required|string|max:13',
                'address' => 'required',
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
        $oldster = Oldster::where('user_id', $user->id)->first();
        $oldster->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $user->save();
        return response()->json([
            'status' => 1,
            'msg' => 'Profile Berhasil Diubah!'
        ]);
    }
}
