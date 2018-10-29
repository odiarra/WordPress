<?php
/**
 * About Section
 */
 ?>
 
 <section class="home-section section" id="home-about-section">
    <div class="tb-container">
        <?php
        $education_buz_about_section_title = get_theme_mod('education_buz_about_section_title');
        $education_buz_service_secton_posts = get_theme_mod('education_buz_service_secton_posts');
        
        $education_buz_about_post_one_icon = get_theme_mod('education_buz_about_post_one_icon');
        $education_buz_about_post_one = get_theme_mod('education_buz_about_post_one');
        $education_buz_about_post_two_icon = get_theme_mod('education_buz_about_post_two_icon');
        $education_buz_about_post_two = get_theme_mod('education_buz_about_post_two');
        $education_buz_about_post_three_icon = get_theme_mod('education_buz_about_post_three_icon');
        $education_buz_about_post_three = get_theme_mod('education_buz_about_post_three');
        $education_buz_about_post_four_icon = get_theme_mod('education_buz_about_post_four_icon');
        $education_buz_about_post_four = get_theme_mod('education_buz_about_post_four');
        $education_buz_array_about = array('one','two','three','four');
        
        if($education_buz_about_section_title ){ ?>
            <div class="section-title">
            
                <?php if($education_buz_about_section_title){ ?>
                    <h2><?php echo esc_html($education_buz_about_section_title); ?></h2>
                    <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                <?php } ?>
                
            </div>
        <?php } ?>
        
        <?php if($education_buz_about_post_one_icon || $education_buz_about_post_one || 
        $education_buz_about_post_two_icon || $education_buz_about_post_two || 
        $education_buz_about_post_three_icon || $education_buz_about_post_three || 
        $education_buz_about_post_four || $education_buz_about_post_four_icon){ ?>
            <div class="about-posts-main">
                
                    <div class="slider about-nav">
                        <?php $post_nav_count = 1; 
                        foreach($education_buz_array_about as $education_buz_array_about_posts){
                            $about_icon = get_theme_mod('education_buz_about_post_'.$education_buz_array_about_posts.'_icon');
                            $about_post = get_theme_mod('education_buz_about_post_'.$education_buz_array_about_posts);?>
                            <div id="<?php echo esc_attr($education_buz_array_about_posts); ?>" class="loop-about-nav-content <?php if($post_nav_count=='1'){echo 'active';} ?>">
                            
                                <?php if($about_icon){ ?>
                                    <div class="feature-icon-about">
                                        <i class="fa <?php echo esc_attr($about_icon); ?>"></i>
                                    </div>
                                <?php } ?>
                                
                                <?php if($about_post){
                                    $education_buz_service_secton_posts_title_query = new WP_Query(array('post_type'=>'post','post__in'=>array($about_post)));
                                    if($education_buz_service_secton_posts_title_query->have_posts()){
                                        while($education_buz_service_secton_posts_title_query->have_posts()){
                                            $education_buz_service_secton_posts_title_query->the_post();?>
                                            
                                            <?php if(get_the_title()){ ?>
                                                <div class="title-service">
                                                    <h3><?php the_title(); ?></h3>
                                                </div>
                                            <?php } ?>
                                            
                                        <?php }
                                    wp_reset_postdata();}
                                } ?>
                                
                            </div>
                        <?php $post_nav_count++; } ?>
                    </div>
                    
                    
                    <div class="slider about-content-bottom">
                    <?php $post_content_count = 1; 
                        foreach($education_buz_array_about as $education_buz_array_about_posts){
                            $about_post = get_theme_mod('education_buz_about_post_'.$education_buz_array_about_posts);?>
                            <div id="<?php echo esc_attr($education_buz_array_about_posts).'-content'; ?>" class="loop-about-content <?php if($post_content_count=='1'){echo 'active';} ?>">
                            
                            <?php if($about_post){
                                $education_buz_service_secton_posts_title_query_2 = new WP_Query(array('post_type'=>'post','post__in'=>array($about_post)));
                                if($education_buz_service_secton_posts_title_query_2->have_posts()){
                                    while($education_buz_service_secton_posts_title_query_2->have_posts()){
                                        $education_buz_service_secton_posts_title_query_2->the_post();
                                        $education_buz_about_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'full'); ?>
                                        
                                        <div class="content-img-desc">
                                        
                                            <?php if($education_buz_about_image[0]){ ?>
                                                <div class="img-about-content">
                                                    <img src="<?php echo esc_url($education_buz_about_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
                                                </div>
                                            <?php } ?>
                                            
                                            <?php if(get_the_content()){ ?>
                                                <div class="title-service">
                                                    <p> 
                                                        <?php the_excerpt(); ?>
                                                        <a href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','education-buz'); ?></a>
                                                    </p>
                                                </div>
                                            <?php } ?>
                                            
                                        </div>
                                        
                                    <?php }
                                wp_reset_postdata();}
                            } ?>
                            
                        </div>
                    <?php $post_content_count++; } ?>
                    </div>
                    
            </div>
        <?php } ?>
    </div>
 </section>