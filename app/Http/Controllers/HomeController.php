<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Mail;
session_start();

class HomeController extends Controller
{
    public function index(){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        $product = DB::table('tbl_product')->where('product_status', '0')->orderby('category_id', 'desc')->paginate(6);
        return view('pages.home')->with('category', $category)->with('brand', $brand)->with('product', $product);
    }
    public function mail_verify_register(Request $request){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        $_SESSION['name'] = $request->txtName;
        $_SESSION['email'] = $request->txtEmail;
        $_SESSION['password'] = $request->txtPassword;
        $result = DB::table('users')->where('email', $request->txtEmail)->first();
        if($result){
            Session::put('message_register', 'Tài khoản đã tồn tại!');
            return view('/login')->with('category', $category)->with('brand', $brand);
        }
        else{
            $vepass = $request->txtVePassword;
            $pass = $request->txtPassword;
            if($pass != $vepass){
                Session::put('message_register', 'Mật khẩu không trùng khớp');
                return view('/login')->with('category', $category)->with('brand', $brand);
            }
            else{
                $user_name = $request->txtEmail;
                Session::put('message_name',  $request->txtEmail);
                $_SESSION['mail_user_name'] = $user_name;
                $name = "S-Clothing";
                Mail::send('sen_to_my_kh', compact('name'), function($email){
                    $name_mail = $_SESSION['mail_user_name'];
                    $email->to($name_mail, "S-Clothing");
                    $email->subject("Verify From S-Clothing");
                });
                return Redirect::to('/show-verify');
            }
        }
    }

    public function show_verify(){
        return view('verify_mail');
    }

}
