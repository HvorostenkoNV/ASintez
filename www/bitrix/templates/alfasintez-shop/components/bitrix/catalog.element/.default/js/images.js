$(function()
{
	var
		$imagesBlock                = $('.alfasintez-catalog-items-detail > .images'),
		$mainImage                  = $imagesBlock.find('.main-image'),
		$slider                     = $imagesBlock.find('.slider .slider-block'),
		$imageViewer                = $('.alfasintez-catalog-items-detail-viewer').appendTo('body'),
		$imageViewerMainSlider      = $imageViewer.find('.main-slider     .slider-block'),
		$imageViewerVerticalSlider  = $imageViewer.find('.vertical-slider .slider-block');
	/* -------------------------------------------------------------------- */
	/* ------------------------- slider preparing ------------------------- */
	/* -------------------------------------------------------------------- */
	$slider
		.setAvSlider
		({
			cyclicity           : true,
			slidesCount         : 3,
			slidesBreakpoints   :
			{
				767: 2
			}
		})
		.parent()
			.on('vclick', '.navigation.back', function()
			{
				$slider.slideAvSlider('back');
			})
			.on('vclick', '.navigation.next', function()
			{
				$slider.slideAvSlider('forward');
			});
	/* -------------------------------------------------------------------- */
	/* -------------------------- slider autoplay ------------------------- */
	/* -------------------------------------------------------------------- */
	$slider
		 .slideAutoAvSlider('forward', 5000)
		 .add($mainImage)
			 .hover(function()
			 {
				 $slider.stopSlideAutoAvSlider();
			 })
			 .mouseleave(function()
			 {
				 if( !$imageViewer.is(':visible') )
					 $slider.slideAutoAvSlider('forward', 5000);
			 });
	 $imageViewer
		 .on('imageViewerShow', function()
		 {
			 $slider.stopSlideAutoAvSlider();
		 })
		 .on('imageViewerHide', function()
		 {
			 $slider.slideAutoAvSlider('forward', 5000);
		 });
	$slider
		 .on('sliding-forward-autoplay-end', function()
		 {
			 $mainImage
				 .find('img')
				 .attr
				 (
					 'src',
					 $slider.getAvSliderSlide('first-active').find('img').attr('src')
				 );
		 });
	/* -------------------------------------------------------------------- */
	/* ---------------------- image viewer show/hide ---------------------- */
	/* -------------------------------------------------------------------- */
	$slider.find('img').add($mainImage.find('img'))
		.on('vclick', function()
		{
			AvBlurScreenOn(1000);
			$imageViewer
				.show()
				.positionCenter(1100, 'Y', 'Y')
				.data('calledImageSrc', $(this).attr('src'))
				.trigger('imageViewerShow')
				.onClickout(function()
				{
					$(this).find('.close').click();
				})
				.on('vclick', '.close', function()
				{
					$imageViewer
						.hide()
						.trigger('imageViewerHide');
					AvBlurScreenOff();
				});
		});
	/* -------------------------------------------------------------------- */
	/* ---------------- image viewer main slider preparing ---------------- */
	/* -------------------------------------------------------------------- */
	$imageViewer.on('imageViewerShow', function()
	{
		if( $imageViewerMainSlider.attr('data-slider-seted') !== 'Y' )
			$imageViewerMainSlider
				.attr('data-slider-seted', 'Y')
				.setAvSlider
				({
					cyclicity       : true,
					slideAnimation  : 'fade',
					slidesCount     : 1
				})
				.parent()
					.on('vclick', '.navigation.back', function()
					{
						$imageViewerMainSlider.slideAvSlider('back');
					})
					.on('vclick', '.navigation.next', function()
					{
						$imageViewerMainSlider.slideAvSlider('forward');
					});
	});
	/* -------------------------------------------------------------------- */
	/* -------------- image viewer vertical slider preparing -------------- */
	/* -------------------------------------------------------------------- */
	$imageViewer.on('imageViewerShow', function()
	{
		if($imageViewerVerticalSlider.attr('data-slider-seted') !== 'Y')
			$imageViewerVerticalSlider
				.attr('data-slider-seted', 'Y')
				.setAvSlider
				({
					cyclicity           : true,
					slidesCount         : 5,
					direction           : 'vertical',
					slidesBreakpoints   :
						{
							991: 3
						}
				})
				.parent()
					.on('vclick', '.navigation.back', function()
					{
						$imageViewerVerticalSlider.slideAvSlider('back');
					})
					.on('vclick', '.navigation.next', function()
					{
						$imageViewerVerticalSlider.slideAvSlider('forward');
					});
	});
	/* -------------------------------------------------------------------- */
	/* ------------ image viewer sliders jump to slide on call ------------ */
	/* -------------------------------------------------------------------- */
	$imageViewer.on('imageViewerShow', function()
	{
		var
			calledImageSrc           = $(this).data('calledImageSrc'),
			$mainSliderNeedSlide     = $imageViewerMainSlider    .find('img[src="'+calledImageSrc+'"]').parent(),
			$verticalSliderNeedSlide = $imageViewerVerticalSlider.find('img[src="'+calledImageSrc+'"]').parent();

		$imageViewerMainSlider    .jumpToSlideAvSlider($mainSliderNeedSlide);
		$imageViewerVerticalSlider.jumpToSlideAvSlider($verticalSliderNeedSlide);

		$imageViewerVerticalSlider.children('.item').removeClass('active');
		$verticalSliderNeedSlide                    .addClass('active');
	});
	/* -------------------------------------------------------------------- */
	/* ------------ image viewer on select in vertical slider ------------- */
	/* -------------------------------------------------------------------- */
	$imageViewerVerticalSlider.on('vclick', '.item', function()
	{
		$imageViewerVerticalSlider.children('.item').removeClass('active');
		$(this)                                     .addClass('active');

		$imageViewerMainSlider
			.jumpToSlideAvSlider
			(
				$imageViewerMainSlider
					.find('img[src="'+$(this).find('img').attr('src')+'"]')
					.parent()
			);
	});
});