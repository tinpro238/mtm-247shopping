<div class="box">
 <div class="box-heading"><?php echo $heading_title;?></div>
 <div class="box-content">
  <?php if ($deals) { ?>
  <div class="box-deal">
    <?php foreach ($deals as $deal) { ?>
    <div>      
      <?php if($deal['sale']) {?>
      <div class="sale"><?php echo $deal['sale']; ?><span>%</span></div>
      <?php } ?>
        <?php if ($deal['thumb']) { ?>
        <div class="image">
          <a href="<?php echo $deal['href']; ?>"><img src="<?php echo $deal['thumb']; ?>" alt="<?php echo $deal['name']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" title="<?php echo $deal['name']; ?>" /></a>
          <div class="wishlist"><a onclick="addToWishList('<?php echo $deal['product_id']; ?>');"><?php echo $button_wishlist; ?></a></div>
          <div class="compare"><a onclick="addToCompare('<?php echo $deal['product_id']; ?>');"><?php echo $button_compare; ?></a></div>
          <div class="cart"><a onclick="addToCart('<?php echo $deal['product_id']; ?>');" class="button"><span><?php echo $button_cart; ?></span></a></div>
        </div>
        <?php } ?>
        <div class="name"><a href="<?php echo $deal['href']; ?>"><?php echo $deal['name']; ?></a></div>
        <div class="description"><?php echo $deal['description']; ?></div>
        <!--<?php if($deal['manufacturer']) { ?>
        <div class="manufacturer"><span>Cung cấp bởi: </span><?php echo $deal['manufacturer']; ?></div>
        <?php } ?>   -->
        <?php if ($deal['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $deal['rating']; ?>.png" alt="<?php echo $deal['reviews']; ?>" /></div>
        <?php } ?>
        <?php if ($deal['price']) { ?>
        <div class="price-buy">
            <div class="dvprice">
                <b>Giá bán</b>
                <span class="price-new"><?php if (!$deal['special']) { ?>
                    <?php echo $deal['price']; ?>
                    <?php } else { ?>
                    <?php echo $deal['special']; ?>
                    <?php } ?></span>
                <?php if ($deal['tax']) { ?>
                <span class="price-tax"><?php echo $text_tax; ?> <?php echo $deal['tax']; ?></span>
                <?php } ?>
            </div>
            <div class="dvbuy">
            	<a id="buy_show<?php echo $deal['product_id']; ?>" class="show" onclick="addToCart('<?php echo $deal['product_id']; ?>');"></a>  
                <a id="buy_hide<?php echo $deal['product_id']; ?>" class="hide" onclick="addToCart('<?php echo $deal['product_id']; ?>');"></a>        
            </div>
            <div class="clear"></div>
            <div class="price-old">Trị giá<br><span><strike><?php echo $deal['price']; ?></strike></span></div>
            <div class="saving">Tiết kiệm<br><span><?php echo $deal['saving']; ?></span></div>
            <div class="period">Thời gian còn lại
            <div id="<?php echo $deal['product_id']; ?>"><span class="time">119 </span><span class="time"> 56 </span><span class="time"> 37 </span></div>
            </div>
        </div>
        <script type="text/javascript">
			var currentyear=new Date().getFullYear()
			var target_date=new cdtime(<?php echo $deal['product_id']; ?>, '<?php echo $deal["date_end"]; ?>')
			target_date.displaycountdown("days", displayCountDown)
		</script>
        <?php } ?>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if (!$deals) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  <?php } ?>
 </div>
</div>
