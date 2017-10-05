<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div class="body_bg">
			<div class="body_box_mid_box">
				<div class="body_lft_menu2">
					<div id="navcontainer">
						
					</div>
				</div>
				
	<div id="content" class="narrowcolumn" role="main">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>



		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
			</div>

		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		
	<?php endif; ?>

	</div>

<div class="clear"></div>		    
			    </div>
			</div>
			<div class="bottom_box_bottom"></div>
		</div>
<?php get_footer(); ?>
