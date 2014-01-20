<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 7085 2007-09-22 04:56:31Z ajeh $
 */

// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }

  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>


<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>>

<!-- ========== IMAGE BORDER TOP ========== -->

<div class="extra">
	<div class="main-width">

	<!-- ====================================== -->

	<!-- ========== HEADER ========== -->
	<?php
	 /* prepares and displays header output */
	  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
		$flag_disable_header = true;
	  }
	  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');
	?>
	<!-- ============================ -->
    <?php
		if($this_is_home_page){
	?>
	<div class="bnrs wrapper">
		<div class="slider">
			<!-- begin edit for ZX Slideshow -->
			<?php if(ZX_SLIDESHOW_STATUS == true) { ?>
				<?php require($template->get_template_dir('zx_slideshow.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/zx_slideshow.php'); ?>
			<?php } ?>    
			<!-- end edit for ZX Slideshow -->
		</div>
        <div class="bot-banners">
        	<div class="inner">
        	<?php
				$new_banner_search = zen_build_banners_group(SHOW_BANNERS_GROUP_SET5);
	
				  // secure pages
				  switch ($request_type) {
					case ('SSL'):
					  $my_banner_filter=" and banners_on_ssl= " . "1";
					  break;
					case ('NONSSL'):
					  $my_banner_filter='';
					  break;
				  }
				
				  $sql = "select banners_id from " . TABLE_BANNERS . " where status = 1 " . $new_banner_search . $my_banner_filter . " order by banners_sort_order";
				  $banners_all = $db->Execute($sql);
	
				// if no active banner in the specified banner group then the box will not show
				  $banner_cnt = 0;
				  while (!$banners_all->EOF) {
					$banner_cnt++;
					$banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET5);
					echo '<div class="item">'.zen_display_banner('static', $banners_all->fields['banners_id']).'</div>';
				// add spacing between banners
					if ($banner_cnt < $banners_all->RecordCount()) {
					  
					}
					$banners_all->MoveNext();
				  }
			?>
            </div>
        </div>
	</div>
    <div class="column-center-padding">
    <div class="main-featured">
        <ul>
            <?php		 
            $categories_products_id_list = '';
            $list_of_products = '';
            $featured_products_query = '';
            $display_limit = '';
            
            if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
              $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id, pd.products_description
                                       from (" . TABLE_PRODUCTS . " p
                                       left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                                       left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                                       where p.products_id = f.products_id
                                       and p.products_id = pd.products_id
                                       and p.products_status = 1 and f.status = 1
                                       and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
            } 
            
            else {
              // get all products and cPaths in this subcat tree
              $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);
            
              if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
                // build products-list string to insert into SQL query
                foreach($productsInCategory as $key => $value) {
                  $list_of_products .= $key . ', ';
                }
                $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
                $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id, pd.products_description
                                            from (" . TABLE_PRODUCTS . " p
                                            left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                                            left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id)
                                            where p.products_id = f.products_id
                                            and p.products_id = pd.products_id
                                            and p.products_status = 1 and f.status = 1
                                            and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                            and p.products_id in (" . $list_of_products . ")";
              }
            }
            if ($featured_products_query != '') { $featured_products = $db->ExecuteRandomMulti($featured_products_query, MAX_DISPLAY_SEARCH_RESULTS_FEATURED);}
                     
                     
            while (!$featured_products->EOF){
            $products_name = '<a class="name" href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' .    	$featured_products->fields['products_id']) . '">' . $featured_products->fields['products_name'] . '</a>';
            $products_price = '<strong>' . zen_get_products_display_price($featured_products->fields['products_id']) . '</strong>';
            $products_butt = '<a href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS, BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>';
			$products_butt2 = '<a href="' . zen_href_link(FILENAME_PRODUCTS_NEW, zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $featured_products->fields["products_id"]) . '">' . zen_image_button(BUTTON_IMAGE_ADD_TO_CART, BUTTON_IN_CART_ALT) . '</a>';
            $products_img = (($featured_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<a href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $featured_products->fields['products_image'], $featured_products->fields['products_name'], IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH, IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT) . '</a>');
            $products_desc = substr(strip_tags($featured_products->fields['products_description']), 0, 20) . '...';
            $num_products_count = ($featured_products_query == '') ? 0 : $featured_products->RecordCount();
            ?>
                        <li class="product-col">
                          <div class="img"><?php echo $products_img; ?></div>
                          <div class="prod-info">
                            <div class="name"><?php echo $products_name;?></div>
                              <div class="bottom">
                              	<span class="price"><?php echo $products_price;?></span>
                                <span class="button"><?php echo $products_butt2;?></span>
                              </div>
                          </div>
                        </li>
                        <?php $featured_products->MoveNextRandom();} ?>
        </ul>
    </div>
    <div class="brands">
    	<?php
			$new_banner_search = zen_build_banners_group(SHOW_BANNERS_GROUP_SET6);

			  // secure pages
			  switch ($request_type) {
				case ('SSL'):
				  $my_banner_filter=" and banners_on_ssl= " . "1";
				  break;
				case ('NONSSL'):
				  $my_banner_filter='';
				  break;
			  }
			
			  $sql = "select banners_id from " . TABLE_BANNERS . " where status = 1 " . $new_banner_search . $my_banner_filter . " order by banners_sort_order";
			  $banners_all = $db->Execute($sql);

			// if no active banner in the specified banner group then the box will not show
			  $banner_cnt = 0;
			  while (!$banners_all->EOF) {
				$banner_cnt++;
				$banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6);
				echo '<div class="item">'.zen_display_banner('static', $banners_all->fields['banners_id']).'</div>';
			// add spacing between banners
				if ($banner_cnt < $banners_all->RecordCount()) {
				  
				}
				$banners_all->MoveNext();
			  }
		?>
    </div>
     </div>
	<?php
		}
	?>
    <?php
		if(!$this_is_home_page){
	?>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" id="contentMainWrapper">
		<tr>
		
			<?php
				if (COLUMN_LEFT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
				  // global disable of column_left
				  $flag_disable_left = true;
				}
				if (!isset($flag_disable_left) || !$flag_disable_left) {
			?>
			
				<td id="column-left" style="width:<?php echo COLUMN_WIDTH_LEFT; ?>;">
					<div style="width:<?php echo COLUMN_WIDTH_LEFT; ?>;">
						<?php
						 /* ----- prepares and displays left column sideboxes ----- */
						?>
						<?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?>
					</div>
				</td>
				
			<?php
				}
			?>	
			
				<td id="column-center" valign="top">

					<div class="column-center-padding">
					
						<!--content_center-->
					
					
							<!-- bof breadcrumb -->
							<?php if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
								<div id="navBreadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
							<?php } ?>
							<!-- eof breadcrumb -->
						
		
							<!-- bof upload alerts -->
							<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
							<!-- eof upload alerts -->
		
						
							<?php
								/* ----- prepares and displays center column ----- */
								require($body_code);
							?>
						
					
						<div class="clear"></div>
						
						<!--eof content_center-->
					
					</div>						
					
				</td>
				
			<?php
			if (COLUMN_RIGHT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
			  // global disable of column_right
			  $flag_disable_right = true;
			}
			if (!isset($flag_disable_right) || !$flag_disable_right) {
			?>
	
				<td id="column_right" style="width:<?php echo COLUMN_WIDTH_RIGHT; ?>">
		
					<div style="width:<?php echo COLUMN_WIDTH_RIGHT; ?>;">
						<?php
						 /* ----- prepares and displays right column sideboxes ----- */
						?>
						<?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?>
					</div>
		
				</td>
				
			<?php
			}
			?>
			
		</tr>
	</table>
	<?php
		}
	?>
	<!-- ========== FOOTER ========== -->
	<?php
	 /* prepares and displays footer output */
	  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
		$flag_disable_footer = true;
	  }
	  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
	?>
	<!-- ============================ -->

	<!--bof- parse time display -->
	<?php
	  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
	?>
	<div class="smallText center">Parse Time: <?php echo $parse_time; ?> - Number of Queries: <?php echo $db->queryCount(); ?> - Query Time: <?php echo $db->queryTime(); ?></div>
	<?php
	  }
	?>
	<!--eof- parse time display -->


	<!-- ========== IMAGE BORDER BOTTOM ========== -->

    </div>
</div>

<!-- ========================================= -->



</body>