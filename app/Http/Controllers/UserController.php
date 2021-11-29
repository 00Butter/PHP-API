<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Log;


class UserController extends Controller
{
   
    /**
     *  단일 회원 상세 정보 조회
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = User::where('id',$id)->first();

        if(!isset($user)) {
            return response()
                ->json([ 'message' => '조회할 정보가 없습니다.','result'=>'N'], 204,[],JSON_UNESCAPED_UNICODE);
        }

        return response()->json( ['data'=>$user,'result'=>'Y'],200,[] ,JSON_UNESCAPED_UNICODE);
    }

    
}
