<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>企业订餐系统管理后台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <base href="/online_meal_ordering/Public/">

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <!-- ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet">

        <!-- Morris -->
        <link href="css/morris.css" rel="stylesheet"/>

        <!-- Datepicker -->
        <link href="css/datepicker.css" rel="stylesheet"/>

        <!-- Animate -->
        <link href="css/animate.min.css" rel="stylesheet">

        <!-- Owl Carousel -->
        <link href="css/owl.carousel.min.css" rel="stylesheet">
        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Simplify -->
        <link href="css/simplify.min.css" rel="stylesheet">

        <!-- Common -->
        <link href="css/self/common.css" rel="stylesheet">

        <!-- Jquery -->
        <script src="js/jquery-1.11.1.min.js"></script>

        <!-- Bootstrap -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- Slimscroll -->
        <script src='js/jquery.slimscroll.min.js'></script>

        <!-- Popup Overlay -->
        <script src='js/jquery.popupoverlay.min.js'></script>

        <!-- Modernizr -->
        <script src='js/modernizr.min.js'></script>

        <!-- Simplify -->
        <script src="js/simplify/simplify.js"></script>
        </body>

        <!-- Common -->
        <script src="js/self/common.js"></script>

    </head>

    <body class="overflow-hidden">
        <div class="wrapper preload">
            <header class="top-nav">
                <div class="top-nav-inner">
                    <div class="nav-header">
                        <a href="/online_meal_ordering/admin" class="brand">
                            <i class="fa fa-database"></i><span class="brand-name">企业订餐系统管理后台</span>
                        </a>
                    </div>
                    <div class="nav-container">
                        <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleLG">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <ul class="nav-notification">
                            <li class="search-list">
                                <div class="search-input-wrapper">
                                    <div class="search-input">
                                        <input type="text" class="form-control input-sm inline-block">
                                        <a href="#" class="input-icon text-normal"><i class="ion-ios7-search-strong"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="pull-right m-right-sm">
                            <div class="user-block hidden-xs">
                                <a href="#" id="userToggle" data-toggle="dropdown">
                                    <img src="images/default_headimg.jpg" alt="" class="img-circle inline-block user-profile-pic">
                                    <div class="user-detail inline-block">
                                        管理员
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                </a>
                                <div class="panel border dropdown-menu user-panel">
                                    <div class="panel-body paddingTB-sm">
                                        <ul>
                                            <li>
                                                <a href="/online_meal_ordering/admin/user/logout">
                                                    <i class="fa fa-power-off fa-lg"></i><span class="m-left-xs">退出</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- ./top-nav-inner -->
            </header>
            <aside class="sidebar-menu fixed">
                <div class="sidebar-inner scrollable-sidebar">
                    <div class="main-menu">
                        <ul class="accordion">
                            <li class="menu-header">
                                Main Menu
                            </li>
                            <li class="bg-palette1 nav-i">
                                <a href="/online_meal_ordering/admin">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
                                        <span class="text m-left-sm">后台主页</span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        主页
                                    </span>
                                </a>
                            </li>
                            <li class="openable bg-palette3 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-users fa-lg"></i></span>
                                        <span class="text m-left-sm">员工账户管理</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        账户
                                    </span>
                                </a>
                                <ul class="submenu bg-palette4">
                                    <li><a href="/online_meal_ordering/admin/user/usermanage"><span class="submenu-label">账户管理</span></a></li>
                                    <li><a href="/online_meal_ordering/admin/user/depmanage"><span class="submenu-label">部门管理</span></a></li>
                                </ul>
                            </li>
                            <li class="openable bg-palette4 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-truck fa-lg"></i></span>
                                        <span class="text m-left-sm">商家店铺管理</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        店铺
                                    </span>
                                </a>
                                <ul class="submenu bg-palette4">
                                    <li><a href="/online_meal_ordering/admin/store/storemanage"><span class="submenu-label">店铺管理</span></a></li>
                                    <li><a href="/online_meal_ordering/admin/store/storedishmanage"><span class="submenu-label">店铺自定义菜系管理</span></a></li>
                                </ul>
                            </li>

                            <li class="openable bg-palette2 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-cutlery fa-lg"></i></span>
                                        <span class="text m-left-sm">菜式管理</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        菜式
                                    </span>
                                </a>
                                <ul class="submenu bg-palette4">
                                    <li><a href="/online_meal_ordering/admin/dish/index"><span class="submenu-label">菜式管理</span></a></li>
                                </ul>
                            </li>

                            <li class="openable bg-palette3 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-gear fa-lg"></i></span>
                                        <span class="text m-left-sm">系统配置</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        配置
                                    </span>
                                </a>
                                <ul class="submenu bg-palette3">
                                    <li><a href="/online_meal_ordering/admin/config/index"><span class="submenu-label">系统配置</span></a></li>
                                </ul>
                            </li>
                            <!--
                            <li class="bg-palette2 nav-i">
                                <a href="landing/landing.html">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
                                        <span class="text m-left-sm">landing</span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        Landing
                                    </span>
                                </a>
                            </li>
                            <li class="openable bg-palette3 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
                                        <span class="text m-left-sm">Form Elements</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        Form
                                    </span>
                                </a>
                                <ul class="submenu bg-palette4">
                                    <li><a href="form_element.html"><span class="submenu-label">Form Element</span></a></li>
                                    <li><a href="form_validation.html"><span class="submenu-label">Form Validation</span></a></li>
                                    <li><a href="form_wizard.html"><span class="submenu-label">Form Wizard</span></a></li>
                                    <li><a href="dropzone.html"><span class="submenu-label">Dropzone</span></a></li>
                                </ul>
                            </li>
                            <li class="openable bg-palette4 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-tags fa-lg"></i></span>
                                        <span class="text m-left-sm">UI Elements</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        UI Kits
                                    </span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="ui_element.html"><span class="submenu-label">Basic Elements</span></a></li>
                                    <li><a href="button.html"><span class="submenu-label">Button & Icons</span></a></li>
                                    <li class="openable">
                                        <a href="#">
                                            <small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs pull-right">2</small>
                                            <span class="submenu-label">Tables</span>
                                        </a>
                                        <ul class="submenu third-level">
                                            <li><a href="static_table.html"><span class="submenu-label">Static Table</span></a></li>
                                            <li><a href="datatable.html"><span class="submenu-label">DataTables</span></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="widget.html"><span class="submenu-label">Widget</span></a></li>
                                    <li><a href="tab.html"><span class="submenu-label">Tab</span></a></li>
                                    <li><a href="calendar.html"><span class="submenu-label">Calendar</span></a></li>
                                    <li><a href="treeview.html"><span class="submenu-label">Treeview</span></a></li>
                                    <li><a href="nestable_list.html"><span class="submenu-label">Nestable Lists</span></a></li>
                                </ul>
                            </li>
                            <li class="bg-palette1 nav-i">
                                <a href="inbox.html">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-envelope fa-lg"></i></span>
                                        <span class="text m-left-sm">Inboxs</span>
                                        <small class="badge badge-danger badge-square bounceIn animation-delay5 m-left-xs">5</small>
                                    </span>
                                    <span class="menu-content-hover block">
                                        Inboxs
                                    </span>
                                </a>
                            </li>
                            <li class="bg-palette2 nav-i">
                                <a href="timeline.html">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-clock-o fa-lg"></i></span>
                                        <span class="text m-left-sm">Timeline</span>
                                        <small class="badge badge-warning badge-square bounceIn animation-delay6 m-left-xs pull-right">7</small>
                                    </span>
                                    <span class="menu-content-hover block">
                                        Timeline
                                    </span>
                                </a>
                            </li>
                            <li class="openable bg-palette3 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-gift fa-lg"></i></span>
                                        <span class="text m-left-sm">Extra Pages</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        Pages
                                    </span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="signin.html"><span class="submenu-label">Sign in</span></a></li>
                                    <li><a href="signup.html"><span class="submenu-label">Sign Up</span></a></li>
                                    <li><a href="lockscreen.html"><span class="submenu-label">Lock Screen</span></a></li>
                                    <li><a href="profile.html"><span class="submenu-label">Profile</span></a></li>
                                    <li><a href="gallery.html"><span class="submenu-label">Gallery</span></a></li>
                                    <li><a href="blog.html"><span class="submenu-label">Blog</span></a></li>
                                    <li><a href="single_post.html"><span class="submenu-label">Single Post</span></a></li>
                                    <li><a href="pricing.html"><span class="submenu-label">Pricing</span></a></li>
                                    <li><a href="invoice.html"><span class="submenu-label">Invoice</span></a></li>
                                    <li><a href="error404.html"><span class="submenu-label">Error404</span></a></li>
                                    <li><a href="blank.html"><span class="submenu-label">Blank</span></a></li>
                                </ul>
                            </li>
                            <li class="openable bg-palette4 nav-i">
                                <a href="#">
                                    <span class="menu-content block">
                                        <span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
                                        <span class="text m-left-sm">Menu Level</span>
                                        <span class="submenu-icon"></span>
                                    </span>
                                    <span class="menu-content-hover block">
                                        Menu
                                    </span>
                                </a>
                                <ul class="submenu">
                                    <li class="openable">
                                        <a href="signin.html">
                                            <span class="submenu-label">menu 2.1</span>
                                            <small class="badge badge-success badge-square bounceIn animation-delay2 m-left-xs pull-right">3</small>
                                        </a>
                                        <ul class="submenu third-level">
                                            <li><a href="#"><span class="submenu-label">menu 3.1</span></a></li>
                                            <li><a href="#"><span class="submenu-label">menu 3.2</span></a></li>
                                            <li class="openable">
                                                <a href="#">
                                                    <span class="submenu-label">menu 3.3</span>
                                                    <small class="badge badge-danger badge-square bounceIn animation-delay2 m-left-xs pull-right">2</small>
                                                </a>
                                                <ul class="submenu fourth-level">
                                                    <li><a href="#"><span class="submenu-label">menu 4.1</span></a></li>
                                                    <li><a href="#"><span class="submenu-label">menu 4.2</span></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><span class="submenu-label">menu 2.2</span></a></li>
                                </ul>
                            </li>
                             -->
                        </ul>
                    </div>
                    <div class="sidebar-fix-bottom clearfix">
                        <div class="user-dropdown dropup pull-left">
                            <a href="#" class="dropdwon-toggle font-18" data-toggle="dropdown"><i class="ion-person-add"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="inbox.html">
                                        Inbox
                                        <span class="badge badge-danger bounceIn animation-delay2 pull-right">1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Notification
                                        <span class="badge badge-purple bounceIn animation-delay3 pull-right">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="sidebarRight-toggle">
                                        Message
                                        <span class="badge badge-success bounceIn animation-delay4 pull-right">7</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">Setting</a>
                                </li>
                            </ul>
                        </div>
                        <a href="lockscreen.html" class="pull-right font-18"><i class="ion-log-out"></i></a>
                    </div>
                </div>
            </aside>
            <div class="main-container">
                <div class="padding-md">
                    <div class="alert-before" style="position: relative;height: 0;">
                        <div class="alert alert-success alert-dismissible" id="alert-div" style="display:none;" role="alert">
                            <!-- <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> -->
                            <i class="fa fa-check-circle m-right-xs"></i><span class="alert-text">You successfully read this important alert message.</span>
                        </div>
                    </div>
                    
<style type="text/css">
ul.store-list {
    overflow: hidden;
}
h4.s-title {
    border-bottom: 2px solid #65CEA7;
    color: #65CEA7;
    line-height: 36px;
}
ul.store-list>li:hover {
    cursor: pointer;
}
ul.store-list>li {
    list-style: none;
    background: #fff;
    margin-right: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    color: #DDD;
    border: 1px solid #aaa;
    font-size: 18px;
    float: left;
    padding: 10px 15px;
}
ul.store-list>li.success {
    border: none;
    background: #32c5cd!important;
    color: #fff!important;;
}
ul.store-list>li.current {
    border: none;
    background: #65CEA7!important;
    color: #fff!important;
}
.smart-widget-body {
    overflow: hidden;
}
.store-key {
    width: 80px;
    float: left;
}
.store-value {
    width: 90%;
    float: left;
}
.menu-table {
    position: relative;
}
.store-detail {
    position: relative;
    clear: both;
}
.ribbon-wrapper {
    z-index: 2;
}
.no {
    display: none;
}
</style>

<div class="smart-widget widget-dark-blue">
    <div class="smart-widget-header">
        今日订单
        <span class="smart-widget-option">
            <span class="refresh-icon-animated">
                <i class="fa fa-circle-o-notch fa-spin"></i>
            </span>
            <a href="#" class="widget-toggle-hidden-option">
                <i class="fa fa-cog"></i>
            </a>
            <a href="#" class="widget-collapse-option" data-toggle="collapse">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a href="#" class="widget-refresh-option">
                <i class="fa fa-refresh"></i>
            </a>
            <a href="#" class="widget-remove-option">
                <i class="fa fa-times"></i>
            </a>
        </span>
    </div>
    <div class="smart-widget-inner">
        <div class="smart-widget-hidden-section">
            <ul class="widget-color-list clearfix">
                <li style="background-color:#20232b;" data-color="widget-dark"></li>
                <li style="background-color:#4c5f70;" data-color="widget-dark-blue"></li>
                <li style="background-color:#23b7e5;" data-color="widget-blue"></li>
                <li style="background-color:#2baab1;" data-color="widget-green"></li>
                <li style="background-color:#edbc6c;" data-color="widget-yellow"></li>
                <li style="background-color:#fbc852;" data-color="widget-orange"></li>
                <li style="background-color:#e36159;" data-color="widget-red"></li>
                <li style="background-color:#7266ba;" data-color="widget-purple"></li>
                <li style="background-color:#f5f5f5;" data-color="widget-light-grey"></li>
                <li style="background-color:#fff;" data-color="reset"></li>
            </ul>
        </div>
        <div class="widget-tab clearfix">
            <ul class="tab-bar">
                <li class="active"><a href="#noon" data-toggle="tab"><i class="fa fa-sun-o"></i>&nbsp;&nbsp;午餐</a></li>
                <li class=""><a href="#night" data-toggle="tab"><i class="fa fa-star-o"></i>&nbsp;&nbsp;晚餐</a></li>
            </ul>
        </div>
        <div class="smart-widget-body">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="noon">
                    <p class="text-center no">
                        当前还没有员工订餐~
                    </p>
                    <div class="ex">
                        <ul class="store-list">
                            <!-- <li class="success">店铺1</li>
                            <li class="current">店铺2</li>
                            <li>店铺3</li> -->
                        </ul>
                        <h4 class="s-title">店铺订单详细</h4>
                        <div class="store-info col-sm-12 no-padding">
                            <p class="clearfix store-key">店铺名称：</p>
                            <p class="clearfix store-value">店铺2</p>
                            <p class="clearfix store-key">店铺电话：</p>
                            <p class="clearfix store-value">15801094323</p>
                            <p class="clearfix store-key">店铺地址：</p>
                            <p class="clearfix store-value">湘潭大学</p>
                        </div>
                        <div class="store-detail">
                            <div class="ribbon-wrapper">
                                <div class="ribbon-inner shadow-pulse bg-success">
                                    已订
                                </div>
                            </div>
                            <table class="table table-bordered menu-table">
                                <thead>
                                    <tr>
                                        <th>菜名</th>
                                        <th>数量</th>
                                        <th>说明</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <buttion class="btn btn-success order">已订餐</buttion>
                                <buttion class="btn btn-info send">已送餐</buttion>
                            </div>
                        </div>
                    </div>
                </div><!-- ./tab-pane -->
                <div class="tab-pane fade" id="night">
                    <p class="text-center no">
                        当前还没有员工订餐~
                    </p>
                    <div class="ex">
                        <ul class="store-list">
                            <!-- <li class="success">店铺1</li>
                            <li class="current">店铺2</li>
                            <li>店铺3</li> -->
                        </ul>
                        <h4 class="s-title">店铺订单详细</h4>
                        <div class="store-info col-sm-12 no-padding">
                            <p class="clearfix store-key">店铺名称：</p>
                            <p class="clearfix store-value">店铺2</p>
                            <p class="clearfix store-key">店铺电话：</p>
                            <p class="clearfix store-value">15801094323</p>
                            <p class="clearfix store-key">店铺地址：</p>
                            <p class="clearfix store-value">湘潭大学</p>
                        </div>
                        <div class="store-detail">
                            <div class="ribbon-wrapper">
                                <div class="ribbon-inner shadow-pulse bg-success">
                                </div>
                            </div>
                            <table class="table table-bordered menu-table">
                                <thead>
                                    <tr>
                                        <th>菜名</th>
                                        <th>数量</th>
                                        <th>说明</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <buttion class="btn btn-success order">已订餐</buttion>
                                <buttion class="btn btn-info send">已送餐</buttion>
                            </div>
                        </div>
                    </div>
                </div><!-- ./tab-pane -->
            </div><!-- ./tab-content -->
        </div>
    </div>
</div>


<script type="text/javascript">
$(function () {

    var orderMeal = {
        storeDetailData: null,
        storeData: null,
        meal_time: 'noon',
        noon: '<?php echo ($noon); ?>',
        night: '<?php echo ($night); ?>',
        currentId: null,
        showStore: function (meal_time) {
            if (_type(this.storeData) == 'array' && this.storeData.length == 0) {
                $('#' + meal_time + '>.ex').css('display', 'none');
                $('#' + meal_time + '>.no').css('display', 'block');
                return false;
            }

            $('#' + meal_time + '>.ex').css('display', 'block');
            $('#' + meal_time + '>.no').css('display', 'none');

            var store = this.storeData;
            var storeList = $('.store-list').html('');
            var current = 0;
            for (var k in store) {
                if (store[k].status == 'new') {
                    if (current == 0) {
                        current = 1;
                        storeList.append('<li class="current" data-id="' + k + '">' + store[k].store_name + '</li>');
                    } else {
                        storeList.append('<li data-id="' + k + '">' + store[k].store_name + '</li>');
                    }
                } else if (store[k].status == 'order_success') {
                    storeList.append('<li class="success" data-id="' + k + '">' + store[k].store_name + '</li>');
                } else if (store[k].status == 'send_success') {
                    storeList.append('<li class="success" data-id="' + k + '">' + store[k].store_name + '</li>');
                }
            }
            if (current == 0) {
                $('.store-list>li').eq(0).addClass('current');
            }
        },
        showOrderData: function () {
            var data = this.storeDetailData;
            $('.store-value').eq(0).text(data.name);
            $('.store-value').eq(1).text(data.phone);
            $('.store-value').eq(2).text(data.adress);

            switch (data.status) {
                case 'new':
                    $('.ribbon-wrapper').css('display', 'none');
                    $('.order,.send').css('display', 'inline-block');
                    break;
                case 'order_success':
                    $('.order').css('display', 'none');
                    $('.send').css('display', 'inline-block');
                    $('.ribbon-wrapper').css('display', 'block');
                    $('.shadow-pulse').text('已订');
                    break;
                case 'send_success':
                    $('.send,.order').css('display', 'none');
                    $('.ribbon-wrapper').css('display', 'block');
                    $('.shadow-pulse').text('已派送');
                    break;
            }


            var tbody = $('.menu-table>tbody');
            tbody.html('');
            var row;
            var tds;
            var dish = data['dish'];
            for (var k in dish) {
                row = 1;
                console.log(dish[k].desc);
                row = dish[k].desc.length;
                tds = '';
                tds = '<tr><td rowspan="' + row + '">' + dish[k].dish_name + '</td>';
                tds += '<td rowspan="' + row + '">X' + dish[k].count + '</td>';
                var desc = dish[k].desc;
                for (var k1 in desc) {
                    if (k1 == 0) {
                        tds += '<td>' + desc[k1] +'</td></tr>';
                    } else {
                        tds += '<tr><td>' + desc[k1] + '</td></tr>'
                    }
                }
                tbody.append(tds);
            }
        },
        loadStoreDetailData: function (store_id, meal_time) {
            if (!store_id) {
                return false;
            }
            $.post('/online_meal_ordering/admin/index/getOrderDataByStore', {"id": store_id, "meal_time": meal_time}, function(res) {
                if (res.status == 'ok') {
                    orderMeal.storeDetailData = res.data;
                    orderMeal.showOrderData();
                } else {
                    Common.alertDialog(res.data);
                }
            }, 'json')
            .error(function () {
                Common.alertDialog('网络错误，请稍后再试');
            });
        },
        loadStoreData: function (meal_time) {
            meal_time = meal_time == 'night' ? meal_time : 'noon';
            var now = new Date();
            var date = now.Format('yyyy-MM-dd');
            var deadline = null;
            var str =  '';
            if (meal_time == 'noon') {
                deadline = new Date(date + ' ' + orderMeal.noon + ':00');
                str = '员工午餐订餐情况正在统计，请在' + orderMeal.noon + '后来查看~';
            } else {
                deadline = new Date(date + ' ' + orderMeal.night + ':00');
                str = '员工晚餐订餐情况正在统计，请在' + orderMeal.night + '后来查看~';
            }
            if (now < deadline) {
                $('.no').text(str);
                $('.no').css('display', 'block');
                orderMeal.showStore(meal_time);
                return false;
            } else {
                $('.no').text('当前还没有员工订餐~');
            }
            $.post('/online_meal_ordering/admin/index/getTodayOrderStore', {"meal_time" : meal_time}, function (res) {
                if (res.status == 'ok') {
                    orderMeal.storeData = res.data
                    orderMeal.showStore(meal_time);
                    orderMeal.currentId = $('li.current').data('id');
                    orderMeal.loadStoreDetailData(orderMeal.currentId, orderMeal.meal_time);
                } else {
                    Common.alertDialog(res.data);
                }
            }, 'json')
            .error(function () {
                Common.alertDialog('网路错误，请稍后再试');
            });
        },
        bindEvent: function () {
            $('ul.tab-bar>li').on('click', function () {
                if ($(this).hasClass('active')) {
                    return false;
                }
                if ($(this).index() == 0) {
                    orderMeal.meal_time = 'noon';
                } else {
                    orderMeal.meal_time = 'night';
                }
                orderMeal.loadStoreData(orderMeal.meal_time);
            });

            $('ul.store-list').on('click', 'li', function () {
                if ($(this).hasClass('current')) {
                    return false;
                }
                $('.current').removeClass('current');
                $(this).addClass('current');
                orderMeal.currentId = $(this).data('id');
                orderMeal.loadStoreDetailData(orderMeal.currentId, orderMeal.meal_time);
            });

            $('.order').on('click', function () {
                $.post('/online_meal_ordering/admin/index/updateStoreStatus', {"id": orderMeal.currentId, "meal_time": orderMeal.meal_time, "action":"order"}, function (res) {
                    if (res.status == 'ok') {
                        Common.alertDialog('订餐成功');
                        orderMeal.loadStoreDetailData(orderMeal.currentId, orderMeal.meal_time);
                    } else {
                        Common.alertDialog(res.data);
                    }
                }, 'json')
                .error(function () {
                    Common.alertDialog('网络错误，请稍后再试');
                });
            });

            $('.send').on('click', function () {
                $.post('/online_meal_ordering/admin/index/updateStoreStatus', {"id": orderMeal.currentId, "meal_time": orderMeal.meal_time, "action":"send"}, function (res) {
                    if (res.status == 'ok') {
                        Common.alertDialog('已收到订餐');
                        orderMeal.loadStoreDetailData(orderMeal.currentId, orderMeal.meal_time);
                    } else {
                        Common.alertDialog(res.data);
                    }
                }, 'json')
                .error(function () {
                    Common.alertDialog('网络错误，请稍后再试');
                });
            });

        },
        init: function () {
            this.loadStoreData();
            this.bindEvent();

        }
    };

    orderMeal.init();

});


</script>

                </div>
            </div>
            <footer class="footer">
                <span class="footer-brand">
                    <strong class="text-danger">企业</strong> 订餐
                </span>
                <p class="no-margin">
                    &copy; 2016 <strong>Yangqinchuan</strong>. ALL Rights Reserved.
                </p>
            </footer>
        </div>


        <a href="#" class="scroll-to-top hidden-print active"><i class="fa fa-chevron-up fa-lg"></i></a>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confirmDialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="_close close" type="button">×</button>
                        <h4 class="modal-title">提示信息</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="_close btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button"  data-dismiss="modal" class="_confirm btn btn-warning">确认</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="alertDialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="_close close" type="button">×</button>
                        <h4 class="modal-title">提示信息</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="_close btn btn-danger" data-dismiss="modal">确认</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- Footer -->
        <script type="text/javascript">
            $(function () {
                var nav = '<?php echo ($nav); ?>';
                var subNav = '<?php echo ($subNav); ?>';
                if (subNav) {
                    $('.nav-i').eq(nav - 1).addClass('open');
                    $('.nav-i').eq(nav - 1).find('ul.submenu').css('display', 'block').find('li').eq(subNav - 1).addClass('active');
                } else {
                    $('.nav-i').eq(nav - 1).addClass('active');
                }
            });

        </script>
    </body>
</html>