<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url('application/assets/mstyle.css');?>">
<link
	href="<?php echo base_url('application/assets/jquery.mCustomScrollbar.css'); ?>"
	rel="stylesheet" type="text/css" />
<script
	src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src=<?php echo base_url('application/assets/categories.js');?>></script>
</head>
<body>
  <div class="jumbotron"
  	style="width: 40%; height: 40%; overflow: auto; margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0; padding-top: 20px;">
  	<h2>Indoor Navigation App</h2>
  	<h1>Login!</h1>
  	<form action="<?php echo base_url("index.php/main/login")?>" method="post">
    	<div class="input-group input-group-lg" style="margin:10px;">
    		<span class="input-group-addon glyphicon glyphicon-user" style="margin-bottom: 1px;"></span>
    		<input type="text" class="form-control" id="login_username" name="login_username" placeholder="Username">
    	</div>
    	<div class="input-group input-group-lg" style="margin:10px;">
      		<span class="input-group-addon glyphicon glyphicon-barcode"></span>
      		<input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
    	</div>
    		<p><input type="submit" class="btn btn-primary btn-lg" role="button" value="Login"/></p>
    	
  	</form>
  </div>
  <?php if(isset($error)) { ?>
    <div class="alert alert-danger">
        <strong>Oh Snap!</strong>&nbsp;<?php echo $error[0]; ?>
      </div>
   <?php } ?>
</body>
</html>
