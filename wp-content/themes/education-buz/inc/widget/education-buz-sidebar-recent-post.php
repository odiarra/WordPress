<?php
/**
 * @package Education Buz
 */

add_action('widgets_init', 'education_buz_recent_blog_register');

function education_buz_recent_blog_register() {
    register_widget('education_buz_recent_blog_Widget');
}

class education_buz_recent_blog_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'education_buz_recent_blog_Widget', 'Education Buz : Sidebar Recent Blog', array(
                'description' => esc_html__('This Widget show Recent Blogs', 'education-buz')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $education_buz_cat_list[''] = esc_html__('--Choose--','education-buz');
        $education_buz_cat_list = education_buz_Category_list();
        $fields = array(
            'bm_recent_blog_title' => array(
                'education_buz_widgets_name' => 'bm_recent_blog_title',
                'education_buz_widgets_title' => esc_html__('Title', 'education-buz'),
                'education_buz_widgets_field_type' => 'text',
            ),
            'bm_recent_blog_category' => array(
                'education_buz_widgets_name' => 'bm_recent_blog_category',
                'education_buz_widgets_title' => esc_html__('Blog Category', 'education-buz'),
                'education_buz_widgets_field_type' => 'select',
                'education_buz_widgets_field_options' => $education_buz_cat_list,
            ),
            'bm_recent_blog_posts' => array(
                'education_buz_widgets_name' => 'bm_recent_blog_posts',
                'education_buz_widgets_title' => esc_html__('Recent Blog Posts Number', 'education-buz'),
                'education_buz_widgets_field_type' => 'number',
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        
        $bm_title_widget = apply_filters( 'widget_title', empty( $instance['bm_recent_blog_title'] ) ? '' : $instance['bm_recent_blog_title'], $instance, $this->id_base );        
        $bm_recent_blog_category = isset( $instance['bm_recent_blog_category'] ) ? $instance['bm_recent_blog_category'] : '' ;
        $bm_recent_blog_posts = isset( $instance['bm_recent_blog_posts'] ) ? $instance['bm_recent_blog_posts'] : '' ;
        if($bm_recent_blog_posts == ''){
            $bm_recent_blog_posts = '4';
        }
        
        echo $before_widget;
        ?>
            <div class="recent-blog-wrap">
                <div class="recent-blog-contents">
                    <?php
                    $bm_recent_blog_args = array(
                        'poat_type' => 'post',
                        'order' => 'DESC',
                        'posts_per_page' => $bm_recent_blog_posts,
                        'post_status' => 'publish',
                        'category_name' => $bm_recent_blog_category
                    ); 
                    $bm_recent_blog_query = new WP_Query($bm_recent_blog_args);
                    if (!empty($bm_title_widget)): ?>
                        <?php echo $args['before_title'] . esc_html($bm_title_widget) . $args['after_title']; ?>
                    <?php endif;
                    
                    if($bm_recent_blog_query->have_posts()): ?>
                        <div class="recent-blog-main-wrap clearfix">
                            <div class="recent-blog-loop-wrap">
                                <?php $bm_count_post = 1;
                                
                                while($bm_recent_blog_query->have_posts()){
                                        $bm_recent_blog_query->the_post();
                                        $bm_recent_blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'education_buz-slider-blog-list-image-1');?>
                                            <div class="loop-posts-blog-recent clearfix">
                                            
                                                <?php if($bm_recent_blog_image[0]){ ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($bm_recent_blog_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
                                                    </a>
                                                <?php } ?>
                                                
                                                <?php if(get_the_title()){ ?>
                                                    <div class="wrap-meta-title">
                                                        <div class="title-recent-post">
                                                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                                                        </div>
                                                        
                                                        <div class="entry-meta">
                                                			<div class="comment-author-date">
                                                                
                                                                <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                                
                                                            </div>
                                                		</div><!-- .entry-meta -->
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php
                                $bm_count_post ++; wp_reset_postdata();} ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	education_buz_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$education_buz_widgets_name] = education_buz_widgets_updated_field_value($widget_field, $new_instance[$education_buz_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	education_buz_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $education_buz_widgets_field_value = !empty($instance[$education_buz_widgets_name]) ? esc_attr($instance[$education_buz_widgets_name]) : '';
            education_buz_widgets_show_widget_field($this, $widget_field, $education_buz_widgets_field_value);
        }
    }

}
