<script type="text/javascript">
// P&T Switch: Checkbox Toggle fieldtype
$(function(){
	var input = $('input[name=<?=$input?>]');
	var input_switch = $('#hold_<?=$field_id?> li.toggle');
	var input_switch_pill = input_switch.find('div');
	
	// Hide our normal comments checkbox to avoid confusion
	input.parent('label').hide();
	
	// auto-toggle our pt-switch if the checkbox value doesn't match the
	// custom field value OR default value
	if (
			(input.is(':checked') && input_switch_pill.css('left') == '0px')
			||
			( ! input.is(':checked') && input_switch_pill.css('left') == '30px')
		)
	{
		// trigger mousedown followed by mouseup due to how P&T Switch uses events
		input_switch.trigger('mousedown');
		input_switch.trigger('mouseup');
	}
	
	// Toggle the original input value when P&T Switch is clicked
	input_switch.live('click',function()
	{
		if (input.is(':checked'))
		{
			input.removeAttr('checked');
		} else {
			input.attr('checked','checked');
		}
	});
	
});
</script>