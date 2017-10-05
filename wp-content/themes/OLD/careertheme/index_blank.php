<?php
/*
Template Name: Template Blank
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="shortcut icon" href="wp-content/themes/careertheme/res/favicon.ico" type="image/x-icon" /> 

  <link rel="stylesheet" type="text/css" href="wp-content/themes/careertheme/css/main.css" />
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="wp-content/themes/careertheme/css/all-ie.css">
    <![endif]-->   
     <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="wp-content/themes/careertheme/css/ie-6.0.css">
    <![endif]--> 
    <!--[if lt IE 7]>
	 <script type="text/javascript" src="wp-content/themes/careertheme/js/ie_png.js"></script>
	 <script type="text/javascript">
			 ie_png.fix('.png');
	 </script>
	 <link href="style_ie.css" rel="stylesheet" type="text/css" />
	<![endif]-->


<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type="text/javascript" src="wp-content/themes/careertheme/js/ddmenu.js"></script>

<style type="text/css" media="screen">

<?php
// Checks to see whether it needs a sidebar or not
if ( empty($withcomments) && !is_single() ) {
?>
	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbg-<?php bloginfo('text_direction'); ?>.jpg") repeat-y top; border: none; }
<?php } else { // No sidebar ?>
	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbgwide.jpg") repeat-y top; border: none; }
<?php } ?>

</style>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body id="home">
    <div class="home_wrap">
    <div class="header_bg2">
		<div class="header_box2">
			<div class="headleft_p0">
			    <div class="headleft_logo">
			    	<img src="wp-content/themes/careertheme/res/logo.png" class="png" alt="" width="218px" height="79px" />
			    </div>
			</div>
			<div class="headright2">
			    <div class="headright_nav">
			        <div class="holder_icon1">
			            <div class="icon1">
			                <a href="index.php"><img src="wp-content/themes/careertheme/res/icon_s.gif" border="0" alt="" /></a>
			            </div>
			            <div class="text_icon">
			                home
			            </div>
			        </div>
			        <div class="holder_icon2">
			            <div class="icon2">
			                <a href="retail"><img src="wp-content/themes/careertheme/res/icon_s.gif" border="0" alt="" /></a>
			            </div>
			            <div class="text_icon">
			                Retail
			            </div>
			        </div>
			        <div class="holder_icon3">
			            <div class="icon3">
			                <a href="pharmacy"><img src="wp-content/themes/careertheme/res/icon_s.gif" border="0" alt="" /></a>
			            </div>
			            <div class="text_icon">
			                Pharmacy
			            </div>
			        </div>
			        <div class="holder_icon4">
			            <div class="icon4">
			                <a href="logistics-manufacturing"><img src="wp-content/themes/careertheme/res/icon_s.gif" border="0" alt="" /></a>
			            </div>
			            <div class="text_icon">
			                Logistics Manufacturing
			            </div>
			        </div>
			        <div class="holder_icon5">
			            <div class="icon5">
                            <a href="corporate"><img src="wp-content/themes/careertheme/res/icon_s.gif" border="0" alt="" /></a>
                        </div>
			            <div class="text_icon">
			                Corporate
			            </div>
			        </div>
			    </div>
			    <div class="headright_top0">
			    </div>
			    <div class="headright_search">
			        <form method="post">
						<select name="url" onchange="switchpage(this)">
						<option value="#" selected="selected">Search for a Job</option>
						<option value="retail">Retail</option>
						<option value="pharmacy">Pharmacy</option>
						<option value="logistics-manufacturing">Distribution</option>
						<option value="logistics-manufacturing">Manufacturing</option>
						<option value="corporate">Corporate</option>
						</select>
					</form> 
			    </div>
			</div>
		</div>
	</div>
	<div class="mid_bg">
		<div class="mid_box2">
		        <div class="midbox_rt_top">
		            <div class="midbox_rt_top_txt2">
		                Find us on:
		            </div>
		            <div class="midbox_rt_top_but">
		            <a href="http://www.linkedin.com" target="blank"><img src="wp-content/themes/careertheme/res/but_inkedin.gif" border="0" alt="" /></a>
		            <a href="http://www.twitter.com" target="blank"><img src="wp-content/themes/careertheme/res/but_twitter.gif" border="0" alt="" /></a>
		            <a href="http://www.facebook.com" target="blank"><img src="wp-content/themes/careertheme/res/but_facebook.gif" border="0" alt="" /></a>
		            </div>
		        </div>
		        <div class="midbox_rt_bottom2">
		            <div class="midbox_rt_bottom_lft2">
		               
		                
		            </div>
		            <div class="midbox_rt_bottom_rt2">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
			</div>
		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>
                 
                 
                  </div>
		        </div>
			<div class="clear"></div>
		</div>
	</div>
			<?php get_footer(); ?>
	</body>











	








