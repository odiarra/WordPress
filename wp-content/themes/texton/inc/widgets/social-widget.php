<?php
/**
 * Social Links Widget
 *
 * @package texton
 */

if ( ! class_exists( 'Texton_Social_Links_Widget' ) ) :

     
    class Texton_Social_Links_Widget extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $st_widget_social = array(
                'classname'   => 'social_widget',
                'description' => esc_html__( 'Enter the url only the icon will be displayed as per the links. Compatible Area: Sidebar, Footer', 'texton' ),
            );
            parent::__construct( 'texton_social_widget', esc_html__( 'ST: Social Links Widget', 'texton' ), $st_widget_social );
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
            $social_link  = isset( $instance['social_link'] ) ? explode( '|', $instance['social_link'] ) : array();

            echo $args['before_widget'];

            if ( ! empty( $title ) ) {
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            } ?>

            <div class="social-icons social-menu">
                <ul class="list-inline">
                    <?php foreach ( $social_link as $link ) : ?>
                        <li><a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php echo texton_return_social_icon( $link ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $title       = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Social Links', 'texton' );
            $social_link  = isset( $instance['social_link'] ) ? $instance['social_link'] : '';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'texton' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <div class="widget_multi_input" >
                <label for="<?php echo esc_attr( $this->get_field_id( 'social_link' ) ); ?>"><?php esc_html_e( 'Social Links:', 'texton' ); ?></label>
                <input type="hidden" id="<?php echo esc_attr( $this->get_field_id('social_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_link' ) ); ?>" value="<?php echo esc_attr( $social_link ); ?>" class="widget_multi_value_field" />
                <div class="widget_multi_fields">
                    <div class="set">
                        <input type="text" value="" class="widget_multi_single_field"/>
                        <span class="widget_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span>
                    </div>
                </div>
                <a href="#" class="button widget_multi_add_field"><?php esc_html_e( 'Add Social Link', 'texton' ); ?></a>

            </div>

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
            $instance['social_link']      = sanitize_text_field( $new_instance['social_link'] );

            return $instance;
        }
    }
endif;
