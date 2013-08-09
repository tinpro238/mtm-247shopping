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
        <?php foreach ($banners as $banner) { ?>
            <li>
                <a href="<?php echo $banner['link']; ?>" title="<?php echo $banner['title']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"/></a>
                <div class="description">
                    <h3><a href="#">Ấm Đun Siêu Tốc Fujishi FB18</a></h3>
                    <div>
                        <p class="prices">
                            <span class="price">150.000đ</span>&nbsp;&nbsp;
                            <span class="old-price">200.000đ</span>
                        </p>
                        <p class="summary">Tiết kiệm thời gian với Ấm đun siêu tốc Fujishi FB- 18 công suất 1500W với giá cực ưu đãi.</p>
                        <p class="stat">
                            <i class="icon-user"></i> 26 &nbsp;
                            <i class="icon-thumbs-up"></i> 26
                        </p>
                        <a href="<?php echo $banner['link']; ?>" class="button button-green">Xem chi tiết</a>
                    </div>
                </div>
            </li>
        <?php } ?>        
    </ul>
    <div style="clear: both"></div>
</div>