$(function()
{
	setTimeout(function()
	{
		$('.alfasintez-catalog-items-slider .slider-block')
			.setAvSlider
			({
				cyclicity           : true,
				slidesCount         : 4,
				slidesBreakpoints   :
				{
					1199    : 3,
					991     : 2,
					768     : 1
				}
			})
			.hover(function()
			{
				$(this).slideAutoAvSlider('forward', 2000);
			})
			.mouseleave(function()
			{
				$(this).stopSlideAutoAvSlider();
			})
			.parent()
				.on('vclick', '.navigation.prev', function()
				{
					$(this).parent().find('.slider-block').slideAvSlider('back');
				})
				.on('vclick', '.navigation.next', function()
				{
					$(this).parent().find('.slider-block').slideAvSlider('forward');
				});
	}, 500);
});