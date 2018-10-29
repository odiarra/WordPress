<?php
add_action('wp_enqueue_scripts','education_buz_dynamic_style');
function education_buz_dynamic_style(){


    $education_buz_dynamic_style = '';
    
    $education_buz_Category_list = education_buz_Category_list();
    if($education_buz_Category_list){
        $education_buz_Category_count = 1;
            foreach($education_buz_Category_list as $education_buz_Category_slug => $education_buz_Category){
            $education_buz_cat_color = esc_attr(get_theme_mod('education_buz_cat_color_'.absint($education_buz_Category_count)));
            if($education_buz_cat_color){

                $education_buz_dynamic_style .= ".cat_$education_buz_Category_slug{background:$education_buz_cat_color !important}";
                $education_buz_dynamic_style .= ".cat_$education_buz_Category_slug{border-color:$education_buz_cat_color !important}";
            }
        $education_buz_Category_count++;}
    }
    
    $education_buz_theme_color = esc_attr(get_theme_mod('education_buz_theme_color'));
    if($education_buz_theme_color){
        $education_buz_dynamic_style .= "#top-site-navigation ul li a{color: $education_buz_theme_color;}";
        $education_buz_dynamic_style .= "#bm-go-top{background: $education_buz_theme_color;}";
        $education_buz_dynamic_style .= "#masthead {border-color: $education_buz_theme_color;}";
    }
    
    wp_add_inline_style( 'education-buz-style', $education_buz_dynamic_style );
}