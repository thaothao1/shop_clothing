<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('/admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all = DB::table('tbl_category_product')->paginate(10);
        $manage_category_product = view('/admin.all_category_product')->with('all_category_product', $all);
        return view('/admin_layout')->with('admin.all_category_product', $manage_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm danh mục thành công');
        return Redirect::to('/add-category-product');

    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message', 'Không kích hoạt danh mục thành công');
        return Redirect::to('/all-category-product');
    }   
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Kích hoạt danh mục thành công');
        return Redirect::to('/all-category-product');
    }

    public function edit_category_product($category_product_id){   
        $this->AuthLogin(); 
        $edit = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manage_category_product = view('/admin.edit_category_product')->with('edit_category_product', $edit);
        return view('/admin_layout')->with('admin.edit_category_product', $manage_category_product);
    }

    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục thành công');
        return Redirect::to('/all-category-product');
        
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xóa danh mục thành công');
        return Redirect::to('/all-category-product');
    }

    //show san pham danh muc
    public function showCategoryHome($category_id){
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        $category_name = DB::table('tbl_category_product')->where('category_id', $category_id)->get();
        $product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('tbl_category_product.category_id', $category_id)
        ->orderby('product_id', 'desc')->paginate(9);
        return view('pages.category.show_category')->with('category', $category)->with('brand', $brand)->with('product', $product)->with('category_name', $category_name);
    }
}
