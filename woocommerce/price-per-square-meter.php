<?php
//  Remove opening and closing php tags if implementing through WP Code Snippets plugin
add_filter( 'woocommerce_get_price_html', 'add_price_per_square_meter_as_suffix' );
function add_price_per_square_meter_as_suffix($price){
	//	Null safety
	if( (!isset($price)) or (empty($price)) or (is_null($price)) or ($price=="") or ($price ==0) ){
		return $price;
	}
	
	//	Get current product
	$current_product = wc_get_product( get_the_ID() );
	
	//	Get product price and width
	$product_price = $current_product->get_price();
	$product_width = $current_product->get_width();
	
	//	Calculate price per square meter
	$price_per_square_meter = round( ( ($product_price*1.19) / $product_width), 2);
	
	//	Format number with comma separator as per woocommerce default
	$suffix = "($price_per_square_meter € je m2)";
    $suffix = str_replace(".", ",", $suffix);
	
	//	Add text after product price
	$price_suffix = "<span>$suffix<span>";
	return $price . ' ' .  $price_suffix;
}
>