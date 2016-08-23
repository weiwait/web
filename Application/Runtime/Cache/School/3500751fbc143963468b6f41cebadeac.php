<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo ($active); ?> - 考勤系统</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- basic styles -->

    <link href="/web/Public/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/web/Public/assets/css/font-awesome.min.css"/>

    <!--[if IE 7]>
    <link rel="stylesheet" href="/web/Public/assets/css/font-awesome-ie7.min.css"/>
    <![endif]-->

    <!-- page specific plugin styles -->

    <!-- fonts -->

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300"/>

    <!-- ace styles -->

    <link rel="stylesheet" href="/web/Public/assets/css/ace.min.css"/>
    <link rel="stylesheet" href="/web/Public/assets/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="/web/Public/assets/css/ace-skins.min.css"/>

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/web/Public/assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <script src="/web/Public/assets/js/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="/web/Public/assets/js/html5shiv.js"></script>
    <script src="/web/Public/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-leaf"></i>
                    考勤系统管理后台
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">






                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo ($_SESSION['user']['headurl']); ?>" alt="<?php echo ($_SESSION['user']['username']); ?>" />
                        <span class="user-info">
                            <small>Welcome,</small>
                            <?php echo ($_SESSION['user']['username']); ?>
                        </span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">




                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo U('Index/logout','','');?>">
                                <i class="icon-off"></i>
                                退出登录
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed')
                } catch (e) {
                }
            </script>



            <?php if(is_array($nav_genre)): foreach($nav_genre as $key=>$title): ?><ul class="nav nav-list">
                    <li class="<?php echo $title['active']; ?> open">
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-list"></i>
                            <span class="menu-text"> <?php echo ($title['title']); ?> </span>
                            <b class="arrow icon-angle-down"></b>
                        </a>
                        <ul class="submenu">
                        <?php if(is_array($left_nav)): foreach($left_nav as $key=>$nav): if($nav['genre_id'] == $title['id']) {?>
                            <li>
                                <a href="<?php echo U($nav['url']);?>" target="<?php echo $nav['target']; ?>">
                                <i class="icon-double-angle-right"></i>
                                <?php echo $nav['name']; ?>
                                </a>
                            </li>
                            <?php } endforeach; endif; ?>
                        </ul>
                    </li>
                </ul><?php endforeach; endif; ?>




            <!-- #sidebar-shortcuts -->



            
<!--             <ul class="nav nav-list">
                <li class="active open">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-list"></i>
                        <span class="menu-text"> 教师 </span>

                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li class="<?php if(($active) == "添加教师"): ?>active<?php endif; ?>">
                            <a href="<?php echo U('School/Teacher/addTeacher');?>" target="ajax-page">
                            <i class="icon-double-angle-right"></i>
                            添加教师
                            </a>
                        </li>
                    </ul>
                </li>
            </ul> -->





            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left"
                   data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {
                }
            </script>
        </div>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>

                <!-- .breadcrumb -->
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="<?php echo U('User/machine_list','','');?>">首页</a>
                    </li>
                    <?php echo ($breadcrumb); ?>
                </ul>


                <!-- #nav-search -->
            </div>
        <div class="page-content" style="height:500px;">
            <iframe src="" class= "ajax-page" name="ajax-page" scrolling="no" frameborder="0" style="width:100%; height:100%;"></iframe>
        </div>

        </div>
        <!-- /.main-content -->

        <!-- /#ace-settings-container -->
    </div>
    <!-- /.main-container-inner -->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>
</div>
<!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

<script src="/web/Public/assets/js/jquery-2.0.3.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="/web/Public/assets/js/jquery-1.10.2.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>" + "<" + "/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if ("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="/web/Public/assets/js/bootstrap.min.js"></script>
<script src="/web/Public/assets/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

<script src="/web/Public/assets/js/jquery.dataTables.min.js"></script>
<script src="/web/Public/assets/js/jquery.dataTables.bootstrap.js"></script>

<!-- ace scripts -->

<script src="/web/Public/assets/js/ace-elements.min.js"></script>
<script src="/web/Public/assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

<script type="text/javascript">
    jQuery(function ($) {
        var oTable1 = $('#sample-table-2').dataTable({
            "aoColumns": [
                {"bSortable": false},
                null, null, null, null, null,
                {"bSortable": false}
            ],
            "aLengthMenu": [[10, 25, 50, -1], ["10条", "25条", "50条", "All"]],
            "iDisplayLength": 25,
        });


        $('table th input:checkbox').on('click', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function () {
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }
    })
</script>

</body>
</html>