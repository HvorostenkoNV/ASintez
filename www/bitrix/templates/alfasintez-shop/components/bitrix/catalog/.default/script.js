$(function()
{
	$(document).on('CATALOG_FILTER_APPLIED', function()
	{
		var
			offers      			= $(this).data('CATALOG_FILTERED_OFFERS'),
			$itemsList  			= $('.alfasintez-catalog > .right-col > .items-list'),
			startTime				= Date.now(),
			operationDuration		= 0,
			preloaderLifeMinTime	= 1500;

		AvWaitingScreenOn();
		$.ajax
		({
			type    : 'POST',
			url     : AlfasintezCatalogSectionListRefresh,
			data    :
			{
				'component-params'  : $itemsList.attr('data-catalog-section-params'),
				'offers'            : offers
			},
			success : function(result)
			{
				$itemsList.html(result);
			},
			complete: function()
			{
                operationDuration = Date.now() - startTime;

                if( operationDuration >= preloaderLifeMinTime )
                    AvWaitingScreenOff();
                else
					setTimeout(function()
					{
						AvWaitingScreenOff();
					}, preloaderLifeMinTime - operationDuration);
			}
		});
	});
});