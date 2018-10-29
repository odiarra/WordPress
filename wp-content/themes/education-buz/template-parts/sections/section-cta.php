<?php
/**
 * CTA Section
 */
 $education_buz_cta_bg_image = get_theme_mod('education_buz_cta_bg_image');
 ?>
 
 <section <?php if($education_buz_cta_bg_image){ ?>style=" background-image: url(<?php echo esc_url($education_buz_cta_bg_image); ?>);"<?php } ?> class="home-section section" id="home-cta-section">
    <div class="tb-container">
        <div class="cta-secondary">
            <?php
            $education_buz_cta_section_title = get_theme_mod('education_buz_cta_section_title');
            $education_buz_cta_section_desc = get_theme_mod('education_buz_cta_section_desc');
            $education_buz_cta_button_text = get_theme_mod('education_buz_cta_button_text');
            $education_buz_cta_button_link = get_theme_mod('education_buz_cta_button_link');
            if($education_buz_cta_button_link){
                if(empty($education_buz_cta_button_text)){
                    $education_buz_cta_button_text = esc_html__('Sign Up','education-buz');
                }
            }
            
            if($education_buz_cta_section_title || $education_buz_cta_section_desc){ ?>
                <div class="cta-section-title">
                
                    <?php if($education_buz_cta_section_title){ ?>
                        <h2><?php echo esc_html($education_buz_cta_section_title); ?></h2>
                    <?php } ?>
                    
                    <?php if($education_buz_cta_section_desc){ ?>
                        <p><?php echo esc_html($education_buz_cta_section_desc); ?></p>
                    <?php } ?>
                    
                </div>
            <?php } ?>
            <?php if($education_buz_cta_button_text){ ?>
                <div class="cta-link">
                    <a href="<?php echo esc_url($education_buz_cta_button_link); ?>"><?php echo esc_html($education_buz_cta_button_text); ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
 </section>