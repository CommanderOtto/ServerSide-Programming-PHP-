<?php
	session_start(); 
	$_SESSION['timeout'] = time(); 
	
	require_once "app.php";
	require_once "dbconnect.php";
	
	$msg = "";	
	$Email = "ottonegron@hotmail.com";
	$Password = "Iloveprogramming123";
?>


<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title>Work Scout</title>

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/colors/green.css" id="colors">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>


<?php

$ConfirmationCode = "";
$CodeSuccess ="";
$CodeWarning ="";
$msg = "";
$count=0;

if (isset($_POST['login']))
	{
		
		$ConfirmationCode = trim($_POST['ConfirmationCode_Form']);
		$Email = trim($_POST['Email_Form']);
		$Password = trim($_POST['Password_Form']);
		
		$Email = mysqli_real_escape_string($con,$Email);
		$Password = mysqli_real_escape_string($con,$Password);
		
		
		if (!CodeValidation($ConfirmationCode))	
		{				
			$CodeWarning = '<p style="color:red;">Code is not valid. FAIL.</p>';
			
		}
		else
		{
			if (EmailSanitize($Email))	
			{     
					//$sql = "select count(*) as c from accounts where Email = '" . $Email. "' and Password = '".$Password. "'";

					//security measure 3: use stored procedures
					$sql = "Call SP_COUNT_USER('".$Email."','".$Password."',@count); select @count as c"; 		
					print $sql;

					//example of fetching the results from multiple queries
					//using multiple queries can reduce the round trip traffic to the database server				
					if (mysqli_multi_query($con,$sql))
					{
						do
    						{
   							 // Store first result set
   							 if ($result=mysqli_store_result($con)) {
      							// Fetch one and one row
      								while ($row=mysqli_fetch_row($result))
       							 {
       								 $count= $row[0];  //the second result is the count. It overwrites the first $count value.
       							 }
      							// Free result set
     							 mysqli_free_result($result);
      						}
    					}
 						 while (mysqli_next_result($con));
					}
					
					print "count is ".$count;
					
					//security measure 4: always use the actual value, don't use $count > 0
					if ($count == 1)
					{

						$sql = "Call SP_FIND_USER_ID('".$Email."', '".$Password."',@uid)";
			
						$result = mysqli_query($con, $sql) or die(mysqli_error($con)); //send the query to the database or quit if cannot connect
						$result = mysqli_query($con, "select @uid as id") or die(mysqli_error($con)); 
						$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
						$uid = $field->id;
				

						$_SESSION['uid'] = $uid;
						$_SESSION['email'] = $Email;
						
						
						print " User authenticated";
						Header ("Location:employerhome.php");

					}
					else $msg = "The information entered does not match with the records in our database.";


			}
			else $msg = "Please enter a valid email.";
				
		}
	}	
	
?>
	<div id="wrapper">


	<!-- Header
	================================================== -->
	<header class="sticky-header">
	<div class="container">
		<div class="sixteen columns">

			<!-- Logo -->
			<div id="logo">
				<h1><a href="index.html"><img src="images/logo.png" alt="Work Scout" /></a></h1>
			</div>

			<!-- Menu -->
			<nav id="navigation" class="menu">
				<ul id="responsive">

					<li><a href="index.html">Home</a>
						<ul>
							<li><a href="index.html">Home #1</a></li>
							<li><a href="index-2.html">Home #2</a></li>
							<li><a href="index-3.html">Home #3</a></li>
							<li><a href="index-4.html">Home #4</a></li>
							<li><a href="index-5.html">Home #5</a></li>
						</ul>
					</li>

					<li><a href="#">Pages</a>
						<ul>
							<li><a href="job-page.html">Job Page</a></li>
							<li><a href="job-page-alt.html">Job Page Alternative</a></li>
							<li><a href="resume-page.html">Resume Page</a></li>
							<li><a href="shortcodes.html">Shortcodes</a></li>
							<li><a href="icons.html">Icons</a></li>
							<li><a href="pricing-tables.html">Pricing Tables</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</li>

					<li><a href="#">For Candidates</a>
						<ul>
							<li><a href="browse-jobs.html">Browse Jobs</a></li>
							<li><a href="browse-categories.html">Browse Categories</a></li>
							<li><a href="add-resume.html">Add Resume</a></li>
							<li><a href="manage-resumes.html">Manage Resumes</a></li>
							<li><a href="job-alerts.html">Job Alerts</a></li>
						</ul>
					</li>

					<li><a href="#">For Employers</a>
						<ul>
							<li><a href="add-job.html">Add Job</a></li>
							<li><a href="manage-jobs.html">Manage Jobs</a></li>
							<li><a href="manage-applications.html">Manage Applications</a></li>
							<li><a href="browse-resumes.html">Browse Resumes</a></li>
						</ul>
					</li>

					<li><a href="blog.html">Blog</a></li>
				</ul>


				<ul class="responsive float-right">
					<li><a href="my-account.html#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
					<li><a href="my-account.html"><i class="fa fa-lock"></i> Log In</a></li>
				</ul>

			</nav>

			<!-- Navigation -->
			<div id="mobile-navigation">
				<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
			</div>

		</div>
	</div>
	</header>
	<div class="clearfix"></div>


	<!-- Titlebar
	================================================== -->
	<div id="titlebar" class="single">
		<div class="container">

			<div class="sixteen columns">
				<h2>My Account</h2>
				<nav id="breadcrumbs">
					<ul>
						<li>You are here:</li>
						<li><a href="#">Home</a></li>
						<li>My Account</li>
					</ul>
				</nav>
			</div>

		</div>
	</div>


	<!-- Content
	================================================== -->

	<!-- Container -->
	<div class="container">

		<div class="my-account">

			<ul class="tabs-nav">
				<li class=""><a href="http://corsair.cs.iupui.edu:20191/lab4/activation.php">Login</a></li>
			</ul>
			

			<div class="tabs-container">
				<!-- Login -->
				<!-- remember to add different form names for login -->
				<div class="tab-content" id="tab1"">
					<form action="activation.php" method="post" class="login">
<?php
				print <<<HERE
						
						$CodeWarning
						$CodeSuccess

HERE;
?>

						<p class="form-row form-row-wide">
							<label for="Email_Form">Email:
								<i class="ln ln-icon-Male"></i>
								<input type="text" class="input-text" name="Email_Form" id="Email_Form" value="" />
							</label>
						</p>

						<p class="form-row form-row-wide">
							<label for="password">Password:
								<i class="ln ln-icon-Lock-2"></i>
								<input class="input-text" type="password" name="Password_Form" id="Password_Form"/>
							</label>
						</p>
						<p class="form-row form-row-wide">
							<label for="password">Activation Code:
								<i class="ln ln-icon-Lock-2"></i>
								<input class="input-text" type="text" name="ConfirmationCode_Form" id="ConfirmationCode_Form"/>
							</label>
						</p>

						<p class="form-row">
							<input type="submit" class="button border fw margin-top-10" name="login" value="Login" />

							<label for="rememberme" class="rememberme">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
						</p>

						
					</form>
				</div>

			</div>
		</div>
	</div>


	<!-- Footer
	================================================== -->
	<div class="margin-top-30"></div>

	<div id="footer">
		<!-- Main -->
		<div class="container">

			<div class="seven columns">
				<h4>About</h4>
				<p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
				<a href="#" class="button">Get Started</a>
			</div>

			<div class="three columns">
				<h4>Company</h4>
				<ul class="footer-links">
					<li><a href="#">About Us</a></li>
					<li><a href="#">Careers</a></li>
					<li><a href="#">Our Blog</a></li>
					<li><a href="#">Terms of Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Hiring Hub</a></li>
				</ul>
			</div>
			
			<div class="three columns">
				<h4>Press</h4>
				<ul class="footer-links">
					<li><a href="#">In the News</a></li>
					<li><a href="#">Press Releases</a></li>
					<li><a href="#">Awards</a></li>
					<li><a href="#">Testimonials</a></li>
					<li><a href="#">Timeline</a></li>
				</ul>
			</div>		

			<div class="three columns">
				<h4>Browse</h4>
				<ul class="footer-links">
					<li><a href="#">Freelancers by Category</a></li>
					<li><a href="#">Freelancers in USA</a></li>
					<li><a href="#">Freelancers in UK</a></li>
					<li><a href="#">Freelancers in Canada</a></li>
					<li><a href="#">Freelancers in Australia</a></li>
					<li><a href="#">Find Jobs</a></li>

				</ul>
			</div>

		</div>

		<!-- Bottom -->
		<div class="container">
			<div class="footer-bottom">
				<div class="sixteen columns">
					<h4>Follow Us</h4>
					<ul class="social-icons">
						<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
						<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
						<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
						<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
					</ul>
					<div class="copyrights">©  Copyright 2015 by <a href="#">Work Scout</a>. All Rights Reserved.</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Back To Top Button -->
	<div id="backtotop"><a href="#"></a></div>

	</div>
	<!-- Wrapper / End -->


	<!-- Scripts
	================================================== -->
	<script src="scripts/jquery-2.1.3.min.js"></script>
	<script src="scripts/custom.js"></script>
	<script src="scripts/jquery.superfish.js"></script>
	<script src="scripts/jquery.themepunch.tools.min.js"></script>
	<script src="scripts/jquery.themepunch.revolution.min.js"></script>
	<script src="scripts/jquery.themepunch.showbizpro.min.js"></script>
	<script src="scripts/jquery.flexslider-min.js"></script>
	<script src="scripts/chosen.jquery.min.js"></script>
	<script src="scripts/jquery.magnific-popup.min.js"></script>
	<script src="scripts/waypoints.min.js"></script>
	<script src="scripts/jquery.counterup.min.js"></script>
	<script src="scripts/jquery.jpanelmenu.js"></script>
	<script src="scripts/stacktable.js"></script>
	<script src="scripts/headroom.min.js"></script>



	<!-- Style Switcher
	================================================== -->
	<script src="scripts/switcher.js"></script>

	<div id="style-switcher">
		<h2>Style Switcher <a href="#"></a></h2>
		
		<div>
			<h3>Predefined Colors</h3>
			<ul class="colors" id="color1">
				<li><a href="#" class="green" title="Green"></a></li>
				<li><a href="#" class="blue" title="Blue"></a></li>
				<li><a href="#" class="orange" title="Orange"></a></li>
				<li><a href="#" class="navy" title="Navy"></a></li>
				<li><a href="#" class="yellow" title="Yellow"></a></li>
				<li><a href="#" class="peach" title="Peach"></a></li>
				<li><a href="#" class="beige" title="Beige"></a></li>
				<li><a href="#" class="purple" title="Purple"></a></li>
				<li><a href="#" class="celadon" title="Celadon"></a></li>
				<li><a href="#" class="pink" title="Pink"></a></li>
				<li><a href="#" class="red" title="Red"></a></li>
				<li><a href="#" class="brown" title="Brown"></a></li>
				<li><a href="#" class="cherry" title="Cherry"></a></li>
				<li><a href="#" class="cyan" title="Cyan"></a></li>
				<li><a href="#" class="gray" title="Gray"></a></li>
				<li><a href="#" class="olive" title="Olive"></a></li>
			</ul>
			
			<h3>Layout Style</h3>
			<div class="layout-style">
				<select id="layout-style"> 
					<option value="2">Wide</option>
					<option value="1">Boxed</option>
				</select>
			</div>
				
			<h3>Header Style</h3>
			<div class="layout-style">
				<select id="header-style"> 
					<option value="1">Style 1</option>
					<option value="2">Style 2</option>
					<option value="3">Style 3</option>
				</select>
			</div>
		
			<h3>Background Image</h3>
			<ul class="colors bg" id="bg">
				<li><a href="#" class="bg1"></a></li>
				<li><a href="#" class="bg2"></a></li>
				<li><a href="#" class="bg3"></a></li>
				<li><a href="#" class="bg4"></a></li>
				<li><a href="#" class="bg5"></a></li>
				<li><a href="#" class="bg6"></a></li>
				<li><a href="#" class="bg7"></a></li>
				<li><a href="#" class="bg8"></a></li>
				<li><a href="#" class="bg9"></a></li>
				<li><a href="#" class="bg10"></a></li>
				<li><a href="#" class="bg11"></a></li>
				<li><a href="#" class="bg12"></a></li>
				<li><a href="#" class="bg13"></a></li>
				<li><a href="#" class="bg14"></a></li>
				<li><a href="#" class="bg15"></a></li>
				<li><a href="#" class="bg16"></a></li>
			</ul>
			
			<h3>Background Color</h3>
			<ul class="colors bgsolid" id="bgsolid">
				<li><a href="#" class="green-bg" title="Green"></a></li>
				<li><a href="#" class="blue-bg" title="Blue"></a></li>
				<li><a href="#" class="orange-bg" title="Orange"></a></li>
				<li><a href="#" class="navy-bg" title="Navy"></a></li>
				<li><a href="#" class="yellow-bg" title="Yellow"></a></li>
				<li><a href="#" class="peach-bg" title="Peach"></a></li>
				<li><a href="#" class="beige-bg" title="Beige"></a></li>
				<li><a href="#" class="purple-bg" title="Purple"></a></li>
				<li><a href="#" class="red-bg" title="Red"></a></li>
				<li><a href="#" class="pink-bg" title="Pink"></a></li>
				<li><a href="#" class="celadon-bg" title="Celadon"></a></li>
				<li><a href="#" class="brown-bg" title="Brown"></a></li>
				<li><a href="#" class="cherry-bg" title="Cherry"></a></li>
				<li><a href="#" class="cyan-bg" title="Cyan"></a></li>
				<li><a href="#" class="gray-bg" title="Gray"></a></li>
				<li><a href="#" class="olive-bg" title="Olive"></a></li>
			</ul>
		</div>
		
		<div id="reset"><a href="#" class="button color">Reset</a></div>
			
	</div>


</body>

</html>