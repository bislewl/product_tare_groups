<?php
/**
 * @package admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zones.php 19330 2011-08-07 06:32:56Z drbyte $
 */
require('includes/application_top.php');
$tare_group_array = array(
    array('id' => '1', 'text' => 'Product Tare Group 1'),
    array('id' => '2', 'text' => 'Product Tare Group 2'),
    array('id' => '3', 'text' => 'Product Tare Group 3'),
    array('id' => '4', 'text' => 'Product Tare Group 4'),
    array('id' => '5', 'text' => 'Product Tare Group 5'),
);
if (isset($_POST['bulk_add_tare_groups']) && $_POST['bulk_add_tare_groups'] == 'true') {
    $category_bulk_add = zen_db_prepare_input($_POST['category']);
    $tare_group_bulk_add = zen_db_prepare_input($_POST['products_tare_group']);
    product_tare_group_bulk($category_bulk_add, $tare_group_bulk_add);
    $messageStack->add("Applied Product Tare Group to " . zen_get_category_name((int) $category_bulk_add, 1), 'success');
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
        <title><?php echo TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
        <script language="javascript" src="includes/menu.js"></script>
        <script language="javascript" src="includes/general.js"></script>
        <script type="text/javascript">
            <!--
          function init()
            {
                cssjsmenu('navbar');
                if (document.getElementById)
                {
                    var kill = document.getElementById('hoverJS');
                    kill.disabled = true;
                }
            }
            // -->
        </script>
    </head>
    <body onload="init()">
        <!-- header //-->
        <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
        <!-- header_eof //-->
        <!-- body //-->
        <table border="0" width="100%" cellspacing="2" cellpadding="2">
            <tr>
                <!-- body_text //-->
                <td width="100%" valign="top">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td>
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="pageHeading"><?php echo BOX_PRODUCT_TARE_GROUPS_BULK; ?></td>
                                        <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    echo zen_draw_form('bulk_add_tare_groups', FILENAME_TARE_GROUPS_BULK);
                    echo zen_draw_hidden_field('bulk_add_tare_groups', 'true');
                    ?>
                    <table>
                        <tr>
                            <td><?php echo 'Category: ' ?></td>
                            <td><?php echo zen_draw_pull_down_menu('category', zen_get_category_tree()) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo TEXT_PRODUCT_TARE_GROUPS.': ' ?></td>
                            <td><?php echo zen_draw_pull_down_menu('products_tare_group', $tare_group_array); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php echo zen_image_submit('button_submit.gif', IMAGE_SUBMIT) ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                    echo '</form>';
                    ?>
                </td>
            </tr>    
        </table>
        <!-- body_eof //-->
        <!-- footer //-->
        <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
        <!-- footer_eof //-->
        <br>
    </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
