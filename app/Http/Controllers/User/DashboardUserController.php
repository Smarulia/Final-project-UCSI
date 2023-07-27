<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookingPAL;
use App\Models\BookingRoom;
use App\Models\Date;
use App\Models\Jurusan;
use App\Models\Major;
use App\Models\PAL;
use App\Models\Room;
use App\Models\Times;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function index()
    {
        $bookingRooms = BookingRoom::join('rooms', 'booking_rooms.room_id', '=', 'rooms.id')
            ->where('booking_rooms.id_users', Auth::user()->id)
            ->whereIn('booking_rooms.status', ['Approve','Pending'])
            ->join('users', 'booking_rooms.id_users', '=', 'users.id')
            ->select('booking_rooms.*', 'rooms.nama_room', 'users.id_student')
            ->get();

        // dd($bookingRooms);

        $rooms = [];
        // dd($bookingRooms);
        foreach ($bookingRooms as $bookingRoom) {

            $times = Times::where('id', $bookingRoom->time_id)->first();
            $room = [
                "id_student" => $bookingRoom->id_student,
                "namaRoom" => $bookingRoom->nama_room,
                "time" => $times->time,
                "status" => $bookingRoom->status,
                "id" => $bookingRoom->id,
            ];

            array_push($rooms, $room);
        }

        $compactData = [
            'rooms' => $rooms
        ];
        return view('user.room', $compactData);
    }

    function editBookingRoom($roomId)
    {
        $rooms = Room::all();
        $dates = Date::all();
        $availableTimes = [];

        foreach ($rooms as $room) {
            $times = Times::all();
            $bookedTimes = explode(',', $room->booked_time_id);
            foreach ($times as $time) {
                if (!in_array($time->id, $bookedTimes)) {

                    try {
                        $timeDb = Times::select('time', 'id')->where('id', $time->id)->first();
                        array_push($availableTimes, [
                            'id' => $timeDb->id,
                            'name' => $timeDb->time
                        ]);
                    } catch (Exception) {
                    }
                }
            }
        }

        $compactData = [
            'roomId' => $roomId,
            'rooms' => $rooms,
            'times' => $availableTimes,
            'dates' => $dates
        ];
        return view('user.edit_booking_room', $compactData);
    }



    function postEditBookingRoom(Request $request, $roomId)
    {
        $nama_users = $request->name;
        $room_id = $request->roomId;
        $time_id = $request->selectedTime;
        $date = $request->date;
        $status = "pending";

        $rooms = Room::where('id', $room_id)->first();

        $update = BookingRoom::where('id', $roomId)->update([
            'nama_users' => $nama_users,
            'time_id' => $time_id,
            'nama_room' => $room_id,
            'date' => $date,
            'status' => $status
        ]);

        $update_time = DB::table('booked_time_rooms')->where('room_id', $roomId)->update([
            'time_id' => $time_id,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Edit booking room successfully!');
    }


    public function indexPal()
    {
        $bookingPals = BookingPAL::select('booking_pals.*', 'pals.nama_pal', 'pals.nama_pal', 'pals.handphone_pal')
            ->join('pals', 'booking_pals.pal_id', 'pals.id')
            ->whereIn('booking_pals.status', ['Approve','Pending'])
            ->where('booking_pals.id_users', Auth::user()->id)
            ->get();
        $compactData = [
            "pals" => $bookingPals
        ];
        // dd($bookingPals);

        return view('user.pal', $compactData);
    }

    public function getBookingRoomTimeById(Request $request)
    {
        $roomId = $request->roomId;

        if (empty($roomId)) {
            return [
                "status" => false,
                "message" => "param roomId required",
                "data" => []
            ];
        }

        $room = Room::where('id', $roomId)->first();

        // check date if date date now
        $checkDate = Date::where('date', date('Y-m-d'))->first();

        if (empty($room)) {
            return [
                "status" => false,
                "message" => "Room not found!",
                "data" => []
            ];
        }

        if ($checkDate) {
            return [
                "status" => false,
                "message" => "Date not found!",
                "data" => []
            ];
        }
        $times = Times::all();
        $availableTimes = [];
        $bookedTimes = [];
        $bookedTimeRooms = DB::table('booked_time_rooms')->where('room_id', $roomId)->get();
        // dd($bookedTimeRooms);
        foreach ($bookedTimeRooms as $booked) {
            array_push($bookedTimes, $booked->time_id);
            // dd($booked->id);
        }

        foreach ($times as $time) {
            if (!in_array($time->id, $bookedTimes)) {
                try {
                    $timeDb = Times::select('time', 'id')->where('id', $time->id)->first();
                    array_push($availableTimes, [
                        'id' => $timeDb->id,
                        'name' => $timeDb->time
                    ]);
                } catch (Exception) {
                }
            }
        }

        return [
            "status" => true,
            "message" => "Get available time successfully",
            "data" => $availableTimes
        ];
    }

    public function getPalsByMajorId(Request $request)
    {
        $majorId = $request->id;

        if (empty($majorId)) {
            return [
                "status" => false,
                "message" => "param major id required",
                "data" => []
            ];
        }

        // where major id == majorId and status == null

        $pals = PAL::where('major_id', $majorId)->where('status', null)->get();
        // dd($pals);
        if (count($pals) <= 0) {
            return [
                "status" => false,
                "message" => "empty pals no data!",
                "data" => []
            ];
        }
        return [
            "status" => true,
            "message" => "Get pal successfully",
            "data" => $pals
        ];
    }

    public function getBookingPalTimeByPalId(Request $request)
    {
        $palId = $request->id;

        if (empty($palId)) {
            return [
                "status" => false,
                "message" => "param palId required",
                "data" => []
            ];
        }

        $pal = Pal::where('id', $palId)->first();

        if (empty($pal)) {
            return [
                "status" => false,
                "message" => "pal id not found!",
                "data" => []
            ];
        }
        $times = Times::all();

        if (count($times) <= 0) {
            return [
                "status" => false,
                "message" => "time is empty!",
                "data" => []
            ];
        }
        $availableTimes = [];

        $bookedTimes = [];
        $bookedTimeRooms = DB::table('booked_time_pals')->where('pal_id', $palId)->get();

        foreach ($bookedTimeRooms as $booked) {
            array_push($bookedTimes, $booked->time_id);
        }

        // checking all time
        foreach ($times as $time) {
            if (!in_array($time->id, $bookedTimes)) {
                try {
                    $timeDb = Times::select('time', 'id')->where('id', $time->id)->first();
                    array_push($availableTimes, [
                        'id' => $timeDb->id,
                        'name' => $timeDb->time
                    ]);
                } catch (Exception) {
                }
            }
        }

        return [
            "status" => true,
            "message" => "Get available pal time successfully",
            "data" => $availableTimes
        ];
    }

    public function booking_room()
    {
        $rooms = Room::where('status', null)->get();
        $dates = Date::all();
        $availableTimes = [];

        // get all rooms
        foreach ($rooms as $room) {
            $times = Times::all();
            $bookedTimeRooms = DB::table('booked_time_rooms')->where('room_id', $room->id)->get();
            $bookedTimes = [];

            foreach ($bookedTimeRooms as $booked) {
                array_push($bookedTimes, $booked->time_id);
            }

            foreach ($times as $time) {
                if (!in_array($time->id, $bookedTimes)) {
                    try {
                        $timeDb = Times::select('time', 'id')->where('id', $time->id)->first();

                        array_push($availableTimes, [
                            'id' => $timeDb->id,
                            'name' => $timeDb->time
                        ]);
                    } catch (Exception $e) {
                    }
                }
            }
        }

        // dd($availableTimes);
        $compactData = [
            "rooms" => $rooms,
            "availableTimes" => $availableTimes
        ];
        // dd($compactData);
        return view('user.booking_room', $compactData);
    }



    public function post_booking_room(Request $request)
    {
        $roomDb = Room::where('id', $request->roomId)->first();

        if (!empty($roomDb)) {
            $room = new BookingRoom();
            $room->time_id = $request->selectedTime;
            $room->room_id = $request->roomId;
            $room->nama_room = $roomDb->nama_room;
            $room->status = "PENDING";
            $room->nama_users = $request->name;
            $room->date = $request->date;
            $room->id_users = Auth::user()->id;

            $room->save();

            $roomDb = Room::where('id', $request->roomId)->first();

            if (!empty($roomDb)) {

                DB::table('booked_time_rooms')->insert([
                    "room_id" => $request->roomId,
                    "booking_room_id" => $room->id,
                    "time_id" => $request->selectedTime
                ]);
            }
            return redirect()->route('user.dashboard');
        }
    }

    public function bookingPal()
    {
        $dates = Date::all();
        $time = Times::select('time', 'id')->get();
        $pals = PAL::where('status', null)->get();
        $majors = Major::all();
        $availableTimes = [];


        // get all rooms
        // foreach ($pals as $pal) {
        //     $times = Times::all();
        //     $bookedTimes = [];
        //     $bookedTimeRooms = DB::table('booked_time_pals')->where('pal_id', $pal->id)->get();

        //     foreach($bookedTimeRooms as $booked) {
        //         array_push($bookedTimes, $booked->time_id);
        //     }
        //     // checking all time
        //     foreach ($times as $time) {
        //         if(!in_array($time->id, $bookedTimes)) {
        //             try {
        //                 $timeDb = Times::select('time', 'id')->where('id', $time->id)->first();

        //                 array_push($availableTimes, [
        //                     'id' => $timeDb->id,
        //                     'name' => $timeDb->time
        //                 ]);
        //             } catch(Exception $e) {
        //             }
        //         }
        //     }
        // }

        $compactData = [
            "pals" => $pals,
            "dates" => $dates,
            "majors" => $majors
        ];


        return view('user.booking_pal', $compactData);
    }

    public function postBookingPal(Request $request)
    {
        $bookingPal = new BookingPAL();

        $time = Times::where('id', $request->time_id)->first();
        // $bookingPal->time = $time->time;
        $bookingPal->major_id = $request->major_id;
        $bookingPal->pal_id = $request->pal_id;
        $bookingPal->status = "pending";
        $bookingPal->nama_users = $request->name;
        $bookingPal->id_users = Auth::user()->id;
        $bookingPal->save();

        $roomDb = Pal::where('id', $request->pal_id)->first();
        return redirect()->route('user.pal');
    }

    function cancelPal(Request $request)
    {
        $bookingPal = BookingPAL::where('id', $request->id)->first();
        $bookingPal->delete();
        return redirect()->route('user.pal');
    }

    function cancelRoom(Request $request)
    {
        $bookingRoom = BookingRoom::where('id', $request->id)->first();
        $hapus_time = DB::table('booked_time_rooms')->where('booking_room_id', $request->id)->delete();
        $bookingRoom->delete();
        return redirect()->back();
    }

    function editBookingPal($palId, Request $request)
    {
        $pal_request = BookingPAL::where('id', $palId)->first();
        $pals = PAL::all();
        $majors = Major::all();

        return view('user.edit_booking_pal', compact('pal_request', 'pals', 'majors'));
    }
    function postEditBookingPal($palId, Request $request)
    {
        $pal = BookingPAL::find($palId);
        $pal->pal_id = $request->pal_id;
        $pal->major_id = $request->major_id;
        $pal->status = "Pending";
        // dd($pal);
        $pal->save();
        return redirect()->route('user.pal');
    }

    function changePassword()
    {
        return view('user.change_password');
    }

    function postChangePassword(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:2',
            'repeat_password' => 'required|same:new_password'
        ]);
        // Logika untuk memperbarui password
        $user = Auth::user(); // Mengambil data user yang sedang login

        // Memeriksa apakah old password yang dimasukkan benar
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak cocok.');
        }

        // Memperbarui password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.pal')->with('success', 'Password berhasil diperbarui.');
    }

    function history()
    {
        $bookingRooms = BookingRoom::join('rooms', 'booking_rooms.room_id', '=', 'rooms.id')
            ->where('booking_rooms.id_users', Auth::user()->id)
            ->whereIn('booking_rooms.status', ['done','reject'])
            ->join('users', 'booking_rooms.id_users', '=', 'users.id')
            ->join('times', 'booking_rooms.time_id', '=', 'times.id')
            ->select('booking_rooms.*', 'rooms.nama_room', 'users.id_student', 'times.time')
            ->get();

        $bookingPal = BookingPAL::join('pals', 'booking_pals.pal_id', '=', 'pals.id')
            ->where('booking_pals.id_users', Auth::user()->id)
            ->where('booking_pals.status', 'done')
            ->join('users', 'booking_pals.id_users', '=', 'users.id')
            ->join('majors', 'majors.id', '=', 'pals.major_id')
            ->select('booking_pals.*', 'pals.nama_pal', 'users.id_student', 'pals.handphone_pal', 'majors.name')
            ->get();

            // dd($bookingPal);
       
        return view('user.history', compact('bookingRooms', 'bookingPal'));
    }
}
