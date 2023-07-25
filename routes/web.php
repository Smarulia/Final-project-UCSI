<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PalAdminController;
use App\Http\Controllers\Admin\RoomAdminController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\Admin\DashboardAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login-admin', [LoginController::class, 'loginAdmin'])->name('admin.login');
Route::post('/login-admin-post', [LoginController::class, 'postLoginAdmin'])->name('admin.post.login');

Route::get('/register-admin', [RegisterController::class, 'register_admin'])->name('admin.register');
Route::post('/register-admin-post', [RegisterController::class, 'register_admin_post'])->name('admin.register.post');

Route::get('/login', [LoginController::class, 'loginUser'])->name('user.login');
Route::post('/login', [LoginController::class, 'postLoginUser'])->name('user.post.login');
Route::get('/register-user', [RegisterController::class, 'register_user'])->name('user.register');
Route::post('/register-user-post', [RegisterController::class, 'register_user_post'])->name('user.register.post');

Route::get('/login-lucture', [LoginController::class, 'loginLucture'])->name('lucture.login');
Route::post('/login-lucture-post', [LoginController::class, 'postLoginLucture'])->name('lucture.post.login');

Route::get('/register-lucture', [RegisterController::class, 'register_lucture'])->name('lucture.register');
Route::post('/register-lucture-post', [RegisterController::class, 'register_lucture_post'])->name('lucture.register.post');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('/admin')->middleware('admin')->group(function(){
    Route::get('/room', [RoomAdminController::class, 'ruangan_index'])->name('admin.ruangan');
    Route::get('/add-room', [RoomAdminController::class, 'ruangan_add'])->name('admin.ruangan.add');
    Route::post('/add-room', [RoomAdminController::class, 'post_ruangan_add'])->name('admin.ruangan.post.add');
    Route::get('/add-time', [RoomAdminController::class, 'ruangan_add_time'])->name('admin.ruangan.add.time');
    Route::post('/add-time', [RoomAdminController::class, 'post_ruangan_add_time'])->name('admin.ruangan.post.add.time');
    Route::get('/pal', [PalAdminController::class, 'pal_index'])->name('admin.pal');
    Route::get('/add-pal', [PalAdminController::class, 'pal_add'])->name('admin.pal.add');
    Route::post('/add-pal', [PalAdminController::class, 'post_pal_add'])->name('admin.pal.post.add');
    Route::get('/jurusan', [PalAdminController::class, 'jurusan_index'])->name('admin.jurusan');
    Route::post('/add-jurusan', [PalAdminController::class, 'post_add_jurusan'])->name('admin.jurusan.post.add');
    Route::get('/request-room', [RoomAdminController::class, 'request_room'])->name('admin.request.room');
    Route::get('/request-pal', [PalAdminController::class, 'request_pal'])->name('admin.request.pal');
    
    Route::post('/request-pal-approve', [PalAdminController::class, 'request_pal_approve'])->name('admin.request.pal.approve');
    Route::post('/request-pal-reject', [PalAdminController::class, 'request_pal_reject'])->name('admin.request.pal.reject');
    Route::post('/request-pal-done', [PalAdminController::class, 'request_pal_done'])->name('admin.request.pal.done');

    Route::post('/request-room-approve', [RoomAdminController::class, 'request_room_approve'])->name('admin.request.room.approve');
    Route::post('/request-room-reject', [RoomAdminController::class, 'request_room_reject'])->name('admin.request.room.reject');
    Route::post('/request-room-done', [RoomAdminController::class, 'request_room_done'])->name('admin.request.room.done');


    

    // edit room and pal
    Route::get('/edit-room/{roomId}', [RoomAdminController::class, 'editRoom'])->name('admin.edit.room');
    Route::post('/edit-room/{roomId}', [RoomAdminController::class, 'postEditRoom'])->name('admin.post.edit.room');
    // hide room
    Route::get('/hide-room/{roomId}', [RoomAdminController::class, 'hideRoom'])->name('admin.hide.room');
    Route::get('/visible-room/{roomId}', [RoomAdminController::class, 'visibleRoom'])->name('admin.visible.room');

    Route::get('/hide-pal/{palId}', [PalAdminController::class, 'hidePal'])->name('admin.hide.pal');
    Route::get('/visible-pal/{palId}', [PalAdminController::class, 'visiblePal'])->name('admin.visible.pal');
    
    Route::get('/edit-pal/{palId}', [PalAdminController::class, 'editPal'])->name('admin.edit.pal');
    Route::post('/edit-pal/{palId}', [PalAdminController::class, 'postEditPal'])->name('admin.post.edit.pal');

    Route::get('/change-password', [RoomAdminController::class, 'changePassword'])->name('admin.change.password');
    Route::post('/change-password', [RoomAdminController::class, 'postChangePassword'])->name('admin.post.change.password');

    Route::get('/history', [RoomAdminController::class, 'history'])->name('admin.history');


});

Route::prefix('/user')->middleware('auth')->group(function(){
    Route::get('/room', [DashboardUserController::class, 'index'])->name('user.dashboard');
    Route::get('/pal', [DashboardUserController::class, 'indexPal'])->name('user.pal');
    Route::get('/booking-room', [DashboardUserController::class, 'booking_room'])->name('user.booking.room');
    Route::post('/booking-room', [DashboardUserController::class, 'post_booking_room'])->name('user.post.booking.room');
    Route::get('/edit-booking-room/{roomId}', [DashboardUserController::class, 'editBookingRoom'])->name('user.edit.booking.room');
    Route::post('/edit-booking-room/{roomId}', [DashboardUserController::class, 'postEditBookingRoom'])->name('user.post.edit.booking.room');
    Route::get('/booking-pal', [DashboardUserController::class, 'bookingPal'])->name('user.booking.pal');
    Route::post('/booking-pal', [DashboardUserController::class, 'postBookingPal'])->name('user.post.booking.pal');
    // edit pal 
    Route::get('/edit-booking-pal/{palId}', [DashboardUserController::class, 'editBookingPal'])->name('user.edit.booking.pal');
    Route::post('/edit-booking-pal/{palId}', [DashboardUserController::class, 'postEditBookingPal'])->name('user.post.edit.booking.pal');

    Route::get('times/{roomId}', [DashboardUserController::class, 'getBookingRoomTimeById']);
    Route::get('pal/times', [DashboardUserController::class, 'getBookingPalTimeByPalId']);
    Route::get('pal/major', [DashboardUserController::class, 'getPalsByMajorId']);

    // cancel pal and room button
    Route::post('/cancel-pal', [DashboardUserController::class, 'cancelPal'])->name('user.cancel.pal');
    Route::post('/cancel-room', [DashboardUserController::class, 'cancelRoom'])->name('user.cancel.room');

    // reset password
    Route::get('/change-password', [DashboardUserController::class, 'changePassword'])->name('user.change.password');
    Route::post('/change-password', [DashboardUserController::class, 'postChangePassword'])->name('user.post.change.password');

    // history
    Route::get('/history', [DashboardUserController::class, 'history'])->name('user.history');
});