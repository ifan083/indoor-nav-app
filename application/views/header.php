<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Indoor Navigation App</a>
  </div>
		<script type="text/javascript">
    function deleteConfirmation(id) {
        if(confirm("Are you sure you want to delete the object?")) {
        				var navigation = $('#navlink_sel').val();
            var url = "http://localhost/xampp_intro/index.php/main/deleteObject/"+id+"/"+navigation;
            window.location.href = url;
        } else {
											alert("not ok");            
        }
  		}

			 function changeSelection(id) {
				 		var current_id = $('#current_obj_id').val();
				 		if(current_id != id) {
					 		 //change the session via AJAX call (on done reload page)
					 		 var name = $('button[value='+id+']').prev().text();
					 		 $.get("http://localhost/xampp_intro/index.php/main/updatesession/"+id+"/"+name,
							 		 function(data) {
						 		 		if(data === "OK") {
							 		 		var navigation = $('#navlink_sel').val();
													url = "http://localhost/xampp_intro/index.php/main/refresh/" + navigation;
													window.location.href = url;
							 		 	}
					 			});
					 	}
				}
		</script>
<!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
  		<input type="hidden" id="current_obj_id" value="<?php 
  		$obj = $this->session->userdata('current_obj');
  		  if(!empty($obj[0])) {
            echo $obj[0]['id'];
          } else {
            echo "0"; 
          }
  		?>">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php 
        $obj = $this->session->userdata('current_obj');
          if(!empty($obj[0])) {
            echo $obj[0]['name'];
          } else {
            echo "No object yet"; 
          }
        ?>&nbsp;<b class="caret"></b></a>
        <ul class="dropdown-menu">
        <?php for($i = 0; $i < count($objects); $i++) {?>
          <li onclick="changeSelection('<?php echo $objects[$i]['id']; ?>')">
          	<a style="display: block; float: left; padding-left: 5px;" href="#"><?php echo $objects[$i]['name']; ?></a>
          	<button onclick="deleteConfirmation('<?php echo $objects[$i]['id']; ?>')" 
          			 class="close pull-right" style="margin-right: 5px; margin-top: 5px;"
          			 value="<?php echo $objects[$i]['id']; ?>" 
          			aria-hidden="true">&times;</button>
          	<div style="clear: both;"></div>
          </li>
          <?php } ?>
          <li class="divider"></li>
          <li id="new_obj_add"><a href="#">Add new object</a></li>
        </ul>
       </li>
       <form id="new_obj_form" style="display: none;" class="navbar-form navbar-left" method="post" action="<?php echo base_url('index.php/main/newobj'); ?>">
        	<div class="form-group">
          	<input type="text" class="form-control" id="obj_name" name="obj_name" placeholder="Object name" />
        	</div>
        	<button type="submit" class="btn btn-success">Submit</button>
        	<button id="new_obj_cancel" type="button" class="btn btn-danger">Cancel</button>
    			</form>
      <li id="nav0" >
      	<a href="<?php echo base_url('index.php/main/news'); ?>">News</a>
      </li>
      <li id="nav1" >
      	<a href="<?php echo base_url('index.php/main/shops'); ?>">Shops</a>
      </li>
      <li id="nav2">
      	<a href="<?php echo base_url('index.php/main/categories'); ?>">Categories</a>
      </li>
      <li id="nav3">
      	<a href="<?php echo base_url('index.php/main/checkpoints'); ?>">Checkpoints</a>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>