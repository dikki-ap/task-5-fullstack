<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardMaterialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardGalleriesController;
use App\Http\Controllers\DashboardMaterialController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginStudentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterStudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

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
    return view('home', [
        "title" => "Home"
    ]);
});

// --- MATERIALS ---
// Route All Materials
Route::get('/materials', [MaterialController::class, 'index']);

// Route Detail Material
// Menggunakan Route Model Binding
Route::get('materials/{material:id}', [MaterialController::class, 'show']); // materials/{material:id} --> {material} adalah wildcard


// --- CATEGORIES ---
// Route All Categories
Route::get('/categories', [CategoryController::class, 'index']);

// Route Category by Slug
Route::get('/categories/{category:id}', [CategoryController::class, 'show']);


// --- TEACHERS ---
// Route All Teachers
Route::get('/teachers', [TeacherController::class, 'index']);

// Route Teacher by Username
Route::get('/teachers/{teacher:username}', [TeacherController::class, 'show']);


// --- TEACHER AUTHENTICATION ---
// Route Teacher Login (View)
Route::get('/login/teacher', [LoginController::class, 'login_teacher'])->name('login');

// Route Teacher Login
Route::post('/login/teacher', [LoginController::class, 'authenticate']);

// Route Teacher Logout
Route::post('/logout/teacher', [LoginController::class, 'logout']);

// Route Teacher Register (View)
Route::get('/register/teacher', [RegisterController::class, 'register_teacher'])->middleware('auth:admin');

// Route Teacher Register
Route::post('/register/teacher', [RegisterController::class, 'store'])->middleware('auth:admin');


// --- STUDENT AUTHENTICATION ---
// Route Student Login (View)
Route::get('/login/student', [LoginStudentController::class, 'login_student']);

// Route Student Login
Route::post('/login/student', [LoginStudentController::class, 'authenticate']);

// Route Student Logout
Route::post('/logout/student', [LoginStudentController::class, 'logout']);

// Route Student Register (View)
Route::get('/register/student', [RegisterStudentController::class, 'register_student']);

// Route Student Register
Route::post('/register/student', [RegisterStudentController::class, 'store']);


// --- DASHBOARD ---
// Route Dashboard Index (View)
Route::resource('/dashboard/materials', DashboardMaterialController::class)->middleware('auth:admin,teacher');

// Dashboard Category
Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth:admin,teacher');

// Route Dashboard Galleries (View)
Route::resource('/dashboard/galleries', DashboardGalleriesController::class)->middleware('auth:admin,teacher');


// --- ADMIN ---
Route::get('/admin', [AdminController::class, 'login']);

// Route Admin Login
Route::post('/login/admin', [AdminController::class, 'authenticate']);

// Route Admin Logout
Route::post('/logout/admin', [AdminController::class, 'logout']);