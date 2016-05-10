<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <!--
    #######################################
        - THE HEAD PART -
    ######################################
    -->
    <head>
        <meta charset="utf-8">
        <title>员工订餐系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <base href="/online_meal_ordering/Public/landing/">

        <!-- Bootstrap core CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet">

        <!-- ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet">

        <!-- Owl -->
        <link href="../css/owl.carousel.min.css" rel="stylesheet">
        <link href="../css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Revolution Slider -->
        <link href="css/style.css" rel="stylesheet">
        <link href="rs-plugin/css/settings.css" rel="stylesheet">
        <link href="css/extralayers.css" rel="stylesheet">

        <!-- Simplify -->
        <link href="../css/simplify.css" rel="stylesheet">
        <!-- Common -->
        <link href="../css/self/common.css" rel="stylesheet">


        <!-- Jquery -->
        <script src="../js/jquery-1.11.1.min.js"></script>

        <!-- Bootstrap -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!-- Modernizr -->
        <script src='../js/modernizr.min.js'></script>

        <!-- Owl -->
        <script src='../js/owl.carousel.min.js'></script>

        <!-- Waypoint -->
        <script src='../js/waypoints.min.js'></script>

        <!-- ScrollTo -->
        <script src="../js/jquery.scrollTo.min.js"></script>

        <!-- Local Scroll -->
        <script src="../js/jquery.localScroll.min.js"></script>

        <!-- Local Scroll -->
        <script src="../js/self/common.js"></script>

        <!-- Revolution Slider -->
        <script src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    </head>

    <style type="text/css">
        ._headimg {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
        }
        ._personal_center {

        }
        ._none {
            display: none;
        }
        ._nav >li.active>a {
            color: #2baab1;
        }
    </style>
<!--
#######################################
    - THE BODY PART -
######################################
-->
    <body>
        <div class="wrapper front-end-wrapper">
            <header class="navbar front-end-navbar" data-spy="affix" data-offset-top="1">
              <div class="container">
                <div class="navbar-header">
                  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="/online_meal_ordering/home/" class="navbar-brand"><strong><span class="text-success">员工</span>订餐系统</strong></a>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                  <ul class="nav _nav navbar-nav">
                    <li>
                      <a href="/online_meal_ordering/home/user/index">个人中心</a>
                    </li>
                    <li>
                      <a href="/online_meal_ordering/home/order/myOrder">我的订单</a>
                    </li>
                    <li>
                      <a href="/online_meal_ordering/home/order/todayorder">今日订餐</a>
                    </li>
                    <li>
                      <a href="/online_meal_ordering/home/order/orderplan">订餐计划</a>
                    </li>
                    <li>
                      <a href="/online_meal_ordering/home/favorite/index">收藏夹</a>
                    </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['KIS_SESSION']['name'])): ?><li class="btn-link _personal_center">
                        <img src="../<?php echo (session('headimg')); ?>" alt="" class="inline-block _headimg">
                        <div class="inline-block"><a href="/online_meal_ordering/home/user/index"><?php echo (session('name')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/online_meal_ordering/admin/user/logout">退出</a></div>
                    </li>
                    <?php else: ?>
                    <li class="btn-link"><a href="/online_meal_ordering/admin/user/index" class="btn btn-sm btn-success">登录</a></li><?php endif; ?>
                  </ul>
                </nav>
              </div>
            </header>

            <style type="text/css">
    .store-name {
        font-size: 16px;
        padding: 0px 20px 5px 10px;
        font-weight: bolder;
    }
    .store-desc {
        font-size: 12px;
        padding: 0px 20px 5px 10px;
    }
    .store-score {
        padding: 0px 10px 10px 10px;
    }
    .store-already {
        padding: 0px 10px 10px 10px;
        float: right;
    }
    .store:hover {
        border: 1px solid #2baab1;
        cursor: pointer;
    }
    #banner {
        margin-top: 10px;
    }
    hr {
        border-top: 2px solid #2baab1;
    }
    .kind-div {
        border: 1px solid #eee;
        overflow: hidden;
        margin-bottom: 15px;
    }
    .dish-kind {
        line-height: 36px;
        text-align: center;
    }
    .dish-kind:hover {
        background: #32c5cd;
        color: white;
        cursor: pointer;
    }
    .dish-kind-checked,.dish-sort-checked {
        background: #32c5cd;
        color: white;
        text-align: center;
    }
    .sort-item {
        border-right: 1px solid #eee;
    }
    .demo {
        display: none;
    }
</style>

<div class="section" id="banner">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel">
                    <div class="item">
                        <img src="../images/banner/banner1.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="../images/banner/banner2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="../images/banner/banner3.jpg" alt="">
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- ./row -->
    </div><!-- ./container -->
</div><!-- ./section -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="header-text m-bottom-md">
                        <i class="fa fa-building-o"></i>&nbsp;&nbsp;店铺
                    <span class="sub-header">
                        store
                    </span>
                </h3>
            </div>
            <div class="col-md-12">
                <div class="kind-div bg-white">
                    <div class="col-md-1" style="margin: 10px 0px;"><h5 class="text-center" style="font-size: 16px;">分类</h5></div>
                    <div class="col-md-10" style="margin: 10px 0px; border-left: 1px solid #eee;">
                        <a class="shanglv col-md-2 dish-kind dish-kind-item dish-kind-checked" data-id="0">全部</a>
                        <?php if(is_array($kindList)): foreach($kindList as $key=>$v): ?><a class="shanglv col-md-2 dish-kind-item dish-kind" data-id="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></a><?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="kind-div bg-white">
                    <a href="javascript:" class="col-md-1 dish-kind sort-item dish-sort-checked" data-sort="default">默认</a>
                    <a href="" class="col-md-1 dish-kind sort-item" data-sort="new">最新添加</a>
                    <a href="" class="col-md-1 dish-kind sort-item" data-sort="up">订餐量 <i class="fa fa-arrow-up fa-1x"></i></a>
                    <a href="" class="col-md-1 dish-kind sort-item" data-sort="down">订餐量 <i class="fa fa-arrow-down fa-1x"></i></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 demo">
                <div class="store pricing-widget clean-pricing bounceIn animation-element" >
                    <div class="pricing-type text-center">
                        <img src="../images/store/01.jpg" alt="">
                    </div>
                    <div class="store-name shenglv"></div>
                    <p class="store-desc common-font"></p>
                    <p class="common-font ">
                        <span class="store-score"></span>
                        <span class="store-already"></span>
                    </p>
                </div><!-- ./pricing-widget -->
            </div><!-- .col -->

            <div class="col-sm-12 text-center none" style="display: none;margin: 10px 0px;">暂时没有店铺信息</div>
        </div><!-- ./row -->
    </div><!-- ./container -->
</div>


<script type="text/javascript">

$(function () {
    $('body').on('click', '.store', function () {
        location.href = '/online_meal_ordering/home/dish/index/id/' + $(this).data('id');
    });

    var list = {
        listData: null,
        currentKind: '',
        updateList: function () {
            $('.new').remove();
            if (!this.listData || this.listData.length == 0) {
                $('.none').css('display','block');
                return false;
            }
            $('.none').css('display','none');
            for (var k in this.listData) {
                var item = $('.demo').clone();
                item.find('.store').data('id', this.listData[k].id);
                item.find('img').attr('src', '../' + this.listData[k].picture);
                item.find('.store-name').text(this.listData[k].name);
                item.find('.store-desc').text(this.listData[k].desc);
                item.find('.store-score').text((this.listData[k].score ? this.listData[k].score : '3.0') + '分');
                item.find('.store-already').text('已订'+ (this.listData[k].mount ? this.listData[k].mount : '0') +'份');
                item.insertBefore('.demo').removeClass('demo').addClass('new');
            }

        },
        getStoreList: function () {
            var data = {};
            if (this.currentKind) {
                data.kindId = this.currentKind;
            }
            if (this.sort != 'default') {
                data.sort = this.sort;
            }
            $.post('/online_meal_ordering/home/index/getStoreList', data, function (res) {
                if (res.status == 'ok') {
                    list.listData = res.data;
                    list.updateList();
                } else {
                    list.getStoreList();
                }
            }, 'json');
        },
        bindEvent: function () {
            $('.dish-kind-item').on('click', function () {
                if ($(this).hasClass('dish-kind-checked')) {
                    return false;
                }
                $('.dish-kind-checked').removeClass('dish-kind-checked');
                $(this).addClass('dish-kind-checked');
                list.currentKind = $(this).data('id');
                list.getStoreList();
                return false;
            });

            $('.sort-item').on('click', function () {
                if ($(this).hasClass('dish-sort-checked')) {
                    return false;
                }
                $('.dish-sort-checked').removeClass('dish-sort-checked');
                $(this).addClass('dish-sort-checked');
                list.sort = $(this).data('sort');
                list.getStoreList();
                return false;
            });
        },
        init: function () {
            this.bindEvent();
            this.getStoreList();
        }
    };
    list.init();
});

</script>


            <footer class="front-end-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>联系我们</h4>
                            <address class="m-top-md">
                                <div class="seperator"></div>
                                <strong>Phone : <span class="theme-font">15801094323</span></strong><br>
                                <strong>Email : <span class="theme-font">yangqinchuan_kis@163.com</span></strong><br>
                                <strong>Website : <span class="theme-font">kisme.xicp.cn</span></strong>
                            </address>
                        </div><!-- ./col -->
                        <div class="col-md-3">
                            <h4>个人订餐链接</h4>
                            <ul class="list-unstyled m-top-md">
                                <li><a href="http://www.nuomi.com/" target="_blank">百度糯米</a></li>
                                <li><a href="http://waimai.baidu.com/" target="_blank">百度外卖</a></li>
                                <li><a href="http://waimai.meituan.com/" target="_blank">美团外卖</a></li>
                                <li><a href="https://www.ele.me" target="_blank">饿了么</a></li>
                            </ul>
                        </div><!-- ./col -->
                        <div class="col-md-3">
                        </div><!-- ./col -->
                        <div class="col-md-3">
                            <h4>Flikr Photo</h4>

                            <ul class="photo-list m-top-md">
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery1.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery2.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery3.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery4.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery5.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery6.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery7.jpg" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="../images/gallery/gallery8.jpg" alt=""></a>
                                </li>
                            </ul>
                        </div><!-- ./col -->
                    </div><!-- ./row -->
                </div><!-- ./container -->
            </footer>

            <a href="#" class="scroll-to-top hidden-print"><i class="fa fa-chevron-up fa-lg"></i></a>
        </div><!-- /wrapper -->

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

        <script type="text/javascript">

        jQuery(document).ready(function() {
            //Slider Revolution
            jQuery('.tp-banner').show().revolution(
            {
                dottedOverlay:"none",
                delay:16000,
                startwidth:1170,
                startheight:700,
                hideThumbs:200,

                thumbWidth:100,
                thumbHeight:50,
                thumbAmount:5,

                navigationType:"bullet",
                navigationArrows:"solo",
                navigationStyle:"preview4",

                touchenabled:"on",
                onHoverStop:"on",

                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,

                                        parallax:"mouse",
                parallaxBgFreeze:"on",
                parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

                keyboardNavigation:"off",

                navigationStyle: "preview2",
                navigationHAlign:"center",
                navigationVAlign:"middle",
                navigationHOffset:0,
                navigationVOffset:20,

                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"center",
                soloArrowLeftHOffset:20,
                soloArrowLeftVOffset:0,

                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:20,
                soloArrowRightVOffset:0,

                shadow:0,
                fullWidth:"on",
                fullScreen:"off",

                spinner:"spinner4",

                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,

                shuffle:"off",

                autoHeight:"off",
                forceFullWidth:"off",

                hideThumbsOnMobile:"off",
                hideNavDelayOnMobile:1500,
                hideBulletsOnMobile:"off",
                hideArrowsOnMobile:"off",
                hideThumbsUnderResolution:0,

                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                startWithSlide:0,
                fullScreenOffsetContainer: ".header"
            });
            //End Slider Revolution

            //Section Animation
            if (Modernizr.mq('(min-width: 1349px)')) {
                $('.animation-element').waypoint(function() {
                        $(this).removeClass('disabled');
                }, { offset: 700 });
            }
            else if (Modernizr.mq('(min-width: 992px)') && Modernizr.mq('(max-width: 1349px)')) {
                $('.animation-element').waypoint(function() {
                        $(this).removeClass('disabled');
                }, { offset: 550 });
            }
            else    {
                $('.animation-element').removeClass('disabled');
            }

            //Testimonial carousel
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                items:1,
                autoplay:true,
                autoplayTimeout:2500,
                autoplayHoverPause:true,
                smartSpeed:500
            });

            //Scrollto section
            $('.front-end-wrapper .navbar-collapse .navbar-nav').localScroll({
              duration:800,
              offset: -100
            });


            var nav = '<?php echo ($nav); ?>';
            if (nav) {
                $('._nav>li').eq(nav-1).addClass('active');
            }

        });

    </script>

    </body>
</html>