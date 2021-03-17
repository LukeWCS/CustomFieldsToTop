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
	var FormName = GetScriptParam('FormName');
	var CustomFields = GetScriptParam('CustomFields').split(',');
	var ShowAfterMove = (GetScriptParam('ShowAfterMove') == true);

	if (!CustomFields.length) {
		return;
	}

	if (FormName == "report") {
		if (!$('#report_bug_form').length) {
			return;
		}
		var InsertPointElement = $("#category_id").closest('tr');
		var CustomElement = null;
		var CustomElementFirst = null;

		for (i = 0; i < CustomFields.length; i++) {
			CustomElement = GetCustomElement(i)
			if (!CustomElement.length) {
				continue;
			}
			CustomElement.attr('tabindex', '1');
			CustomElement.closest('tr').insertBefore(InsertPointElement);
			if (CustomElementFirst === null) {
				CustomElementFirst = GetCustomElement(i);
			}
		}
		if (ShowAfterMove) {
			$("#report_bug_form").find("table.table").css({"opacity": "1", "pointer-events": "auto"});
		}
		if (CustomElementFirst !== null) {
			$("#category_id").removeClass('autofocus');
			CustomElementFirst.addClass('autofocus');
			CustomElementFirst.focus();
		}
	} else if (FormName == "update") {
		if (!$('#update_bug_form').length) {
			return;
		}
		var InsertPointElement = $("#category_id").closest('tr');
		var CustomElement = null;

		for (i = CustomFields.length - 1; i >= 0; i--) {
			CustomElement = GetCustomElement(i)
			if (!CustomElement.length) {
				continue;
			}
			CustomElement.attr('tabindex', '3');
			CustomElement.closest('tr').insertAfter(InsertPointElement);
		}
		InsertPointElement.after('<tr class="spacer"><td colspan="6"></td></tr><tr class="hidden"></tr>');
		$("tr.hidden").next("tr.spacer").remove();
		$("tr.hidden").next("tr.hidden").remove();
		if (ShowAfterMove) {
			$("#update_bug_form").find("table.table").css({"opacity": "1", "pointer-events": "auto"});
		}
	}
});
