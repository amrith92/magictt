<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MagicTT</title>

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
              <a class="navbar-brand" href="#"><img src="<?php echo UI_PATH; ?>/img/logo.png" title="Magic Tours and Travels" height="20" /> Magic</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">Packages</a></li>
                <li><a href="#contact">Personalised Packages</a></li>
                <li><a href="#trendy-package">Trendy Packages</a></li>
                <li><a href="#popula-packages">Popular packages</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>

		<div class="container">
		  <div class="jumbotron main-feature">
		  	<h1>Looking for your next destination?</h1>
		  	<h2>We&apos;ll find you the <em>right</em> one!</h2>
			</div>
		</div>
		
		<div class="container">
			<div class="get-started">
				<div class="get-started-content">
					<h3>&raquo; Start Now!</h3>
					
					<div class="question-box">
						<div>
							How <strike>old</strike> <em>young</em> are you?
							<input type="number" id="age" min="18">
						</div>
					</div>
					
					<div class="question-box hidden">
						<div>
							Married (<em>almost</em> ;) )?
							<select id="marital-status">
								<option value="No">No</option>
								<option value="Yes">Yes</option>
							</select>
						</div>
					</div>
					
					<div class="question-box hidden">
						<div>
							Have any rugrats?
							<select id="kids">
								<option value="No">No</option>
								<option value="Yes">Yes</option>
							</select>
						</div>
					</div>
					
					<div class="imaginary next-btn">
						<button class="btn btn-warning" id="next-step" data-step="age"><strong>Next!</strong></button>
					</div>
				</div>
			</div>
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
