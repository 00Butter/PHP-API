<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Log;
use DB;

class ProductController extends Controller
{
    
    /**
     *  여러 회원 목록 조회 :
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = DB::table('users as u')->select('u.id','p.no','p.order_num', 'p.name', 'p.order_date');
        $query = $query->leftJoin("products as p", function ($join) {
            $join->on("p.no", "=", DB::raw('(select MAX(no) from products as c where c.user_id=u.id)'));
        })->orderby("id")->paginate(10);
 
        if(!isset($query)) {
            return response()
                ->json([ 'message' => '조회할 데이터가 없습니다.' ,'result'=>'N'], 204,[] ,JSON_UNESCAPED_UNICODE);
        }
        return response()->json( [ 'data'=>$query->toArray(),'result'=>'Y'] ,200,[] ,JSON_UNESCAPED_UNICODE);
    
    }

    /**
     * 단일 회원의 주문 목록 조회
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table("products")->select('no','order_num', 'name', 'order_date')
        ->where('user_id',$id)->orderby('order_date','desc')->get()->toArray();
        
        if(!isset($product)||count($product)<1) {
            return response()
                ->json([ 'message' => '조회할 데이터가 없습니다.','result'=>'N' ], 204,[] ,JSON_UNESCAPED_UNICODE);
        }
        return response()->json( ['data'=>$product ,'result'=>'Y'] ,200,[] ,JSON_UNESCAPED_UNICODE);
    }


    /**
     *  여러 회원 목록 조회 :
     *
     * @param  string  $search
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
         $query = DB::table('users as u')->select('u.id','u.name','p.no','p.order_num', 'p.name', 'p.order_date');
         $query = $query->leftJoin("products as p", function ($join) {
             $join->on("p.no", "=", DB::raw('(select MAX(no) from products as c where c.user_id=u.id)'));
         })->where('u.name',$search)->orwhere('u.email',$search)->orderby("id")->paginate(10);
  
         if(!isset($query)) {
             return response()
                 ->json([ 'message' => '조회할 데이터가 없습니다.' ,'result'=>'N' ], 204,[] ,JSON_UNESCAPED_UNICODE);
         }
         return response()->json([ 'data'=>$query->toArray(),'result'=>'Y' ],200,[] ,JSON_UNESCAPED_UNICODE);
     
    }
}
