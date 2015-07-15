<?php

function product_tare_group_bulk($category,$tare_group){
    global $db;
   $db->Execute("UPDATE ".TABLE_PRODUCTS." SET products_tare_group='".(int)$tare_group."' WHERE master_categories_id = '".(int)$category."'");
   $sub_categories = $db->Execute("SELECT * FROM ".TABLE_CATEGORIES." WHERE parent_id = '".(int)$category."'");
   if($sub_categories->RecordCount() > 0){
       while(!$sub_categories->EOF){
           product_tare_group_bulk((int)$sub_categories->fields['categories_id'],(int)$tare_group);
           $sub_categories->MoveNext();
       }
   }
   $product_to_cat_groups = $db->Execute("SELECT * FROM ".TABLE_PRODUCTS_TO_CATEGORIES." WHERE categories_id='".(int)$category."'");
   while(!$product_to_cat_groups->EOF){
       $db->Execute("UPDATE ".TABLE_PRODUCTS." SET products_tare_group='".(int)$tare_group."' WHERE products_id = '".(int)$product_to_cat_groups->fields['products_id']."'");
       $product_to_cat_groups->MoveNext();
   }
}