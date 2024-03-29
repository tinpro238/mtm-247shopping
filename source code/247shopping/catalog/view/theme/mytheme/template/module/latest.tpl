<div class="box">
    <div class="box-heading"><?php echo $heading_title; ?></div>
    <div class="box-content">
        <div class="box-product">
            <?php foreach ($products as $product) { ?>
                <div>
                    <?php if ($product['thumb']) { ?>
                        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                    <?php } ?>
                    <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                    <?php if ($product['price']) { ?>
                        <div class="price">
                            <?php if (!$product['special']) { ?>
                                <?php echo $product['price']; ?>
                            <?php } else { ?>
                                <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                <div class="period">Thời gian còn lại
                                    <div id="<?php echo $product['product_id']; ?>"><span class="time">119 </span><span class="time"> 56 </span><span class="time"> 37 </span></div>
                                </div>
                                <script type="text/javascript">
                                    var currentyear = new Date().getFullYear()
                                    var target_date = new cdtime(<?php echo $product['product_id']; ?>, '<?php echo $product["date_end"]; ?>')
                                    target_date.displaycountdown("days", displayCountDown)
                                </script>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if ($product['rating']) { ?>
                        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                    <?php } ?>
                    <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
