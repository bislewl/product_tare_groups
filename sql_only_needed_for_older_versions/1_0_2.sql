
SET @configuration_group_id=0;
SELECT (@configuration_group_id:=configuration_group_id) FROM configuration_group WHERE configuration_group_title= 'Product Tare Groups' LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;

INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, 'Product Tare Groups', 'Set Product Tare Groups Options', '1', '1');
SET @configuration_group_id=last_insert_id();
UPDATE configuration_group SET sort_order = @configuration_group_id WHERE configuration_group_id = @configuration_group_id;

SET @configuration_group_id=0;
SELECT (@configuration_group_id:=configuration_group_id) FROM configuration_group WHERE configuration_group_title= 'Product Tare Groups' LIMIT 1;


INSERT INTO configuration ( configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added) VALUES 
        ('Version', 'PRODUCT_TARE_GROUPS_VERSION', '1.0.2', 'Version installed:', @configuration_group_id, 0, NOW(), NOW()), 
          ('Product Tare Group 1', 'PRODUCT_TARE_GROUP_1', '0:2', 'Enter the desired tare as percent and or lbs for this group.<br>Example: 10% + 1lb 10:1<br>10% + 0lbs 10:0<br>0% + 5lbs 0:5<br>0% + 0lbs 0:0<br>',@configuration_group_id, '15', NOW(), NOW()),
          ('Product Tare Group 2', 'PRODUCT_TARE_GROUP_2', '0:4', 'Enter the desired tare as percent and or lbs for this group.<br>Example: 10% + 1lb 10:1<br>10% + 0lbs 10:0<br>0% + 5lbs 0:5<br>0% + 0lbs 0:0<br>',@configuration_group_id, '20', NOW(), NOW()),
          ('Product Tare Group 3', 'PRODUCT_TARE_GROUP_3', '0:6', 'Enter the desired tare as percent and or lbs for this group.<br>Example: 10% + 1lb 10:1<br>10% + 0lbs 10:0<br>0% + 5lbs 0:5<br>0% + 0lbs 0:0<br>',@configuration_group_id, '30', NOW(), NOW()),
          ('Product Tare Group 4', 'PRODUCT_TARE_GROUP_4', '0:8', 'Enter the desired tare as percent and or lbs for this group.<br>Example: 10% + 1lb 10:1<br>10% + 0lbs 10:0<br>0% + 5lbs 0:5<br>0% + 0lbs 0:0<br>',@configuration_group_id, '40', NOW(), NOW()),
          ('Product Tare Group 5', 'PRODUCT_TARE_GROUP_5', '0:10', 'Enter the desired tare as percent and or lbs for this group.<br>Example: 10% + 1lb 10:1<br>10% + 0lbs 10:0<br>0% + 5lbs 0:5<br>0% + 0lbs 0:0<br>',@configuration_group_id, '50', NOW(), NOW());

INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES ('config_product_tare_groups', 'BOX_PRODUCT_TARE_GROUPS', 'FILENAME_CONFIGURATION',CONCAT('gID=',@configuration_group_id), 'configuration', 'Y', @configuration_group_id);

IF COL_LENGTH(products, products_tare_group) IS NULL

BEGIN
    ALTER TABLE products ADD COLUMN products_tare_group varchar(32)
END