<div id="footer">
    <div class="inner">
        <?php if ($informations) { ?>
            <div class="column">
                <ul class="unstyled">
                <strong><?php echo $text_information; ?></strong>
                <div class="social-icon">
                    <a href="#"><img src="catalog/view/theme/247shopping/image/ggm.png" /></a>
                    <a href="#"><img src="catalog/view/theme/247shopping/image/fb.png" /></a>
                    <a href="#"><img src="catalog/view/theme/247shopping/image/yahoo.png" /></a>
                    <a href="#"><img src="catalog/view/theme/247shopping/image/skype.png" /></a>
                </div>
                
                <?php foreach ($informations as $information) { ?>
                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
                
                </ul>
            </div>
        <?php } ?>
        

        <div class="column">
            <ul class="unstyled"><strong><?php echo $text_help; ?></strong>
                <li><a href="<?php echo $giaonhan; ?>"><?php echo $text_giaonhan; ?></a></li>
                <li><a href="<?php echo $trahoantien; ?>"><?php echo $text_trahoantien; ?></a></li>
                <li><a href="<?php echo $sudung247shop; ?>"><?php echo $text_sudung247shop; ?></a></li>
                <li><a href="<?php echo $cachthucmuahang; ?>"><?php echo $text_cachthucmuahang; ?></a></li>
                <li><a href="<?php echo $hinhthucthanhtoan; ?>"><?php echo $text_hinhthucthanhtoan; ?></a></li>
                <li><a href="<?php echo $taikhoandonhang; ?>"><?php echo $text_taikhoandonhang; ?></a></li>
            </ul>
        </div>

        <div class="column">
            <strong><?php echo $text_company; ?></strong><br/>
            Công ty CP Mua Sắm 247<br/>
            93 Trần Thiện Chánh P.12, Q.10, HCMC<br/>
            Điện thoại: (08) 3862 5868<br/>
            Fax: (08) 3862 5869<br/>
            Website: www.247shopping.vn<br/>
            Email: info247@247shopping.vn<br/>
        </div>

        <div class="clearfix"></div>

    </div>
</div>

</div>

<a class="go-top" href="javascript:void(0);" title="Lên đầu trang"></a>

</body>
</html>