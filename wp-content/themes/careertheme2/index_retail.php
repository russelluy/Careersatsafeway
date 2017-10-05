<?php
/*
Template Name: Template Retail
*/
?>
<?php get_header(); ?>
		<div class="midbox_rt_bottom2">
			<?php 
				// left hand navigation is controlled by WP3.0
				wp_nav_menu( 
					array(
						'theme_location'=>'retail-menu',
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
								<div class="entry">
									<div class="mid_box_lft2">
										<?php if( is_page('retail') ) { ?>
											<img src="<?php bloginfo('template_directory'); ?>/res/page_title.jpg" border="0" alt="" />
										<?php } ?>
										<?php the_content('Read the rest of this entry &raquo;'); ?>
									</div> <!-- .mid_box_lft2 -->
									<div class="mid_box_rt2">
										<div class="midbox_rt_top2">
											<div class="midbox_rt_pic1_rt"></div>
											<div class="midbox_rt_larree_rt">
												<div class="quote_txt2">&quot;Opportunities for growth and advancement here are endless. You are bound only by your own determination.&quot;</div>
												<div class="sign">
													<div class="larree_sign">Monica</div>
													<div style="left: 10px;position: relative;top: 10px;">
														<a href="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface"><img src="<?php bloginfo('template_directory'); ?>/res/apply_now.jpg" border="0" alt="" /></a>
													</div>
													<!--<div class="larree_title">Department Manager</div>-->
												</div> <!-- .sign -->
											</div> <!-- .midbox_rt_larree_rt -->
										</div> <!-- .midbox_rt_top2 -->
									</div> <!-- mid_box_rt2 -->
								</div> <!-- .entry -->
							</div> <!-- .post_class() -->
						<?php endwhile; else : ?>
				
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