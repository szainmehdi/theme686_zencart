<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_search.php 15881 2010-04-11 16:32:39Z wilt $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content .= zen_draw_form('quick_find', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
  $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
  $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();

  if (strtolower(IMAGE_USE_CSS_BUTTONS) == 'no') {
    $content .= zen_draw_input_field('keyword', '', 'class="input1"') . ' ' . zen_image_submit ('search.gif',HEADER_SEARCH_BUTTON);
    //$content .= '<br /><a href="' . zen_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_SEARCH_ADVANCED_SEARCH . '</a>';
  } else {
    $content .= zen_draw_input_field('keyword', '', 'size="18" maxlength="100" class="input1" style="width: ' . ($column_width-85) . 'px"') . ' <input type="submit" value="' . HEADER_SEARCH_BUTTON . '" style="width: 47px" />';
    $content .= '<br /><a  class="advsearch" href="' . zen_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_SEARCH_ADVANCED_SEARCH . '</a>';
  }

  $content .= "</form>";
  $content .= '</div>';
?>