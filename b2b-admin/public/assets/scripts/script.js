$(document).ready(function()
{
    $('.jq-popup-congrim').click(function(e)
	{
		e.preventDefault();

		var submitClass = $(this).attr('data-submit-class');

		$('#modal-delete .jq-delete-submit').on('click', function(e)
		{
			$('.' + submitClass).submit();
			$('#modal-delete').modal('hide');
		});

		$('#modal-delete').modal('show');
	});

	$('.jq-open-close-card button').click(function(e)
	{
		var visible = 0;

		if($(this).attr('data-card-widget') == 'remove' || ($(this).attr('data-card-widget') == 'collapse' && !$(this).closest('.jq-open-close-card').hasClass('collapsed-card')))
		{
			visible = 1;
		}

		var array = {};
		array['filters[' + $(this).closest('.jq-open-close-card').attr('data-card') + ']'] = visible;

		$.ajax({
			url: $('.jq-open-close-card-form').attr('action') + '/no-redirect',
			data: array,
			type: 'post'
		  });
	});

	$('.jq-open-close-card-clear').click(function(e)
	{
		e.preventDefault();

		$(this).closest('.jq-open-close-card').find('input[type=text]').each(function() 
		{
			$(this).val($(this).attr('data-default-value'));
		});

		$(this).find('.jq-open-close-card select').each(function() 
		{
			$(this).val($(this).attr('data-default-value')).change();
		});

		$(this).closest('form').submit();
	});
});