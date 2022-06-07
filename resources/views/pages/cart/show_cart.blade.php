@extends('welcome')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Giỏ hàng của bạn</li>
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
                                <input type="submit" value="Cập nhật" name="up-quantity" class="btn btn-default btn-sm">
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
<?php
    $user_id = Session::get('user_id');
    $user = DB::table('users')->where('id', $user_id)->first();
?>
<form action="{{URL::to('/thanh-toan/'.$user->id)}}" method="post">
{{csrf_field()}}
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <textarea name="txtName" id="" cols="20" rows="1" placeholder="Tên người nhận hàng"><?php echo $user->name; ?></textarea>
                        <textarea name="txtDiaChi" id="" cols="20" rows="5" placeholder="Địa chỉ nhận hàng"><?php echo $user->diachi; ?></textarea>
                        <textarea name="txtSDT" id="" cols="20" rows="1" placeholder="Số điện thoại" maxlength="10"><?php echo $user->SDT; ?></textarea>
                    </ul>
                </div>
            </div>
            </form>
            <div class="col-sm-6">
                <div class="total_area">
                <?php
                    $price = DB::table('tbl_cart')->where('checkTT', '0')->sum('product_total');
                ?>
                    <ul>
                        <li>Tổng <span>
                             {{number_format($price).' VND'}}
                        </span></li>
                        <li>Thuế <span> {{number_format($price*0.1).' VND'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{number_format($price*0.1 + $price).' VND'}}</span></li>
                    </ul>
                    <button type="submit" onclick="return confirm('Bạn có chắc muốn đặt hàng không?')" class="btn btn-default check_out">Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
</form>

@endsection