<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        $product_id = $request->pro_id; 
        $user_id = Session::get('user_id');
        if($user_id == null){
            return view('login')->with('category', $category)->with('brand', $brand);
        }
        $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
        $data = array();
        $data['product_id'] = $product_id;
        $data['user_id'] = $user_id;
        $data['product_name'] = $product->product_name;
        $data['product_price'] = $product->product_price;
        $data['product_quantity_cart'] = $request->txtSL;
        $data['product_total'] = $request->txtSL*$product->product_price;
        $data['product_image'] = $product->product_image; 
        $data['checkTT'] = '0'; 
        DB::table('tbl_cart')->insert($data);
        return Redirect::to('/show-cart');
    }
    
    public function show_cart(){
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        $user_id = Session::get('user_id');
        if($user_id == null){
            return view('login')->with('category', $category)->with('brand', $brand);
        }
        $message = Session::get('id');
        $cart = DB::table('tbl_cart')->where('checkTT', '0')->where('user_id', $user_id)->orderby('cart_id', 'desc')->get();
        return view('/pages.cart.show_cart')->with('category', $category)->with('brand', $brand)->with('cart',$cart);
    }

    public function update_cart(Request $request){
        $data = array();
        $product_id = $request->pro_id;
        $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
        $data['product_quantity_cart'] = $request->quantity;
        $data['product_total'] = $request->quantity*$product->product_price;
        DB::table('tbl_cart')->where('product_id', $product_id)->update($data);
        return Redirect::to('/show-cart');
    }

    public function delete_cart($product_id){
        DB::table('tbl_cart')->where('product_id', $product_id)->delete();
        return Redirect::to('/show-cart');
    }

    public function thanh_toan($id, Request $request){
        $product = DB::table('tbl_product')
        ->join('tbl_cart','tbl_cart.product_id','=','tbl_product.Product_id')->where('user_id', $id)->where('tbl_cart.checkTT', '0')->first();
        $quantity = $product->product_quantity - $product->product_quantity_cart;
        $data3 = array();
        $data3['product_quantity'] = $quantity;
        DB::table('tbl_product')
        ->join('tbl_cart','tbl_cart.product_id','=','tbl_product.product_id')->where('user_id', $id)->where('tbl_cart.checkTT', '0')
        ->orderby('product_id', 'desc')->update($data3);
        $data = array();
        $data['checkTT'] = '1';
        $data2 = array();
        $data2['name'] = $request->txtName;
        $data2['diachi'] = $request->txtDiaChi;
        $data2['SDT'] = $request->txtSDT;
        DB::table('users')->where('id', $id)->update($data2);
        DB::table('tbl_cart')->where('checkTT', '0')->update($data);

        return Redirect::to('/show-don-hang');
    }

    public function show_don_hang(){
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        $user_id = Session::get('user_id');
        if($user_id == null){
            return view('login')->with('category', $category)->with('brand', $brand);
        }
        $message = Session::get('id');
        $cart = DB::table('tbl_cart')->where('checkTT', '1')->where('user_id', $user_id)->orderby('cart_id', 'desc')->get();
        return view('/pages.cart.show_don_hang')->with('category', $category)->with('brand', $brand)->with('cart',$cart);
    }
}
