<?php
/**
 * Portfolio Widget
 *
 * @package texton
 */

if ( ! class_exists( 'Texton_Portfolio_Widget' ) ) :

     
    class Texton_Portfolio_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_portfolio = array(
                'classname'   => 'portfolio_widget',
                'description' => esc_html__( 'Compatible Area: Homepage, Sidebar', 'texton' ),
            );
            parent::__construct( 'texton_portfolio_widget', esc_html__( 'ST: Portfolio Widget', 'texton' ), $st_widget_portfolio );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {
            // outputs the content of the widget
            if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
            }

            $title   = ( ! empty( $instance['title'] ) ) ? ( $instance['title'] ) : '';
            $title   = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $cat_id = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : '';
            $query_args = array(
                'post_type'         => 'post',
                'posts_per_page'    => 6,
                'cat'               => absint( $cat_id ),
                'ignore_sticky_posts' => true,
                ); 

            $query = new WP_Query( $query_args );

            echo $args['before_widget'];
            ?>
                <div id="gallery" class="page-section relative">
                    <div class="wrapper">
                        <?php if ( ! empty( $title ) ) : ?>
                            <div class="section-header align-center">
                                <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                                <div class="separator"></div>
                            </div><!-- .section-header -->
                        <?php endif; ?>

                        <div class="section-content column-3">
                            <?php if ( $query -> have_posts() ) : while ( $query -> have_posts() ) : $query -> the_post(); ?>
                                <article class="hentry">
                                    <div class="post-wrapper">
                                        <div class="gallery">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <div class="featured-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail( 'texton-medium', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                                    </a>
                                                    <div class="overlay">
                                                        <header class="entry-header">
                                                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                        </header>
                                                    </div>
                                                </div>
                                            <?php endif; ?> 
                                        </div><!-- .gallery -->
                                    </div><!-- .post-wrapper -->
                                </article>

                            <?php endwhile; endif;
                            wp_reset_postdata(); ?>
                        </div><!-- .section-content -->
                    </div><!-- .wrapper -->
                </div><!-- #gallery -->

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title      = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Portfolio', 'texton' );
            $read_more = isset( $instance['read_more'] ) ? $instance['read_more'] : esc_html__( 'Read More', 'texton' );
            $cat_id     = isset( $instance['cat_id'] ) ? $instance['cat_id'] : '';
            $category_options = texton_category_choices();
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'texton' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>"><?php echo esc_html__( 'Select Category', 'texton' ); ?></label>
                <select class="texton-widget-chosen-select widfat" id="<?php echo esc_attr( $this->get_field_id( 'cat_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cat_id' ) ); ?>">
                    <?php foreach ( $category_options as $category_option => $value ) : ?>
                        <option value="<?php echo absint( $category_option ); ?>" <?php selected( $cat_id, $category_option, $echo = true ) ?> ><?php echo esc_html( $value ); ?></option>
                    <?php endforeach; ?>
                </select>
                <small><?php esc_html_e( 'Six posts will be shown from selected category.', 'texton' ); ?></small>
            </p>

        <?php }

        /**
        * Processing widget options on save
        *
        * @param array $new_instance The new options
        * @param array $old_instance The previous options
        */
        public function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance                   = $old_instance;
            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['cat_id']         = texton_sanitize_category( $new_instance['cat_id'] );
           
            return $instance;
        }
    }
endif;
