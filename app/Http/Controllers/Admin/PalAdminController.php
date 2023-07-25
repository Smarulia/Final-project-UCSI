<?php

namespace App\Http\Controllers\Admin;

use App\Models\PAL;
use App\Models\Major;
use App\Models\Times;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookingPAL;
use Illuminate\Support\Facades\DB;

class PalAdminController extends Controller
{
    public function pal_index()
    {
        $pals = PAL::join('majors', 'majors.id', '=', 'pals.major_id')
            ->select('pals.*', 'majors.name')
        ->get();

        return view('admin.pal', compact('pals'));
    }
    public function pal_add()
    {
        $jurusan = DB::table('majors')->get();
        return view('admin.add_data_pal', compact('jurusan'));
    }

    function post_pal_add(Request $request)
    {
        $data = new PAL();
        $data->nama_pal = $request->name_pal;
        $data->major_id = $request->jurusan_id;
        $data->handphone_pal = $request->no_telp;
        $data->save();
        return redirect()->route('admin.pal');
    }

    public function jurusan_index()
    {
        return view('admin.add_jurusan');
    }

    function post_add_jurusan(Request $request)
    {
        $jurusan = new Major();
        $jurusan->name = $request->jurusan;
        $jurusan->save();
        return redirect()->route('admin.pal');
    }


    public function request_pal()
    {
        $tampilan = BookingPAL::join('pals', 'pals.id', '=', 'booking_pals.pal_id')
            ->join('majors', 'majors.id', '=', 'pals.major_id')
            ->join('users', 'users.id', '=', 'booking_pals.id_users')
            ->select('booking_pals.*', 'pals.nama_pal', 'majors.name','users.id_student')
            ->whereIn('booking_pals.status', ['pending', 'approved'])
            ->get();
        // dd($tampilan);
        return view('admin.request_pal', compact('tampilan'));
    }

    function request_pal_approve(Request $request)
    {
        $bookingPal = BookingPAL::where('id', $request->id)->first();
        $bookingPal->status = "approved";
        $bookingPal->save();

        return redirect()->back();
    }

    function request_pal_reject(Request $request)
    {
        $bookingPal = BookingPAL::where('id', $request->id)->first();
        $bookingPal->status = "rejected";
        $bookingPal->save();

        return redirect()->back();
    }

    function request_pal_done(Request $request) {
        $done = BookingPAL::find($request->id);
        sleep(1); 
        $done->status = 'done';
        $done->save();
        return redirect()->back();
    }

    function editPal($palId)
    {
        $pal = PAL::find($palId);
        $jurusan = DB::table('majors')->join(
            'pals',
            'pals.major_id',
            '=',
            'majors.id'
        )->where('pals.id', $palId)->select('majors.*', 'pals.*')->get();
        return view('admin.edit_pals', compact('pal', 'jurusan'));
    }

    function postEditPal(request $request, $palId)
    {
        $pal = PAL::find($palId);
        $pal->nama_pal = $request->name_pal;
        $pal->major_id = $request->jurusan_id;
        $pal->handphone_pal = $request->no_telp;
        $pal->save();
        return redirect()->route('admin.pal');   
    }
    function deletePal($palId)
    {
        $pal = PAL::find($palId);
        sleep(1);
        $pal->delete();
        return redirect()->route('admin.pal');
    }

    function hidePal($palId) {
        $pal = PAL::find($palId);
        sleep(1);
        $pal->status = 'hide';
        $pal->update();
        return redirect()->back();
    }

    function visiblePal($palId) {
        $pal = PAL::find($palId);
        sleep(1);
        $pal->status = null;
        $pal->update();
        return redirect()->back();
    }
}
