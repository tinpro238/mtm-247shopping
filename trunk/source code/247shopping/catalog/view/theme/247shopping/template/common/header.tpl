
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/247shopping/stylesheet/style.css" />        
        <!-- scroller -->
        <link href="catalog/view/theme/247shopping/stylesheet/scroller_roll.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
        <?php foreach ($styles as $style) { ?>
            <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php } ?>
        <script type="text/javascript" src="catalog/view/javascript/scroller_roll.js"></script>
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
                
                $('.cell').hover(function(e) {
                    // mouse over
                    $(this).find('.description div').stop();
                    $(this).find('.description div').slideDown();
                }, function(e) {
                    // mouse out
                    $(this).find('.description div').stop();
                    $(this).find('.description div').slideUp();
                });

                $('#content div.cell:nth-child(2n+1)').css('margin-right', '18px');

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
                                <li><a href="#"><i class="menu-service"></i>Dịch vụ</a></li>
                                <li><a href="#"><i class="menu-product"></i>Sản phẩm</a></li>
                                <li><a href="#"><i class="menu-fashion"></i>Thời trang</a></li>
                            </ul>
                            <div class="pull-right login">
                                <a href="#"><i class="icon-white icon-off"></i> Đăng nhập</a>
                            </div>
                            <div class="pull-right locations">
                                <select>
                                    <option>Hồ Chí Minh</option>
                                    <option>Biên Hòa</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="sub-top-nav">
                        <div class="inner">
                            <ul class="menu unstyled">
                                <li><a href="#" class="active"><i class="menu-service"></i>Deal Hot Trong Ngày</a></li>
                                <li><a href="#"><i class="menu-product"></i>Deal Bán Chạy</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            

            
                
            

            