$(function()
{
	/* -------------------------------------------------------------------- */
	/* --------------------------- smart filter --------------------------- */
	/* -------------------------------------------------------------------- */
	$('.alfasintez-smart-filter').on('change', ':checkbox, :radio', function()
	{
		var
			$filter     = $(this).closest('.alfasintez-smart-filter'),
			formData    = {};

		$filter.find(':checkbox:checked, :radio:checked').each(function()
		{
			formData[$(this).attr('name')] = $(this).attr('value');
		});

		$filter.addClass('in-process');
		$.ajax
		({
			type    : 'POST',
			url     : AlfasintezCatalogSmartFilterQueryItems,
			data    :
			{
				'iblock-id'         : $filter.attr('data-iblock-id'),
				'offers-iblock-id'  : $filter.attr('data-offers-iblock-id'),
				'section-id'        : $filter.attr('data-section-id'),
				'filter-url'        : $filter.attr('data-filter-url'),
				'filter-name'       : $filter.attr('data-filter-name'),
				'values'            : formData
			},
			success : function(result)
			{
				var
					jsonAnswer  = {},
					items       = [],
					offers      = [],
					filterUrl   = '';

				try             {jsonAnswer = JSON.parse(result);}
				catch( error )  {}

				if( jsonAnswer.hasOwnProperty('ITEMS') && Array.isArray(jsonAnswer.ITEMS) )
					items = jsonAnswer.ITEMS;
				if( jsonAnswer.hasOwnProperty('OFFERS') && Array.isArray(jsonAnswer.OFFERS) )
					offers = jsonAnswer.OFFERS;
				if( jsonAnswer.hasOwnProperty('URL') && typeof jsonAnswer.URL === 'string' )
					filterUrl = jsonAnswer.URL;
				if( !filterUrl.length )
					filterUrl = $filter.attr('data-clear-filter-url');

				if( items.length > 0 || offers.length > 0 )
				{
					$(document).data('CATALOG_FILTERED_ITEMS',  items);
					$(document).data('CATALOG_FILTERED_OFFERS', offers);
					$(document).trigger('CATALOG_FILTER_APPLIED');
					window.history.pushState('', '', filterUrl);
				}
			},
			complete: function()
			{
                setTimeout(function(){
                	$filter.removeClass('in-process');
                }, 2000);

			}
		});
	});

    /* -------------------------------------------------------------------- */
    /* ------------------------ add / remove close ------------------------ */
    /* -------------------------------------------------------------------- */
    $(".alfasintez-smart-filter .open-button").on('vclick', function(){
        var
            $block  = $(this).closest('.field-block'),
            $body   = $block.find('.body');

        if( $body.is(':visible') )
        {
            $block.addClass('closed');
            $body.show().slideUp();
        }
        else
        {
            $block.removeClass('closed');
            $body.hide().slideDown();
        }
    });
});