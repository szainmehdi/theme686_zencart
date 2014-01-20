<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 15511 2010-02-18 07:19:44Z drbyte $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<?php
if (!isset($flag_disable_footer) || !$flag_disable_footer) {
?>

<div id="footer">
	<div class="wrapper">
		<div class="footer-menu">
			<div id="navSupp">
			<?php //echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'. HEADER_TITLE_CATALOG . '</a>'; ?>
			<?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
			<?php require($template->get_template_dir('tpl_ezpages_bar_footer.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_footer.php'); ?>
			<?php } ?>
			
			</div>
		</div><br>
		<hr>
		<table width="940" border="1" align="center" cellpadding="3" cellspacing="5">
  <tr>
    <td align="center" valign="middle"></td>
    <td align="center" valign="middle">                                    <script type="text/JavaScript">
//<![CDATA[
var sealServer=document.location.protocol+"//seals.websiteprotection.com/sealws/51534e59-4184-4e8e-a3bb-2892cbdd56cb.gif";var certServer=document.location.protocol+"//certs.websiteprotection.com/sealws/?sealId=51534e59-4184-4e8e-a3bb-2892cbdd56cb";var hostName="vdimotorsports.com";document.write(unescape('<div style="text-align:center;margin:0 auto;"><a target="_blank" href="'+certServer+'&pop=true" style="display:inline-block;"><img src="'+sealServer+'" alt="Website Protection&#153; Site Scanner protects this website from security threats." title="This Website Protection site seal is issued to '+ hostName +'. Copyright &copy; 2013, all rights reserved."oncontextmenu="alert(\'Copying Prohibited by Law\'); return false;" border="0" /></a><div id="bannerLink"></a></div></div>'));
//]]>
</script>
                    </td>
    <td align="center" valign="middle"><span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=Aga2EqwBC4Gd5E5Zx58z8wH5hIF99Nsec0iNLKlVLBBzq2UY6iLM1TP"></script></span>                                    
                    </td>
    <td align="center" valign="middle"><center>VDI Motorsports a Division of Vertical Doors, Inc.<br>(951) 273-1069</td>
    <td align="center" valign="middle">

<script type="text/javascript" data-pp-pubid="802aaf6f83" data-pp-placementtype="234x60"> (function (d, t) {
"use strict";
var s = d.getElementsByTagName(t)[0], n = d.createElement(t);
n.src = "//paypal.adtag.where.com/merchant.js";
s.parentNode.insertBefore(n, s);
}(document, "script"));
</script>
</td>
  </tr>
</table><hr>
		<div class="copyright">
			<!-- ========== COPYRIGHT ========== -->
				<?php echo FOOTER_TEXT_BODY; ?> &nbsp;| &nbsp;<a href="<?php echo zen_href_link(FILENAME_PRIVACY)?>"><?php echo BOX_INFORMATION_PRIVACY?></a>
			
				<?php
					if (SHOW_FOOTER_IP == '1') {
				?>
						<div id="siteinfoIP"><?php echo TEXT_YOUR_IP_ADDRESS . '  ' . $_SERVER['REMOTE_ADDR']; ?></div>
				<?php
					}
				?>
			<!-- =============================== -->
		</div>
		<?php
			if($this_is_home_page){
		?>
		<div></div>
		<?php
			}
		?>
		<!--<div class="cards">
			<?php echo zen_image(DIR_WS_TEMPLATE.'images/paypal.gif'); ?>
		</div>-->
		<div class="back_to_top">
			<a href="#"><span>&uarr;</span> TOP</a>
		</div>
	</div>
</div>


<?php
} // flag_disable_footer
?>
