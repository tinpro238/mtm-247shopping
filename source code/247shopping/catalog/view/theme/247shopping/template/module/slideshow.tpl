<!--<div class="slideshow">
  <div id="slideshow<?php echo $module; ?>" class="nivoSlider" style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
<?php foreach ($banners as $banner) { ?>
    <?php if ($banner['link']) { ?>
                            <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
    <?php } else { ?>
                            <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
    <?php } ?>
<?php } ?>
  </div>
</div>-->
<div id="scroller" class="scroller_roll">
    <ul>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/01.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/02.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/03.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/04.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/05.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/06.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/07.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/08.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/09.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/10.png" alt="title"/></a></li>
        <li><a href="#" title="title1"><img src="catalog/view/theme/247shopping/image/scroller_img/11.png" alt="title"/></a></li>
    </ul>
    <div style="clear: both"></div>
</div>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
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
    });
</script>