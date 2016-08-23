<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>machine</title>
</head>
<style>
    .form {
        margin: 58px 88px;
        width: 100%;
        height: 100%;
        position: absolute;
    }
    input {
        width: 188px;
        height: 22px;
        margin: 6px auto;
    }
    .popup-true, .popup-false {
        width: 168px;
        height: 148px;
        background: pink;
        position: relative;
        top: 0;
        left: 32%;
        font-size: 28px;
        text-align: center;
        line-height: 148px;
        display: none;
    }
    .popup-false {
        top: -28%;
    }
</style>
<body>
    <div class="form">
        <form action="" method="post" id="sub" onsubmit="return sub();">
            <div>考勤机号: <input type="text" name="mid"></div>
            <div><input type="submit"></div>
        </form>
        <div class="popup-true">添加成功</div>
        <div class="popup-false">添加失败</div>
    </div>
    <script type="text/javascript" src="/web/Public/assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/web/Public/assets/js/ajaxForm.js"></script>
    <script type="text/javascript">
        function sub() {
            $('#sub').ajaxSubmit(function(m) {
                if(m >= 1) {
                    $('.popup-true').fadeIn(1200, function() {
                        $(this).slideUp(800,function() {
                            window.location.reload();
                        });
                    });
                }else {
                    $('.popup-false').slideDown(1200, function() {
                        $(this).fadeOut(800, function() {
                            window.location.reload();
                        });
                    });
                }
            });
            return false;
        }
    </script>
</body>
</html>