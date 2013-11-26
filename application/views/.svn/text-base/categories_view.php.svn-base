<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url('application/assets/mstyle.css');?>">
<link href="<?php echo base_url('application/assets/jquery.mCustomScrollbar.css'); ?>" rel="stylesheet" type="text/css" />
<script
	src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src=<?php echo base_url('application/assets/categories.js');?>></script>
</head>
<body>
<input type="hidden" id="navlink_sel" value="<?php echo $navlink; ?>" />
<div id="wrapper">
  <?php include 'header.php'; ?>
	<div id="content">
		<div id="main_container">
			<div id="category_list_container" style="float: left; width: 30%;">
    		<ul id="category_container">
    			  <?php for($i = 0; $i<count($data); $i++) { ?>
          	<li id="row<?php echo $i; ?>" class="list-group-item">
            	<span id="name<?php echo $i; ?>"><?php echo $data[$i]["name"]; ?></span>
            	<input id="id<?php echo $i; ?>" value="<?php echo $data[$i]["id"]; ?>" type="hidden" />
          	</li>
        <?php }?>
    		</ul>
			</div>
			<div id="category_details_container" style="float: left; width: 50%;">
				<div class="panel panel-default">
        	<div class="panel-heading">
          	<h3 class="panel-title">Shops in this category</h3>
        	</div>
        	<div class="panel-body">
    				<form id="edit_category_form" method="post" action="<?php echo base_url('index.php/main/editcategories'); ?>">
      				<input type="text" id="cat_name" name="cat_name" placeholder="Enter category name" class="form-control input-lg" />
      				<input type="hidden" id="cat_id" name="cat_id" /> 	
      				<ul id="selected_category_list" name="selected_category_list" >
      				</ul>
    				</form>
        	</div>
        </div>
			</div>
			<div style="float: left; width: 20%;">
			  <?php include 'quick_actions_view.php'; ?>
			</div>
		</div>
	
	</div>
	<div id="footer">
		<?php include 'footer.php';?>
	</div>
</div>
</body>
</html>