<?php
/*
Template Name: Template Military Program
*/
?>
<?php get_header(); ?>
		<div class="midbox_rt_bottom2">
				<?php 
					// left hand navigation is controlled by WP3.0
					wp_nav_menu( 
						array(
							'theme_location'=>'generic-menu',
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
								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php the_content('Read the rest of this entry &raquo;'); ?>
								</div>
                                
                                
<!--Commented out because he no longer works with the company
								<div class="mid_box_rt2">
									<div class="midbox_rt_top2">
										<div class="midbox_rt_pic13_rt"></div>
										<div class="midbox_rt_larree_rt">
											<div class="quote_txt2">&quot;The Safeway Leadership Development Program is a challenging and exciting learning experience.  This program not only enables you to showcase your military leadership skills but gives you an opportunity to learn how to manage and operate a business.&quot;</div>
											<div class="sign">
												<div class="larree_sign">Lieutenant Thomas Hector</div>
												<div class="larree_title">Thomas Hector, Store Manager-In-Training and Lieutenant in U.S. Navy</div>
											</div>
										</div>
									</div>
								</div>-->


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
