/**
*
* MantisBT Plugin: CustomFieldsToTop - Moves selected custom fields to the top of the Report Issue form and the Update Issue form.
*
* @copyright (c) 2021, LukeWCS
*
*/

$(document).ready(function() {
	var GetScriptParam = function(name) {
		var param = $('#CustomFieldsToTop_js').attr('data-' + name);
		return ((typeof param !== 'undefined') ? param : '');
	};
	var	GetCustomElement = function(num) {
		return $('#custom_field_' + CustomFields[num]);
	};
	var ShowForm = function(name) {
		$('#' + name).find('table').eq(0).css({'opacity': '1', 'pointer-events': 'auto'});
	};
	var Reindex = function(name) {
		var newindex = 0;
		$('#' + name).find('[tabindex]').each(function(i) {
			if ($(this).attr('tabindex') > 0) {
				newindex++;
				$(this).attr('tabindex', newindex);
			}
		});
	};
	var FormName = GetScriptParam('FormName');
	var CustomFields = GetScriptParam('CustomFields').split(',');
	var ShowAfterMove = (GetScriptParam('ShowAfterMove') == true);

	if (FormName == 'report') {
		if (CustomFields[0] !== '' && $('#report_bug_form').length) {
			var InsertPointElement = $('#category_id').closest('tr');
			var CustomElement = null;
			var CustomElementFirst = null;

			for (i = 0; i < CustomFields.length; i++) {
				CustomElement = GetCustomElement(i)
				if (!CustomElement.length) {
					continue;
				}
				CustomElement.closest('tr').insertBefore(InsertPointElement);
				if (CustomElementFirst === null) {
					CustomElementFirst = GetCustomElement(i);
				}
			}
			if (CustomElementFirst !== null) {
				$('#category_id').removeClass('autofocus');
				CustomElementFirst.addClass('autofocus');
				CustomElementFirst.focus();
				Reindex('report_bug_form');
			}
		}
		if (ShowAfterMove) {
			ShowForm('report_bug_form');
		}
	} else if (FormName == 'update') {
		if (CustomFields[0] !== '' && $('#update_bug_form').length) {
			var InsertPointElement = $('#category_id').closest('tr');
			var CustomElement = null;
			var CustomElementMoved = false;

			for (i = CustomFields.length - 1; i >= 0; i--) {
				CustomElement = GetCustomElement(i)
				if (!CustomElement.length) {
					continue;
				}
				CustomElement.closest('tr').insertAfter(InsertPointElement);
				CustomElementMoved = true;
			}
			if (CustomElementMoved) {
				InsertPointElement.after('<tr class="spacer"><td colspan="6"></td></tr><tr class="hidden"></tr>');
				$('tr.hidden').next('tr.spacer').remove();
				$('tr.hidden').next('tr.hidden').remove();
				Reindex('update_bug_form');
			}
		}
		if (ShowAfterMove) {
			ShowForm('update_bug_form');
		}
	}
});
