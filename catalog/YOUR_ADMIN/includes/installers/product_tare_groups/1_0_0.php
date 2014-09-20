<?php
// use $configuration_group_id where needed

// For Admin Pages
$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150) { // continue Zen Cart 1.5.0
  // delete configuration menu
  $db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = 'config_product_tare_groups' LIMIT 1;");
  // add configuration menu
  if (!zen_page_key_exists('config_product_tare_groups')) 
  {
      zen_register_admin_page('config_product_tare_groups',
          'BOX_PRODUCT_TARE_GROUPS', 
          'FILENAME_CONFIGURATION',
          'gID=' . $configuration_group_id, 
          'configuration', 
          'Y',
          $configuration_group_id);
      
      $messageStack->add('Enabled Product Tare Groups Configuration Menu.', 'success');
    
  }
}

$generic_description = "<br>What is the weight of typical packaging of small to medium packages?<br>Example: 10% + 1lb 10:1<br>10% + 0lbs 10:0<br>0% + 5lbs 0:5<br>0% + 0lbs 0:0<br>"; 
      // add configuration group 
      $db->Execute("INSERT INTO ".TABLE_CONFIGURATION."  (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added)  VALUES 
          ('Product Tare Group 1', 'PRODUCT_TARE_GROUP_1', '0:2', '<b>Product Tare Group 1</b>".$generic_description."',".$configuration_group_id.", '15', NOW(), NOW()),
          ('Product Tare Group 2', 'PRODUCT_TARE_GROUP_2', '0:4', '<b>Product Tare Group 2</b>".$generic_description."',".$configuration_group_id.", '20', NOW(), NOW()),
          ('Product Tare Group 3', 'PRODUCT_TARE_GROUP_3', '0:6', '<b>Product Tare Group 3</b>".$generic_description."',".$configuration_group_id.", '30', NOW(), NOW()),
          ('Product Tare Group 4', 'PRODUCT_TARE_GROUP_4', '0:8', '<b>Product Tare Group 4</b>".$generic_description."',".$configuration_group_id.", '40', NOW(), NOW()),
          ('Product Tare Group 5', 'PRODUCT_TARE_GROUP_5', '0:10', '<b>Product Tare Group 5</b>".$generic_description."',".$configuration_group_id.", '50', NOW(), NOW())
          ");


      $db->Execute("CREATE TABLE ".TABLE_PRODUCTS_EXTRA_FIELDS." (id int primary key auto_increment not null, products_id int not null, product_tare_group varchar(255))");
      

