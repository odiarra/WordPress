<?php
/**
 * Course Section
 */
 ?>
 
 <section class="home-section section" id="home-course-section">
    <div class="tb-container">
        <?php
        $education_buz_course_section_title = get_theme_mod('education_buz_course_section_title');
        $education_buz_course_cat = get_theme_mod('education_buz_course_cat');
        
        if($education_buz_course_section_title){ ?>
            <div class="section-title">
            
                <?php if($education_buz_course_section_title){ ?>
                    <h2><?php echo esc_html($education_buz_course_section_title); ?></h2>
                    <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                <?php } ?>
                
            </div>
        <?php } ?>
        
        <?php if(is_active_sidebar('education-buz-our-course')){ ?>
            <div class="course-posts-main">
                <div class="owl-carousel course-content">
                    <?php dynamic_sidebar('education-buz-our-course'); ?>
                </div>
                
            </div>
        <?php } ?>
        
    </div>
 </section>