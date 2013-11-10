<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book <?php echo $tour->getName(); ?> &middot; Tours &middot; MagicTT</title>

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
              <a class="navbar-brand" href="#"><img src="<?php echo UI_PATH; ?>/img/logo.png" title="Magic Tours and Travels" height="20" /> Magic Tours</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav pull-right">
                <li><a href="/">Home</a></li>
                <li class="active"><a href="#about">Packages</a></li>
                <li><a href="#trendy-package">Trendy Packages</a></li>
                <li><a href="#popula-packages">Popular packages</a></li>
              </ul>
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
    		<li><a href="#">Booking</a></li>
    	</ol>
    </div>
    
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
					<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" src="<?php echo $tour->getPicture(); ?>" alt="<?php echo $tour->getName(); ?>" width="64" height="64" />
						</a>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $tour->getName(); ?></h4>
							
							<p>
								<?php echo $tour->getDescription(); ?>
							</p>
						</div>
					</div>
		  	</div>
    	</div>
    	<form role="form" class="booking-form" action="/booking/process" method="POST">
    		<input type="hidden" name="tourId" value="<?php echo $tour->getId(); ?>">
    		<div class="form-group">
    			<label for="_journeyDate">When do you want to go?</label>
    			<input type="date" name="journeyDate" id="_journeyDate" class="form-control" placeholder="DD-MM-YYYY" />
    		</div>
    		
    		<fieldset>
    			<legend>Ticketing</legend>
    			<div id="tickets">
						<div class="row">
							<div class="col-xs-4">
								<label for="_ticket_name">Full Name</label>
								<input type="text" name="ticket_name[]" id="_ticket_name" class="form-control" placeholder="Full Name" />
							</div>
							<div class="col-xs-3">
								<label for="_ticket_dob">Date Of Birth</label>
								<input type="date" name="ticket_dob[]" id="_ticket_dob" class="form-control" placeholder="Date Of Birth (DD-MM-YYYY)" />
							</div>
							<div class="col-xs-4">
								<label for="_ticket_gender">Gender</label>
								<select class="form-control" name="ticket_gender[]" id="_ticket_gender">
									<option value="Female">Female</option>
									<option value="Male">Male</option>
								</select>
							</div>
							<div class="col-xs-1">
								<a class="btn btn-primary" id="add-button" role="button" href="#add">+</a>
							</div>
						</div>
    			</div>
    		</fieldset>
	    	
	    	<br />
	    	<button type="submit" class="btn btn-warning">Book</button>
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
    <script data-main="<?php echo UI_PATH; ?>/js/booking-app.js" src="<?php echo UI_PATH; ?>/js/require.js"></script>
  </body>
</html>
