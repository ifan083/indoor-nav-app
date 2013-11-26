<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet"
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url('application/assets/mstyle.css');?>">
<script
	src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src=<?php echo base_url('application/assets/shops.js');?>></script>
</head>
<body>
<input type="hidden" id="navlink_sel" value="<?php echo $navlink; ?>" />
<div id="wrapper">
<?php include 'header.php'; ?>
	<div id="content">
		
  <div id="main_container">
    <div id="list_container" style="float: left; width: 30%;" >
    <input type="text" id="find_shops_auto" name="find_shops_auto" class="form-control input-lg" placeholder="Start typing shop name" />
    <ul class="list-group" id="shop_list">
      <?php for($i = 0; $i<count($data); $i++) { ?>
    	<li id="row<?php echo $i; ?>" class="list-group-item">
      	<input id="logo<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["logo_url"]; ?>" />
      	<span id="name<?php echo $i; ?>"><?php echo $data[$i]["name"]; ?></span>
      	<input id="picture<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["picture_url"]?>" / >
      	<input id="id<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["id"]; ?>" />
      	<input id="floor<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["floor"]; ?>" />
      	<input id="description<?php echo $i;?>" type="hidden" value="<?php echo $data[$i]["description"]; ?>" />
      	<input id="category<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["category_id"]; ?>" />
      	<input id="vertex<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["vertex_id"]; ?>"/>
      	<input id="workhrs<?php echo $i; ?>" type="hidden" value="<?php echo $data[$i]["working_hours"]; ?>" />
    	</li>
    <?php }?>
    </ul>
    </div>
    
    <div id="details_container" style="float: left; width: 70%;">
    
    <form id="edit_shops_form" action="<?php echo base_url("index.php/main/editshops"); ?>" method="post">
      
      <div id="parent_details_panel"> 
      
      <div class="panel panel-default" style="float: left; width: 50%;">
        <div class="panel-heading">
          <h3 class="panel-title">Shop details</h3>
        </div>
        <div class="panel-body">
        
          <div style="float: left;">
        		<img id="details_logo" />
        		<div class="input-group input-group-lg" style="padding-right: 10px; margin-bottom: 10px;">
          		<span id="details_edit_logo_label" class="input-group-addon" >Enter logo url</span>
          		<input type="text" id="details_edit_logo_url" name="details_edit_logo_url" class="form-control input-lg" />
        		</div>
        		 <div class="well" id="shop_name_cont">
            	<b><span id="details_name"></span></b>
            	<div class="input-group input-group-lg">
              	<span id="details_edit_name_label" class="input-group-addon">Shop name</span>
              	<input type="text" id="details_edit_name" name="details_edit_name" class="form-control input-lg" />
            	</div>
            </div>
          </div>
        
          <div style="float: left;">
            <div class="well">
            	<span id="details_label_category"><b>Category:&nbsp;</b></span><span id="details_category_id"></span>
            	<div class="input-group input-group-lg">
              	<span id="details_edit_category_id_label" style="width: 150px;" class="input-group-addon">Category</span>
                <select id="details_edit_cat_id" name="details_edit_cat_id" class="form-control">
                	<option value="cat0">UNSPECIFIED</option>
                  <?php for($i = 0; $i < count($categories); $i++) {?>
                  	<option value="cat<?php echo $categories[$i]['id']; ?>"><?php echo $categories[$i]['name']; ?></option>
                  <?php } ?>
                </select>
            	</div>
            
            	<span id="details_label_wrkhrs"><b>Working hours:&nbsp;</b></span><span id="details_working_hours"></span>
            	<div class="input-group input-group-lg">
              	<span id="details_edit_workhrs_label" style="width: 150px;" class="input-group-addon">Working hours</span>
              	<input type="text" id="details_edit_working_hours" name="details_edit_working_hours" class="form-control input-lg" placeholder="i.e. 09-23"/>
            	</div>	
            	
            	<span id="details_label_floor"><b>Floor:&nbsp;</b></span><span id="details_floor"></span>
            	<div class="input-group input-group-lg">
              	<span id="details_edit_floor_label" class="input-group-addon" style="width: 150px;">Floor</span>
              	<input type="text" id="details_edit_floor" name="details_edit_floor" class="form-control input-lg" />
            	</div>
            	
              <span id="details_label_vertex"><b>Vertex:&nbsp;</b></span><span id="details_vertex_id"></span>
            	<div class="input-group input-group-lg">
              	<span id="details_edit_vertex_id_label" class="input-group-addon" style="width: 150px;">Vertex id</span>
                <select id="details_edit_vertex_id" name="details_edit_vertex_id" class="form-control">
                	<option value="vert0">UNSPECIFIED</option>
                  <?php for($i = 0; $i < count($vertexes); $i++) {?>
                  	<option value="vert<?php echo $vertexes[$i]['id']; ?>"><?php echo $vertexes[$i]['name']; ?></option>
                  <?php } ?>
                </select>
            	</div>
            </div>
          </div>
      
        </div>
      </div>
      
      <div id="actions_container" style="float: right; width: 50%; padding-left: 10px; ">
      	<?php include 'quick_actions_view.php'; ?>
      </div>
      
      
      </div>
      
      <div style="clear: both;"></div>
      
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Shop info</h3>
        </div>
        <div class="panel-body">
      		<img id="details_picture" />
      		<div class="input-group input-group-lg">
        		<span id="details_edit_picture_label" class="input-group-addon">Enter image url</span>
        		<input type="text" id="details_edit_picture_url" name="details_edit_picture_url" class="form-control input-lg" />
      		</div>
        </div>
        
        <div class="well" style="margin: 10px;">
        	<span id="details_label_description"><b>Description:&nbsp;</b></span><span id="details_description"></span>
        	<div class="input-group input-group-lg">
          	<span id="details_edit_description_label" class="input-group-addon">Description</span>
          	<input type="text" id="details_edit_description" name="details_edit_description" class="form-control input-lg" />
        	</div>
        </div>
      </div>
      
      
      
      <input type="hidden" id="details_id" name="details_id"/>
      
      </form>
    </div>
    
    </div>
    <div style="clear: both;"></div>
	</div>
	<div id="footer">
		<?php include 'footer.php';?>
	</div>
</div>
</body>
</html>
