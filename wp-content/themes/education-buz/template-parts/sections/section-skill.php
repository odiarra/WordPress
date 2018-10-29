<?php
/**
 * skill Section
 */
?>
 <section class="home-section section" id="home-skill-section">
    
        <?php
        $education_buz_skill_section_title = get_theme_mod('education_buz_skill_section_title');
        $education_buz_skill_section_desc = get_theme_mod('education_buz_skill_section_desc');
        
        $education_buz_skill_title_one = get_theme_mod('education_buz_skill_title_one');
        $education_buz_skill_percent_one = get_theme_mod('education_buz_skill_percent_one');
        $education_buz_skill_title_two = get_theme_mod('education_buz_skill_title_two');
        $education_buz_skill_percent_two = get_theme_mod('education_buz_skill_percent_two');
        $education_buz_skill_title_three = get_theme_mod('education_buz_skill_title_three');
        $education_buz_skill_percent_three = get_theme_mod('education_buz_skill_percent_three');
        $education_buz_skill_title_four = get_theme_mod('education_buz_skill_title_four');
        $education_buz_skill_percent_four = get_theme_mod('education_buz_skill_percent_four');
        $education_buz_array_skills = array('one','two','three','four');
        $education_buz_skill_section_image = get_theme_mod('education_buz_skill_section_image');
        ?>
        <div class="main-skill-wrap clearfix">
        
            <div class="left-skill" <?php if($education_buz_skill_section_image){ ?> style="background-image: url(<?php echo esc_url($education_buz_skill_section_image); ?>);" <?php } ?>></div>
            
            <div class="right-skill">
            
                <?php  if($education_buz_skill_section_title || $education_buz_skill_section_desc){ ?>
                    <div class="section-title clearfix">
                    
                        <?php if($education_buz_skill_section_title){ ?>
                            <h2><?php echo esc_html($education_buz_skill_section_title); ?></h2>
                            <span><i class="fa fa-bookmark" aria-hidden="true"></i></span>
                        <?php } ?>
                        
                        <?php if($education_buz_skill_section_desc){ ?>
                            <p><?php echo esc_html($education_buz_skill_section_desc); ?></p>
                        <?php } ?>
                        
                    </div>
                <?php } ?>
                
                <?php if($education_buz_skill_title_one || $education_buz_skill_percent_one || 
                $education_buz_skill_title_two || $education_buz_skill_percent_two || 
                $education_buz_skill_title_three || $education_buz_skill_percent_three || 
                $education_buz_skill_title_four || $education_buz_skill_percent_four){ ?>
                    <div class="skill-secondary-wrap">
                        <?php $skill_count = 1; 
                        foreach($education_buz_array_skills as $education_buz_array_skill){
                            $education_buz_skill_title = get_theme_mod('education_buz_skill_title_'.$education_buz_array_skill);
                            $education_buz_skill_percent = get_theme_mod('education_buz_skill_percent_'.$education_buz_array_skill);
                            ?>
                            <div class="main-progressbar wow fadeInUp">
                            
                                <div class="pbar-container">
                                
                                    <?php if($education_buz_skill_title){ ?>
                                        <div class="pbar-title"><?php echo esc_html($education_buz_skill_title); ?></div>
                                        <div class="percent-bar"><?php echo absint($education_buz_skill_percent); ?> %</div>
                                    <?php } ?>
                                    
                                    <?php if($education_buz_skill_percent){ ?>
                                        <div class="progress-bar-horizontal" data-width="<?php echo absint($education_buz_skill_percent); ?>">
                                            <div></div>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                                
                            </div>
                        <?php $skill_count++; } ?>
                    </div>
                <?php } ?>
                
            </div>
                
        </div>
 </section>