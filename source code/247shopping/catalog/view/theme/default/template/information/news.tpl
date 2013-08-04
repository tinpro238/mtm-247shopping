<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="news-info">
  <div class="heading-title"><?php echo $heading_title; ?></div>
    <?php if ($review_status) { ?>
    <div class="review">
	  <!-- chia se-->
      <div class="share">
<!--<img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" align="left" />-->
		  <!-- Place this tag where you want the +1 button to render -->
		<g:plusone size="small" annotation="none"></g:plusone>

		<!-- Place this render call where appropriate -->
		<script type="text/javascript">
 			 (function() {
   			 var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
 			   po.src = 'https://apis.google.com/js/plusone.js';
 			   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 		 })();
		</script>
		  <a href="javascript:void(0)" title="Facebook" onclick="fbs_click()"><img border="0" src="image/social/share_facebook_20.png" height="18" /></a>
		  <a href="javascript:void(0)" title="Twitter" onclick="twitter_click()"><img border="0" src="image/social/share_twitter_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Linkedin" onclick="linkedin_click()"><img border="0" src="image/social/share_linkedin_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Wordpress" onclick="wordpress_click()"><img border="0" src="image/social/share_wordpress_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="MySpace" onclick="myspace_click()"><img border="0" src="image/social/share_myspace_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Stumbleupon" onclick="stumbleupon_click()"><img border="0" src="image/social/share_stumbleupon_20.png" height="18"/></a>
  		  <a href="javascript:void(0)" title="Delicious" onclick="delicious_click()"><img border="0" src="image/social/share_delicious_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Digg" onclick="digg_click()"><img border="0" src="image/social/share_digg_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Reddit" onclick="reddit_click()"><img border="0" src="image/social/share_reddit_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Messenger" onclick="messenger_click()"><img border="0" src="image/social/share_messenger_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Google" onclick="google_click()"><img border="0" src="image/social/share_google_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Blogger" onclick="blogger_click()"><img border="0" src="image/social/share_blogger_20.png" height="18"/></a>
	 	  <a href="javascript:void(0)" title="Google Reader" onclick="googlereader_click()"><img border="0" src="image/social/share_googlereader_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Linkhay" onclick="linkhay_click()"><img border="0" src="image/social/share_linkhay_20.png" height="18"/></a>
		  <a href="javascript:void(0)" title="Zing Me" onclick="zingme_click()"><img border="0" width="20" src="image/social/share_zingme_20.png" height="18"/></a>
		
    </div>
	<!--ket thuc chia se-->
    <?php } ?>
    <div class="description">
<?php echo $description; ?>
    <br/> 
Đừng quên nhấn nút Thích trên Facebook của chúng tôi để nhận tin mới hàng ngày nhé.<br/>
<div class="fb-like" data-href="http://www.facebook.com/pages/So1VnvN/144848878911054" data-send="true" data-width="480" data-show-faces="fasle"></div>
	</div>
	<div class="descriptionfb">
   <div class="fb-comments" data-href="<?php echo $href;?>" data-num-posts="5" data-width="660" data-colorscheme="dark" style"border-color:#000000" style"font-color:#000000"></div>
	</div>
    </div>
    <?php if ($review_status) { ?>
    <div id="tab-review">
      <div id="review"></div>
      <h2 id="review-title"><?php echo $text_write; ?></h2>
      <b><?php echo $entry_name; ?></b><br />
      <input type="text" name="name" value="" />
      <br />
      <br />
      <b><?php echo $entry_review; ?></b>
      <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
      <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
      <br />
      <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
      <input type="radio" name="rating" value="1" />
      &nbsp;
      <input type="radio" name="rating" value="2" />
      &nbsp;
      <input type="radio" name="rating" value="3" />
      &nbsp;
      <input type="radio" name="rating" value="4" />
      &nbsp;
      <input type="radio" name="rating" value="5" />
      &nbsp; <span><?php echo $entry_good; ?></span><br />
      <br />
      <b><?php echo $entry_captcha; ?></b><br />
      <input type="text" name="captcha" value="" />
      <br />
      <img src="index.php?route=information/news/captcha" alt="" id="captcha" /><br />
      <br />
      <div>
      <div class="left"><a id="button-review" class="button"><span><?php echo $button_continue; ?></span></a></div>
      </div>
  </div>
  <?php } ?>
  </div>
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php foreach ($tags as $tag) { ?>
    <a href="<?php echo $tag['href']; ?>"><?php echo $tag['tag']; ?></a>,
    <?php } ?>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').slideUp('slow');
		
	$('#review').load(this.href);
	
	$('#review').slideDown('slow');
	
	return false;
});			

$('#review').load('index.php?route=information/news/review&news_id=<?php echo $news_id; ?>');

$('#button-review').bind('click', function() {
	$.ajax({
		type: 'POST',
		url: 'index.php?route=information/news/write&news_id=<?php echo $news_id; ?>',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data.error) {
				$('#review-title').after('<div class="warning">' + data.error + '</div>');
			}
			
			if (data.success) {
				$('#review-title').after('<div class="success">' + data.success + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script>
<script type="text/javascript">
function GetMetaValue(meta_name) {
	var my_arr=document.getElementsByTagName("META");
	for (var counter=0; counter<my_arr.length; counter++) {
		if (my_arr[counter].name.toLowerCase() == meta_name.toLowerCase()) {
			return my_arr[counter].content;
		}
	}  
	return "N/A";
}
</script>
<script type="text/javascript">
function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function twitter_click(){u=location.href;t=document.title;window.open('http://twitter.com/share/?url='+encodeURIComponent(u)+'&text='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function linkedin_click(){u=location.href;t=document.title;window.open('http://www.linkedin.com/shareArticle?url='+encodeURIComponent(u)+'&title='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function wordpress_click(){u=location.href;t=document.title;window.open('http://so1vnforum.wordpress.com/wp-admin/press-this.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t)+'&s='+GetMetaValue('description')+'&v='+2,'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function tumblr_click() {u=location.href;t=document.title;window.open('http://www.tumblr.com/share/link?url='+encodeURIComponent(u)+'&name='+t+'&description='+GetMetaValue('description'),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function myspace_click() {u=location.href;t=document.title;window.open('http://www.myspace.com/index.cfm?fuseaction=postto&t='+encodeURIComponent(t)+'&c='+GetMetaValue('description')+'&u='+encodeURIComponent(u),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function stumbleupon_click() {u=location.href;t=document.title;window.open('http://www.stumbleupon.com/submit?url='+encodeURIComponent(u)+'&title='+t,'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function delicious_click() {u=location.href;t=document.title;window.open('http://delicious.com/post?url='+encodeURIComponent(u)+'&title='+t+'&notes='+GetMetaValue('description'),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function digg_click() {u=location.href;t=document.title;window.open('http://digg.com/submit?url='+encodeURIComponent(u)+'&title='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function reddit_click() {u=location.href;t=document.title;window.open('http://www.reddit.com/submit?url='+encodeURIComponent(u)+'&title='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function messenger_click() {u=location.href;t=document.title;window.open('http://profile.live.com/P.mvc#!/badge?url='+encodeURIComponent(u)+'&title='+encodeURIComponent(t)+'&description='+GetMetaValue('description'),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function google_click() {u=location.href;t=document.title;window.open('http://www.google.com/bookmarks/mark?op=edit&bkmk='+encodeURIComponent(u)+'&title='+t+'&annotation='+GetMetaValue('description'),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function blogger_click(){u=location.href;t=document.title;window.open('http://www.blogger.com/blog_this.pyra?t=&u='+encodeURIComponent(u)+'&n='+encodeURIComponent(t)+'&pli='+1,'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function googlereader_click() {u=location.href;t=document.title;window.open('http://www.google.com/reader/link?url='+encodeURIComponent(u)+'&title='+t+'&snippet='+GetMetaValue('description'),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function linkhay_click() {u=location.href;t=document.title;window.open('http://linkhay.com/submit?link_url='+encodeURIComponent(u)+'&link_title='+t,'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function zingme_click() {u=location.href;t=document.title;window.open('http://link.apps.zing.vn/pro/view/conn/share?u='+encodeURIComponent(u)+'&t='+t+'&desc='+GetMetaValue('description'),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
//function govn_click() {u=location.href;t=document.title;window.open('http://my.go.vn/share.aspx?url='+encodeURIComponent(u)+'&title='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
function yahoo_click() {u=location.href;t=document.title;window.open('http://buzz.yahoo.com/buzz?publisherurn=VNE&targetUrl='+encodeURIComponent(u),'sharer','toolbar=0,status=0,width=626,height=436');return false;}
</script>
<?php echo $footer; ?>