<?php

/**
 * Observer class used to override shipping weight to support product_tare_groups 
 *
 */
class product_tare_groups extends base {
  /**
   * constructor method
   */
  function __construct(){
    global $zco_notifier;
    global $db;
    $zco_notifier->attach($this, array('NOTIFY_SHIPPING_MODULE_PRE_CALCULATE_BOXES_AND_TARE','NOTIFY_SHIPPING_MODULE_CALCULATE_BOXES_AND_TARE'));
    $this->original_shipping_weight = 0;
    $configuration = $db->Execute("SELECT configuration_key, configuration_value FROM ".TABLE_CONFIGURATION." WHERE configuration_key like 'PRODUCT_TARE_GROUP_%'");
    $this->product_tare_group_array = null;
    while(!$configuration->EOF)
    {
      $this->product_tare_group_array[$configuration->fields['configuration_key']] = $configuration->fields['configuration_value'];
      $configuration->MoveNext();
    }
  }
  /**
   * Update Method
   *
   * Called by observed class when any of our notifiable events occur
   *
   * @param object $class
   * @param string $eventID
   */
  function update(&$class, $eventID, $paramsArray) {

    if(get_class($class) == 'shipping')
    {
      global $messageStack;
      global $db;
      global $shipping_weight;

      if($eventID == 'NOTIFY_SHIPPING_MODULE_PRE_CALCULATE_BOXES_AND_TARE')
      {
        if($shipping_weight)
        {
          $this->original_shipping_weight = $shipping_weight;
        }
      }
      elseif($eventID == 'NOTIFY_SHIPPING_MODULE_CALCULATE_BOXES_AND_TARE')
      {
        $shipping_weight = $this->original_shipping_weight;
        $cartProducts = $_SESSION['cart']->get_products();
        foreach($cartProducts as $product )
        {
          $product_id = (int)$product['id'];
          $qty = $_SESSION['cart']->contents[$product_id]['qty'];
          $sql = "SELECT ".TABLE_PRODUCTS_EXTRA_FIELDS." from products_extra_fields WHERE products_id=".$product_id." LIMIT 1"; 
          $product_tare_group = $db->Execute($sql);
          while(!$product_tare_group->EOF)
          {
            $ratio = preg_split('/[:,]/', $this->product_tare_group_array[$product_tare_group->fields['product_tare_group']]);
            $percent = $ratio[0];
            $weight = $ratio[1]; 
            if($product['weight'] * $percent)
            {
              $shipping_weight = $shipping_weight + ((($product['weight'] * $percent / 100) + $weight) * $qty);
            }
            $product_tare_group->MoveNext();
          }
        }
      }

      //echo $shipping_weight;
    }

    return;
  }
}
