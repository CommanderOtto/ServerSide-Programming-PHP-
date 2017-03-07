<?php 
	session_start();
    $_SESSION['timeout'] = time();
	

	require_once "inc/sessionVerify.php";
	require_once "dbconnect.php";
	require_once "app.php";

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

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>

<?php 

	$JobTitle = "";
	$Salary = "";
	$City = "";
	$State = "";
	$Description = "";
	$CompanyName = "";
	$JobType = "";
	$sql = "";
	$msg = "";
	$result = "";

	if (isset($_POST['createjob']))
	{
		
		$JobTitle = trim($_POST['JobTitle_Form']);
		$Salary = trim($_POST['Salary_Form']);
		$City = trim($_POST['City_Form']);
		$State = trim($_POST['State_Form']);
		$Description = trim($_POST['Description_Form']);
		$CompanyName = trim($_POST['CompanyName_Form']);
		$JobType = trim($_POST['JobType_Form']);
		
		$JobTitle = mysqli_real_escape_string($con, $JobTitle);
		$Salary = mysqli_real_escape_string($con, $Salary);
		$City = mysqli_real_escape_string($con, $City);
		$State = mysqli_real_escape_string($con, $State);
		$Description = mysqli_real_escape_string($con, $Description);
		$CompanyName = mysqli_real_escape_string($con, $CompanyName);
		$JobType = mysqli_real_escape_string($con, $JobType);
		
		$sql = "Call SP_CREATE_JOB('".$JobTitle."','".$Salary."','".$City."','".$State."','".$Description."','".$CompanyName."','".$JobType."')";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con)); 
		
		if ($result) $msg = "<b>Your information is entered into the database. </b>";
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

				<li><a href="lab5.php">Home</a></li>
				<li><a href="employerhome.php">Employer Page</a></li>
			</ul>


			<ul class="responsive float-right">
				<li><a href="lab4.php"><i class="fa fa-user"></i> Log Out</a></li>
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
<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i> Add Job</h2>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div action="addjob.php" method="post" class="submit-page">
		
		<?php 
		
		print $msg;
		
		?>

			<form method="post">
				<!-- Title -->
				<div class="form">
					<h5>Job Title</h5>
					<input class="search-field" type="text" maxlength = "50" name="JobTitle_Form" id="JobTitle_Form"/>
				</div>
				
				<div class="form">
					<h5>Salary</h5>
					<input class="search-field" type="text" maxlength = "50" name="Salary_Form" id="Salary_Form"/>
				</div>
				
				<div class="form">
					<h5>City</h5>
					<input class="search-field" type="text" maxlength = "50" name="City_Form" id="City_Form"/>
				</div>
				
				<div class="form">
					<h5>State</h5>
					<input class="search-field" type="text" maxlength = "50" name="State_Form" id="State_Form"/>
				</div>
				
				<div class="form">
					<h5>Description</h5>
					<input class="search-field" type="text" maxlength = "50" name="Description_Form" id="Description_Form"/>
				</div>
	

				<!-- Job Type -->
				<div class="form">
					<h5>Job Type</h5>
					<select data-placeholder="Full-Time" class="chosen-select-no-single" name="JobType_Form" id="JobType_Form">
						<option value="Full-Time">Full-Time</option>
						<option value="Part-Time">Part-Time</option>
						<option value="Internship">Internship</option>
						<option value="Freelance">Freelance</option>
					</select>
				</div>
				
				<!-- Company Details -->
				<div class="divider"><h3>Company Details</h3></div>

				<!-- Company Name -->
				<div class="form">
					<h5>Company Name</h5>
					<input type="text" placeholder="Enter the name of the company" maxlength = "50" name="CompanyName_Form" id="CompanyName_Form">
				</div>

				<div class="divider margin-top-0"></div>
				<!--<a href="#" class="button big margin-top-5">Preview <i class="fa fa-arrow-circle-right"></i></a>-->
				<input type="submit"  name="createjob" class="submit" id="createjob" value="Add Job"/>
			</form>
		</div>
	</div>

</div>


<!-- Footer
================================================== -->
<div class="margin-top-60"></div>

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


<!-- WYSIWYG Editor -->
<script type="text/javascript" src="scripts/jquery.sceditor.bbcode.min.js"></script>
<script type="text/javascript" src="scripts/jquery.sceditor.js"></script>


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