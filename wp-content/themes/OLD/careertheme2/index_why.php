<?php
/*
Template Name: Template WhyWorkForUs
*/
?>
<?php get_header(); ?>
		<div class="midbox_rt_bottom2">
			<?php 
				// left hand navigation is controlled by WP3.0
				wp_nav_menu( 
					array(
						'theme_location'=>'why-menu',
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
									<?php if( is_page('why-work-for-us') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title5.jpg" border="0" alt="" />
									<?php } elseif( is_page('training-and-development') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title7.jpg" border="0" alt="" />
									<?php } elseif( is_page('benefits') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title8.jpg" border="0" alt="" />
									<?php } elseif( is_page('csr') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title9.jpg" border="0" alt="" />
									<?php } elseif( is_page('diversity') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title10.jpg" border="0" alt="" />
									<?php } ?>
									<?php the_content('Read the rest of this entry &raquo;'); ?>
								</div> <!-- .mid_box_lft2 -->
								<div class="mid_box_rt2">
									<div class="midbox_rt_top2">
										<?php if( is_page('diversity') ) { ?>
											<div class="midbox_rt_pic12_rt"></div>
											<div class="midbox_rt_larree_rt">
												<div class="quote_txt2">&quot;By recognizing and celebrating our differences, we embrace our collective talents and use our contributions to create a more successful company.&quot;</div>
												<div class="sign">
													<div class="larree_sign">Steven A. Burd</div>
													<div class="larree_title">Chairman, President and Chief Executive Officer<br />Safeway Inc.</div>
												</div> <!-- .sign -->
											</div> <!-- .midbox_lft_larree_rt -->
                                        <?php } elseif( is_page('csr') ) { ?>
											<div class="midbox_rt_pic14_rt"></div>
											<div class="midbox_rt_larree_rt">
												<div class="quote_txt2">&quot;Safeway has a true commitment to corporate social responsibility  and to contributing to the broader communities we serve—which we refer to as  the &ldquo;Heart of Safeway.&rdquo; Not only am I proud to work for Safeway, I have also  had fantastic opportunities to grow professionally.&quot;</div>
												<div class="sign">
													<div class="larree_sign">Christy Consler</div>
													<div class="larree_title">Vice President, Sustainability</div>
												</div> <!-- .sign -->
											</div> <!-- .midbox_lft_larree_rt -->
										<?php } elseif( is_page('training-and-development') ) { ?>
											<div class="midbox_rt_pic11_rt"></div>
											<div class="midbox_rt_larree_rt">
												<div class="quote_txt2">&quot;My work environment here is dynamic, energized, focused, and exciting.&quot;</div>
												<div class="sign">
													<div class="larree_sign">Erick</div>
													<!--<div class="larree_title">IT Project Manager</div>-->
												</div> <!-- .sign -->
											</div> <!-- .midbox_lft_larree_rt -->
										<?php } else { ?>
											<div class="midbox_rt_pic15_rt"></div>
											<div class="midbox_rt_larree_rt">
												<div class="quote_txt2">&quot;Safeway offers a  dynamic, fast paced and energizing environment. We have talented employees who  tackle unique challenges and who are offered substantial opportunities that,  together, produce fulfilling and exciting careers in a  wide variety of fields.&quot;</div>
												<div class="sign">
													<div class="larree_sign">Russ Jackson</div>
													<div class="larree_title">Sr. Vice President, Human Resources<!--, Corporate Headquarters - Pleasanton, CA--></div>
												</div> <!-- .sign -->
											</div> <!-- .midbox_lft_larree_rt -->
										<?php } ?>
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