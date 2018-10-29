<?php
/**
 * Team Section
 */
 ?>
 
 <section class="home-section section" id="home-team-section">
    <div class="tb-container">
        <?php
        $education_buz_team_section_title = get_theme_mod('education_buz_team_section_title');
        $education_buz_team_cat = get_theme_mod('education_buz_team_cat');
        
        if($education_buz_team_section_title){ ?>
            <div class="section-title">
            
                <?php if($education_buz_team_section_title){ ?>
                    <h2><?php echo esc_html($education_buz_team_section_title); ?></h2>
                    <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                <?php } ?>
                
            </div>
        <?php } ?>
        
        <?php if($education_buz_team_cat){ ?>
            <div class="team-posts-main">
                <div class="main-team-content">
                <?php $education_buz_team_cat_query = new WP_Query(array('post_type' => 'post','category_name'=>$education_buz_team_cat,'posts_per_page'=>-1));
                if($education_buz_team_cat_query->have_posts()){ ?>
                    
                        <div class="slider secondary-team-wrap clearfix">
                            <?php while($education_buz_team_cat_query->have_posts()){
                                $education_buz_team_cat_query->the_post(); 
                                $tb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-team-image'); ?>
                                    
                                    <div class="loop-team-logo">
                                    
                                        <div class="img-team">
                                            <img src="<?php echo esc_url($tb_image_url[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                            
                                            <?php if(get_the_content() || get_the_title()){ ?>
                                                <div class="team-content">
                                                
                                                    <?php the_excerpt(); ?>
                                                    
                                                </div>
                                            <?php } ?>
                                        
                                        </div>
                                        
                                        <?php if(get_the_title()){ ?>
                                            <div class="team-name-desg">
                                                
                                                <?php if(get_the_title()){?>
                                                    <h5><?php the_title(); ?></h5>
                                                <?php } ?>
                                                
                                            </div>
                                        <?php } ?>
                                        
                                    </div>
                                
                            <?php } ?>
                        </div>
                    
                <?php wp_reset_postdata();} ?>
                
                </div>
                
            </div>
        <?php } ?>
        
    </div>
 </section>