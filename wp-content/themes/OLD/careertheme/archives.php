<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
<div class="body_bg">
		<div class="body_box_mid_box">

<div id="content" class="widecolumn">


<h2>Archives by Month:</h2>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

<h2>Archives by Subject:</h2>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>

</div>

</div>
		<div class="clear"></div>
		<div class="bottom_box_bottom"></div>
	</div>

<?php get_footer(); ?>
