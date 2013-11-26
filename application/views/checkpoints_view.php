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
	src=<?php echo base_url('application/assets/checkpoints.js');?>></script>
</head>
<body>
<input type="hidden" id="navlink_sel" value="<?php echo $navlink; ?>" />
<div id="wrapper">
  <?php include 'header.php'; ?>
	<div id="content">
		<div id="main_container">
			<!--	handle upload errors	-->
		  <?php if(!empty($error)) { ?>
  			<div class="alert alert-danger alert-dismissable">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <strong>Failed to upload image!</strong> 
	            <?php foreach($error as $some_error) {
	              echo $some_error;
	            }?>
        	</div>
		  <?php } ?>
        <!-- Modal for adding floor -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Upload blueprint</h4>
              </div>
              <div class="modal-body">
               <?php 
                 $attributes = array('class' => 'email', 'id' => 'new_checkpoint_form');
                   echo form_open_multipart('main/uploadblueprint', $attributes);?>
    				<input type="file" id="userfile" name="userfile" size="20" />
    				<br />
    				<div id="form_name" class="input-group input-group-lg" style="padding-right: 10px; margin-bottom: 10px;">
                		<span id="floor_name_label" class="input-group-addon" >Enter floor name</span>
                		<input type="text" id="floor_name_edit" name="floor_name_edit" class="form-control input-lg" />
              		</div>
              		<div id="form_number" class="input-group input-group-lg" style="padding-right: 10px; margin-bottom: 10px;">
                		<span id="floor_number_label" class="input-group-addon" >Floor number</span>
                		<input type="text" id="floor_number_edit" name="floor_number_edit" class="form-control input-lg" />
              		</div>
				</form>
              </div>
              <div class="modal-footer">
                <button id="modal_btn_close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="upload_blueprint" type="submit" class="btn btn-primary" style="margin-bottom: 10px;" form="new_checkpoint_form">Save</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
		<div id="floor_area" style="float: left; width: 40%;"> <!--   -->   
     	<!-- Display available floors -->
     	<?php if(empty($floors)) { echo "<p>There are no floors entered yet!</p>"; } else { ?>
    		<select id="floors_selector" class="form-control">
    			<?php foreach ($floors as $floor) { ?>
						<option value="{'id':'<?php echo $floor['id']; ?>',
							'img_url':'<?php echo $floor['blueprint_map_url']; ?>',
							'floor':'<?php echo $floor['flooor_num']; ?>'}"><?php echo $floor['name']; ?></option>
            	<?php } ?>  
            </select> 			    
     	<?php } ?> 
     		
         <!--	Modal dialog -- add new image		-->
        <button id="add_new_floor" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Add new floor
          </button>
	      <div id="image_holder">
      		<img id="image_base" style="position: relative; top: 0px; left:0px;" />
              <canvas id="image_map" width="200" height="100" style="border:1px solid #000000;">
					</canvas>
	      </div>
		</div>      
		<div id="vertex_area" style="float: right; width: 60%;">   
			<div id="vertex_info" style="width: 50%; float: left; padding-right: 10px;">
			
			  <ul class="nav nav-tabs" style="margin-bottom: 10px;">
				<li id="nav_vertex" class="active"><a>Vertexes</a></li>
				<li id="nav_edge"><a>Edges</a></li>
			  </ul>
			  
			  <div id="vertex_wrapper">
				  <button id="add_new_vertex" class="btn btn-primary btn-lg">
		            Add new vertex
		          </button>
		          <ul id="vertex_list"></ul>
			  </div>
			  <div id="edge_wrapper">
			  	<button id="add_new_edge" class="btn btn-primary btn-lg">
		            Add new edge
		          </button>
		          <ul id="edge_list"></ul>
			  </div>
	          
			</div>
			<div id="vertex_details" style="width: 50%; float: left">
				<div>
  				<button id="vert_edit" class="btn btn-primary btn-lg" style="width: 31%; margin-left: 0; float: left;">
              Edit
            </button>
            <button id="vert_save" class="btn btn-primary btn-lg" style="width: 31%; margin-left: 0; float: left;">
              Save
            </button>
            <button id="vert_cancel" class="btn btn-primary btn-lg" style="width: 31%; margin-left: 0; float: left;">
              Cancel
            </button>
          <div style="clear: both;"></div>
          </div>
				<div class="input-group input-group-lg" style="float: left; width: 50%; padding-right: 10px;">
            <span class="input-group-addon">X coordinate</span>
            <input type="text" id="vert_coord_x" name="vert_coord_x" class="form-control input-lg" disabled="disabled" />
          </div>
          <div class="input-group input-group-lg" style="float: left; width: 50%; padding-right: 10px;">
            <span class="input-group-addon">Y coordinate</span>
            <input type="text" id="vert_coord_y" name="vert_coord_y" class="form-control input-lg" disabled="disabled"/> 
          </div>
          <div style="clear: both;"></div>
          <div id="vertex_input">
            <input type="text" id="vert_name" name="vert_name" placeholder="Enter vertex name" class="form-control input-lg" />
            <input type="hidden" id="vert_id" name="vert_id" />
            </div>
            <div id="vertex_galery" style="margin-bottom: 10px; background-position: center center; background-repeat: no-repeat;" >
            </div>
            <div class="input-group input-group-lg" style="margin-bottom: 10px; margin-right: 10px;" id="vertex_img_input">
            <span class="input-group-addon">Image url</span>
            <input type="text" id="vert_img_url" name="vert_img_url" class="form-control input-lg" /> 
          </div>
          <div class="panel panel-default" style="margin-right: 10px;">
            <div class="panel-heading">
              <h3 class="panel-title">Shops near this vertex</h3>
            </div>
              <div class="panel-body">
                  <button id="add_new_shop" class="btn btn-primary btn-lg"
                  style="width: 200px;" data-toggle="modal" data-target="#myShopModal">Add
                  new shop</button>
                <ul id="vertex_shops"></ul>
            </div>
            </div>
	</div>
			<div style="clear: both;"></div>
		</div>
      	<div style="clear: both;"></div>
      	
		<!-- Modal for adding shop -->
      	<div class="modal fade" id="myShopModal" tabindex="-1" role="dialog" aria-labelledby="myModalShopLabel"  aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add shop</h4>
              </div>
              <div class="modal-body">
             		<input type="text" id="shop_finder_input" name="shop_finder_input" class="form-control input-lg" placeholder="Enter shop name" style="margin-bottom: 10px;" />
            		<ul id="add_shop_list"></ul>
            		<input type="hidden" id="new_shop_cache_id" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add_shop_btn" type="button" class="btn btn-primary" style="margin-bottom: 10px;">Add</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        
        <!-- Modal for same floor edge -->
      	<div class="modal fade" id="mySameFloorModal" tabindex="-1" role="dialog" aria-labelledby="myModalSameFloorLabel"  aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create SAME FLOOR edge</h4>
              </div>
              <div class="modal-body">
              	<div style="float: left; width: 50%;">
              		<b><span id="same_edge1"></span></b><br/>
	              	&nbsp;to&nbsp;<br/>
              		<b><span id="same_edge2"></span></b><br/>
              		<input type="hidden" id="hid_same_edge1" />
              		<input type="hidden" id="hid_same_edge2" />
              	</div>
			    <div class="input-group input-group-lg" style="padding: 10px;">
              		<span class="input-group-addon">Weight</span>
                	<select id="edgeWeightSame"  class="form-control">
                  		<option value="1">1</option>
                  		<option value="0">0</option>
	                </select>         		
              	</div>
				<div style="clear: both;"></div>
				<br/>
				</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="save_same_edge_btn" type="button" class="btn btn-primary" style="width: 120px; margin-bottom: 10px;">Save</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <button id="new_same_btn" class="btn btn-primary btn-lg" data-toggle="modal" style="visibility:hidden;"; data-target="#mySameFloorModal">invisible (same) btn</button>
        
        <!-- Modal for different floor edge -->
      	<div class="modal fade" id="myDiffFloorModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create DIFF FLOOR edge</h4>
              </div>
              <div class="modal-body">
	              <div style="float: left;">
	              		<b><span id="diff_edge1">scm_f1_entrance_south</span></b><br/>
		              	&nbsp;to&nbsp;<br/>
		              	<input type="hidden" id="hid_diff_edge1" />
		              	<input type="hidden" id="hid_diff_edge2" />
	              		<input type="text" id="vertex_finder_input" name="vertex_finder_input" class="form-control input-lg" 
	              			placeholder="Enter vertex name" style="margin-bottom: 10px;" />
	              	</div>
				    <div class="input-group input-group-lg" style="padding: 10px;">
	              		<span class="input-group-addon">Weight</span>
	                	<select id="edgeWeightDiff"  class="form-control">
	                  		<option value="0">0</option>
	                  		<option value="1">1</option>
		                </select>         		
	              	</div>
					<div style="clear: both;"></div>
					<br/>
					<ul id="list_other_floor_vertex" style="max-height: 60%;"></ul>
              </div>
              <div class="modal-footer">
                <button id="cancel_diff_edge" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="save_diff_edge_btn" disabled="disabled" type="button" class="btn btn-primary" style="width: 120px; margin-bottom: 10px;">Save</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <button id="new_diff_btn" class="btn btn-primary btn-lg" data-toggle="modal" style="visibility:hidden;"; data-target="#myDiffFloorModal">invisible (diff) btn</button>
	
	</div>
	<div id="footer">
		<?php include 'footer.php';?>
	</div>
</div>
</body>
</html>