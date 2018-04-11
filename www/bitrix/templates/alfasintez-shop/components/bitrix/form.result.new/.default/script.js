$(function()
{
	$(document)
		.on('vclick', '.alfasintez-form :submit', function()
		{
			return $(this).closest('.alfasintez-form').checkFormValidation();
		});
});