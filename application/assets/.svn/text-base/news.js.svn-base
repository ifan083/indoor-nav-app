$(function() {

	$('#' + $('#navlink_sel').val()).addClass('active');

	$('#action_add').text('Add news');
	$('#action_save_add').val('Save');
	$('#action_edit').text('Edit news');
	$('#action_delete').val('Delete news');

	$('.input-group').hide();

	$('#action_save_add').attr('form', 'news_form');
	$('#action_save_edit').attr('form', 'news_form');
	$('#action_delete').attr('form', 'news_form');

	$('#details_edit_date').datepicker( {
		format : "dd.mm.yyyy",
		startDate : "now",
		autoclose : true,
		todayHighlight : true
	});
	
	selectListItem('0');

	$('#details_edit_title, #details_edit_date, #details_edit_image, #details_edit_type, #details_edit_description').keyup(function () {
		validateEditFields();
	});
	
	function validateEditFields() {
		if (($('#details_edit_title').val() != '')
				&& ($('#details_edit_date').val() != '')
				&& ($('#details_edit_type').val() != '')
				&& ($('#details_edit_image').val() != '')
				&& ($('#details_edit_description').val() != '')) {
			//enable both save buttons
			$('#action_save_add').removeAttr('disabled');
			$('#action_save_edit').removeAttr('disabled');
		} else {
			//disable both save button
			$('#action_save_add').attr('disabled', 'disabled');
			$('#action_save_edit').attr('disabled', 'disabled');
		}
	}
	
	function toggleDetails() {
		$('.input-group').toggle();
		$('span[id^="label_"]').toggle();
		$('span[id^="det_"]').toggle();
		$('#details_image').toggle();
	}

	$('#action_edit').click(function() {
		toggleDetails();
		enableActionBtns(false);
		validateEditFields();
	});
	
	$('#action_add').click(function() {
		clearDetails();
		toggleDetails();
		enableActionBtns(false);
		validateEditFields();
	});

	
	$('#action_cancel_add').click(function() {
		$('#collapseOne').collapse('hide');
		$('#action_add').css('pointer-events', '');
		toggleDetails();
		clearDetails();
	});
	
	$('#action_cancel_edit').click(function() {
		$('#collapseTwo').collapse('hide');
		enableActionBtns(true);
		toggleDetails();
	});
	
	function enableActionBtns(enable) {
		var attrVal = enable ? '' : 'none';
		$('#action_add').css('pointer-events', attrVal);
		$('#action_edit').css('pointer-events', attrVal);
		$('#action_delete').css('pointer-events', attrVal);
	}

	function clearDetails() {
		$('#det_title').text('');
		$('#det_date').text('');
		$('#det_description').text('');
		$('#details_image').attr('src','');
		$('#det_type').val('');
		$('#det_id').val('');
		
		$('#details_edit_title').val('');
		$('#details_edit_date').val('');
		$('#details_edit_type').val('');
		$('#details_edit_image').val('');
		$('#details_edit_description').val('');
	}
	
	$('li[id^=row]').mousedown(function() {
		var rowId = $(this).attr('id');
		var index = rowId.substr(3);
		selectListItem(index);
	});
	
	$('li[id^=row]').hover(function() {
		if (!$(this).hasClass('listitem_sel')) {
			$(this).css('background-color', '#cccccc');
		}
	}, function() {
		$(this).removeAttr('style');
	});

	function selectListItem(row) {
		if ($('#news_container').children().length > 0) {
			$('li').removeClass('listitem_sel');
			$('li[id=row' + row + ']').addClass('listitem_sel');

			if ($('#details_edit_title').is(":visible")) {
				toggleDetails();
				$('#collapseOne').collapse('hide');
				$('#collapseTwo').collapse('hide');
				//colapse both
			}
			enableActionBtns(true);

			var obj = eval("(" + $('#details' + row).val() + ")");

			$('#det_title').text(obj.title);
			$('#det_date').text(obj.date);
			$('#det_description').text(obj.description);
			$('#details_image').attr('src', obj.image);
			$('#det_type').text(obj.type);
			$('#det_id').val(obj.id);

			$('#details_edit_title').val(obj.title);
			$('#details_edit_date').val(obj.date);
			$('#details_edit_type').val(obj.type);
			$('#details_edit_image').val(obj.image);
			$('#details_edit_description').val(obj.description);
		}

	}
});