<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function error()
    {
        //
        return response()->json( ['message' => '로그인 정보가 필요합니다','result'=>'N'], 401,[],JSON_UNESCAPED_UNICODE );
       
    }
}
