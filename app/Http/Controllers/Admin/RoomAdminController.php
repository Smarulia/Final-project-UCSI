<?php

namespace App\Http\Controllers\Admin;

use App\Models\Date;
use App\Models\Room;
use App\Models\Times;
use App\Models\BookingPAL;
use App\Models\BookingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RoomAdminController extends Controller
{
    public function ruangan_add()
    {
        $times = Times::get();
        return view('admin.add_data_room', compact('times'));
    }

    function editRoom($roomId) {
        $find = Room::find($roomId);
        $room = Room::get();
        $times = Times::get();
        return view('admin.edit_room', compact('room', 'times', 'find'));
    }

    function postEditRoom(Request $request, $roomId) {
        // dd($request->all());
        $room = Room::find($roomId);
        $room->nama_room = $request->name;
        $room->update();
        return redirect()->route('admin.ruangan');
    }

    function post_ruangan_add(Request $request) {
        $room = new Room;
        $room->nama_room = $request->name;
        // $room->date = $request->date;
        $room->save();

        return redirect()->route('admin.ruangan');
    }

    function ruangan_add_time() {
        return view('admin.add_data_time');
    }

    function post_ruangan_add_time(Request $request) {
        $time = new Times;
        $time->time = $request->time;
        $time->save();

        return redirect()->route('admin.ruangan');
    }
    public function ruangan_index()
    {
        $room_data = Room::get();
        return view('admin.room', compact('room_data'));
    }
    public function request_room()
    {
        $tampilan = BookingRoom::join('rooms', 'booking_rooms.room_id', '=', 'rooms.id')
        ->join('times', 'booking_rooms.time_id', '=', 'times.id')
        ->join('users', 'booking_rooms.id_users', '=', 'users.id')
        ->whereIn('booking_rooms.status', ['approve', 'pending'])
        ->select('booking_rooms.*', 'rooms.nama_room', 'times.time','users.id_student')->get();
        // dd($tampilan);
        return view('admin.request_room', compact('tampilan'));
    }

    function request_room_approve(Request $request) {
        $approve = BookingRoom::find($request->id);
        sleep(1); 
        $approve->status = 'approve';
        $approve->save();

        // redirect back with success
        return redirect()->back()->with('success', 'Request Approved');
    }

    function request_room_reject(Request $request) {
        $reject = BookingRoom::find($request->id);
        sleep(1); 
        $hapus_time = DB::table('booked_time_rooms')->where('booking_room_id', $request->id)->delete();
        $reject->status = 'reject';
        $reject->save();
        return redirect()->back();
    }

    function request_room_done(Request $request) {
        $done = BookingRoom::find($request->id);
        $done->status = 'done';
        $hapus_time = DB::table('booked_time_rooms')->where('booking_room_id', $request->id)->delete();
        $done->save();
        return redirect()->back();
    }

    function hideRoom($roomId) {
        $room = Room::find($roomId);
        sleep(1);
        $room->status = 'hide';
        $room->update();
        return redirect()->back();
    }

    function visibleRoom($roomId) {
        $room = Room::find($roomId);
        sleep(1);
        $room->status = null;
        $room->update();
        return redirect()->back();
    }

    function changePassword() {
        return view('admin.change_password');
    }

    function postChangePassword(Request $request) {
        // dd($request->all());

            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:2',
                'repeat_password' => 'required|same:new_password'
            ]);
            // Logika untuk memperbarui password
            $user = Auth::guard('admin')->user();
            // Memeriksa apakah old password yang dimasukkan benar
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Password lama tidak cocok.');
            }
        
            // Memperbarui password baru
            $user->password = Hash::make($request->new_password);
            $user->save();
        
            return redirect()->route('admin.ruangan')->with('success', 'Password berhasil diperbarui.');
        
    }
    function history()
    {
        $bookingRooms = BookingRoom::join('rooms', 'booking_rooms.room_id', '=', 'rooms.id')
            ->whereIn('booking_rooms.status', ['done','reject'])
            ->join('users', 'booking_rooms.id_users', '=', 'users.id')
            ->join('times', 'booking_rooms.time_id', '=', 'times.id')
            ->select('booking_rooms.*', 'rooms.nama_room', 'users.id_student', 'times.time')
            ->get();

        $bookingPal = BookingPAL::join('pals', 'booking_pals.pal_id', '=', 'pals.id')
            ->whereIn('booking_pals.status', ['done','reject'])
            ->join('users', 'booking_pals.id_users', '=', 'users.id')
            ->join('majors', 'majors.id', '=', 'pals.major_id')
            ->select('booking_pals.*', 'pals.nama_pal', 'users.id_student', 'pals.handphone_pal', 'majors.name')
            ->get();
       
        return view('admin.history', compact('bookingRooms', 'bookingPal'));
    }
}
