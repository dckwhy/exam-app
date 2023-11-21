<?php

namespace App\Http\Controllers\Parent;

use App\Models\Tier;
use App\Models\Result;
use App\Models\TryOut;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TryOutController extends Controller
{
    public function indexTryOut($child_id, $id){
        $tier = Tier::find($id);
        $try_outs = TryOut::where('tier_id', $id)->where('status', 1)->get();
        $id = $child_id;
        return view('pages.parent.grade.try-out', compact('tier', 'try_outs', 'id'));
    }

    public function indexGrade($child_id, $tier_id, $try_out_id){
        $try_out = TryOut::find($try_out_id);
        $results = Result::where('try_out_id', $try_out_id)->where('user_id', $child_id)->get();
        $id = $child_id;
        return view('pages.parent.grade.detail', compact('try_out', 'results','id'));
    }

    public function export($child_id, $tier_id, $try_out_id){
        $try_out = TryOut::find($try_out_id);
        $results = Result::where('try_out_id', $try_out_id)->where('user_id', $child_id)->get();
        $user = User::find($child_id);
        $pdf = Pdf::loadview('pages.parent.grade.export', compact('try_out', 'results', 'user'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('Laporan Nilai ' . $try_out->name . ' ' . $user->name . ' - ' . Carbon::now()->translatedFormat('d F Y') . '.pdf');
    }
}
