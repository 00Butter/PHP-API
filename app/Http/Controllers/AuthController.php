<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 이름	20	필수	한글, 영문 대소문자만 허용
        //별명	30	필수	영문 소문자만 허용
        //비밀번호	최소 10자 이상	필수	영문 대문자, 영문 소문자, 특수 문자, 숫자 각 1개 이상씩 포함
       // 전화번호	20	필수	숫자
       // 이메일	100	필수	이메일 형식
        $validation = $request -> validate([
            'name' => 'required|min:1|max:20|alpha|string',
            'nickname' => 'required|min:1|max:30|unique:users|string',
            'password' => 'required|min:10|max:30|confirmed',
            'email' => 'required|max:100|email',
            'phone' => 'required|digits:value11'
        ]);

        if( $validator->fails() ) {
            return response()->json(['message'=> '회원가입 정보 유효성 실패', 'errors' => $validator->errors()], 422);
        }else{
   
            if(preg_match('/[0-9]/u', $validation['password'])<1 || preg_match('/[A-Z]/u', $validation['password'])<1 ||
            preg_match('/[a-z]/u', $validation['password'])<1 || preg_match("/[\!\@\#\$\%\^\&\*]/u", $validation['password'])<1 ){
                return response()->json(['message'=> '회원가입 정보 유효성 실패', 'errors' => '비밀번호 유효성 실패'], 422);
            }
        }

        $param = $request->only([
            'name', 'nickname', 'password', 'phone', 'email', 'gender'
        ]);
        $param['password'] = bcrypt($validation['password']);
        $user = User::create($param);

        return response()->json($user);   
    }

    public function login(Request $request) {
        $params = $request->only([ 'email', 'password' ]);
        if( Auth::attempt($params) ) {
            $user = User::where( 'email', $params[ 'email' ] )->first();
            $token = $user->createToken(env('APP_KEY'));
            return response()->json( [
                'user' => $user,
                'token' => $token->plainTextToken,
            ] );
        }
        else {
            return response()->json( ['message' => '로그인 정보를 확인하세요'], 400 );
        }
    }

    public function logout(Request $request) {
        Auth::logout();
    }
}
