<?php
if(session_id() == '') {
    session_start();
}
$_SESSION['verify_mail'] = rand(1000, 9999);
?>
<h2 style="text-align: center;">Xin chào {{$name}}</h2>
<p style="text-align: center;">
    Đây là xác thực từ S-Clothing
</p>
<p style="text-align: center;">
    Mã xác thực của bạn là
</p>
<h1 style="text-align: center;"><?php echo($_SESSION['verify_mail']) ?></h1>