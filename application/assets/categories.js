$(function() {

	// hide edit toggle elements
	$('#cat_name').hide();

	// rename action buttons 
	$('#action_add').text('Add Category');
	$('#action_edit').text('Edit Category');
	$('#action_delete').val('Delete Category');
	$('#action_save_add').val('Save Category');
	
	$('#action_edit').css('pointer-events', 'none');
	$('#action_delete').css('pointer-events', 'none');

	// asign form for submit buttons
	$('#action_save_edit').attr('form','edit_category_form');
	$('#action_save_add').attr('form','edit_category_form');
	$('#action_delete').attr('form','edit_category_form');

	$('li').hover(function() {
		if (!$(this).hasClass('listitem_sel')) {
			$(this).css('background-color', '#cccccc');
		}
	}, function() {
		$(this).removeAttr('style');
	});

	selectListItem(0);

	// update header
	$('#' + $('#navlink_sel').val()).addClass('active');

	function selectListItem(index) {
		
		if($('#category_container').children().length > 0) {
			resetListItems();
			$('#row' + index).removeAttr('style');
			$('#row' + index).addClass('listitem_sel');
			
			// populate details fields
			$('#cat_name').val($('#name' + index).text());
			var categoryId = $('#id' + index).val();
			$('#cat_id').val(categoryId);
			
			loadList(categoryId);
			
			// enable edit & delete
			$('#action_edit').css('pointer-events', '');
			$('#action_delete').css('pointer-events', '');
		}
		
	}
	
	function removeDetailsListItem(obj) {
		// update the shop with category_id == null
		var shopId = obj.next().val();
		var categoryId = obj.next().next().val();
		
		// make ajax call
		$.get("http://localhost/xampp_intro/index.php/main/removeshopfromcategory/" + shopId, function(data) {
			if (data == "OK") {
				loadList(categoryId);
			} else {
				alert("Error while removing shop from category");
			}
		});
	}

	function loadList(categoryId) {
		// make ajax call and populate the list
		$.getJSON("http://localhost/xampp_intro/index.php/service/shopsByCategory/" + categoryId,
			function(data) {
				//clear all children of the category details list (shop names)
				$('#selected_category_list').empty();
	
				if(data.length == 0) {
					$('#selected_category_list').append('<p>There are no shops available for this category</p>');
				} else {
					for ( var i in data) {
						var obj = data[i];
						
						var child = '<li class="list-group-item" >';
						child += '<span id="shop_name' + i + '" style="margin-left: 5px; float: left; ">' + obj.name + '</span>';
						child += '<button id="del_shop' + i + '" type="button" class="close pull-right" aria-hidden="true">&times;</button>';
						child += '<input type="hidden" value="' + obj.id + '" />';
						child += '<input type="hidden" value="' + categoryId + '" />';
						child += '<div style="clear: both;"></div>';
						child += '</li>';
						$('#selected_category_list').append(child);
						
						
						
						//hide all delete button
						if(!$('#cat_name').is(":visible")) {
							$('button[id^="del_shop"]').hide();
						} 
					}
				}
				
				$('button[id^="del_shop"]').click(function () {
					removeDetailsListItem($(this));
				});
			});
	}
	

	$('li').mousedown(function() {
		var rowId = $(this).attr('id');
		var index = rowId.substr(3);

		selectListItem(index);
	});

	function resetListItems() {
		$('li').removeClass('listitem_sel');
	}

	function clearDetails() {
		// reset values for editing details fields (the hidden ones)
		$('#cat_name').val('');
		$('#cat_id').val('');
		// clear list
		$('#selected_category_list').empty();
	}

	function enableActionBtns(enable) {
		var attrVal = enable ? '' : 'none';
		$('#action_add').css('pointer-events', attrVal);
		$('#action_edit').css('pointer-events', attrVal);
		$('#action_delete').css('pointer-events', attrVal);
	}

	$('#action_add').click(function() {
		clearDetails();
		toggleEditDetails();
		// disable edit & delete
		enableActionBtns(false);
	});

	$('#action_cancel_add').click(function() {
		$('#collapseOne').collapse('hide');
		$('#action_add').css('pointer-events', '');
		toggleEditDetails();
	});

	$('#action_edit').click(function() {
		enableActionBtns(false);
		toggleEditDetails();
	});

	$('#action_cancel_edit').click(function() {
		// hide collapseTwo
		$('#collapseTwo').collapse('hide');
		// disable edit delete
		enableActionBtns(true);
		toggleEditDetails();
	});

	function toggleEditDetails() {
		// call .toggle on details in edit or view mode
		$('#cat_name').toggle();
		$('button[id^="del_shop"]').toggle();
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

});