<?php

/**
 * WooCommerce Germanized extended SEPA Export Usage Value
 *
 * Plugin Name:       WooCommerce Germanized extended SEPA Export Usage Value
 * Plugin URI:        https://github.com/holzhannes/woocommerce-germanized-extended-sepa-usage
 * GitHub Plugin URI: https://github.com/holzhannes/woocommerce-germanized-extended-sepa-usage
 * Description:       This Plugin will change the usage line in the SEPA Export File to: Order #, item-names, (optional) Period of first item
 * Version:           0.1
 * Author:            holzhannes
 * Author URI:        https://github.com/holzhannes/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-gzd-change-usage
 * Domain Path:       /languages
 */



function custom_woocommerce_germanized_direct_debit_purpose( $default , $order) {
	$debit_purpose_default = sprintf( __( 'Order %s', 'woocommerce-germanized' ), $order->get_order_number() );
	$order = wc_get_order($order->ID);

	foreach ($order->get_items() as $item_key => $item_values) {
        $item_id = $item_values->get_id();
        $item_names .= ', ' . $item_values->get_name();
        if (!isset($debit_period) && subscription_plugins_active()){
        	$debit_period = wc_get_order_item_meta($item_id, __('Period', 'wc-sub-period-meta') , true);
    	}
    }
    $debit_purpose = $debit_purpose_default . $item_names . ', ' . __('Period', 'wc-sub-period-meta') . ': ' . $debit_period;
    // Teststring $debit_purpose = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789':?,-(+.)/ ÄÖÜäöüßèé€@$§%&?=`´*+#;-_–°><#";
    return substr(clean_for_swift_latin_character_set( $debit_purpose ), 0, 140);
}
 
add_filter( 'woocommerce_germanized_direct_debit_purpose','custom_woocommerce_germanized_direct_debit_purpose', 99, 2);

function clean_for_swift_latin_character_set( $string ) {
	$string = replace_special_chars($string);
	//  SWIFT Latin Character SET: a-zA-Z0-9':?,-(+.)/ Space
   return preg_replace('/[^A-Za-z0-9\-\'\:\?\,\-\(\+\.\)\/\s]/', '', $string);
}

function replace_special_chars($string){
	$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "è", "é", "€", "@", "&", ">", "<", "°", "#");
	$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "e", "e", "EUR", "AT", "und", "groesser", "kleiner", "(grad)", "(Raute)");
	return str_replace($search, $replace, $string);
}

function subscription_plugins_active(){
    if (is_plugin_active('woocommerce-subscriptions-period-meta/woocommerce-subscriptions-period-meta.php') && is_plugin_active('woocommerce-subscriptions/woocommerce-subscriptions.php')) {
    	return true;
    } else {
    	return false;
    }
}