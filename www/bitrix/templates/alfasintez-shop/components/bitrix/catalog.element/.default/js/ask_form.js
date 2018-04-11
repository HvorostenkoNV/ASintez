$(function()
{
	$('.alfasintez-catalog-items-detail-ask-form').appendTo('body');

	$('.alfasintez-catalog-items-detail [data-call-ask-form]').on('vclick', function()
	{
		var
			$form       = $('.alfasintez-catalog-items-detail-ask-form'),
			itemtLink   = $form.attr('data-item-link');

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

		$form.getFormElememt({name: $form.attr('data-link-field-id')})
			.setFormElememtParam('value', itemtLink)
			.hide();
	});
});