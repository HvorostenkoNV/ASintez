$(function()
{
	$('.alfasintez-catalog-sections-slider').each(function()
	{
		var
			$sliderBlock    = $(this).find('.slider-block'),
			$navBack        = $(this).find('.navigation.prev'),
			$navForward     = $(this).find('.navigation.next');

		$sliderBlock
			.on('slidingForwardUnable', function() {$navForward.css('visibility', 'hidden')})
			.on('slidingForwardEnable', function() {$navForward.css('visibility', 'visible')})
			.on('slidingBackUnable',    function() {$navBack   .css('visibility', 'hidden')})
			.on('slidingBackEnable',    function() {$navBack   .css('visibility', 'visible')})
			.setAvSlider
			({
				slidesCount      : 5,
				slidesBreakpoints:
				{
					991: 3,
					767: 2
				}
			});
		$navForward.on('vclick', function() {$sliderBlock.slideAvSlider('forward')});
		$navBack   .on('vclick', function() {$sliderBlock.slideAvSlider('back')});
	});
});