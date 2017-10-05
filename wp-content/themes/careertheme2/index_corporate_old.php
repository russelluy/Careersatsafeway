<?php
/*
Template Name: Template Corporate
*/
?>
<?php get_header(); ?>
		<div class="midbox_rt_bottom2">
			<?php 
				// left hand navigation is controlled by WP3.0
				wp_nav_menu( 
					array(
						'theme_location'=>'corporate-menu',
						'container_class'=>'midbox_rt_bottom_lft2',
						'before'=>'<div class="lft_nav">',
						'after'=>'</div>'
					) 
				); 
			?>
			<div class="midbox_rt_bottom_rt2">
		
				<?php if (have_posts()) : ?>
			
					<?php while (have_posts()) : the_post(); ?>
			
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class="entry">
								<?php if( !is_page( 'regional-offices' ) ) { ?>
								<div class="mid_box_lft2">
									<div class="midbox_lft_top2">
										<div class="midbox_lft_pic5_lft"></div>
										<div class="midbox_lft_larree_rt">
											<div class="quote_txt2">&#8220;I&#8217;m excited everyday working on challenging projects that reach millions of customers, working with people from so many different backgrounds.&#8221;</div> 
											<div class="sign"> 
												<div class="larree_sign">Walter</div> 
												<div class="larree_title">Broadcast Advertising Manager <br />Corporate Headquarters &#8211; Pleasanton, CA</div> 
											</div> <!-- .sign -->
										</div> <!-- .midbox_lft_larree_rt -->
									</div> <!-- .midbox_lft_top2 -->
									</div> <!-- .mid_box_lft2 -->
									<div class="mid_box_rt2">
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title4.jpg" border="0" alt="Become Part of Our Corporate Team!" />
										<?php the_content('Read the rest of this entry &raquo;'); ?>
									</div> <!-- .mid_box_rt2 -->
								<?php } else { ?>
									<?php the_content('Read the rest of this entry &raquo;'); ?>
								<?php } ?>
							</div> <!-- .entry -->
						</div> <!-- .post_class() -->
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