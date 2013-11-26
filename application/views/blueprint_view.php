<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?php echo base_url('application/assets/jquery.mCustomScrollbar.css'); ?>" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src=<?php echo base_url('application/assets/blueprint.js');?>></script>
</head>
<body>
	<input type="hidden" id="floor_info" value="<?php echo $id; ?>"/>
	<img id="blueprint_img" style="position: relative; top: 0px; left:0px;" src="<?php $url = 'uploads/'.$blueprint_map_url; echo base_url($url); ?>"/>
 <canvas id="blueprint_map" width="200" height="100" style="border:1px solid #000000;"></canvas>
</body>
</html>