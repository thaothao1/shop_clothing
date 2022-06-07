
@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm</h2>
    @foreach($product as $key=>$pro)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->Product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" />
                    <h2>{{number_format($pro->product_price).' VND'}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <form action="{{URL::to('/save-cart')}}" method="post">
                        {{csrf_field()}}
                    <span>
                        <input type="hidden" value="1" min="1" name="txtSL">
                        <input type="hidden" value="{{$pro->Product_id}}" name="pro_id">
                        <button type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                    </span>
                    </form>
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