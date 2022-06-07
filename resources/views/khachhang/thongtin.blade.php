@extends('welcome')
@section('content')

<style>

    .table td{
        padding: 5px 0;
        font-size: 15px;
        color: 	#555555;
        font-family: Tahoma;
    }
    .table .user{   
        font-size: 18px;
        color: red;
    }
    .table input[type=text]{
        font-family: Tahoma;
        font-weight: bold;
        font-size: 13px;
        padding-left: 5px;
        border: #DDDDDD solid 1px;
        height: 30px;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .table input[type=submit]{
        padding: 0 4px;
        border: #DDDDDD solid 1px;
        height: 20px;
        color: #fff;
        background: #FF3300;
        font-size: 15px;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .table textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }
</style>
<section id="do_action">
    <div class="container">
        <div class="row">
            <?php
                $user_id = Session::get('user_id');
                $user = DB::table('users')->where('id', $user_id)->first();
            ?>
            <div class="col-sm-6">
                <div class="total_area">
                <form action="{{URL::to('dia-chi/'.$user->id)}}" method="post">
                    {{csrf_field()}}
                    <table class="table">
                        <tr>
                            <th colspan="6">Thông tin cá nhân</th>
                        </tr>
                        <tr>
                            <td><label>Tài khoản: </label></td>
                            <td class="user">{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td><label>Họ tên: </label></td>
                            <td>
                                <input type="text" name="txtName" value="{{$user->name}}">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Địa chỉ: </label></td>
                            <td>
                                <textarea name="txtDiaChi">{{$user->diachi}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Số điện thoại: </label></td>
                            <td>
                                <input type="text" name="txtSDT" value="{{$user->SDT}}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="bntUpdate" value="Cập nhật" onclick = "return confirm('Bạn có chắc muốn thay đổi thông tin không?')">
                            </td>
                        </tr>
                    </table>
                </form>
                <form action="{{URL::to('change-pass/'.$user->id)}}" method="post">
                    {{csrf_field()}}
                    <table class="table">
                        <tr>
                            <th colspan="3">Đổi mật khẩu</th>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                    $message = Session::get('mes');
                                    echo $message;
                                    $message = Session::put('mes', null);
                                ?> 
                            </td>
                        </tr>
                        <tr>
                            <td><label>Mật khẩu cũ: </label></td>
                            <td>
                                <input type="password" name="txtPassword" placeholder="Mật khẩu cũ">
                            </td>
                            <td>
                               <?php
                                    $message = Session::get('mes1');
                                    echo $message;
                                    $message = Session::put('mes1', null);
                               ?> 
                            </td>
                        </tr>
                        <tr>
                            <td><label>Mật khẩu mới</label></td>
                            <td>
                                <input type="password" name="txtPasswordNew" placeholder="Mật khẩy mơi">
                            </td>
                            <td>
                                <?php
                                    $message = Session::get('mes2');
                                    echo $message;
                               ?> 
                            </td>
                        </tr>
                        <tr>
                            <td><label>Xác nhận mật khẩu: </label></td>
                            <td>
                                <input type="password" name="txtPasswordXN" placeholder="Xác nhận mật khẩu">
                            </td>
                            <td>
                                <?php
                                    $message = Session::get('mes2');
                                    echo $message;
                                    $message = Session::put('mes2', null);
                               ?> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="bntSwapPass" value="Đổi mật khẩu">
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection