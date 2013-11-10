<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registration &middot; MagicTT</title>

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
              <a class="navbar-brand" href="/"><img src="<?php echo UI_PATH; ?>/img/logo.png" title="Magic Tours and Travels" height="20" /> Magic Tours</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/tour">Packages</a></li>
                <li><a href="#trendy-package">Trendy Packages</a></li>
                <li><a href="#popula-packages">Popular packages</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
		
		<div class="container">
			<form role="form">
				<fieldset>
					<legend>Register</legend>
					
					<div class="form-group">
						<label for="_firstName">First Name</label>
						<input type="text" name="firstName" id="_firstName" placeholder="First Name" class="form-control" />
					</div>
					
					<div class="form-group">
						<label for="_lastName">Last Name</label>
						<input type="text" name="lastName" id="_lastName" placeholder="Last Name" class="form-control" />
					</div>
					
					<div class="form-group">
						<label for="_email">Email</label>
						<input type="email" name="email" id="_email" placeholder="Email" class="form-control" />
					</div>
					
					<div class="form-group">
						<label for="_password">Password</label>
						<input type="password" name="password" id="_password" placeholder="Password" class="form-control" />
					</div>
					
					<div class="form-group">
						<label for="_gender">Gender</label>
						<select class="form-control" name="gender" id="_gender">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="_dob">Date Of Birth</label>
						<input type="date" name="dob" id="_dob" placeholder="Date of Birth (DD-MM-YYYY)" class="form-control" />
					</div>
					
					<button class="btn btn-inverse">Register!</button>
				</fieldset>
			</form>
		</div>

      <!-- FOOTER -->
    <div class="container footer-container">
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?php echo date('Y'); ?> MagicTT, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo UI_PATH; ?>/js/bootstrap.min.js"></script>
    <script data-main="<?php echo UI_PATH; ?>/js/app.js" src="<?php echo UI_PATH; ?>/js/require.js"></script>
  </body>
</html>
