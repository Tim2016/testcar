<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
?>
<h1>content-None</h1>
<div class="notfound">
	
	<h3><?php esc_html_e( 'Nothing Found', 'engines' ); ?></h3>
	
	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( '%1$s %2$s.', esc_html__( 'Ready to publish your first post?', 'engines' ), '<a href="'. esc_url( admin_url( 'post-new.php' ) ) .'">'. esc_html__( 'Get started here', 'engines' ) .'</a>' ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'engines' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'engines' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</div><!-- .no-results -->
