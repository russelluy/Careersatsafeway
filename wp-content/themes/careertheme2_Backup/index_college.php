<?php
/*
Template Name: Template College Program
*/
?>
<?php get_header(); ?>
			<div class="midbox_rt_bottom2">
				<?php 
					// left hand navigation is controlled by WP3.0
					wp_nav_menu( 
						array(
							'theme_location'=>'college-menu',
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
									<?php if( is_page('College Programs') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title6.jpg" border="0" alt="" />
									<?php } elseif( is_page('Pharmacy Internships / Programs') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title12.jpg" border="0" alt="" />
                                    <?php } elseif( is_page('Summer Internship Program') ) { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title3.jpg" border="0" alt="" />										
									<?php } else { ?>
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title3.jpg" border="0" alt="" />
									<?php } ?>
									<?php the_content('Read the rest of this entry &raquo;'); ?>
								</div> <!-- .mid_box_lft2 -->
								<div class="mid_box_rt2">
									<div class="midbox_rt_top2">
									<?php if( is_page('College Programs') ) { ?>
										<div class="midbox_rt_pic6_rt"></div>
										<div class="midbox_rt_larree_rt">
											<div class="quote_txt2">&quot;It's great to get so much responsibility right at the start of my career, like being part of major corporate initiatives.&quot;</div>
											<div class="sign">
												<div class="larree_sign">Angeline</div>
												<div style="left: 10px;position: relative;top: 10px;">
														<a href="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface"><img src="<?php bloginfo('template_directory'); ?>/res/apply_now.jpg" border="0" alt="" /></a>
													</div>
												<!--<div class="larree_title">Marketing Coordinator</div>-->
											</div> <!-- .sign -->
										</div> <!-- .midbox_rt_larree_rt -->
									<?php } elseif(is_page('Pharmacy Internships / Programs')) { ?>
										<div class="midbox_rt_pic3_rt"></div>
										<div class="midbox_rt_larree_rt">
											<div class="quote_txt2">&quot;Safeway  not only offers you a rewarding pharmacy career, but also the opportunity to  expand your skills and make a meaningful contribution to your profession and to  public health.&quot;</div>
											<div class="sign">
												<div class="larree_sign">Sunil</div>
												<!--<div class="larree_title">Pharmacy Manager Store#1490</div>-->
											</div> <!-- .sign -->
										</div> <!-- .midbox_rt_larree_rt -->
									<?php } elseif( is_page('Finance Leadership Program') ) { ?>
										<div class="midbox_rt_pic8_rt"></div>
									<?php } elseif( is_page('Operations Leadership Program') ) { ?>
										<div class="midbox_rt_pic9_rt"></div>
									<?php } elseif( is_page('Summer Internship Program') ) { ?>
										<div class="midbox_rt_pic7_rt"></div>
										<div style="left: 10px;position: relative;top: 10px;">
											<a href="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface"><img src="<?php bloginfo('template_directory'); ?>/res/apply_now.jpg" border="0" alt="" /></a>
										</div>
									<?php } elseif( is_page('Summer Internship Program') ) { ?>
										<div class="midbox_rt_pic7_rt"></div>
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