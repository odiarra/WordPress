<?php
/**
 * Subscribe Section
 */
 $education_buz_subscribe_bg_image = get_theme_mod('education_buz_subscribe_bg_image');
 ?>
 
 <section <?php if($education_buz_subscribe_bg_image){ ?>style=" background-image: url(<?php echo esc_url($education_buz_subscribe_bg_image); ?>);"<?php } ?> class="home-section section" id="home-subscribe-section">
    <div class="tb-container">
        <?php
        if(is_active_sidebar('education-buz-subscribe-form')){
            dynamic_sidebar('education-buz-subscribe-form');
        } ?>
    </div>
 </section>