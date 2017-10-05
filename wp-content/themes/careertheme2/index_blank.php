<?php
/*
Template Name: Template Blank
*/
?>
<?php get_header(); ?>
	<div class="midbox_rt_bottom2">
		<div class="midbox_rt_bottom_lft2"></div>
		<div class="midbox_rt_bottom_rt2">

			<?php if (have_posts()) : ?>
		
				<?php while (have_posts()) : the_post(); ?>
		
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry">
							<?php the_content('Read the rest of this entry &raquo;'); ?>
						</div> <!-- .entry -->
					</div> <!-- post_class() -->
				<?php endwhile; else :  ?>
		
					<h2 class="center">Not Found</h2>
					<p class="center">Sorry, but you are looking for something that isn't here.</p>
					<?php get_search_form(); ?>
		
			<?php endif; ?>
               
				</div> <!-- .midbox_rt_bottom_rt2 -->
			</div> <!-- .midbox_rt_bottom2 -->
			<div class="clear"></div>
		</div> <!-- .mid_box2 -->
	</div> <!-- .mid_bg -->
<?php get_footer(); ?>