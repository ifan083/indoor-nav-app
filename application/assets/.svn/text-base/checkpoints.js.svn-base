$(function() {
	
	var clickingOnCanvasEnabled = false;
	var vertexCanvasArray = null;
	var radius = 10;
	
	var edgeStart = null;
	var edgeEnd = null;
	var clickingForEdges = false;
	
	var totalWidth = window.innerWidth;
	totalWidth -= 100;
	totalWidth *= 0.3;
	totalWidth -= 10;
	var totalHeight = totalWidth * 0.66;
	
	//comment
	var canvas = $('#image_map');
	$('#vert_edit').attr('disabled', 'disabled');
	$('#vert_save').attr('disabled', 'disabled');
	$('#vert_cancel').attr('disabled', 'disabled');
	$('#vert_name').attr('disabled', 'disabled');
	
	$('#vertex_img_input').hide();
	$('#edge_wrapper').hide();
	
	$('#add_new_floor').click(function() {
		$('#upload_blueprint').attr('disabled', 'disabled');
	});

	// only allow entering of numeric values without leading zeros
	$('#floor_number_edit').keypress(function(e) {
		code = (e.keyCode ? e.keyCode : e.which);
		if (code < 48 || code > 57 || (code == 48 && $(this).val() == "")) {
			e.preventDefault();
		}
	});
	
	$('#add_new_edge').click(function () {
		//show info
		showEdgeInfo();
		
		//enable clicking
		clickingForEdges = true;
		
		//reset old edge ids
		redrawCheckpoints();
		edgeStart = null;
		edgeEnd = null;
	}); 
	
	function showEdgeInfo() {
		if(!$('#info_edge').is(':last-child')) {
			child = '<div id="info_edge" class="alert alert-info alert-dismissable" style="margin-top: 10px;">';
			child += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			child += '<strong>Click on two neighbor vertexes to add an edge OR double click to connect to another floor!</strong>'; 
			child += '</div>';
			$('#image_holder').append(child);
		}
	}
	
	function showNewVertexInfo() {
		if(!$('#info_vertex').is(':last-child')) {
			child = '<div id="info_vertex" class="alert alert-info alert-dismissable" style="margin-top: 10px;">';
			child += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			child += '<strong>Click the picture where you wish the checkpoint should be!</strong>'; 
			child += '</div>';
			$('#image_holder').append(child);
		}
	}
	
	$('#add_new_shop').attr('disabled', 'disabled');

	// update header
	$('#' + $('#navlink_sel').val()).addClass('active');

	$('#floor_number_edit, #floor_name_edit').keyup(function() {
		var hasError = false;

		var number = $('#floor_number_edit');
		var name = $('#floor_name_edit');

		if (number.val().length == 0) {
			$('#form_number').addClass('has-error'); 
			hasError = true;
		} else {
			$('#form_number').removeClass('has-error');
		}

		if (name.val().length == 0) {
			$('#form_name').addClass('has-error');
			hasError = true;
		} else {
			$('#form_name').removeClass('has-error');
		}

		if (hasError || $('#userfile').val() === '') {
			$('#upload_blueprint').attr('disabled', 'disabled');
		} else {
			$('#upload_blueprint').removeAttr('disabled');
		}

	});

	$('#userfile').on('change', function() {
		$('#floor_name_edit').trigger('keyup');
	});
	
	$('#floors_selector').change(function() {
		var obj = eval("(" + $(this).val() + ")");
		var screenImage = $("#image_base");
		screenImage.attr('src', 'http://localhost/xampp_intro/uploads/' + obj.img_url);
		
		screenImage.unbind("load").load(function() {
			// Create new offscreen image to test
			var theImage = new Image();
			theImage.src = screenImage.attr("src");
			
			// Get accurate measurements from that.
			var imageWidth = theImage.width;
			var imageHeight = theImage.height;
			
			canvas.attr('width', imageWidth);
			canvas.attr('height', imageHeight);
			
			var offset = $('#image_base').offset();
			canvas.css('position', 'absolute');
			canvas.css('top', offset.top + 'px');
			canvas.css('left', offset.left + 'px');
			canvas.css('z-index','1');
			
			//draw previosly added vertexes
			var floor = obj.id;
			refreshVertexes(floor);
		});
		
		//clear all details data
		resetDetailsFields();
		
		//disable edit / save / delete
		$('#vert_edit').attr('disabled', 'disabled');
		$('#vert_save').attr('disabled', 'disabled');
		$('#vert_cancel').attr('disabled', 'disabled');
	});
	
	$('#vert_cancel').click(function() {
		//toggle back
		$('#vert_name').attr('disabled', 'disabled');
		$('#vert_save').attr('disabled', 'disabled');
		clickingOnCanvasEnabled = false;
		$('#vertex_img_input').hide();
		$('#vertex_galery').show();
		$('button[id^=del_shop]').hide();
		$(this).attr('disabled', 'disabled');
		
		//make the selection again
		$('#vertex_list').children().first().trigger('click');
		
		// redraw
		resetVertexDrawingArray();
		redrawCheckpoints();
	});
	
	function resetVertexDrawingArray() {
		for ( var i = 0; i < vertexCanvasArray.length; i++) {
			vertexCanvasArray[i].editable = false;
		}
	}
	
	canvas
	.mouseup(function(e) {
		var x = e.pageX - this.offsetLeft;
		var y = e.pageY - this.offsetTop;
		var context = $(this).get(0).getContext("2d");
		
		if(clickingOnCanvasEnabled) {
			redrawCheckpoints();
			
			drawEmptyCheckpoint(x, y, context);
			
			$('#vert_coord_x').val(x);
			$('#vert_coord_y').val(y);
		} else if(clickingForEdges) {
			var selected = getSelectedVertexOnCanvasNoEdit(x, y);
			if(selected != null) {
				if(edgeStart == null) {
					edgeStart = selected;
					
					//redraw
					redrawCheckpoints();
					drawEdgeVertex(edgeStart, context);
				} else {
					edgeEnd = selected;
					
					//redraw
					redrawCheckpoints();
					drawEdgeVertex(edgeStart, context);
					drawEdgeVertex(edgeEnd, context);
					
					//maybe draw line
					drawEdgeLine(edgeStart, edgeEnd, context);
					
					//start modal
					if(edgeEnd.id == edgeStart.id) {
						startDiffFloorEdgeModal();
					} else {
						startSameFloorEdgeModal();
					}
				}
			}			
		}
	});
	
	function startDiffFloorEdgeModal() {
		//populate modal
		$('#diff_edge1').text(edgeEnd.name);
		$('#hid_diff_edge1').val(edgeEnd.id);
		
		$('#new_diff_btn').trigger('click');
	}
	
	$('#vertex_finder_input').keyup(function() {
		//get floor and partial
		var selectedObj = eval("("+ $('#floors_selector').find(":selected").val() + ")");
		var floor = selectedObj.id;
		
		var partial = $(this).val();
		
		//make ajax call
		$.getJSON("http://localhost/xampp_intro/index.php/main/vertexNotInFloorWithName/" + floor +"/" + partial,
		function(result) {
			if(result.length > 0) {
				$('#list_other_floor_vertex').empty();
				for(var i = 0; i < result.length; i++) {
					var obj = result[i];
					child = '<li class="list-group-item" id="other_diff' + i + '">';
					child += '<span id="name">' + obj.name + '</span>';
					child += '<input type="hidden" value="' + obj.id + '" />';
					child += '</li>';
					$('#list_other_floor_vertex').append(child);
				}
				
				$('li[id^=other_diff]').mousedown(function () {
					$('#save_diff_edge_btn').removeAttr('disabled');
					var diffEdge2Id = $(this).children().last().val();
					$('#hid_diff_edge2').val(diffEdge2Id);
					$(this).addClass('listitem_sel');
				});
				
				$('li[id^=other_diff]').hover(function () {
					if (!$(this).hasClass('listitem_sel')) {
						$(this).css('background-color', '#cccccc');
					}
				}, function() {
					$(this).removeAttr('style');
				});
			}
		});
	});
	
	$('#save_diff_edge_btn').click(function () {
		//get values
		var edge1 = $('#hid_diff_edge1').val();
		var edge2 = $('#hid_diff_edge2').val();
		var weight = $('#edgeWeightDiff option:selected').val();
				
		//disable selection of vertexes
		clickingForEdges = false;
		
		//make ajax call
		$.get("http://localhost/xampp_intro/index.php/main/addNewEdge/" + edge1 + "/" + edge2 + "/"+weight, function (result) {
			if(result === "OK") {
				var selectedObj = eval("("+ $('#floors_selector').find(":selected").val() + ")");
				var floor = selectedObj.floor;
				//refresh edges list
				getEdgesForFloor(floor);
				$('#myDiffFloorModal').modal('hide');
			} else {
				alert("Error while adding edge");
			}
		});
		
	});
	
	$('#save_same_edge_btn').click(function() {
		//get values
		var edge1 = $('#hid_same_edge1').val();
		var edge2 = $('#hid_same_edge2').val();
		var weight = $('#edgeWeightSame option:selected').val();
		
		//disable selection of vertexes
		clickingForEdges = false;
		
		//make ajax call
		$.get("http://localhost/xampp_intro/index.php/main/addNewEdge/" + edge1 + "/" + edge2 + "/" + weight, function (result) {
			if(result === "OK") {
				var selectedObj = eval("("+ $('#floors_selector').find(":selected").val() + ")");
				var floor = selectedObj.floor;
				getEdgesForFloor(floor);
				$('#mySameFloorModal').modal('hide');
			} else {
				alert("Error while adding edge");
			}
		});
	});
	
	function removeEdge(vert1Id, vert2Id) {
		$.get("http://localhost/xampp_intro/index.php/main/removeEdge/" + vert1Id + "/" + vert2Id, function(result) {
			if(result === "OK") {
				var selectedObj = eval("("+ $('#floors_selector').find(":selected").val() + ")");
				var floor = selectedObj.floor;
				// refresh edges
				getEdgesForFloor(floor);
				redrawCheckpoints();
			} else {
				alert("Error while removing edge");
			}
		});
	}
	
	function getEdgesForFloor(floor) {
		//make ajax call
		$.getJSON("http://localhost/xampp_intro/index.php/main/getAllEdgesForFloor/" + floor,function(result) {
			$('#edge_list').empty();
			if(result.length > 0) {
				for(var i = 0; i < result.length; i++) {
					var obj = result[i];
					child = '<li id="edge' + i + '" class="list-group-item" >';
					child += '<span>' + obj.vertex1_name + '&nbsp;&nbsp;<b><></b>&nbsp;&nbsp;' + obj.vertex2_name + '</span>';
					child += '<button id="del_edge' + i + '" type="button" class="close pull-right" aria-hidden="true">&times;</button>';
					child += '<input type="hidden" value="{\'vertex1_id\':\'' + obj.vertex1_id + '\',\'vertex2_id\':\'' + obj.vertex2_id + '\'}">';
					var vert1Str = JSON.stringify(getVertexById(obj.vertex1_id));
					child += '<input type="hidden" value="' + vert1Str.replace(/"/g,'\'') + '">';
					var vert2Str = JSON.stringify(getVertexById(obj.vertex2_id));
					child += '<input type="hidden" value="' + vert2Str.replace(/"/g,'\'') + '">';
					child += '</li>';
					$('#edge_list').append(child);
				}
			}
			
			$('button[id^=del_edge]').click(function () {
				var vertexes = eval("(" + $(this).next().val() + ")");
				removeEdge(vertexes.vertex1_id, vertexes.vertex2_id);
			});
			
			//bind mousedown event for the li
			$('li[id^=edge]').mousedown(function () {
				$('li[id^=edge]').removeClass('listitem_sel');
				$(this).addClass('listitem_sel');
				
				//redraw everything
				redrawCheckpoints();
				var context = canvas.get(0).getContext("2d");
				var vertEnd = eval("(" + $(this).children().last().val() + ")");
				var vertStart = eval("(" + $(this).children().last().prev().val() + ")");
				
				var hasNull = false;
				var tempEdge = null;
				if (vertStart != null) {
					drawEdgeVertex(vertStart, context);
					tempEdge = vertStart;
				} else {
					hasNull = true;
				}
				if (vertEnd != null) {
					drawEdgeVertex(vertEnd, context);
					tempEdge = vertEnd;
				} else {
					hasNull = true;
				}
				if(hasNull) {
					drawDiffFloorEdge(tempEdge, context);
				} else {
					drawEdgeLine(vertStart, vertEnd, context);
				}
			});
			
			$('li[id^=edge]').hover(function () {
				if (!$(this).hasClass('listitem_sel')) {
					$(this).css('background-color', '#cccccc');
				}
			}, function() {
				$(this).removeAttr('style');
			});
			
		});
		
		
	}
	
	function drawDiffFloorEdge(vertex, context) {
		context.beginPath();
		context.arc(vertex.x, vertex.y, radius-3, 0, Math.PI*2, false);
		context.closePath();
		context.fillStyle = "green";
		context.fill();
	}
	
	function getVertexById(id) {
		for(var i = 0; i < vertexCanvasArray.length; i++) {
			if(vertexCanvasArray[i].id == id) {
				return vertexCanvasArray[i];
			}
		}
		return null;
	}
	
	function startSameFloorEdgeModal() {
		//populate modal
		$('#same_edge1').text(edgeStart.name);
		$('#same_edge2').text(edgeEnd.name);
		$('#hid_same_edge1').val(edgeStart.id);
		$('#hid_same_edge2').val(edgeEnd.id);
		
		//populate the model
		$('#new_same_btn').trigger('click');
	}
	
	function getSelectedVertexOnCanvasNoEdit(x,y) {
		var i;
		for (i = 0; i < vertexCanvasArray.length; i++) {
			if(isInside(x,y,vertexCanvasArray[i].x,vertexCanvasArray[i].y)) {
				return vertexCanvasArray[i];
			}
		}
		return null;
	}
	
	function drawEdgeVertex(vertex, context) {
		context.beginPath();
		context.arc(vertex.x, vertex.y, radius + 2, 0, Math.PI*2, false);
		context.closePath();
		context.fillStyle = "red";
		context.fill();
	}
	
	function drawEdgeLine(start, end, context) {
			context.strokeStyle = "red";
			context.moveTo(start.x,start.y);
			context.lineTo(end.x,end.y);
			context.stroke();
	}
	
	function clearCanvas() {
		var canvasObj = canvas.get(0);
		var context = canvasObj.getContext("2d");
		context.clearRect(0, 0, canvasObj.width, canvasObj.height);
	}
	
	$('#floors_selector').trigger('change');
	
	$('#add_new_vertex').click(function (){
		resetDetailsFields();
		$('#vert_edit').attr('disabled', 'disabled');
		$('#vert_name').removeAttr('disabled');
		$('#vert_cancel').removeAttr('disabled');
		clickingOnCanvasEnabled = true;
		$('#vertex_img_input').show();
		$('#vertex_galery').hide();
		showNewVertexInfo();
	});
	
	$('#nav_vertex').click(function() {
		if(!$(this).hasClass('active')) {
			$(this).addClass('active');
			$('#nav_edge').removeClass('active');
			toggleTabs();
		}
	});
	
	$('#nav_edge').click(function() {
		if(!$(this).hasClass('active')) {
			$(this).addClass('active');
			$('#nav_vertex').removeClass('active');
			toggleTabs();
		}
	});
	
	function toggleTabs() {
		$('#edge_wrapper').toggle();
		$('#vertex_wrapper').toggle();
	}
	
	function resetDetailsFields() {
		$('#vert_coord_x').val('');
	    $('#vert_coord_y').val('');
	    $('#vert_name').val('');
	    $('#vert_id').val('');
	    $('#vertex_shops').empty();
	    
	    $('#vert_img_url').val('');
	    $('#vertex_galery').css('background-image', 'none');
	}
	
	function resetAddNewShopModal() {
		$('#shop_finder_input').val('');
		$('#add_shop_list').empty();
		$('#new_shop_cache_id').val('');
	}
	
	$('#vert_edit').click(function() {
		$(this).attr('disabled', 'disabled');
		$('#vert_save').removeAttr('disabled');
		$('#vert_name').removeAttr('disabled');
		$('#vert_cancel').removeAttr('disabled');
		$('#vertex_img_input').show();
		$('#vertex_galery').hide();
		
		//enable clicking on canvas (only of selected vertex)
		clickingOnCanvasEnabled = true;
		
		//enable name changing and listitems removal
		$('button[id^=del_shop]').show();
		
		//get selected vertex
		var selected = getSelectedVertexOnCanvas($('#vert_coord_x').val(),$('#vert_coord_y').val());
		
		//redraw it
		redrawCheckpoints();
		drawEmptyCheckpoint(selected.x, selected.y, canvas.get(0).getContext("2d"));
	});
	
	function getSelectedVertexOnCanvas(x,y) {
		var i;
		for (i = 0; i < vertexCanvasArray.length; i++) {
			if(isInside(x,y,vertexCanvasArray[i].x,vertexCanvasArray[i].y)) {
				vertexCanvasArray[i].editable = true;
				return vertexCanvasArray[i];
			}
		}
		return null;
	}

	$('#vert_name').keyup(function() {
		var hasError = false;

		if ($(this).val().length == 0) {
			$('#vertex_input').addClass('has-error'); 
			hasError = true;
		} else {
			$('#vertex_input').removeClass('has-error');
		}
		
		if(hasError) {
			$('#vert_save').attr('disabled', 'disabled');
		} else {
			$('#vert_save').removeAttr('disabled');
		}
	});
	
	$('#vert_save').click(function() {
		$('#vertex_img_input').hide();
		$('#vertex_galery').show();
		
		$(this).attr('disabled', 'disabled');
		clickingOnCanvasEnabled = false;
		// get floor
		var selectedObj = eval("("+ $('#floors_selector').find(":selected").val() + ")");
		// get data
		var postData = {'x' : $('#vert_coord_x').val(),
				'y' : $('#vert_coord_y').val(),
				'name' : $('#vert_name').val(),
				'id' : $('#vert_id').val(),
				'floor' : selectedObj.id,
				'img_url' : $('#vert_img_url').val()};
		
		// perform ajax call
		$.ajax({
		  type: "POST",
		  url: "http://localhost/xampp_intro/index.php/main/addvertex",
		  data: postData,
		  success: function (result) {
			// refresh data -- first get floor
			refreshVertexes(selectedObj.id);
			$('#vert_name').attr('disabled', 'disabled');
		  }
		});
	});
	
	function refreshVertexes(floor) {
		$.getJSON("http://localhost/xampp_intro/index.php/main/vertexes/" + floor, function(data) {
			var i;
			vertexCanvasArray = new Array();
			$('#vertex_list').empty();
			for (i = 0; i < data.length; i++) {
				var obj = data[i];
				child = '<li id="vvert' + i + '" class="list-group-item">';
				child += '<span id="name">' + obj.name + '</span>';
				child += '<button id="del_vert' + i + '" type="button" class="close pull-right" aria-hidden="true">&times;</button>';
				child += '<input type="hidden" value="{\'x\':\'' + obj.x + '\',\'y\':\'' + obj.y + '\', \'id\':\''+obj.id+'\',\'img_url\':\''+obj.checkpoint_url+'\' }" />';
				child += '</li>';
				$('#vertex_list').append(child);
				
				vertexCanvasArray[i] = {'x' : obj.x, 'y' : obj.y, 'id' : obj.id, 'editable' : false, 'name' : obj.name};
				
			}
			
			// bind ui changes to refreshed list
			$('li[id^=vvert]').hover(function() {
				if (!$(this).hasClass('listitem_sel')) {
					$(this).css('background-color', '#cccccc');
				}
			}, function() {
				$(this).removeAttr('style');
			});
			
			$('li[id^=vvert]').mousedown(function () {
				selectListItem($(this));
				//enable edit
				$('#vert_edit').removeAttr('disabled');
			});
			
			$('button[id^=del_vert]').click(function() {
				var vertObj = eval("(" + $(this).next().val() + ")");
				removeVertex(vertObj.id);
			});
			
			// also draw on canvas
			redrawCheckpoints();
			
			//start ajax call for edges
			getEdgesForFloor(floor);
		});
	}
	
	function removeVertex(vertexId) {
		$.get("http://localhost/xampp_intro/index.php/main/removeFullVertex/" + vertexId, function (result) {
			if(result === "OK") {
				var selectedObj = eval("("+ $('#floors_selector').find(":selected").val() + ")");
				var floor = selectedObj.floor;
				refreshVertexes(floor);
				$('#vertex_list').childre().first().trigger('mousedown');
			} else {
				alert('Error while removing all related vertex info');
			}
		});
	}
	
	function selectListItem(obj) {
		resetListItems();
		obj.addClass('listitem_sel');

		// populate details fields
		//span
		var span = obj.children().first();
		$('#vert_name').val(span.text());
		//hidden
		var hidden = obj.children().last();
		var values = eval("(" + hidden.val() + ")");
		$('#vert_coord_x').val(values.x);
		$('#vert_coord_y').val(values.y);
		
		$('#vert_id').val(values.id);
		
		redrawCheckpoints();
		drawEmptySelectedCheckpoint(values.x, values.y, canvas.get(0)
				.getContext("2d"), radius + 15);
		
		// make ajax call to populate list of shops for the selected vertex
		$('#add_new_shop').removeAttr('disabled');
		getShopsForVertex(values.id);
		
		//images also
	    if(values.img_url != 'null' || values.img_url === "") {
	    	$('#vert_img_url').val(values.img_url);
	    	$('#vertex_galery').css('background-image', 'url(' + values.img_url + ')');
	    	$('#vertex_galery').css('width', totalWidth + 'px');
	    	$('#vertex_galery').css('height', totalHeight + 'px');
	    	$('#vertex_galery').css('margin-bottom', '10px');
	    } else {
	    	$('#vertex_galery').removeAttr('style');
	    	$('#vert_img_url').val('');
	    }
	}
	
	$('#add_new_shop').click(function() {
		$('#add_shop_btn').attr('disabled', 'disabled');
		resetAddNewShopModal();
	});
	
	$('#shop_finder_input').keyup(function() {
		var value = $(this).val(); 
		if(value != "") {
			$.getJSON("http://localhost/xampp_intro/index.php/main/getSimpleShopsLikeName/" + value, function(data) {
				$('#add_shop_list').empty();
				if(data.length > 0) {
					for ( var i = 0; i < data.length; i++) {
						var obj = data[i];
						child = '<li id="find_shop' + i + '" class="list-group-item">';
						child += '<span>' + obj.name + '</span>';
						child += '<input type="hidden" value="' + obj.id + '" />';
						child += '</li>';
						$('#add_shop_list').append(child);
					}
					$('li[id^=find_shop]').mousedown(function () {
						$('#add_shop_btn').removeAttr('disabled');
						var shopId = $(this).children().last().val();
						$('#new_shop_cache_id').val(shopId);
						$(this).addClass('listitem_sel');
					});
					$('li[id^=find_shop]').hover(function() {
						if (!$(this).hasClass('listitem_sel')) {
							$(this).css('background-color', '#cccccc');
						}
					}, function() {
						$(this).removeAttr('style');
					});
					
				} else {
					$('#add_shop_list').append('<p>There is no such shop</p>');
				}
			});
			
		}
	});
	
	$('#add_shop_btn').click(function () {
		//get ids
		var shopId = $('#new_shop_cache_id').val();
		var vertexId = $('#vert_id').val();
		//make ajax call to change the vertex id of the selected shop
		$.get("http://localhost/xampp_intro/index.php/main/changeVertexIdForShop/"+shopId+"/"+ vertexId,
			function (result) {
				if(result != "OK") {
					alert('Error while assigning shop to vertex');
				}
		});
		//refresh the shops for the given vertex
		getShopsForVertex(vertexId);
		//dismiss modal
		$('#myShopModal').modal('hide');
	});
	
	function getShopsForVertex(id) {
		$.getJSON("http://localhost/xampp_intro/index.php/main/shopsforvertex/" + id, 
			function(result) {
				var i;
				$('#vertex_shops').empty();
				
				if(result.length > 0) {
					for (i = 0; i < result.length; i++) {
						var obj = result[i];
						child = '<li class="list-group-item">';
						child += '<span id="name">' + obj.name + '</span>';
						child += '<button id="del_shop' + i + '" type="button" class="close pull-right" aria-hidden="true">&times;</button>';
						child += '<input type="hidden" value="' + obj.id + '" />';
						child += '</li>';
						$('#vertex_shops').append(child);
					}
					
					$('button[id^=del_shop]').hide();
					$('button[id^=del_shop]').click(function () {
						removeShopFromVertexList($(this).next().val(), id);
					});
				} else {
					$('#vertex_shops').append('<p>There are no shops entered for this vertex</p>');
				}
			});
	}
	
	function removeShopFromVertexList(id, vertexId) {
		$.get("http://localhost/xampp_intro/index.php/main/removeshopfromvertex/" + id, function(data) {
			if(data === "OK") {
				getShopsForVertex(vertexId);
			} else {
				alert("Error while removing shop from vertex");
			}
		});
	}
	
	function resetListItems() {
		$('li').removeClass('listitem_sel');
	}
	
	function redrawCheckpoints() {
		clearCanvas();
		var i;
		var canvasObj = canvas.get(0);
		var context = canvasObj.getContext("2d");
		for (i = 0; i < vertexCanvasArray.length; i++) {
			if(!vertexCanvasArray[i].editable) {
				drawFullCheckpoint(vertexCanvasArray[i].x, vertexCanvasArray[i].y, context);
			}
		}
	}
	
	function drawFullCheckpoint(x,y,context) {
		context.beginPath();
		context.arc(x, y, radius, 0, Math.PI*2, false);
		context.closePath();
		context.fillStyle = "blue";
		context.fill();
	}
	
	function drawEmptyCheckpoint(x,y,context) {
		context.beginPath();
		context.arc(x, y, radius, 0, Math.PI*2, false);
		context.closePath();
		context.strokeStyle = "blue";
		context.stroke();
	}
	
	function drawEmptySelectedCheckpoint(x,y,context,rad) {
		context.beginPath();
		context.arc(x, y, rad, 0, Math.PI*2, false);
		context.closePath();
		context.strokeStyle = "green";
		context.stroke();
	}
	
	function isInside(touchX, touchY, centerX, centerY) {
		var z = Math.sqrt(((touchX - centerX) * (touchX - centerX))
				+ ((touchY - centerY) * (touchY - centerY))); 
		return z <= radius;
	}
});