<?php
/** Woocommerce Functions & Hook **/
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
add_action('woocommerce_before_main_content','education_buz_woocommerce_wrap_start',22);

function education_buz_woocommerce_wrap_start(){
    ?>
    <div class="tb-main-content-wraper">
    <div class="tb-container">
    	<div id="primary" class="content-area">
    		<main id="main" class="site-main">
    <?php
}

add_action('woocommerce_after_main_content','education_buz_woocommerce_wrap_end',12);
function education_buz_woocommerce_wrap_end(){
    ?>
                </main>
            </div>
        <?php get_sidebar(); ?>
        </div>
    </div>
    <?php
}