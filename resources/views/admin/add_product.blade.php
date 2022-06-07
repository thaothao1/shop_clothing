@extends('admin_layout')
@section('admin_content')

<div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_category" class="form-control input-lg m-bot15">
                                        @foreach($category as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name="product_brand" class="form-control input-lg m-bot15">
                                    @foreach($brand as $key => $bran)
                                        <option value="{{$bran->Brand_id}}">{{$bran->Brand_name}}</option>
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
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection