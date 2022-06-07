
@extends('welcome')
@section('content')

<div class="features_items"><!--features_items-->
    @foreach($brand_name as $key=>$name)
    <h2 class="title text-center">Thương hiệu {{$name->Brand_name}}</h2>
    @endforeach
    @foreach($product as $key=>$pro)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->Product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" />
                        <h2>{{number_format($pro->product_price).' VND'}}</h2>
                        <p>{{$pro->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
            </div>
        </div>
    </div>
    </a>
    @endforeach
</div><!--features_items-->
<nav aria-label="Page navigation" style="text-align: center;">
    {!! $product->links() !!}
</nav>

@endsection