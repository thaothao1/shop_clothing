@extends('welcome')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Lịch sử đặt hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description">Thông tin</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $key=>$ca)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$ca->product_image)}}" width="100px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$ca->product_name}}</a></h4>
                            <p>ID: {{$ca->product_id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($ca->product_price).' VND'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <form action="{{URL::to('/update-cart/'.$ca->product_id)}}" method="post">  
                                {{csrf_field()}}  
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="number" min="1" name="quantity" value="{{$ca->product_quantity_cart}}" autocomplete="off" size="2">
                                <input type="hidden" value="{{$ca->product_id}}" name="pro_id">
                            </div>
                            </form>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($ca->product_total).' VND'}}</p>
                        </td>
                        <td class="cart_delete">
                            <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" class="cart_quantity_delete" href="{{URL::to('delete-cart/'.$ca->product_id)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                <?php
                    $price = DB::table('tbl_cart')->sum('product_total');
                ?>
                    <ul>
                        <li>Tổng <span>
                             {{number_format($price).' VND'}}
                        </span></li>
                        <li>Thuế <span> {{number_format($price*0.1).' VND'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{number_format($price*0.1 + $price).' VND'}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection