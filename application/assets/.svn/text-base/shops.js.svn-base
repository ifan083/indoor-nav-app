$(document).ready(
		function() {

			$('[id^="details_edit"]').hide();
			
			//disable edit & delete when nothing is selected
			$('#action_edit').css('pointer-events', 'none');
			$('#action_delete').css('pointer-events', 'none');
			
			//assign form
			$('#action_save_edit').attr('form','edit_shops_form');
			$('#action_save_add').attr('form','edit_shops_form');
			$('#action_delete').attr('form','edit_shops_form');

			$('li').hover(function() {
				if (!$(this).hasClass('listitem_sel')) {
					$(this).css('background-color', '#cccccc');
				}
			}, function() {
				$(this).removeAttr('style');
			});

			//update header
			$('#'+$('#navlink_sel').val()).addClass('active');
			
			selectListItem(0);
			
			function selectListItem(index) {
				resetListItems();
				$('#row'+index).removeAttr('style');
				$('#row'+index).addClass('listitem_sel');

				// populate details fields
				$('#details_picture').attr('src', $('#picture' + index).val());
				$('#details_logo').attr('src', $('#logo' + index).val());
				$('#details_name').text($('#name' + index).text());
				$('#details_floor').text($('#floor' + index).val());
				$('#details_description').text($('#description' + index).val());
				$('#details_working_hours').text($('#workhrs' + index).val());
				
				var categoryTitle = $('option[value=cat'+$('#category' + index).val()+']').text();
				$('#details_category_id').text(categoryTitle);
				
				var vertexTitle = $('option[value=vert'+$('#vertex' + index).val()+']').text();
				$('#details_vertex_id').text(vertexTitle);
				
				$('#details_id').val($('#id' + index).val());

				// populate details EDIT fields
				$('#details_edit_picture_url').val($('#details_picture').attr('src'));
				$('#details_edit_logo_url').val($('#details_logo').attr('src'));
				$('#details_edit_name').val($('#details_name').text());
				$('#details_edit_floor').val($('#details_floor').text());
				$('#details_edit_description').val($('#details_description').text());
				$('#details_edit_working_hours').val($('#details_working_hours').text());
				$('#details_edit_category_id').val($('#details_category_id').text());
				$('#details_edit_vertex_id').val($('#details_vertex_id').text());
				
				var categoryId = $('#category' + index).val();
				if(!$.isNumeric($('#category' + index).val())) {
					categoryId = 0;
				}
				
				$('#details_edit_cat_id').val('cat' + categoryId);
				
				var vertexId = $('#vertex' + index).val();
				if(!$.isNumeric($('#vertex' + index).val())) {
					vertexId = 0;
				}
				$('#details_edit_vertex_id').get(0).selectedIndex = vertexId;
				
				//enable edit & delete 
				$('#action_edit').css('pointer-events', '');
				$('#action_delete').css('pointer-events', '');
			}
			
			$('li').mousedown(function () {
				var rowId = $(this).attr('id');
				var index = rowId.substr(3);
				
				selectListItem(index);
			});

			function resetListItems() {
				$('li').removeClass('listitem_sel');
			}
			
			function clearDetails() {
				$('#details_edit_picture_url').val("");
				$('#details_edit_logo_url').val("");
				$('#details_edit_name').val("");
				$('#details_edit_floor').val("");
				$('#details_edit_description').val("");
				$('#details_edit_working_hours').val("");
				$('#details_edit_category_id').val("");
				$('#details_edit_vertex_id').val("");
				$('#details_id').val("");
			}
			
			function clearDetailsInfo() {
				$('#details_picture').attr('src', '');
				$('#details_logo').attr('src', '');
				$('#details_name').text('');
				$('#details_floor').text('');
				$('#details_description').text('');
				$('#details_working_hours').text('');
				$('#details_category_id').text('');
				$('#details_vertex_id').text('');
				$('#details_id').val('');
			}
			
			function enableActionBtns(enable) {
				var attrVal = enable ? '' : 'none';
				$('#action_add').css('pointer-events', attrVal);
				$('#action_edit').css('pointer-events', attrVal);
				$('#action_delete').css('pointer-events', attrVal);
			}
			
			$('#action_add').click(function () {
				clearDetails();
				toggleEditDetails();
				//disable edit & delete
				enableActionBtns(false);
				validateEdits();
			});
			
			
			$('#action_cancel_add').click(function() {
				$('#collapseOne').collapse('hide');
				$('#action_add').css('pointer-events', '');
				toggleEditDetails();
				clearDetailsInfo();
				selectListItem(0);
			});
			
			$('#action_edit').click(function() {
				enableActionBtns(false);
				toggleEditDetails();
				validateEdits();
			});
			
			$('#action_cancel_edit').click(function() {
				//hide collapseTwo
				$('#collapseTwo').collapse('hide');
				//disable edit delete
				enableActionBtns(true);
				toggleEditDetails();
			});
			
			function toggleEditDetails() {
				$('#details_picture').toggle();
				$('#details_logo').toggle();
				$('#details_name').toggle();
				$('#details_floor').toggle();
				$('#details_description').toggle();
				$('#details_working_hours').toggle();
				$('#details_category_id').toggle();
				$('#details_vertex_id').toggle();
				$('#details_id').toggle();

				$('[id^="details_edit"]').toggle();
				
				$('span[id^="details_label"]').toggle();
			}

			$('#shop_save_sbmt').click(function() {
				$('#shop_edit_btn').show();
				$(this).hide();
				toggleEditDetails();
			});

			$('#shop_edit_btn').click(function() {
				toggleEditDetails();
				$('#shop_save_sbmt').show();
				$(this).hide();
			});
			
			//shops autocomplete
			$('#find_shops_auto').keyup(function(e) {
				//clear old list
				$('#shop_list').empty();
				
				//extract current value
				var partial = $(this).val();
				
				// make ajax call
				$.getJSON("http://localhost/xampp_intro/index.php/service/shops/" + partial, 
					function(data) {
					//update list
					updateShopsList(data);
					
					//reset list item behavior
					$('li').mousedown(function () {
						var rowId = $(this).attr('id');
						var index = rowId.substr(3);
						
						selectListItem(index);
					});
					$('li').hover(function() {
						if (!$(this).hasClass('listitem_sel')) {
							$(this).css('background-color', '#cccccc');
						}
					}, function() {
						$(this).removeAttr('style');
					});

					selectListItem(0);
				});
				
				
			});
			
			function updateShopsList(data) {
				for (var i in data) {
					var obj = data[i];
					var child = '<li id="row' + i +'" class="list-group-item">';
					child += '<input id="logo' + i + '" type="hidden" value="' + obj.logo_url + '" />';
					child += '<span id="name' + i + '">' + obj.name + '</span>';
					child += '<input id="picture' + i + '" type="hidden" value="' + obj.picture_url + '" />';
			       	child += '<input id="id' + i + '" type="hidden" value="' + obj.id + '" />';
			       	child += '<input id="floor' + i + '" type="hidden" value="' + obj.floor + '" />';
			       	child += '<input id="description' + i + '" type="hidden" value="' + obj.description + '" />';
			       	child += '<input id="category' + i + '" type="hidden" value="' + obj.category_id + '" />';
			       	child += '<input id="vertex' + i + '" type="hidden" value="' + obj.vertex_id + '"/>';
			       	child += '<input id="workhrs' + i + '" type="hidden" value="' + obj.working_hours + '" />';
			       	child += '</li>';
					$("#shop_list").append(child);
				}
			}
			
			function validateEdits() {
				var notEmpty = false;
				if (($('#details_edit_logo_url').val() != '')
						&& ($('#details_edit_name').val() != '')
						&& ($('#details_edit_floor').val())
						&& ($('#details_edit_picture_url').val() != '')) {
					$('#action_save_add').removeAttr('disabled'); //save
					$('#action_save_edit').removeAttr('disabled'); //edit
				} else {
					$('#action_save_add').attr('disabled','disabled'); //save
					$('#action_save_edit').attr('disabled', 'disabled'); //edit
				}
			}
			
			$('#details_edit_logo_url, #details_edit_name, #details_edit_floor, #details_edit_picture_url').keyup(function() {
				validateEdits();
			});
			
		});