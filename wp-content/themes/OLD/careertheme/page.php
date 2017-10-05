<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<div class="body_bg">
			<div class="body_box_mid_box">
				<div class="body_lft_menu">
					<div id="navcontainer">
						
					</div>
					<div class="clear"></div>
				</div>
				
				   
				   			<div id="content" class="narrowcolumn" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h1><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
                   	<div class="clear"></div>	    
			   
			</div>
			<div class="bottom_box_bottom"></div>
		</div>
	

<?php get_footer(); ?>
