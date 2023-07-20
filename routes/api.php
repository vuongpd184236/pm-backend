<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ProjectController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum', 'verified')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/test-midd/search/{title}', function ($title) {
        return $title;
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/test', function () {
        return "12345";
    });
    Route::get('/member_workspace', [UserController::class,'getAllUserInWorkspace']);
    Route::get('/my_profile', [UserController::class,'getProfile']);
    Route::post('/update_profile', [UserController::class,'updateProfile']);
    Route::post('/update_member/{id}', [UserController::class,'updateMemberProfile']);
    //workspace
    Route::post('/workspace', [WorkspaceController::class, 'create']);
    Route::get('/workspace/{id}', [WorkspaceController::class, 'show']);
    Route::post('/workspace/{id}', [WorkspaceController::class, 'edit']);
    //project
    Route::post('/project', [ProjectController::class, 'create']);
    Route::post('/add_member_to_project', [ProjectController::class, 'addMemberToProject']);
    Route::post('/add_list_members_to_project', [ProjectController::class, 'addListMembersToProject']);
    Route::get('/project/{id}', [ProjectController::class, 'show']);
    Route::get('/members_of_project/{id}', [ProjectController::class, 'getAllMembersOfProject']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('/verify-email/{id}/{token}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
Route::get('/delete', [UserController::class,'deleteImg']);
Route::get('/avatar/{id}', [UserController::class,'showAvatar']);
