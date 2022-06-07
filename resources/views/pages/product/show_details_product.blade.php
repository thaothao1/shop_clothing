
@extends('welcome')
@section('content')

<div class="product-details"><!--product-details-->
@foreach($product as $key=>$pro)
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" /> 
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$pro->product_name}}</h2>
            <p>ID: {{$pro->Product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="post">
                {{csrf_field()}}
            <span>
                <span>{{number_format($pro->product_price).' VND'}}</span>
                <label>Số lượng:</label>
                <input type="number" value="1" min="1" name="txtSL">
                <input type="hidden" value="{{$pro->Product_id}}" name="pro_id">
                <button type="submit" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                </button>
            </span>
            </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Điều kiện:</b> Mới 100%</p>
            <p><b>Thương hiệu:</b> {{$pro->Brand_name}}</p>
            <p><b>Danh mục:</b> {{$pro->category_name}}</p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#content" data-toggle="tab">Nội dung sản phẩm</a></li>
            <li><a href="#desc" data-toggle="tab">Mô tả sản phẩm</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="content" >
        <div class="col-sm-12">
            <h4>Nội dung:</h4>
            <p>- {{$pro->product_content}}</p>
            <p><b>Cảm ơn bạn đã lựa chọn tôi</b></p>
        </div>
    </div>
        
        <div class="tab-pane fade" id="desc" >
            <div class="col-sm-12">
                <h4>Mô tả:  </h4>
                <p>- {{$pro->product_desc}}</p>
                <p><b>Cảm ơn bạn đã lựa chọn tôi</b></p>
            </div> 
        </div>
    </div>
@endforeach
</div><!--/category-tab-->

@endsection