<?php

function social_media($products_id, $products_name) {

  $media_icons = '';
if (TWITTER_STATUS == 1) {
  echo '<a href="https://twitter.com/share" class="twitter-share-button fleft">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
}
if (GOOGLE_STATUS == 1) {
  echo '<div class="fleft"><div class="g-plusone" data-size="medium"></div></div>'; 
}
if (FACEBOOK_STATUS == 1) {
	echo '<div class="fleft"><fb:like send="false" layout="button_count" width="150" show_faces="false"></fb:like></div>';
}
  return $media_icons;
}
?>