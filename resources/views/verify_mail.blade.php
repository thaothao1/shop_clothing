<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>
<body>
    <form action="{{URL::to('/register-kh')}}" method="post">
    {{ csrf_field() }}
        <div class="container height-100 d-flex justify-content-center align-items-center"> 
            <div class="position-relative"> 
                <div class="card p-2 text-center"> 
                    <h6>Vui lòng xác nhận tài khoản của bạn! </h6>
                    <div> <span>Mã xác nhận OTP đã được gửi tới địa chỉ email: </span>
                        <?php
                            $message = Session::get('message_name');
                            if($message){
                                echo '<span class="text-alert">',$message.'</span>';
                            }
                            $message_OTP = Session::get('message_OTP');
                            if($message){
                                echo '<br>';
                                echo '<span class="text-alert" style="color: red">',$message_OTP.'</span>';
                                $message = Session::put('message_OTP', null);
                            }
                        ?>
                    </div>
                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
                        <input class="m-2 text-center form-control rounded" type="text" name="txtOTP" id="first" maxlength="6"/> 
                    </div> 
                    <div class="mt-4"> 
                        <button type="submit" class="btn btn-danger px-4 validate">Xác nhận</button> 
                    </div> 
                </div> 
            </div>
        </div>
    </form>
</body>
</html>