<?php
	require_once "app.php";
	require_once "mail/mail.class.php";
	
	
	$code = randomCodeGenerator(50);
	$codeMessage = 'Your code is '.$code;
	$EmailBody = <<<HERE


	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Actionable emails e.g. reset password</title>
	<link href="css/styles.css" media="all" rel="stylesheet" type="text/css" />
	</head>

	<body itemscope itemtype="http://schema.org/EmailMessage">

	<table class="body-wrap">
		<tr>
			<td></td>
			<td class="container" width="600">
				<div class="content">
					<table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction">
						<tr>
							<td class="content-wrap">
								<meta itemprop="name" content="Confirm Email"/>
								<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<td class="content-block">
											Please confirm your email address by clicking the link below and entering your code.
											$codeMessage;
											
										</td>
									</tr>
									<tr>
										<td class="content-block">
											We may need to send you critical information about our service and it is important that we have an accurate email address.
										</td>
									</tr>
									<tr>
										<td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler">
											
												<a href= http://corsair.cs.iupui.edu:20191/lab4/activation.php class="btn-primary" itemprop="url">Confirm email address</a>
											
										</td>
									</tr>
									<tr>
										<td class="content-block">
											&mdash; Classifieds
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
			</td>
			<td></td>
		</tr>
	</table>

	</body>
	</html>
HERE;

?>