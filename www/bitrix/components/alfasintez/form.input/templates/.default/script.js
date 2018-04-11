/* -------------------------------------------------------------------- */
/* --------------------- av_form_elements methods --------------------- */
/* -------------------------------------------------------------------- */
(function($)
{
	jQuery.fn.getFormElememtNameInputAlfasintez = function()
	{
		return this.find(':text').attr('name');
	};
	jQuery.fn.setFormElememtNameInputAlfasintez = function(value)
	{
		this.find(':text').attr('name', value);
	};
	jQuery.fn.getFormElememtValueInputAlfasintez = function()
	{
		return this.find(':text').val();
	};
	jQuery.fn.setFormElememtValueInputAlfasintez = function(value)
		{
		this.find(':text')
			.attr('value', value)
			.val(value);
		};
	jQuery.fn.getFormElememtRequiredInputAlfasintez = function()
	{
		return this.hasClass('required');
	};
	jQuery.fn.setFormElememtRequiredInputAlfasintez = function(value)
		{
		     if( value == 'on' )   this.addClass('required');
		else if( value == 'off' )  this.removeClass('required');
		};
	jQuery.fn.getFormElememtAlertInputAlfasintez = function()
	{
		return this.hasClass('alert-input');
	};
	jQuery.fn.setFormElememtAlertInputAlfasintez = function(value)
		{
		     if( value == 'on' )  this.addClass('alert-input');
		else if( value == 'off' ) this.removeClass('alert-input');
		};
})(jQuery);
/* -------------------------------------------------------------------- */
/* ------------- 'av_form_elements' methods registration -------------- */
/* -------------------------------------------------------------------- */
SetFormElementsFunction('alfasintez', 'input', 'getFormElememtName',     'getFormElememtNameInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'setFormElememtName',     'setFormElememtNameInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'getFormElememtValue',    'getFormElememtValueInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'setFormElememtValue',    'setFormElememtValueInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'getFormElememtRequired', 'getFormElememtRequiredInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'setFormElememtRequired', 'setFormElememtRequiredInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'getFormElememtAlert',    'getFormElememtAlertInputAlfasintez');
SetFormElementsFunction('alfasintez', 'input', 'setFormElememtAlert',    'setFormElememtAlertInputAlfasintez');