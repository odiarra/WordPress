<?php
/** Breadcrumb Function **/
function education_buz_header_banner_x() {
	if(is_home() || is_front_page()) :
	else :
    $education_buz_breadcrumb_image = get_theme_mod('education_buz_breadcrumb_image') 
		?>
			<div class="header-banner-container" <?php if($education_buz_breadcrumb_image){ ?>style="background-image: url(<?php echo esc_url($education_buz_breadcrumb_image); ?>);" <?php } ?> >
                <div class="tb-container">
    				<div class="page-title-wrap">
    					<?php education_buz_breadcrumbs(); ?>
    				</div>
                </div>
			</div>
		<?php
	endif;
}
add_action('education_buz_header_banner', 'education_buz_header_banner_x');

/** Breadcrumb Sanitize **/
function education_buz_sanitize_bradcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}

/** Breadcrumb Titles **/
function education_buz_breadcrumbs() {
    global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = '&gt;';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="education-buz-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'education-buz') . '</a></div></div>';
    } else {

        echo '<div id="education-buz-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'education-buz') . '</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo esc_html(get_category_parents($thisCat->parent, TRUE, ' ' . esc_html($delimiter) . ' '));
            echo '<span class="current">' . esc_html__('Archive By Category','education-buz').' "' . esc_html(single_cat_title('', false)) . '"</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','education-buz'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<a href="' . esc_url(get_month_link(esc_attr(get_the_time('Y')), esc_attr(get_the_time('m')))) . '">' . esc_html(get_the_time('F')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('d')) . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('F')) . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . esc_html(get_the_time('Y')) . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . esc_html($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo education_buz_sanitize_bradcrumb($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            if($post_type){
            echo '<span class="current">' . esc_html($post_type->labels->singular_name) . '</span>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo education_buz_sanitize_bradcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_html($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_html($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_html__('Posts tagged','education-buz').' "' . esc_html(single_tag_title('', false)) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_html__('Articles posted by ','education-buz'). esc_html($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' . esc_html__('Error 404','education-buz') . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_html__('Page', 'education-buz') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}

/** Header Banner Function **/
function education_buz_home_banner_x(){ ?>
        <div class="main-banner-wrap layout-1">
            <?php $education_buz_slider_cat = get_theme_mod('education_buz_slider_cat');
                if($education_buz_slider_cat){
                    $education_buz_slider_query = new WP_Query(array('post','category_name'=>$education_buz_slider_cat,'posts_per_page'=>-1));
                    if($education_buz_slider_query->have_posts()){ ?>
                        <div class="slider-1-main-wrap">
                            <div class="owl-carousel secondary-slider-1">
                            <?php
                                while($education_buz_slider_query->have_posts()){
                                    $education_buz_slider_query->the_post();
                                    $tb_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-slider-1'); ?>
                                    
                                        <div class="slider-1-loop">
                                            <div class="secondary-slider-1-loop">
                                            
                                                <?php if(has_post_thumbnail()){ ?>
                                                    <div class="image-slider-1">
                                                        <img src="<?php echo esc_url($tb_slider_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                                    </div>
                                                <?php } ?>
                                                
                                                <?php if(get_the_title() || get_the_content()){ ?>
                                                    <div class="content-title">
                                                        <div class="tb-container">
                                                            
                                                            <div class="content-inner-wrap">
                                                                <?php if(get_the_title()){ ?>
                                                                    <h1><?php the_title(); ?></h1>
                                                                <?php } ?>
                                                                
                                                                <?php if(get_the_content()){ ?>
                                                                    <div class="content-slider"><?php the_content(); ?></div>
                                                                <?php } ?>
                                                            </div>
                                                                
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    
                                <?php } ?>
                            </div>
                        </div>
                    <?php wp_reset_postdata();}
                } ?>
                
                <?php $education_buz_array_slider_features = array('one','two','three','four','five','six'); ?>
                <div class="tb-slider-feature-wrap">
                    <div class="secondary-slider-feature clearfix">
                    
                        <?php foreach($education_buz_array_slider_features as $education_buz_array_slider_feature){ 
                            $education_buz_slider_feature_color = get_theme_mod('education_buz_slider_feature_color_'.$education_buz_array_slider_feature);
                            $education_buz_slider_feature_post = get_theme_mod('education_buz_slider_feature_post_'.$education_buz_array_slider_feature);
                            if($education_buz_slider_feature_post){
                                $education_buz_slider_features_posts_query = new WP_Query(array('post_type'=>'post','post__in'=>array($education_buz_slider_feature_post)));
                                if($education_buz_slider_features_posts_query->have_posts()){
                                    while($education_buz_slider_features_posts_query->have_posts()){
                                        $education_buz_slider_features_posts_query->the_post();
                                        $img_slider_feature = wp_get_attachment_image_src(get_post_thumbnail_id(),'education-buz-feature-image'); ?>
                                        <div <?php if($education_buz_slider_feature_color){?> style="background: <?php echo esc_attr($education_buz_slider_feature_color); ?>" <?php } ?> class="loop-slider-feature <?php echo esc_attr($education_buz_array_slider_feature); ?>">
                                        
                                            <?php if($img_slider_feature[0]){ ?>
                                                <div class="feature-slider-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($img_slider_feature[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            
                                            <?php if(get_the_title()){ ?>
                                                <span><a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a></span>
                                            <?php } ?>
                                            
                                        </div>
                                    <?php }
                                wp_reset_postdata();}
                            }
                        }?>
                        
                    </div>
                </div>
            
        </div>
    <?php
}
add_action('education_buz_home_banner','education_buz_home_banner_x');

/** Post Category List **/
function education_buz_Category_list(){
    $education_buz_cat_lists = get_categories(
        array(
            'hide_empty' => '0',
            'exclude' => '1',
        )
    );
    $education_buz_cat_array = array();
    foreach($education_buz_cat_lists as $education_buz_cat_list){
        $education_buz_cat_array[$education_buz_cat_list->slug] = $education_buz_cat_list->name;
    }
    return $education_buz_cat_array;
}

/** Post Category List **/
function education_buz_post_lists(){
    wp_reset_postdata();
    $posts = get_posts(array('posts_per_page'   => -1));
    $post_lists = array();
    $post_lists[''] = esc_html__('Select post', 'education-buz'); 
    foreach($posts as $post) :
        $post_lists[$post->ID] = $post->post_title;
    endforeach;
    return $post_lists;
}

/** FA Icon Lists **/
function education_buz_FA_icons(){
    return $array_exp = array("","address-book-o","address-card","address-card-o","bandcamp","bath","bathtub","drivers-license","drivers-license-o","eercast","envelope-open","envelope-open-o","etsy","free-code-camp","grav","handshake-o","id-badge","id-card","id-card-o","imdb","linode","meetup","microchip","podcast","quora","ravelry","s15","shower","snowflake-o","superpowers","telegram","thermometer","thermometer-0","thermometer-1","thermometer-2","thermometer-3","thermometer-4","thermometer-empty","thermometer-full","thermometer-half","thermometer-quarter","thermometer-three-quarters","times-rectangle","times-rectangle-o","user-circle","user-circle-o","user-o","vcard","vcard-o","window-close","window-close-o","window-maximize","window-minimize","window-restore","wpexplorer","address-book","address-book-o","address-card","address-card-o","adjust","american-sign-language-interpreting","anchor","archive","area-chart","arrows","arrows-h","arrows-v","asl-interpreting","assistive-listening-systems","asterisk","at","audio-description","automobile","balance-scale","ban","bank","bar-chart","bar-chart-o","barcode","bars","bath","bathtub","battery","battery-0","battery-1","battery-2","battery-3","battery-4","battery-empty","battery-full","battery-half","battery-quarter","battery-three-quarters","bed","beer","bell","bell-o","bell-slash","bell-slash-o","bicycle","binoculars","birthday-cake","blind","bluetooth","bluetooth-b","bolt","bomb","book","bookmark","bookmark-o","braille","briefcase","bug","building","building-o","bullhorn","bullseye","bus","cab","calculator","calendar","calendar-check-o","calendar-minus-o","calendar-o","calendar-plus-o","calendar-times-o","camera","camera-retro","car","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","cart-arrow-down","cart-plus","cc","certificate","check","check-circle","check-circle-o","check-square","check-square-o","child","circle","circle-o","circle-o-notch","circle-thin","clock-o","clone","close","cloud","cloud-download","cloud-upload","code","code-fork","coffee","cog","cogs","comment","comment-o","commenting","commenting-o","comments","comments-o","compass","copyright","creative-commons","credit-card","credit-card-alt","crop","crosshairs","cube","cubes","cutlery","dashboard","database","deaf","deafness","desktop","diamond","dot-circle-o","download","drivers-license","drivers-license-o","edit","ellipsis-h","ellipsis-v","envelope","envelope-o","envelope-open","envelope-open-o","envelope-square","eraser","exchange","exclamation","exclamation-circle","exclamation-triangle","external-link","external-link-square","eye","eye-slash","eyedropper","fax","feed","female","fighter-jet","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-movie-o","file-pdf-o","file-photo-o","file-picture-o","file-powerpoint-o","file-sound-o","file-video-o","file-word-o","file-zip-o","film","filter","fire","fire-extinguisher","flag","flag-checkered","flag-o","flash","flask","folder","folder-o","folder-open","folder-open-o","frown-o","futbol-o","gamepad","gavel","gear","gears","gift","glass","globe","graduation-cap","group","hand-grab-o","hand-lizard-o","hand-paper-o","hand-peace-o","hand-pointer-o","hand-rock-o","hand-scissors-o","hand-spock-o","hand-stop-o","handshake-o","hard-of-hearing","hashtag","hdd-o","headphones","heart","heart-o","heartbeat","history","home","hotel","hourglass","hourglass-1","hourglass-2","hourglass-3","hourglass-end","hourglass-half","hourglass-o","hourglass-start","i-cursor","id-badge","id-card","id-card-o","image","inbox","industry","info","info-circle","institution","key","keyboard-o","language","laptop","leaf","legal","lemon-o","level-down","level-up","life-bouy","life-buoy","life-ring","life-saver","lightbulb-o","line-chart","location-arrow","lock","low-vision","magic","magnet","mail-forward","mail-reply","mail-reply-all","male","map","map-marker","map-o","map-pin","map-signs","meh-o","microchip","microphone","microphone-slash","minus","minus-circle","minus-square","minus-square-o","mobile","mobile-phone","money","moon-o","mortar-board","motorcycle","mouse-pointer","music","navicon","newspaper-o","object-group","object-ungroup","paint-brush","paper-plane","paper-plane-o","paw","pencil","pencil-square","pencil-square-o","percent","phone","phone-square","photo","picture-o","pie-chart","plane","plug","plus","plus-circle","plus-square","plus-square-o","podcast","power-off","print","puzzle-piece","qrcode","question","question-circle","question-circle-o","quote-left","quote-right","random","recycle","refresh","registered","remove","reorder","reply","reply-all","retweet","road","rocket","rss","rss-square","s15","search","search-minus","search-plus","send","send-o","server","share","share-alt","share-alt-square","share-square","share-square-o","shield","ship","shopping-bag","shopping-basket","shopping-cart","shower","sign-in","sign-language","sign-out","signal","signing","sitemap","sliders","smile-o","snowflake-o","soccer-ball-o","sort","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-asc","sort-desc","sort-down","sort-numeric-asc","sort-numeric-desc","sort-up","space-shuttle","spinner","spoon","square","square-o","star","star-half","star-half-empty","star-half-full","star-half-o","star-o","sticky-note","sticky-note-o","street-view","suitcase","sun-o","support","tablet","tachometer","tag","tags","tasks","taxi","television","terminal","thermometer","thermometer-0","thermometer-1","thermometer-2","thermometer-3","thermometer-4","thermometer-empty","thermometer-full","thermometer-half","thermometer-quarter","thermometer-three-quarters","thumb-tack","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","ticket","times","times-circle","times-circle-o","times-rectangle","times-rectangle-o","tint","toggle-down","toggle-left","toggle-off","toggle-on","toggle-right","toggle-up","trademark","trash","trash-o","tree","trophy","truck","tty","tv","umbrella","universal-access","university","unlock","unlock-alt","unsorted","upload","user","user-circle","user-circle-o","user-o","user-plus","user-secret","user-times","users","vcard","vcard-o","video-camera","volume-control-phone","volume-down","volume-off","volume-up","warning","wheelchair","wheelchair-alt","wifi","window-close","window-close-o","window-maximize","window-minimize","window-restore","wrench","american-sign-language-interpreting","asl-interpreting","assistive-listening-systems","audio-description","blind","braille","cc","deaf","deafness","hard-of-hearing","low-vision","question-circle-o","sign-language","signing","tty","universal-access","volume-control-phone","wheelchair","wheelchair-alt","hand-grab-o","hand-lizard-o","hand-o-down","hand-o-left","hand-o-right","hand-o-up","hand-paper-o","hand-peace-o","hand-pointer-o","hand-rock-o","hand-scissors-o","hand-spock-o","hand-stop-o","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","ambulance","automobile","bicycle","bus","cab","car","fighter-jet","motorcycle","plane","rocket","ship","space-shuttle","subway","taxi","train","truck","wheelchair","wheelchair-alt","genderless","intersex","mars","mars-double","mars-stroke","mars-stroke-h","mars-stroke-v","mercury","neuter","transgender","transgender-alt","venus","venus-double","venus-mars","file","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-movie-o","file-o","file-pdf-o","file-photo-o","file-picture-o","file-powerpoint-o","file-sound-o","file-text","file-text-o","file-video-o","file-word-o","file-zip-o","info-circle","cog","gear","refresh","spinner","check-square","check-square-o","circle","circle-o","dot-circle-o","minus-square","minus-square-o","plus-square","plus-square-o","square","square-o","cc-amex","cc-diners-club","cc-discover","cc-jcb","cc-mastercard","cc-paypal","cc-stripe","cc-visa","credit-card","credit-card-alt","google-wallet","paypal","area-chart","bar-chart","bar-chart-o","line-chart","pie-chart","bitcoin","btc","cny","dollar","eur","euro","gbp","gg","gg-circle","ils","inr","jpy","krw","money","rmb","rouble","rub","ruble","rupee","shekel","sheqel","try","turkish-lira","usd","viacoin","won","yen","[657]","align-justify","align-left","align-right","bold","chain","chain-broken","clipboard","columns","copy","cut","dedent","eraser","file","file-o","file-text","file-text-o","files-o","floppy-o","font","header","indent","italic","link","list","list-alt","list-ol","list-ul","outdent","paperclip","paragraph","paste","repeat","rotate-left","rotate-right","save","scissors","strikethrough","subscript","superscript","table","text-height","text-width","th","th-large","th-list","underline","undo","unlink","angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows","arrows-alt","arrows-h","arrows-v","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","exchange","hand-o-down","hand-o-left","hand-o-right","hand-o-up","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","toggle-down","toggle-left","toggle-right","toggle-up","arrows-alt","backward","compress","eject","expand","fast-backward","fast-forward","forward","pause","pause-circle","pause-circle-o","play","play-circle","play-circle-o","random","step-backward","step-forward","stop","stop-circle","stop-circle-o","youtube-play","500px","adn","amazon","android","angellist","apple","bandcamp","behance","behance-square","bitbucket","bitbucket-square","bitcoin","black-tie","bluetooth","bluetooth-b","btc","buysellads","cc-amex","cc-diners-club","cc-discover","cc-jcb","cc-mastercard","cc-paypal","cc-stripe","cc-visa","chrome","codepen","codiepie","connectdevelop","contao","css3","dashcube","delicious","deviantart","digg","dribbble","dropbox","drupal","edge","eercast","empire","envira","etsy","expeditedssl","fa","facebook","facebook-f","facebook-official","facebook-square","firefox","first-order","flickr","font-awesome","fonticons","fort-awesome","forumbee","foursquare","free-code-camp","ge","get-pocket","gg","gg-circle","git","git-square","github","github-alt","github-square","gitlab","gittip","glide","glide-g","google","google-plus","google-plus-circle","google-plus-official","google-plus-square","google-wallet","gratipay","grav","hacker-news","houzz","html5","imdb","instagram","internet-explorer","ioxhost","joomla","jsfiddle","lastfm","lastfm-square","leanpub","linkedin","linkedin-square","linode","linux","maxcdn","meanpath","medium","meetup","mixcloud","modx","odnoklassniki","odnoklassniki-square","opencart","openid","opera","optin-monster","pagelines","paypal","pied-piper","pied-piper-alt","pied-piper-pp","pinterest","pinterest-p","pinterest-square","product-hunt","qq","quora","ra","ravelry","rebel","reddit","reddit-alien","reddit-square","renren","resistance","safari","scribd","sellsy","share-alt","share-alt-square","shirtsinbulk","simplybuilt","skyatlas","skype","slack","slideshare","snapchat","snapchat-ghost","snapchat-square","soundcloud","spotify","stack-exchange","stack-overflow","steam","steam-square","stumbleupon","stumbleupon-circle","superpowers","telegram","tencent-weibo","themeisle","trello","tripadvisor","tumblr","tumblr-square","twitch","twitter","twitter-square","usb","viacoin","viadeo","viadeo-square","vimeo","vimeo-square","vine","vk","wechat","weibo","weixin","whatsapp","wikipedia-w","windows","wordpress","wpbeginner","wpexplorer","wpforms","xing","xing-square","y-combinator","y-combinator-square","yahoo","yc","yc-square","yelp","yoast","youtube","youtube-play","youtube-square","h-square","heart","heart-o","heartbeat","hospital-o","medkit","plus-square","stethoscope","user-md","wheelchair","wheelchair-alt");
}