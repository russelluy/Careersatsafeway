<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	

	
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/res/favicon.ico" type="image/x-icon" /> 
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/main.css" />
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/all-ie.css">
	<![endif]-->   
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie-6.0.css">
	<![endif]--> 
	<!--[if lt IE 7]>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ie_png.js"></script>
		<script type="text/javascript">
			ie_png.fix('.png');
		</script>
		<link href="<?php bloginfo('template_directory'); ?>/style_ie.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ddmenu.js"></script>
	
	<?php wp_head(); ?>
</head>
<body id="home" <?php body_class(); ?>>
	<div class="home_wrap">
		<div class="header_bg2">
			<div class="header_box2">
				<div class="headleft_p">
					<div class="headleft_logo"> <a href="http://plevmudv07/jeremy/apps/careersatsafeway/"><img src="<?php bloginfo('template_directory'); ?>/res/logo.png" class="png" alt="" width="218px" height="79px" /></a>
					</div> <!-- .headleft_logo -->
				</div> <!-- headleft_p1 -->
				<div class="headright2">
			    <div class="headright_nav2">
						<div class="holder_icon1">
							<div class="icon1">
								<a href="http://plevmudv07/jeremy/apps/careersatsafeway/"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon1 -->
							<div class="text_icon">
								Home
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon1 -->
						<div class="holder_icon2">
							<div class="icon2">
								<a href="retail"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon2 -->
							<div class="text_icon">
								Retail
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon2 -->
						<div class="holder_icon3">
							<div class="icon3">
								<a href="pharmacy"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon3 -->
							<div class="text_icon">
								Pharmacy & Wellness Center
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon3 -->
						<div class="holder_icon3b">
							<div class="icon3b">
								<a href="home-delivery"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon3b -->
							<div class="text_icon">
								Home Delivery
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon3b -->
						<div class="holder_icon4">
							<div class="icon4">
								<a href="distribution-manufacturing"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon4 -->
							<div class="text_icon">
								Distribution Manufacturing
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon4 -->
						<div class="holder_icon5">
							<div class="icon5">
								<a href="corporate"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon5 -->
							<div class="text_icon">
								Corporate
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon5 -->
						<div class="holder_icon6">
							<div class="icon6">
								<a href="college-programs"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
							</div> <!-- .icon6 -->
							<div class="text_icon">
								College
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon6 -->
			    </div> <!-- .headright_nav -->
			    <div class="headright_top"></div>
			    <div class="headright_search">
						<form id="form1" name="form1" method="post" action="">
							<select class="search" name="url" onchange="switchpage(this)">
								<option value="#" disabled="disabled" selected="selected">-- Apply Now --</option>
								
                                <optgroup label="Retail">
                                	<option value="http://www.safeway.apply2jobs.com/">Store Management</option>
									<option value="http://www.safeway.apply2jobs.com/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">Store Positions</option>	
                                </optgroup>
                                
                                <optgroup label="Pharmacy">
                                	<option value="http://www.safeway.apply2jobs.com/">Pharmacy</option>
									<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Pharmacy Technician Floater (NorCal)</option>
									<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">Pharmacy Technician (United States)</option>
                                    <option value="http://www.safeway.ca/sixframeset.asp?page=careers">Pharmacy Technician (Canada)</option>
									<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Patient Care Technician</option>
                                </optgroup>
								<optgroup label="Home Delivery">
                                	<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Driver</option>
									
                                </optgroup>
                                
                                <optgroup label="Distribution">
                                	<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Management</option>
                                	<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">General Warehouse</option>
                                    <option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Office Support</option>
                                </optgroup>
                                <optgroup label="Manufacturing">
                                	<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Management</option>
                                	<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">Non-Management</option>
                                    <option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Office Support</option>
                                </optgroup>
                                <optgroup label="Military">
                                	<option value="http://www.safeway.apply2jobs.com/">Retail Leadership Development Program</option>
                                	<option value="http://www.safeway.apply2jobs.com/">Manufacturing/Distribution</option>	
                                </optgroup>
                                <optgroup label="Transportation">
                                	<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">Transportation</option>
                                </optgroup>

								
								<!--<optgroup label="Junior Military Officer Leadership">
                                	<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Management</option>
                                </optgroup>-->
                                
                                <optgroup label="Corporate">
                                	<option value="http://www.safeway.apply2jobs.com/">Corporate</option>
                                </optgroup>
                                
                                <optgroup label="College">
                                	<option value="http://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">College Programs</option>
                                </optgroup>
								<!--<option value="http://www.careersatsafeway.com/college-programs">&nbsp;&nbsp;College Programs</option>-->
							</select>
						</form>
						<a href="http://facebook.com/safeway" target="_blank" style="margin: 8px;position: absolute; @media screen and (-webkit-min-device-pixel-ratio:0) {margin-left: 108px;}" class="forchrome"><img src="<?php bloginfo('template_directory'); ?>/res/fb_logo.png" border="0" alt="" /></a>
                        <a href="http://twitter.com/safeway" target="_blank" style="margin: 8px 0 8px 40px;position: absolute;" class="forchrome2"><img src="<?php bloginfo('template_directory'); ?>/res/twit_logo.png" border="0" alt="" /></a>
			    </div> <!-- .headright_search -->
				</div> <!-- .headright2 -->
			</div> <!-- .header_box2 -->
		</div> <!-- .header_bg2 -->
		<div class="mid_bg">
			<div class="mid_box2">
				<div class="midbox_rt_top">
					<div class="midbox_rt_top_txt2">Find us on:</div>
					<div class="midbox_rt_top_but">
						<a href="http://www.linkedin.com" target="blank"><img src="<?php bloginfo('template_directory'); ?>/res/but_inkedin.gif" border="0" alt="" /></a>
						<a href="http://www.twitter.com" target="blank"><img src="<?php bloginfo('template_directory'); ?>/res/but_twitter.gif" border="0" alt="" /></a>
						<a href="http://www.facebook.com" target="blank"><img src="<?php bloginfo('template_directory'); ?>/res/but_facebook.gif" border="0" alt="" /></a>
					</div> <!-- .midbox_rt_top_but -->
				</div> <!-- .midbox_rt_top -->
