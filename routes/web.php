<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ManageDestinationController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageComments;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Visitor\BookingTicketController;
use App\Http\Controllers\Visitor\HomepageController;
use App\Http\Controllers\Visitor\ListDestinationController;
use App\Http\Controllers\Visitor\DestinationDetailController;
use App\Http\Controllers\Visitor\MyBookedTicketController;
use App\Http\Controllers\Visitor\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\MustAdminsMiddleware;
use Illuminate\Support\Facades\Route;

// Route Publik
Route::get('/', [HomepageController::class, 'index'])->name('homepage'); // Halaman utama
Route::get('/cari-wisata', [ListDestinationController::class, 'index']); // Cari tempat wisata
Route::get('/tempat-wisata/{id}', [DestinationDetailController::class, 'index'])->name('destination.detail'); // Detail tempat wisata
// Route::get('/tempat-wisata/{id}/booking/detail-tiket')->name('booking.detail-tiket'); // Detail tempat wisata
// Route::post('/tempat-wisata/{id}', [DestinationDetailController::class, 'index'])->name('destination.detail'); // Detail tempat wisata
Route::get('/api/destinations', [ListDestinationController::class, 'getDestinations']); // API untuk mendapatkan daftar destinasi
Route::post('/api/visitor-data', [VisitorController::class, 'getVisitorData']); // API untuk mendapatkan data pengunjung
Route::get('/tentangkami',function(){
return view('visitor-pages.pages.tentangkami');
} );
// testing halaman
Route::get('/kelola-wisata',function(){
return view('visitor-pages.pages.kelola-wisata');
} );


Route::get('/booking/pesanan/selesai',function(){
return view('visitor-pages.pages.booking.pesanan.selesai');
} );
Route::get('/booking/pesanan/detail-pesanan',function(){
return view('visitor-pages.pages.booking.pesanan.detail-pesanan');
} );






// Route Auth (Middleware Guest)
Route::middleware(GuestMiddleware::class)->group(function(){
    Route::get('/login', [LoginController::class, 'index'])->name('login'); // Halaman login
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate'); // Proses autentikasi login
    Route::get('/register', [RegisterController::class, 'index'])->name('register'); // Halaman pendaftaran
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store'); // Proses penyimpanan data pendaftaran
});

// Route Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); // Logout pengguna

// Route Authenticated (Middleware Auth)
Route::middleware(AuthMiddleware::class)->group(function(){
    Route::post('/tempat-wisata/{id}/ulasan', [ManageComments::class, 'store'])->name('comment.store'); // Proses penyimpanan data pendaftaran


    Route::get('/booking-tiket',[BookingTicketController::class, 'indexBookingAmount'])->name('destination.booking');
    Route::get('/booking-tiket/payment', [BookingTicketController::class, 'indexBookingPayment'])->name('destination.booking.payment');
    Route::post('/booking-tiket/payment', [BookingTicketController::class, 'processBuyTicket'])->name('destination.booking.payment.apply');

    Route::get('/booking-tiket/semua-pesanan',[MyBookedTicketController::class, 'index'])->name('booking.list');
    Route::get('/booking-tiket/detail', [MyBookedTicketController::class, 'indexDetail'])->name('booking.detail');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile'); // Halaman profil pengguna
    Route::get('/settings', [ProfileController::class, 'indexSettings'])->name('profile.settings');
    Route::put('/settings', [ProfileController::class, 'update'])->name('profile.settings.update');
});

// Route Admin (Harus Admin)
Route::middleware(MustAdminsMiddleware::class)->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard'); // Dashboard Admin
    Route::get('/admin/kelola-wisata', [ManageDestinationController::class, 'index'])->name('admin.manage.destination'); // Kelola tempat wisata
    Route::get('/admin/kelola-ulasan', [ManageComments::class, 'index'])->name('admin.manage.comment'); // Kelola ulasan
    Route::get('/admin/kategori-wisata', [CategoryController::class, 'index'])->name('admin.kategori-wisata'); // Kelola wisata
    Route::get('/admin/tempat-wisata/{id}/ubah', [DestinationController::class, 'indexEditDestination'])->name('destination.edit.show'); // Ubah tempat wisata
    Route::get('/admin/tempat-wisata/tambah', [DestinationController::class, 'indexAddDestination'])->name('destination.add.show'); // Tambah tempat wisata

    Route::delete('/admin/kelola-ulasan/{id}/hapus', [ManageComments::class, 'deleteComment'])->name('comment.destroy'); // Hapus tempat wisata

    Route::delete('/admin/tempat-wisata/{id}/hapus', [ManageDestinationController::class, 'deleteDestination'])->name('destination.destroy'); // Hapus tempat wisata
    Route::post('/admin/tempat-wisata/tambah', [DestinationController::class, 'createDestination'])->name('destination.store'); // Proses penyimpanan data tempat wisata
    Route::put('/admin/tempat-wisata/ubah', [DestinationController::class, 'updateDestination'])->name('destination.update'); // Proses penyimpanan data tempat wis

    Route::post('admin/kategori-wisata/store', [CategoryController::class, 'store'])->name('admin.kategori-wisata.store');
    Route::post('admin/kategori-wisata/update', [CategoryController::class, 'update'])->name('admin.kategori-wisata.update');
    Route::get('admin/kategori-wisata/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.kategori-wisata.destroy');

    Route::get('/admin/kelola-tiket', [TicketController::class, 'indexKelolaTiket'])->name('admin.kelola-tiket');
    Route::get('/admin/konfirmasi-tiket', [TicketController::class, 'indexKonfirmasiTiket'])->name('admin.kelola-tiket.konfirmasi');



});

// Route Manajemen Admin (Middleware Admin dengan level akses tert  entu)
Route::middleware(AdminMiddleware::class . ":1")->group(function(){
    Route::get('/admin/kelola-pengguna', [ManageUserController::class, 'index'])->name('user.manage'); // Kelola Admin
    Route::get('/admin/kelola-pengguna/ubah/{id}', [ManageUserController::class, 'indexEditUser'])->name('user.edit.show'); // Ubah admin
    Route::get('/admin/kelola-pengguna/tambah', [ManageUserController::class, 'indexCreateUser'])->name('user.create.show'); // Tambah admin
    Route::post('/admin/kelola-pengguna/tambah', [ManageUserController::class, 'store'])->name('user.create'); // Proses tambah admin
    Route::put('/admin/kelola-pengguna/ubah/{id}', [ManageUserController::class, 'update'])->name('user.update'); // Proses update admin
    Route::delete('/admin/kelola-pengguna/hapus/{id}', [ManageUserController::class, 'delete'])->name('user.destroy'); // Hapus admin
});
