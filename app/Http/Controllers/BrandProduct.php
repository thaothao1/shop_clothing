<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
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
    
    public function add_Brand_product(){
        $this->AuthLogin();
        return view('/admin.add_Brand_product');
    }
    public function all_Brand_product(){
        $this->AuthLogin();
        $all = DB::table('tbl_Brand_product')->paginate(10);
        $manage_Brand_product = view('/admin.all_Brand_product')->with('all_Brand_product', $all);
        return view('/admin_layout')->with('admin.all_Brand_product', $manage_Brand_product);
    }

    public function save_Brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['Brand_name'] = $request->Brand_product_name;
        $data['Brand_desc'] = $request->Brand_product_desc;
        $data['Brand_status'] = $request->Brand_product_status;

        DB::table('tbl_Brand_product')->insert($data);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('/add-Brand-product');

    }

    public function unactive_Brand_product($Brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_Brand_product')->where('Brand_id', $Brand_product_id)->update(['Brand_status' => 1]);
        Session::put('message', 'Không kích hoạt thương hiệu thành công');
        return Redirect::to('/all-Brand-product');
    }   
    public function active_Brand_product($Brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_Brand_product')->where('Brand_id', $Brand_product_id)->update(['Brand_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('/all-Brand-product');
    }

    public function edit_Brand_product($Brand_product_id){  
        $this->AuthLogin();  
        $edit = DB::table('tbl_Brand_product')->where('Brand_id', $Brand_product_id)->get();
        $manage_Brand_product = view('/admin.edit_Brand_product')->with('edit_Brand_product', $edit);
        return view('/admin_layout')->with('admin.edit_Brand_product', $manage_Brand_product);
    }

    public function update_Brand_product(Request $request, $Brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['Brand_name'] = $request->Brand_product_name;
        $data['Brand_desc'] = $request->Brand_product_desc;
        DB::table('tbl_Brand_product')->where('Brand_id', $Brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-Brand-product');
        
    }
    public function delete_Brand_product($Brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_Brand_product')->where('Brand_id', $Brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('/all-Brand-product');
    }

        //show san pham thuong hieu
        public function showBrandHome($brand_id){
            $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
            $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
            $brand_name = DB::table('tbl_Brand_product')->where('Brand_id', $brand_id)->get();
            $product = DB::table('tbl_product')
            ->join('tbl_brand_product','tbl_brand_product.Brand_id','=','tbl_product.Brand_id')->where('tbl_brand_product.Brand_id', $brand_id)
            ->orderby('product_id', 'desc')->paginate(9);
            return view('pages.brand.show_brand')->with('category', $category)->with('brand', $brand)->with('product', $product)->with('brand_name', $brand_name);
        }
}
