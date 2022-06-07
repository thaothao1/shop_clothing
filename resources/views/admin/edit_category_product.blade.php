@extends('admin_layout')
@section('admin_content')

<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">',$message.'</span>';
                                    $message = Session::put('message', null);
                                }
                            ?>
                            @foreach($edit_category_product as $key => $id)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$id->category_id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$id->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1">{{$id->category_desc}}</textarea>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection