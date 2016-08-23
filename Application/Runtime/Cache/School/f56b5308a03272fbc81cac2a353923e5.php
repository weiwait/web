<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>course</title>
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
    .select {
        width: 192px;
        height: 30px;
        margin: 6px auto;
        text-indent: 6px;
    }
</style>
<body>
    <div class="form">
        <form action="" method="post" id="sub" onsubmit="return sub();">
            <div>学　　生: <select name="user" class="select">
                <?php if(is_array($user)): foreach($user as $key=>$subuser): ?><option value="<?php echo ($subuser['id']); ?>"><?php echo ($subuser['name']); ?></option><?php endforeach; endif; ?>
            </select></div>
            <div>科　　目: <select name="course" class="select">
                <?php if(is_array($course)): foreach($course as $key=>$subcourse): ?><option value="<?php echo ($subcourse['id']); ?>"><?php echo ($subcourse['name']); ?></option><?php endforeach; endif; ?>
            </select></div>
            <div>课程提醒: <input type="text" name="notify"></div>
            <div>评　　价: <input type="text" name="value"></div>
            <div>用户分数: <input type="text" name="score"></div>
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