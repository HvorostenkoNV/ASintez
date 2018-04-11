/* -------------------------------------------------------------------- */
/* ----------------------------- methods ------------------------------ */
/* -------------------------------------------------------------------- */
(function($)
{
	/* ------------------------------------------- */
	/* --------------- show result --------------- */
	/* ------------------------------------------- */
	jQuery.fn.showAlfasintezShopSearchTitleResult = function()
	{
		return this.each(function()
		{
			var
				$search         = $(this).filter('.alfasintez-shop-search-title'),
				$searchResult   = $('.alfasintez-shop-search-title-result[data-search-id="'+$search.attr('data-search-id')+'"]');

			if( $search.length <= 0 || $searchResult.length <= 0 )
				return;

			if( !$searchResult.is(':visible') && $searchResult.children().length > 0 )
				$searchResult
					.positionAlfasintezShopSearchTitleResult()
					.slideDown(600);
		});
	};
	/* ------------------------------------------- */
	/* --------------- hide result --------------- */
	/* ------------------------------------------- */
	jQuery.fn.hideAlfasintezShopSearchTitleResult = function(callback)
	{
		return this.each(function()
		{
			var
				$search         = $(this).filter('.alfasintez-shop-search-title'),
				$searchResult   = $('.alfasintez-shop-search-title-result[data-search-id="'+$search.attr('data-search-id')+'"]'),
				emptyResult     = $searchResult.find('.empty-result').length > 0;

			if( $search.length <= 0 || $searchResult.length <= 0 )
				return;

			if( $searchResult.is(':visible') )
				$searchResult.slideUp(600, function()
				{
					if( emptyResult )
						$searchResult.html('');
				});
		});
	};
	/* ------------------------------------------- */
	/* ------------- position result ------------- */
	/* ------------------------------------------- */
	jQuery.fn.positionAlfasintezShopSearchTitleResult = function()
	{
		return this.each(function()
		{
			var
				$searchResult   = $(this).filter('.alfasintez-shop-search-title-result'),
				$search         = $('.alfasintez-shop-search-title[data-search-id="'+$searchResult.attr('data-search-id')+'"]'),
				searchDOMRect   = $search[0].getBoundingClientRect();

			if( $search.length <= 0 || $searchResult.length <= 0 )
				return;

			$searchResult.css
			({
				'position'  : 'absolute',
				'top'       : searchDOMRect.top + searchDOMRect.height + 3 - $(window).scrollTop(),
				'left'      : searchDOMRect.left,
				'width'     : searchDOMRect.width,
				'z-index'   : 500
			});
		});
	};
})(jQuery);
/* -------------------------------------------------------------------- */
/* ----------------------------- handlers ----------------------------- */
/* -------------------------------------------------------------------- */
$(function()
{
	$('.alfasintez-shop-search-title')
		.on('vclick', function(event)
		{
			if( !$(event.target).is(':text') )
				$(this).find(':text').focus();
		})
		.on('focus', ':text', function()
		{
			$(this).parent()
				.addClass('active')
				.showAlfasintezShopSearchTitleResult();
		})
		.on('focusout', ':text', function()
		{
			$(this).parent()
				.removeClass('active')
				.hideAlfasintezShopSearchTitleResult();
		})
		.on('keyup', ':text', function(event)
		{
			var
				keyCode         = event.keyCode,
				$input          = $(this),
				$search         = $input.parent(),
				$searchResult   = $('.alfasintez-shop-search-title-result[data-search-id="'+$search.attr('data-search-id')+'"]'),
				$selectedItem   = $searchResult.find('a.active'),
				inputValue      = $input.val().length >= 2 ? $input.val() : '';
			if( $searchResult.length <= 0 ) return;
			/* ---------------------------- */
			/* -------- navigation -------- */
			/* ---------------------------- */
			if( (keyCode === 38 || keyCode === 40) && $searchResult.is(':visible') )
			{
				var
					$links          = $searchResult.find('a'),
					links           = [],
					needItemIndex   = 0;

				$links.each(function()
				{
					links.push($(this).attr('href'));
				});

				if( links.length > 0 )
					needItemIndex = links.indexOf($selectedItem.attr('href'));

				if( needItemIndex !== -1 )
				{
					if( keyCode === 40 ) needItemIndex++;
					if( keyCode === 38 ) needItemIndex--;
				}
				if( !links[needItemIndex] )
				{
					if( keyCode === 40 ) needItemIndex = 0;
					if( keyCode === 38 ) needItemIndex = links.length - 1;
				}

				$links
					.removeClass('active')
					.filter('[href="'+links[needItemIndex]+'"]')
					.addClass('active');
			}
			/* ---------------------------- */
			/* -------- item select ------- */
			/* ---------------------------- */
			else if( keyCode === 13 && $selectedItem.length > 0 )
			{
				$selectedItem[0].click();
				AvWaitingScreenOn();
			}
			/* ---------------------------- */
			/* ------- form submit -------- */
			/* ---------------------------- */
			else if( keyCode === 13 && inputValue.length > 0 )
			{
				window.location.replace($search.attr('data-search-page').replace('#SEACRH#', inputValue));
				AvWaitingScreenOn();
			}
			/* ---------------------------- */
			/* ---------- search ---------- */
			/* ---------------------------- */
			else if( inputValue.length > 0 && $input.attr('data-search-value') !== inputValue)
				BX.ajax.post
				(
					'/',
					{
						'ajax_call' : 'y',
						'q'         : inputValue
					},
					function(result)
					{
						var resultContent = result.length > 0
							? result
							: '<div class="empty-result">'+$search.attr('data-empty-result-title')+'</div>';

						$input.attr('data-search-value', inputValue);
						$searchResult.html(resultContent);
						$search.showAlfasintezShopSearchTitleResult();
					}
				);
		});

	$(window).on('scroll resize', function()
	{
		$('.alfasintez-shop-search-title-result:visible')
			.positionAlfasintezShopSearchTitleResult();
	});
});