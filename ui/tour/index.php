<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tours &middot; MagicTT</title>

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
              <ul class="nav navbar-nav">
                <li class="active"><a href="#about">Packages</a></li>
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
    	<div class="row">
    	<?php
    		$count = \count($tours);
    		$ctr = 0;
    		
    		foreach ($tours as $tour) {
    	?>
    		<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img src="<?php echo $tour->getPicture(); ?>" alt="<?php echo $tour->getName(); ?>">
						<div class="caption">
						  <h3><?php echo $tour->getName(); ?></h3>
						  <p><?php echo $tour->getDescription(); ?></p>
						  <p><a href="/tour/show/<?php echo $tour->getId(); ?>" class="btn btn-primary" role="button">Find Out More!</a></p>
						</div>
					</div>
				</div>
			<?php
					++$ctr;
				
					if (0 == ($ctr % 3)) {
						echo '</div><div class="row">';
					}
				}
			?>
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
  </body>
</html>
