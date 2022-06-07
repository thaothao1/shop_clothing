<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class KHController extends Controller
{
    //
    public function AuthLogin(){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        $user_id = Session::get('user_id');
        if($user_id){
            return view('/pages.home')->with('category', $category)->with('brand', $brand);
        }
        else{
            Session::put('message', 'Xin nhập tài khoản và mật khẩu!');
            return view('login')->with('category', $category)->with('brand', $brand);
        }
    }

    public function index(){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        return view('login')->with('category', $category)->with('brand', $brand);
    }
    public function login_kh(Request $request){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        $email = $request->txtAccount;
        $password = md5($request->txtPassword);
        $result = DB::table('users')->where('email', $email)->where('password', $password)->first();
        if($result){
            Session::put('name', $result->name);
            Session::put('user_id', $result->id);
            return Redirect::to('/trang-chu');
        }
        else{
            Session::put('message_login', 'Sai tài khoản Hoặc mật khẩu!');
            return view('/login')->with('category', $category)->with('brand', $brand);
        }
    }
    public function register_kh(Request $request){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        $data = array();
        $data['name'] = $_SESSION['name'];
        $data['email'] = $_SESSION['email'];
        $data['password'] = md5($_SESSION['password']);
        $OTP = $request->txtOTP;
        if($OTP == $_SESSION['verify_mail']){
            Session::put('message_register', 'Đăng kí thành công');
            DB::table('users')->insert($data);
            return view('/login')->with('category', $category)->with('brand', $brand);
        }
        else{
            Session::put('message_OTP', 'Mã OTP không trùng khớp!');
            return view('verify_mail'); 
        }
    }
    public function logout(){
        $this->AuthLogin();
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        Session::put('name', null);
        Session::put('user_id', null);
        Session::put('message', 'Đã đăng xuất!');
        return view('/login')->with('category', $category)->with('brand', $brand);
    }

    public function dia_chi($id, Request $request){
        $data = array();
        $data['name'] = $request->txtName;
        $data['diachi'] = $request->txtDiaChi;
        $data['SDT'] = $request->txtSDT;
        DB::table('users')->where('id', $id)->update($data);
        return Redirect::to('/thong-tin');
    }

    public function thong_tin(){
        $category = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->where('Brand_status', '0')->orderby('Brand_id', 'desc')->get();
        return view('khachhang.thongtin')->with('category', $category)->with('brand', $brand);
    }

    public function change_pass($id, Request $request){
        $data = array();
        $password = md5($request->txtPassword);
        $password_new = $request->txtPasswordNew;
        $password_xn = $request->txtPasswordXN;
        $user =  DB::table('users')->where('id', $id)->first();
        if($password != $user->password){
            Session::put('mes1', 'Sai mật khẩu!');
        }
        else{
            if($password_new != $password_xn){
                Session::put('mes2', 'Mật khẩu không trùng khớp!');
            }
            else{
                Session::put('mes', 'Thay đổi mật khẩu thành công!');
                $data['password'] = md5($password_new);
                DB::table('users')->where('id', $id)->update($data);
            }
        }
        return Redirect::to('/thong-tin');
    }
}
