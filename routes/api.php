<?php


use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::any('/error', [AppController::class, 'error'])->name('error');


    
//- 회원 가입
Route::post('/register',            [AuthController::class, 'register'])    ->name('register');

//- 회원 로그인(인증)
Route::post('/login',               [AuthController::class, 'login'])       ->name('login');

//- 회원 로그아웃
Route::group(['middleware' => 'auth:sanctum' ], function() {
    Route::post('/logout', [            AuthController::class, 'logout'])       ->name('logout');
        
    //회원만 조회가 가능한 경우가 아닌경우  위의 middleware에서 해제

    //- 단일 회원 상세 정보 조회
    Route::get('/user/{id}',            [UserController::class, 'show'])        ->name('user.show');

    //- 단일 회원의 주문 목록 조회
    Route::get('/product/user/{id}',    [ProductController::class, 'show'])     ->name('product.show');

    /*- 여러 회원 목록 조회 :
        - 페이지네이션으로 일정 단위로 조회합니다.
        - 이름, 이메일을 이용하여 검색 기능이 필요합니다.
        - 각 회원의 마지막 주문 정보*/
    Route::get('/product',              [ProductController::class, 'index'])    ->name('product.index');    
    Route::get('/product/search/{search}',     [ProductController::class, 'search'])   ->name('product.search');



} );
