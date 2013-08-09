
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $title; ?></title>
            <base href="<?php echo $base; ?>" />
            <?php if ($description) { ?>
                <meta name="description" content="<?php echo $description; ?>" />
            <?php } ?>
            <?php if ($keywords) { ?>
                <meta name="keywords" content="<?php echo $keywords; ?>" />
            <?php } ?>
            <?php if ($icon) { ?>
                <link href="<?php echo $icon; ?>" type="image/x-icon" title="SELFHTML Icon" rel="shortcut icon" />
            <?php } ?>
            <?php foreach ($links as $link) { ?>
                <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
            <?php } ?>
            <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/bootstrap-glyphicons.css" />
            <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/button.css" />
            <!--        <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/bootstrap-responsive.min.css" />-->
            <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/style.css" />        
            <!-- scroller -->            
            <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.10.2.min.js"></script>
            <script type="text/javascript" src="catalog/view/theme/247shopping/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="catalog/view/theme/247shopping/js/twitter-bootstrap-hover-dropdown.min.js"></script>
            <?php foreach ($styles as $style) { ?>
                <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
            <?php } ?>
            <link href="catalog/view/theme/247shopping/stylesheet/scroller_roll.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="catalog/view/javascript/scroller_roll.js"></script>
            <script type="text/javascript" src="catalog/view/theme/247shopping/js/jquery.lazyload.min.js"></script>
            <script type="text/javascript" src="catalog/view/javascript/countdown.js"></script>
            <?php foreach ($scripts as $script) { ?>
                <script type="text/javascript" src="<?php echo $script; ?>"></script>
            <?php } ?>
            <!--[if IE 7]> 
            <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/ie7.css" />
            <![endif]-->
            <!--[if lt IE 7]>
            <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/ie6.css" />
            <script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
            <script type="text/javascript">
            DD_belatedPNG.fix('#logo img');
            </script>
            <![endif]-->
            <?php if ($stores) { ?>
                <script type="text/javascript"><!--
                $(document).ready(function() {
    <?php foreach ($stores as $store) { ?>
                            $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
    <?php } ?>
                    });
                    //--></script>
            <?php } ?>
            <?php echo $google_analytics; ?>
            <script language="javascript" type="text/javascript">
                $(document).ready(function() {

                    $(".cell img").lazyload({
                        effect: "fadeIn"
                    });

                    $("#scroller").scroller_roll({
                        title_show: 'disable',
                        time_interval: '12',
                        window_background_color: 'none',
                        window_padding: '0',
                        border_size: '0',
                        border_color: 'transparent',
                        images_width: 'auto',
                        images_height: '300',
                        images_margin: '0',
                        title_size: '12',
                        title_color: 'black',
                        show_count: '1'
                    });

                    $('.cell').hover(function(e) {
                        // mouse over
                        $(this).find('.description div').stop();
                        $(this).find('.description div').slideDown();
                    }, function(e) {
                        // mouse out
                        $(this).find('.description div').stop();
                        $(this).find('.description div').slideUp();
                    });

                    $('#scroller > ul > li').hover(function(e) {
                        $(this).find('.description').stop();
                        $(this).find('.description').fadeIn('fast');
                    }, function(e) {
                        $(this).find('.description').stop();
                        $(this).find('.description').fadeOut();
                    });

                    // $('#content div.cell:nth-child(2n+1)').css('margin-right', '6px');

                    $('.go-top').hide();

                    $('.go-top').click(function() {
                        $('html,body').animate({scrollTop: 0}, 'slow');
                        return false;
                    });

                    $(window).scroll(function() {
                        delta = $(window).scrollTop();
                        if (delta == 0) {
                            $('.go-top').fadeOut();
                        } else {
                            $('.go-top').fadeIn();
                        }
                    });

                });
            </script>
            <!-- endscroller -->		
<link href="catalog/view/javascript/jquery/cloud-zoom/cloud-zoom.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript" src="catalog/view/javascript/jquery/cloud-zoom/cloud-zoom.1.0.2.js"></script>
    </head>
    <body>

        <div id="container">
            <div id="top">
                <div id="top-fixed">
                    <div class="top-nav">
                        <div class="inner">
                            <?php if ($logo) { ?>
                                <h1 class="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></h1>
                            <?php } ?>
                            <ul class="menu unstyled">
                                <li><a href="#">Tất cả deal</a></li>
                                <li><a href="#">Deal trong ngày</a></li>
                                <li><a href="#">Deal hot</a></li>
                            </ul>
                            <div class="pull-right login">
                                <a href="#"><i class="icon-white icon-off"></i> Đăng nhập</a>
                            </div>
                            <div class="pull-right login">
                                <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i> Giỏ hàng (15)</a>
                            </div>
                            <div class="pull-right" id="subcribe">
                                <form class="">
                                    <div class="control-group">
                                        <div class="input-append" style="margin:0;">
                                            <input class="span3" id="email" type="text" placeholder="Đăng ký nhận email giảm giá">
                                                <span class="add-on"><i class="icon-envelope"></i></span>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php if ($categories) { ?>
                        <div class="sub-top-nav">
                            <div class="inner">
                                <ul class="nav nav-pills" style="margin:0">
                                    <?php foreach ($categories as $category) { ?>

                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-hover="dropdown" href="<?php echo $category['href']; ?>">
                                                <?php echo $category['name']; ?> <strong>(<?php echo $category['product_total'] ?>)</strong> <?php if ($category['children']) { ?><span class="caret"></span><?php } ?>
                                            </a>
                                            <?php if ($category['children']) { ?>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($category['children'] as $child2) { ?>
                                                        <?php if ($child2['children']) { ?>
                                                            <li class="dropdown-submenu">
                                                                <a href="<?php echo $child2['href']; ?>"><?php echo $child2['name_standard'] ?> <strong>(<?php echo $child2['product_total'] ?>)</strong></a>                                                                
                                                                <ul class="dropdown-menu">
                                                                    <?php foreach ($child2['children'] as $child3) { ?>
                                                                        <li><a href="<?php echo $child3['href']; ?>"><?php echo $child3['name_standard']; ?> <strong>(<?php echo $child3['product_total'] ?>)</strong></a></li>                                                                        
                                                                    <?php } ?>
                                                                </ul>                                                                
                                                            </li>
                                                        <?php } else { ?>
                                                            <li><a href="<?php echo $child2['href']; ?>"><?php echo $child2['name_standard']; ?> <strong>(<?php echo $child2['product_total'] ?>)</strong></a></li>                                                            
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>



