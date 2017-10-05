<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta name="google-site-verification" content="HVGIw-0NNoxFWQPBqdtBwR2_C4F3GupOn7WbdMiGUkY" />
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
		<link href="<?php bloginfo('template_directory'); ?>/css/style_ie.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ddmenu.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
	
	
	</script>


	
	<?php wp_head(); ?>
</head>

<body id="home" <?php body_class(); ?>>
	<div class="home_wrap">
		<div class="header_bg">
			<div class="header_box">
				<div class="headleft">
					<div class="headleft_logo">
						<a href="index.php"><img src="<?php bloginfo('template_directory'); ?>/res/logo.png" class="png" alt="" width="218px" height="79px" /></a>
					</div> <!-- .headleft_logo -->
				</div> <!-- .headleft -->
				<div class="headright">
			    <div class="headright_nav">
						<div class="holder_icon1">
							<div class="icon1">
								<a href="index.php"><img src="<?php bloginfo('template_directory'); ?>/res/icon_s.gif" border="0" alt="" /></a>
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
								Pharmacy
							</div> <!-- .text_icon -->
						</div> <!-- .holder_icon3 -->
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
			    <div class="headright_mid">
						We offer a range of career opportunities in a dynamic retail environment. We are an innovative Fortune 100 Company that, thanks to the professionalism, diversity, spirit and friendliness of our people, is thriving in locations across the U.S. and Canada. From our stores                    to our corporate headquarters, we offer careers that build your skills and your future. 
			    </div> <!-- .headright_mid -->
			    <div class="headright_search2">
						<!--<form method="post" action="">
							<select class="search" name="url" onchange="switchpage(this)">
								<option value="#" disabled="disabled" selected="selected">-- Search for a Job --</option>
								<option disabled="disabled">Retail -</option>
								<option value="http://www.safeway.apply2jobs.com/">&nbsp;&nbsp;Store Management</option>
								<option value="http://www.safeway.apply2jobs.com/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">&nbsp;&nbsp;Store Positions</option>
								<option disabled="disabled">Pharmacy -</option>
								<option value="http://www.safeway.apply2jobs.com/">&nbsp;&nbsp;Pharmacists</option>
								<option value="http://www.safeway.apply2jobs.com/">&nbsp;&nbsp;Pharmacy Managers</option>
								<option value="http://www.safeway.apply2jobs.com/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">&nbsp;&nbsp;Pharmacy Technicians</option>
								<option disabled="disabled">Distribution/Manufacturing -</option>
								<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">&nbsp;&nbsp;Management</option>
								<option value="http://www.safeway.apply2jobs.com/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">&nbsp;&nbsp;General Warehouse</option>
								<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">&nbsp;&nbsp;Quality Assurance</option>
								<option value="http://www.safeway.apply2jobs.com/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">&nbsp;&nbsp;Transportation</option>
								<option disabled="disabled">Corporate -</option>
								<option value="http://www.safeway.apply2jobs.com/">&nbsp;&nbsp;Corporate</option>
								<option disabled="disabled">Internships</option>
								<option value="http://www.careersatsafeway.com/college-programs">&nbsp;&nbsp;College Programs</option>
							</select>
						</form> -->
                        
                        <form id="form1" name="form1" method="post" action="">
							<select class="search" name="url" onchange="switchpage(this)">
								<option value="#" disabled="disabled" selected="selected">-- Apply Now --</option>
								
                                <optgroup label="Retail">
                                	<option value="http://www.safeway.apply2jobs.com/">Store Management</option>
									<option value="http://www.safeway.apply2jobs.com/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">Store Positions</option>	
                                </optgroup>
                                
                                <optgroup label="Pharmacy">
                                	<option value="http://www.safeway.apply2jobs.com/">Pharmacy</option>
									<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">Pharmacy Technician (United States)</option>
                                    <option value="http://www.safeway.ca/sixframeset.asp?page=careers">Pharmacy Technician (Canada)</option>
                                </optgroup>
                                
                                <optgroup label="Distribution">
                                	<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Management</option>
                                	<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">General Warehouse</option>
                                    <option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Office Support</option>
                                </optgroup>
                                <optgroup label="Manufacturing">
                                	<option value="https://www.safeway.apply2jobs.com/ProfExt/index.cfm?fuseaction=mExternal.showSearchInterface">Management</option>
                                	<option value="https://www.safeway.apply2jobs.com/HVExt/index.cfm?fuseaction=mHVExternal.showMinimumAgeSelection">General Warehouse</option>
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
                        
			    </div> <!-- .headright_search2 -->
			</div> <!-- .headright -->
		</div> <!-- .header_box -->
	</div> <!-- .header_bg -->
	<div class="mid_bg">
		<div class="mid_box">
			<div class="mid_box_lft">
				<div class="midbox_lft_top">
					<div class="midbox_lft_larree_rt"></div>
					<div class="midbox_lft_larree_lft">
						<div class="quote"></div>
						<div class="quote_txt">
							I started over 30 years ago as a part time clerk at Safeway. My career is proof of the opportunities we have to offer.
						</div>
						<div class="unquote"></div>
						<div class="larree">
							<div class="larree_sign">Larree Renda</div>
              <div class="larree_title">Executive Vice President, Safeway Inc. / President, Safeway Health, Inc.</div>
							<div class="clear"></div>
						</div> <!-- .larree -->
					</div> <!-- .midbox_lft_larree_rt -->
				</div> <!-- .midbox_lft_larree_lft -->
	    </div> <!-- .mid_box_lft -->
	    <div class="mid_box_rt">
				<div class="midbox_rt_top">
					<div class="midbox_rt_top_txt">Find us on:</div>
						<a href="http://www.linkedin.com" target="blank"><img src="<?php bloginfo('template_directory'); ?>/res/but_inkedin.gif" border="0" alt="" /></a>
						<a href="http://www.twitter.com" target="blank"><img src="<?php bloginfo('template_directory'); ?>/res/but_twitter.gif" border="0" alt="" /></a>
						<a href="http://www.facebook.com" target="blank"><img src="<?php bloginfo('template_directory'); ?>/res/but_facebook.gif" border="0" alt="" /></a>
					</div> <!-- .midbox_rt_top -->
	        <div class="midbox_rt_bottom">
						<div class="midbox_rt_bottom_lft">
							<img src="<?php bloginfo('template_directory'); ?>/res/pic_rotate_store.gif" border="0" alt="" />
						</div> <!-- mixbox_rt_bottom_lft -->
            
	        </div> <!-- .midbox_rt_bottom -->
		    </div> <!-- .midbox_rt -->
				<div class="clear"></div>
				<div id="midbox_lower">
					<a href="why-work-for-us"><img src="<?php bloginfo('template_directory'); ?>/res/specialbutton1.jpg" border="0" alt="" /></a>
					<a href="college-programs"><img src="<?php bloginfo('template_directory'); ?>/res/specialbutton2.jpg" border="0" alt="" /></a>
					<a href="military"><img src="<?php bloginfo('template_directory'); ?>/res/specialbutton3.jpg" border="0" alt="" /></a>
						<img src="<?php bloginfo('template_directory'); ?>/res/recognition.jpg" border="0" alt="" />
					
				</div> <!-- #midbox_lower -->
				
				<div class="clear"></div>
			</div> <!-- .mid_box -->
		</div> <!-- .mid_bg -->
	<?php get_footer(); ?>
	
	
