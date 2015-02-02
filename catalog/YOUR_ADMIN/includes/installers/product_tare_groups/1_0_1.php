<?php
//add field to product field
global $sniffer;
if (!$sniffer->field_exists(TABLE_PRODUCTS, 'products_tare_group'))  $db->Execute("ALTER TABLE " . TABLE_PRODUCTS . " ADD COLUMN products_tare_group varchar(32);");
