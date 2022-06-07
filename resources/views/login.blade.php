@extends('welcome')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    <?php
                        $message = Session::get('message_login');
                        if($message){
                            echo '<span class="text-alert">',$message.'</span>';
                            $message = Session::put('message_login', null);
                        }
                    ?>
                    <form action="{{URL::to('/login-kh')}}" method="post">
                    {{ csrf_field() }}
                        <input type="email" name="txtAccount" placeholder="Địa chỉ Email" />
                        <input type="password" name="txtPassword" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Nhớ mật khẩu
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Tạo tài khoản mới!</h2>
                    <?php
                        $message = Session::get('message_register');
                        if($message){
                            echo '<span class="text-alert">',$message.'</span>';
                            $message = Session::put('message_register', null);
                        }
                    ?>
                    <form action="{{URL::to('/send-mail')}}" method="post">
                    {{ csrf_field() }}
                        <input type="text" name="txtName" placeholder="Name"/>
                        <input type="email" name="txtEmail" placeholder="Địa chỉ Email"/>
                        <input type="password" name="txtPassword" placeholder="Mật khẩu"/>
                        <input type="password" name="txtVePassword" placeholder="Xạc nhận mật khẩu"/>
                        <button type="submit" class="btn btn-default">Đăng kí</button>
                        <!-- <a href="send-mail">xac nhan</a> -->
                        
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection