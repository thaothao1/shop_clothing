<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();


class AdminController extends Controller
{
    //

    public function AuthLogin(){
        $admin_id = Session::get('admin_name');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            Session::put('message', 'Xin nhập tài khoản và mật khẩu!');
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->adminEmail;
        $admin_password = md5($request->adminPassword);
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        
        if($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message', 'Sai tài khoản Hoặc mật khẩu!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function registration(){
        return view('/registration');
    }

    public function register_admin(Request $request){
        $data = array();
        $date['admin_name'] = $request->txtName;
        $date['admin_email'] = $request->txtEmail;
        $date['admin_password'] = md5($request->txtPassword);
        $vepass = $request->txtVePassword;
        $pass = $request->txtPassword;
        $result = DB::table('tbl_admin')->where('admin_email', $request->txtEmail)->first();
        if($pass != $vepass){
            Session::put('message_register', 'Mật khẩu không trùng khớp');
            return Redirect::to('/registration-admin')->send();
        }
        else{
            if($result){
                Session::put('message_register', 'Tài khoản đã tồn tại!');
                return Redirect::to('/registration-admin')->send();
            }
            else{
                Session::put('message', 'Đăng kí thành công');
                DB::table('tbl_admin')->insert($date);
                return Redirect::to('/admin');
            }
        }

    }
}
