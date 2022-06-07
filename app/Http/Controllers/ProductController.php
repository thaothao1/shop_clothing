<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        return view('/admin.add_product')->with('category', $category)->with('brand', $brand);
    }
    public function all_product(){
        $this->AuthLogin();
        $all = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_Brand_product','tbl_Brand_product.Brand_id','=','tbl_product.Brand_id')->orderby('product_id', 'desc')->paginate(10);
        $manage_product = view('/admin.all_product')->with('all_product', $all);
        return view('/admin_layout')->with('admin.all_product', $manage_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['Brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image; 
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('/add-product');
        }
        $data['product_image'] = ''; 
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('/add-product');

    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('Product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }   
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('Product_id', $product_id)->update(['Product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id){   
        $this->AuthLogin(); 
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        $edit = DB::table('tbl_product')->where('product_id', $product_id)
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_Brand_product','tbl_Brand_product.Brand_id','=','tbl_product.Brand_id')->orderby('product_id', 'desc')->get();
        $manage_product = view('/admin.edit_product')->with('edit_product', $edit)->with('category', $category)->with('brand', $brand);
        return view('/admin_layout')->with('admin.edit_product', $manage_product);
    }

    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['Brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image; 
            DB::table('tbl_product')->where('Product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        } 
        DB::table('tbl_product')->where('Product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
        return view('/admin_layout')->with('admin.edit_product', $manage_product);


        
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('Product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    
    public function showDetailsProduct($product_id){
        $category = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand = DB::table('tbl_Brand_product')->orderby('Brand_id', 'desc')->get();
        $product = DB::table('tbl_product')->where('product_id', $product_id)
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_Brand_product','tbl_Brand_product.Brand_id','=','tbl_product.Brand_id')->get();
        
        return view('pages.product.show_details_product')->with('category', $category)->with('brand', $brand)->with('product', $product);
    }
}
