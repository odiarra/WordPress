<?php
/**
 * portfolio Section
 */
 
 
 $education_buz_portfolio_layout = get_theme_mod('education_buz_portfolio_layout');?>
 <section class="home-section section" id="home-portfolio-section <?php echo esc_attr($education_buz_portfolio_layout); ?>">
    
        <?php
        $education_buz_portfolio_section_title = get_theme_mod('education_buz_portfolio_section_title');
        $education_buz_portfolio_cat = get_theme_mod('education_buz_portfolio_cat');
        $education_buz_portfolio_cat_id = get_category_by_slug( $education_buz_portfolio_cat )->term_id;
        $education_buz_portfolio_parent_cats = get_categories(array('type' => 'post', 'parent' => $education_buz_portfolio_cat_id, 'hide_empty' => false));
        
        if($education_buz_portfolio_cat){ ?>
            <div class="portfolio-posts-main">
            
                <div class="tb-container">
                    <?php  if($education_buz_portfolio_section_title){ ?>
                        <div class="section-title">
                        
                            <?php if($education_buz_portfolio_section_title){ ?>
                                <h2><?php echo esc_html($education_buz_portfolio_section_title); ?></h2>
                                <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                            <?php } ?>
                            
                        </div>
                    <?php } ?>
                    
                    <div class="portfolio-post-filter clearfix">
                        <div class="titles-port">
                            <div class="filter active" data-filter="*"><?php esc_html_e('All', 'education-buz'); ?></div>
                            <?php foreach ($education_buz_portfolio_parent_cats as $education_buz_portfolio_parent_cat) : ?>
                                <div class="filter" data-filter=".category-<?php echo esc_attr($education_buz_portfolio_parent_cat->term_id); ?>"><?php echo esc_html($education_buz_portfolio_parent_cat->name); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio-content">
                
                    <?php $education_buz_portfolio_cat_query = new WP_Query(array('post_type' => 'post','category_name'=>$education_buz_portfolio_cat,'posts_per_page'=>-1));
                    if($education_buz_portfolio_cat_query->have_posts()){ ?>
                        
                            <div class="secondary-portfolio-wrap clearfix">
                                <?php
                                $tb_portfolio_count = 1; 
                                while($education_buz_portfolio_cat_query->have_posts()){
                                    $education_buz_portfolio_cat_query->the_post();
                                    $education_buz_cats = get_the_category();
                                    $education_buz_cat_list = '';
                                    foreach ($education_buz_cats as $education_buz_cat) :
                                            $education_buz_cat_list .= 'category-' . $education_buz_cat->term_id . ' ';
                                    endforeach;
                                    
                                    if($education_buz_portfolio_layout == 'layout-2'){
                                        if($tb_portfolio_count == '1' || 
                                        $tb_portfolio_count == '3' || 
                                        $tb_portfolio_count == '5' || 
                                        $tb_portfolio_count == '6'){
                                            $tb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-portfolio-2-image');
                                        }else{
                                            $tb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-portfolio-1-image');
                                        }
                                    }else{
                                     $tb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-portfolio-1-image');   
                                    } ?>
                                        
                                        <div class="loop-portfolio-logo <?php echo esc_attr($education_buz_cat_list); ?>">
                                            <div class="img-portfolio">
                                                
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url($tb_image_url[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                                </a>
                                                
                                                <?php if(get_the_title()){ ?>
                                                    <div class="portfolio-title">
                                                        <span class="secondary-title-wrap">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    
                                <?php $tb_portfolio_count++; } ?>
                            </div>
                        
                    <?php wp_reset_postdata();} ?>
                
                </div>
                
            </div>
        <?php } ?>
    
 </section>