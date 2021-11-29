<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Log;
use Auth;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // 이름	20	필수	한글, 영문 대소문자만 허용
        //별명	30	필수	영문 소문자만 허용
        //비밀번호	최소 10자 이상	필수	영문 대문자, 영문 소문자, 특수 문자, 숫자 각 1개 이상씩 포함
       // 전화번호	20	필수	숫자
       // 이메일	100	필수	이메일 형식
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:1|max:20|alpha|string',
            'nickname' => 'required|min:1|max:30|unique:users|string',
            'password' => 'required|min:10|max:30|string',
            'email' => 'required|max:100|email|unique:users',
            'phone' => 'required|digits:11'
        ]);
       

        if( $validation->fails() ) {
            return response()->json(['result'=>'N','message'=> '회원가입 정보 유효성 실패', 'errors' => $validation->errors()], 400,[],JSON_UNESCAPED_UNICODE);
        }else{
                 
            if(preg_match("/[^a-z]/i", $request->nickname)||!ctype_lower($request->nickname)) { 
                return response()->json(['result'=>'N','message'=> '회원가입 정보 유효성 실패', 'errors' => ['nickname'=>'별명은 소문자만 가능합니다.']], 400,[],JSON_UNESCAPED_UNICODE);
            }
            
            if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['result'=>'N','message'=> '회원가입 정보 유효성 실패', 'errors' => ['email'=>'이메일 형식 오류.']], 400,[],JSON_UNESCAPED_UNICODE);
            }
            if(preg_match('/[0-9]/u', $request->password)<1 || preg_match('/[A-Z]/u', $request->password)<1 ||
            preg_match('/[a-z]/u', $request->password)<1 || preg_match("/[\!\@\#\$\%\^\&\*]/u", $request->password)<1 ){
                return response()->json(['result'=>'N','message'=> '회원가입 정보 유효성 실패', 'errors' => ['password'=>'비밀번호 유효성 실패']], 400,[],JSON_UNESCAPED_UNICODE);
            }
        }

        $param = $request->only([
            'name', 'nickname', 'password', 'phone', 'email', 'gender'
        ]);
        $param['password'] = bcrypt($request->password);
        try{
            $user = User::create($param);
            Log::debug($user->toArray());
            if(!isset($user)|| $user->id<1) return response()
            ->json(['result'=>'N', 'message' => '회원 저장에 실패하였습니다.' ], 400,[],JSON_UNESCAPED_UNICODE);
        }catch(Exception $e){
            return response()
                ->json(['result'=>'N', 'message' => '회원 저장에 실패하였습니다.' ], 500,[],JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['data'=>['id'=>$user->id],'result'=>'Y'],201,[],JSON_UNESCAPED_UNICODE);   
    }

    public function login(Request $request) {
        $params = $request->only([ 'email', 'password' ]);
        if( Auth::attempt($params) ) {
            $user = User::where( 'email', $params[ 'email' ] )->first();
            $token = $user->createToken(env('APP_KEY'));
            return response()->json( [
                'user' => $user,
                'token' => $token->plainTextToken,
                'result'=>'Y'
            ],202 ,[],JSON_UNESCAPED_UNICODE);
        }
        else {
            return response()->json( ['message' => '로그인 정보를 확인하세요','result'=>'N'], 401 ,[],JSON_UNESCAPED_UNICODE);
        }
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        //$request->user()->currentAccessToken()->delete();

        return response()->json( ['message' => '로그인 아웃이 완료되었습니다.','result'=>'Y'], 200 ,[],JSON_UNESCAPED_UNICODE);
    }
}
