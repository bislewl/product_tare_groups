<?php

// For Admin Pages
$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150) { // continue Zen Cart 1.5.0
  // delete configuration menu
  $db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'config_product_tare_groups' LIMIT 1;");
  // add configuration menu
  if (!zen_page_key_exists('catalogTareGroupsBulk')) 
  {
      zen_register_admin_page('catalogTareGroupsBulk',
          'BOX_PRODUCT_TARE_GROUPS_BULK', 
          'FILENAME_TARE_GROUPS_BULK',
          '', 
          'catalog', 
          'Y',
          $configuration_group_id);
      
      $messageStack->add('Enabled Product Tare Groups Bulk Add Menu Item.', 'success');
    
  }
}

