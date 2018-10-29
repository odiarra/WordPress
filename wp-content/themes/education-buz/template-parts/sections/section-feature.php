<?php
/**
 * Feature Section
 */
 ?>
 
 <section class="home-section section" id="home-feature-section">
    <div class="tb-container">
        <?php
        $education_buz_feature_section_title = get_theme_mod('education_buz_feature_section_title');
        $education_buz_feature_cat = get_theme_mod('education_buz_feature_cat');
        
        if($education_buz_feature_section_title){ ?>
            <div class="section-title">
            
                <?php if($education_buz_feature_section_title){ ?>
                    <h2><?php echo esc_html($education_buz_feature_section_title); ?></h2>
                    <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                <?php } ?>
                
            </div>
        <?php } ?>
        
        <?php if($education_buz_feature_cat){ ?>
            <div class="feature-posts-main">
                
                    <div class="slider feature-nav clearfix">
                        <?php $education_buz_feature_secton_post_query = new WP_Query(array('post_type'=>'post','category_name'=>$education_buz_feature_cat));
                            if($education_buz_feature_secton_post_query->have_posts()){
                                while($education_buz_feature_secton_post_query->have_posts()){
                                    $education_buz_feature_secton_post_query->the_post(); 
                                    $tb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-feature-image'); ?>
                                    <div class="loop-feature-nav-content">
                                    
                                        <?php if($tb_image_url){ ?>
                                            <div class="feature-icon-feature">
                                                <a href="<?php the_permalink() ?>">
                                                    <img src="<?php echo esc_url($tb_image_url[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                                </a>
                                            </div>
                                        <?php } ?>
                                                    
                                        <?php if(get_the_title()){ ?>
                                            <div class="title-feature">
                                                <a href="<?php the_permalink(); ?>">
                                                    <h3><?php the_title(); ?></h3>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        
                                        <?php if(get_the_content()){ ?>
                                            <div class="content-feature">
                                                <p> 
                                                    <?php the_excerpt(); ?>
                                                </p>
                                                <a href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','education-buz'); ?></a>
                                            </div>
                                        <?php } ?>
                                        
                                    </div>
                                <?php }
                            wp_reset_postdata();}  ?>
                    </div>

            </div>
        <?php } ?>
        
        <?php
        $education_buz_feature_section_image = get_theme_mod('education_buz_feature_section_image');
        if($education_buz_feature_section_image){ ?>
            <div class="feature-section-image">
                <img src="<?php echo esc_url($education_buz_feature_section_image); ?>" title="<?php esc_attr_e('Section Feature Image','education-buz'); ?>" alt="<?php esc_attr_e('Section Feature Image','education-buz'); ?>" />
            </div>
        <?php } ?>
    </div>
 </section>