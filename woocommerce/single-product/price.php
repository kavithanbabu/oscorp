<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="prices">
    <!--product reviews-->
    <div class="" itemprop="offers" style="float:left">
        <div class="product-price">
            <span itemprop="price" class="price-value-8035">
            <?php echo $product->get_price_html(); ?>
            </span>
        </div>
        <meta itemprop="priceCurrency" content="GBP">
    </div>
    <!--availability-->
    <div class="availability">
        <div class="stock">
            <span class="label">Availability:</span>
            <span class="value" id="stock-availability-value-8035"><?php echo ( $product->is_in_stock() ? "In stock":"Sorry product not available"); ?></span>
        </div>
    </div>
</div>