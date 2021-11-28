<?php


use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ping', function () {
    return response()->json(['message' => 'member']);
});

Route::get('/pong', [AppController::class, 'index']);


    
//- 회원 가입
Route::post('/register',    [AuthController::class, 'register'])    ->name('회원가입');

//- 회원 로그인(인증)
Route::post('/login',       [AuthController::class, 'login'])       ->name('로그인');

//- 회원 로그아웃
Route::middleware('auth:sanctum')->post('/logout',      [AuthController::class, 'logout'])      ->name('로그아웃');
   

//- 단일 회원 상세 정보 조회
Route::get('/user/{id}',    [UserController::class, 'show']);

//- 단일 회원의 주문 목록 조회
Route::get('/product/{id}', [ProductController::class, 'show']);

/*- 여러 회원 목록 조회 :
    - 페이지네이션으로 일정 단위로 조회합니다.
    - 이름, 이메일을 이용하여 검색 기능이 필요합니다.
    - 각 회원의 마지막 주문 정보*/
Route::get('/product', [ProductController::class, 'index']);
    


