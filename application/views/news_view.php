<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url('application/assets/mstyle.css');?>">
	<link rel="stylesheet"
	href="<?php echo base_url('application/assets/datepicker.css');?>">
<script
	src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript"
	src=<?php echo base_url('application/assets/header.js');?>></script>
	<script
	src="<?php echo base_url('application/assets/bootstrap-datepicker.js'); ?>"></script>
<script
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src=<?php echo base_url('application/assets/news.js');?>></script>
</head>
<body>
  <input type="hidden" id="navlink_sel" value="<?php echo $navlink; ?>" />
  <div id="wrapper"><?php include 'header.php'; ?>
    <div id="content">
      <div id="main_container">
        <div id="news_list_container" style="float: left; width: 30%;">
          <ul class="list-group" id="news_container">
          <?php for($i = 0; $i < count($news); $i++) {?>
          	<li id="row<?php echo $i; ?>" class="list-group-item">
          		<span><?php echo $news[$i]['title']; ?></span>
          		<input type="hidden" id="details<?php echo $i; ?>"
		value="{'id':'<?php echo $news[$i]['id'];?>','image':'<?php echo $news[$i]['image_url']; ?>', 'title':'<?php echo $news[$i]['title']; ?>', 'description':'<?php echo $news[$i]['description']; ?>', 'date':'<?php echo $news[$i]['date']; ?>', 'type':'<?php echo $news[$i]['type']; ?>'}" />
          	</li>
          	<?php } ?>
          </ul>
        </div>
        <div id="category_details_container" style="float: left; width: 50%;">
        
          <form id="news_form" action="<?php echo base_url('index.php/main/editnews')?>" method="post">
          
            <div class="panel panel-default">
              <div class="panel-heading">News Details</div>
              <div class="panel-body">
              
              	<span id="label_title"><b>Title:&nbsp;</b></span><span id="det_title"></span><br/>
              	<div class="input-group input-group-lg">
                	<span id="details_edit_title_label" class="input-group-addon">Title</span>
                	<input type="text" id="details_edit_title" name="details_edit_title" class="form-control input-lg" />
              	</div>
              	
              	<span id="label_date"><b>Date:&nbsp;</b></span><span id="det_date"></span><br/>
  													<div class="input-group input-group-lg input-append date">
                	<span id="details_edit_title_label" class="input-group-addon glyphicon glyphicon-calendar"></span>
                	<input type="text" id="details_edit_date" name="details_edit_date" class="form-control input-lg" />
              	</div>	
  														
              	<span id="label_type"><b>Type:&nbsp;</b></span><span id="det_type"></span><br/>
              	<div class="input-group input-group-lg">
                	<span id="details_edit_type_label" class="input-group-addon">Type</span>
                 <select id="details_edit_type" name="details_edit_type" class="form-control">
                 		<option value="unspecified"></option>
                  	<option value="Info">Info</option>
                  	<option value="Discount">Discount</option>
                  	<option value="Event">Event</option>
                 </select>
              	</div>
              	
              	<input type="hidden" id="det_id" name="det_id" />
              	
              </div>
          </div>
          
         <div class="panel panel-default">
          <div class="panel-heading">News Info</div>
          <div class="panel-body">
          
            <div class="well">
            	<img src="" id="details_image" />
            	<div class="input-group input-group-lg">
              	<span id="details_edit_image_label" class="input-group-addon">Image url</span>
              	<input type="text" id="details_edit_image" name="details_edit_image" class="form-control input-lg" />
            	</div>
            	
            	<br/><span id="label_description"><b>Description:&nbsp;</b></span><span id="det_description"></span><br/>
  												<div class="input-group input-group-lg input-append date">
              	<span id="details_edit_title_label" class="input-group-addon">Description</span>
              	<input type="text" id="details_edit_description" name="details_edit_description" class="form-control input-lg" />
            	</div>	
         	  </div>
          
          </div>
    				</div>
    				</form>
      </div>
      <div style="float: left; width: 20%;"><?php include 'quick_actions_view.php'; ?></div>
    	<div style="clear: both;"></div>
    </div>
  </div>
    <div id="footer"><?php include 'footer.php';?></div>
    </div>
</body>
</html>
