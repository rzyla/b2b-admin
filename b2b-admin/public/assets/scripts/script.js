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
});