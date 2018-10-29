<?php
/**
 * Blog Section
 */
 ?>
 
 <section class="home-section section" id="home-blog-section">
    <div class="tb-container">
        <?php
        $education_buz_blog_section_title = get_theme_mod('education_buz_blog_section_title');
        $education_buz_blog_cat = get_theme_mod('education_buz_blog_cat');
        
        if($education_buz_blog_section_title){ ?>
            <div class="section-title">
            
                <?php if($education_buz_blog_section_title){ ?>
                    <h2><?php echo esc_html($education_buz_blog_section_title); ?></h2>
                    <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                <?php } ?>
                
            </div>
        <?php } ?>
        
        <?php if($education_buz_blog_cat){ ?>
            <div class="blog-posts-main">
                <div class="blog-content">
                <?php $education_buz_blog_cat_query = new WP_Query(array('post_type' => 'post','category_name'=>$education_buz_blog_cat,'posts_per_page'=>6));
                if($education_buz_blog_cat_query->have_posts()){ ?>
                    
                        <div class="secondary-blog-wrap clearfix">
                            <?php while($education_buz_blog_cat_query->have_posts()){
                                $education_buz_blog_cat_query->the_post(); 
                                $tb_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-blog-image'); ?>
                                    
                                    <div class="loop-blog-logo">
                                    
                                        <div class="img-blog-date-author">
                                        
                                            <div class="blog-image">
                                                <a href="<?php the_permalink() ?>">
                                                    <img src="<?php echo esc_url($tb_image_url[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                                </a>
                                            </div>
                                            
                                            <div class="author-date-blog clearfix">
                                            
                                                <span class="post-author">
                                                    <a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>">
                                                        <i class="fa fa-user-o" aria-hidden="true"></i>
                                                        <?php the_author(); ?>
                                                    </a>
                                                </span>
                                            
                                                <span class="post-date">
                                                    <a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                        <?php echo esc_html(get_the_date(get_option('date_format'))); ?>
                                                    </a>
                                                </span>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="home-blog-title-content">
                                        
                                            <?php if(get_the_title()){ ?>
                                                <div class="home-blog-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                    <?php the_title();; ?>
                                                    </a>
                                                    
                                                </div>
                                            <?php } ?>
                                            
                                            <?php if(get_the_content()){ ?>
                                                <div class="home-blog-content">
                                                    
                                                    <?php the_excerpt(); ?>
                                                    
                                                </div>
                                            <?php } ?>
                                            
                                            <div class="blog-read-more-comment clearfix">
                                            
                                                <span class="link-blog">
                                                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','education-buz'); ?></a>
                                                </span>
                                                
                                                <span class="comment-blog">
                                                    <a href="<?php comments_link(); ?>">
                                                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                        <?php echo absint(get_comments_number()); esc_html_e(' comment','education-buz'); ?>
                                                    </a>
                                                </span>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                
                            <?php } ?>
                        </div>
                    
                <?php wp_reset_postdata();} ?>
                
                </div>
                
            </div>
        <?php } ?>
        
    </div>
 </section>