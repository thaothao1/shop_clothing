@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương hiệu sản phẩm
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
            <th>Tên thương hiệu</th>
            <th>Hiển thị</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_Brand_product as $key => $cate_pro)
          <tr>
            <td>{{($cate_pro->Brand_name)}}</td>
            <td><span class="text-ellipsis">
              <?php
              if($cate_pro->Brand_status==0){
                ?>
                  <a href="{{URL::to('/unactive-Brand-product/'.$cate_pro->Brand_id)}}"> <span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
              }
              else {
              ?>
                <a href="{{URL::to('/active-Brand-product/'.$cate_pro->Brand_id)}}"> <span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
              }
              ?>
            <td>
              <a href="{{URL::to('/edit-Brand-product/'.$cate_pro->Brand_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')" href="{{URL::to('/delete-Brand-product/'.$cate_pro->Brand_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <nav aria-label="Page navigation" style="text-align: center;">
          {!! $all_Brand_product->links() !!}
      </nav>
    </footer>
  </div>
</div>
@endsection