$(function()
{
	$('header .call-back-call-cell > *').on('vclick', function()
	{
		var $form = $('#call-back-form');

		AvBlurScreenOn(1000);
		$form
			.show()
			.positionCenter(1100, true, true)
			.onClickout(function()
			{
				$(this).find('.close').click();
			})
			.on('vclick', '.close', function()
			{
				$form.hide();
				AvBlurScreenOff();
			});
	});
});