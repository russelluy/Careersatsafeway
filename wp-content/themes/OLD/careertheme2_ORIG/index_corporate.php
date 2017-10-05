<?php
/*
Template Name: Template Reverse Corporate
*/
?>
<?php get_header(); ?>
		<script type="text/javascript">
		<!--
			// Andy Langton's show/hide/mini-accordion - updated 23/11/2009
			// Latest version @ http://andylangton.co.uk/jquery-show-hide
			
			// this tells jquery to run the function below once the DOM is ready
			jQuery.noConflict();
			jQuery(document).ready(function() {
			
			// choose text for the show/hide link - can contain HTML (e.g. an image)
			var showText='read more';
			var hideText='hide';
			
			// initialise the visibility check
			var is_visible = false;
			
			// append show/hide links to the element directly preceding the element with a class of "toggle"
			jQuery('.toggle').prev().append(' <a href="#" class="toggleLink">'+showText+'</a>');
			
			// hide all of the elements with a class of 'toggle'
			jQuery('.toggle').hide();
			
			// capture clicks on the toggle links
			jQuery('a.toggleLink').click(function() {
			
			// switch visibility
			is_visible = !is_visible;
			
			// change the link depending on whether the element is shown or hidden
			//jQuery(this).html( (!is_visible) ? showText : hideText);
			
			// toggle the display - uncomment the next line for a basic "accordion" style
			//jQuery('.toggle').hide();$('a.toggleLink').html(showText);
			//jQuery(this).parent().next('.toggle').slideDown('slow'); //toggle('clip','',500);
			
			// change the link text depending on whether the element is shown or hidden
			if (jQuery(this).text()==showText) {
			jQuery(this).text(hideText);
			jQuery(this).parent().next('.toggle').slideDown(250);
			}
			else {
			jQuery(this).text(showText);
			jQuery(this).parent().next('.toggle').slideUp(250);
			}
			
			// return false so any link destination is not followed
			return false;
			
			});
			});
			//-->
		</script>		
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
							<?php if( is_page( 'regional-offices' ) ) { ?>
								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<div class="entry">
									<?php the_content('Read the rest of this entry &raquo;'); ?>
							<?php } else { ?>
								<div class="entry">
									<div class="mid_box_lft2">
										<img src="<?php bloginfo('template_directory'); ?>/res/page_title4.jpg" border="0" alt="Become Part of Our Corporate Team!" />
										<?php the_content('Read the rest of this entry &raquo;'); ?>
									</div> <!-- .mid_box_lft2 -->
									<div class="mid_box_rt2">
										<div class="midbox_rt_top2">
											<div class="midbox_rt_pic5_rt"></div>
											<div class="midbox_rt_larree_rt">
												<div class="quote_txt2">&#8220;I&#8217;m excited everyday working on challenging projects that reach millions of customers, working with people from so many different backgrounds.&#8221;</div> 
												<div class="sign"> 
													<div class="larree_sign">Walter</div> 
													<!--<div class="larree_title">Broadcast Advertising Manager </div> -->
												</div> <!-- .sign -->
											</div> <!-- .midbox_lft_larree_rt -->
										</div> <!-- .midbox_lft_top2 -->
										</div> <!-- .mid_box_lft2 -->
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