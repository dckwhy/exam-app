<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Tier;
use App\Models\TryOut;
use App\Models\UserExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $count_student = UserExam::where('status', 3)->count();
            $count_tier = Tier::where('status', 1)->count();
            $count_try_out = TryOut::where('status', 1)->count();
            return view('pages.admin.dashboard.index', compact('count_student','count_tier','count_try_out'));
        }
        if ($user->role == 'parent') {
            $count_child = Student::where('oldster_id', Auth::user()->oldster->id)->count();
            $count_payment_pending = UserExam::where('parent_id', Auth::user()->id)->where('status', 2)->count();
            return view('pages.parent.dashboard.index', compact('user', 'count_child', 'count_payment_pending'));
        }
        if ($user->role == 'student') {
            $check = Hash::check(strtok($user->email, '@'), $user->password);
            return view('pages.student.dashboard.index', compact('check'));
        }
    }
}
