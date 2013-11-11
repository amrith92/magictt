<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Authenticate &middot; MagicTT</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo UI_PATH; ?>/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <link href="<?php echo UI_PATH; ?>/css/main.css" rel="stylesheet" />
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">Magic Tours</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right">
                <li><a href="/tour">Packages</a></li>
                <li><a href="#trendy-package">Trendy Packages</a></li>
                <li><a href="#popula-packages">Popular packages</a></li>
              </ul>
              <?php if ($session->isLoggedIn()) { ?>
              <ul class="nav navbar-nav pull-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->getFullName(); ?> <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">History</a></li>
										<li class="divider"></li>
										<li><a href="/auth/logout">Logout</a></li>
									</ul>
								</li>
							</ul>
							<?php } ?>
            </div>
          </div>
        </div>

      </div>
    </div>
    
    <div class="container">
    	<ol class="breadcrumb">
    		<li><a href="/">Home</a></li>
    		<li><a href="/tour">Packages</a></li>
    		<li><a href="/tour/show/<?php echo $tour->getId(); ?>"><?php echo $tour->getName(); ?></a></li>
    		<li><a href="#">Login or Register</a></li>
    	</ol>
    </div>
		
		<div class="container auth-feature">
			<h1>Hang On!</h1>
			
			<p>
				You&apos;ll have to register or login before continuing. Reap
				the benefits of our membership. Get magicked today!
			</p>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="auth-box">
						<h4>Already a member?</h4>
					
						<p>
							Please login using the form below.
						</p>
						
						<form role="form" action="/auth/login" method="POST" class="form-horizontal">
							<div class="form-group">
								<label for="_username" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" id="_username" name="username" placeholder="abc@xyz.com" class="form-control" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="_password" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" id="_password" name="password" placeholder="Password" class="form-control" />
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn">Login</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="auth-box">
						<h4>New Holidayer?</h4>
					
						<p>
							Give us a few details to get you started.
						</p>
						
						<form role="form" class="form-horizontal" action="/auth/register" method="POST">
							<div class="form-group">
								<label for="_name" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-5">
									<input type="text" id="_name" name="firstName" placeholder="First Name" class="form-control" />
								</div>
								<div class="col-sm-5">
									<input type="text" id="_lname" name="lastName" placeholder="Last Name" class="form-control" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="_email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" id="_email" name="email" placeholder="abc@xyz.com" class="form-control" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="_reg_password" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" id="_reg_password" name="regpassword" placeholder="Password" class="form-control" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="_dob" class="col-sm-2 control-label">Date Of Birth</label>
								<div class="col-sm-10">
									<input type="date" id="_dob" name="dob" placeholder="DD-MM-YYYY" class="form-control" />
								</div>
							</div>
							
							<div class="form-group">
								<label for="_gender" class="col-sm-2 control-label">Gender</label>
								<div class="col-sm-10">
									<select class="form-control" name="gender" id="_gender">
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-warning">Register</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

      <!-- FOOTER -->
    <div class="container footer-container">
      <footer>
      	<div class="row">
        	<div class="col-md-3">
        		<p>&copy; <?php echo date('Y'); ?> MagicTT, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      		</div>
      		<div class="col-md-6">
      			<img src="<?php echo UI_PATH; ?>/img/logo.png" title="Magic Tours and Travels" />
      		</div>
      		<div class="col-md-3">
        		<p class="pull-right"><a href="#">Back to top</a></p>
        	</div>
    		</div>
      </footer>

    </div><!-- /.container -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo UI_PATH; ?>/js/bootstrap.min.js"></script>
    <script data-main="<?php echo UI_PATH; ?>/js/app.js" src="<?php echo UI_PATH; ?>/js/require.js"></script>
  </body>
</html>
