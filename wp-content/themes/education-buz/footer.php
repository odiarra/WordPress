<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education Buz
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="bottom-footer">
            <div class="tb-container">
        		<div class="site-info">
        			<div class="footer-copyright">
                    <span class="copyright-text"><?php echo esc_html( get_theme_mod( 'education_buz_footer_copyright_text'));?></span>
        			<span class="sep"> | </span>
        			<?php 
        				printf( esc_html__( 'Education Buz By %1$s.', 'education-buz' ), '<a href="'.esc_url( 'https://buzthemes.com' ).'" rel="designer">'.esc_html__('Buzthemes', 'education-buz').'</a>' ); 
                    ?>
    	       </div><!-- .site-info -->
        		</div><!-- .site-info -->
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php
$education_buz_go_top_enable_disable = get_theme_mod('education_buz_go_top_enable_disable');
if($education_buz_go_top_enable_disable == 'enable'){ ?>
    <div id="tb-go-top" class="tb-on"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
<?php } ?>
<div id="dynamic-css"></div>
<?php wp_footer(); ?>

</body>
</html>
