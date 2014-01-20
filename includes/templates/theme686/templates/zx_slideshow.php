<script language="javascript" type="text/javascript">
jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
			effect: '<?php echo ZX_SLIDESHOW_EFFECT; ?>',
			animSpeed: <?php echo ZX_SLIDESHOW_ANIM_SPEED; ?>,
 	        pauseTime: <?php echo ZX_SLIDESHOW_PAUSE; ?>,
			directionNav: <?php echo ZX_SLIDESHOW_NAV; ?>,
			directionNavHide: <?php echo ZX_SLIDESHOW_NAV_HIDE; ?>,
 	        controlNav: <?php echo ZX_SLIDESHOW_CONTROL_NAV; ?>,
			pauseOnHover: <?php echo ZX_SLIDESHOW_HOVER_PAUSE; ?>,
			captionOpacity: <?php echo ZX_SLIDESHOW_CAPTION_OPACITY; ?>
			});
    });

</script>

<div class="slider-wrapper theme-default">
    	<div id="slider" class="nivoSlider" style="width:<?php echo ZX_SLIDESHOW_WIDTH; ?>px !important; height:<?php echo ZX_SLIDESHOW_HEIGHT; ?>px !important;">
			<?php
  if (SHOW_BANNERS_GROUP_SET9 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET9)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner); 
    }
  }
?>
			
			<?php
  if (SHOW_BANNERS_GROUP_SET10 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET10)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner); 
    }
  }
?>

			<?php
  if (SHOW_BANNERS_GROUP_SET11 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET11)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET12 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET12)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET13 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET13)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET14 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET14)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET15 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET15)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET16 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET16)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET17 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET17)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
<?php
  if (SHOW_BANNERS_GROUP_SET18 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET18)) {
    if ($banner->RecordCount() > 0) {
		echo zen_display_banner('static', $banner);
    }
  }
?>
		</div>
    </div>