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
        $cartProducts = $_SESSION['cart']->get_products();
        $shipping_weight = 0;
        foreach($cartProducts as $product )
        {
          $base_product_id = explode(":",$product['id']);
          $product_id = (int)$base_product_id[0];
          $qty = $product['quantity'];
          $product_tare_group = $db->Execute("SELECT products_tare_group FROM ".TABLE_PRODUCTS." WHERE products_id=".$product_id." LIMIT 1");
            if($product_tare_group->fields['products_tare_group'] == ''){
                $tare_group = 1;
            }
            else{
                $tare_group = $product_tare_group->fields['products_tare_group'];
            }
            $ratio = explode(":", constant('PRODUCT_TARE_GROUP_'.$tare_group));
            $percent = 100 + $ratio[0];
            $weight = $ratio[1]; 
            $shipping_weight = $shipping_weight + ((($product['weight'] * $percent / 100) + $weight) * $qty);
        }
      }
    }

    return;
  }
}
