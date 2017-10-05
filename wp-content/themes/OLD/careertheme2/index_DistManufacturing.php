<?php
/*
Template Name: Template DistManufacturing
*/
?>
<?php get_header(); ?>
		<div class="midbox_rt_bottom2">
			<?php 
				// left hand navigation is controlled by WP3.0
				wp_nav_menu( 
					array(
						'theme_location'=>'logistics-menu',
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
									<img src="<?php bloginfo('template_directory'); ?>/res/page_title3.jpg" border="0" alt="" />
									<?php the_content('Read the rest of this entry &raquo;'); ?>
								</div> <!-- .mid_box_lft2 -->
								<div class="mid_box_rt2">
									<div class="midbox_rt_top2">
										<div class="midbox_rt_pic4_rt"></div>
										<div class="midbox_rt_larree_rt">
											<div class="quote_txt2">&quot;There are new challenges every day and an unlimited opportunity for growth.&quot;</div>
											<div class="sign">
												<div class="larree_sign">Maura</div>
												<!--<div class="larree_title">Plant Supervisor </div>-->
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
		<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
<?php get_footer(); ?>