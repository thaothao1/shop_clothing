@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="table-responsive">
      <?php
          $message = Session::get('message');
          if($message){
              echo '<span class="text-alert">',$message.'</span>';
              $message = Session::put('message', null);
          }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hiển thị</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_product as $key => $pro)
          <tr>
            <td>{{($pro->product_name)}}</td>
            <td><img src="public/uploads/product/{{($pro->product_image)}}" width="100"></td>
            <td>{{($pro->product_price)}}</td>
            <td>{{($pro->product_quantity)}}</td>
            <td>{{($pro->category_name)}}</td>
            <td>{{($pro->Brand_name)}}</td>
            <td><span class="text-ellipsis">
              <?php
              if($pro->product_status==0){
                ?>
                  <a href="{{URL::to('/unactive-product/'.$pro->Product_id)}}"> <span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
              }
              else {
              ?>
                <a href="{{URL::to('/active-product/'.$pro->Product_id)}}"> <span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
              }
              ?>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->Product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$pro->Product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <nav aria-label="Page navigation" style="text-align: center;">
            {!! $all_product->links() !!}
        </nav>
      </div>
    </footer>
  </div>
</div>
@endsection