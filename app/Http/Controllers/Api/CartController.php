<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request_uid = $request->query('uid');
        $carts = Cart::where('uid', '=' , $request_uid)->paginate();
        return $carts;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Cart::create([
            'uid' => $request->uid,
            'iid' => $request->iid,
            'count' =>$request->count,
        ]);
        $response = [
            'item' =>$item,
        ];
        return response($response ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $main = Cart::findOrFail($id);
        return $main;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $request_uid = $request->query('uid');
        $request_iid = $request->query('iid');
        DB::table('carts')->where([
            ['uid', '=' , $request_uid],
            ['iid', '=' , $request_iid],
        ])->delete();
        $carts = DB::table('carts')->where('uid', '=' , $request_uid)->paginate();
            $response = [
                'data' =>$carts,
            ];
            return response($response ,200);
    }
}


