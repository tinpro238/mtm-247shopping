<?php
$column = 3;
$count = 0;
?>
<div class="inner">
    <div class="cat-header">
        <h3 class="pull-left"><a href="#"><?php echo $heading_title; ?></a><span class="count"> (154)</span></h3>
        <div class="clearfix"></div>
    </div>
    <?php if ($deals) { ?>
        <?php foreach ($deals as $deal) { ?>
            <?php $count++; ?>            
            <div class="cell<?php echo (($count % $column) == 0) ? ' cell-fix' : ''; ?>">
                <?php if ($deal['sale']) { ?>
                        <!--                    <div class="sale"><?php echo $deal['sale']; ?><span>%</span></div>-->
                <?php } ?>
                <?php if ($deal['thumb']) { ?>
                    <a href="<?php echo $deal['href']; ?>"><img src="catalog/view/theme/247shopping/image/grey.gif" data-original="<?php echo $deal['thumb']; ?>" /></a>
                <?php } ?>
                <div class="description">
                    <h3><a href="<?php echo $deal['href']; ?>"><?php echo $deal['name']; ?></a></h3>
                    <div>
                        <p class="prices">
                            <span class="price">
                                <?php if (!$deal['special']) { ?>
                                    <?php echo $deal['price']; ?>
                                <?php } else { ?>
                                    <?php echo $deal['special']; ?>
                                <?php } ?>
                            </span>
                            <br/>
                            <span class="old-price">                                
                                <?php echo $deal['price']; ?>                                
                            </span>
                        </p>
                        <p class="summary"><?php echo $deal['description']; ?></p>
                        <p class="stat">
                            <i class="icon-user"></i> 26 &nbsp;
                            <i class="icon-thumbs-up"></i> 26
                        </p>
                        <a href="<?php echo $deal['href']; ?>" class="button button-green">Xem chi tiết</a>
                    </div>
                </div>
            </div>


        <?php } ?>
        <div class="clearfix"></div>
    <?php } ?>
    <?php if (!$deals) { ?>
        <div class="content"><?php echo $text_empty; ?></div>
        <div class="buttons">
            <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
        </div>
    <?php } ?>

</div>

