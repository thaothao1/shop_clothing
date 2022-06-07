@extends('admin_layout')
@section('admin_content')

<div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">',$message.'</span>';
                                    $message = Session::put('message', null);
                                }
                            ?>
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->Product_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" value="{{$pro->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" width="100" heigh="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sô lượng</label>
                                    <input type="number" value="{{$pro->product_quantity}}" name="product_quantity" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_category" class="form-control input-lg m-bot15">
                                        @foreach($category as $key => $cate)
                                        @if($cate->category_id == $pro->category_id){
                                            <option selected value="{{$cate->category_id}}">{{$pro->category_name}}</option>
                                        }
                                        @else{
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        }
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-lg m-bot15">
                                        @foreach($brand as $key => $bran)
                                        @if($bran->Brand_id == $pro->Brand_id){
                                            <option selected value="{{$bran->Brand_id}}">{{$pro->Brand_name}}</option>
                                        }
                                        @else{
                                            <option value="{{$bran->Brand_id}}">{{$bran->Brand_name}}</option>
                                        }
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-lg m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>
                        </div>
                    </section>
            </div>
@endsection