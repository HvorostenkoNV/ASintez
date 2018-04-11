/* -------------------------------------------------------------------- */
/* --------------------- av_form_elements methods --------------------- */
/* -------------------------------------------------------------------- */
(function($)
	{
	jQuery.fn.getFormElememtNameRadioAlfasintez = function()
	{
		return this.find(':radio').attr('name');
	};
	jQuery.fn.setFormElememtNameRadioAlfasintez = function(value)
	{
		this.find(':radio').attr('name', value);
	};
	jQuery.fn.getFormElememtValueRadioAlfasintez = function()
		{
		var
			$parent = this.closest('form'),
			$radio  = this.find(':radio');

		if( !$parent.length )
			$parent = this.parent();

		return $parent
			.find(':radio[name="'+$radio.attr('name')+'"]:checked')
			.length;
		};
	jQuery.fn.setFormElememtValueRadioAlfasintez = function(value)
		{
		var
			$parent = this.closest('form'),
			$radio  = this.find(':radio');

		if( !$parent.length )
			$parent = this.parent();

		$parent.find(':radio[name="'+$radio.attr('name')+'"]')
			.removeAttr('checked')
			.prop('checked', false)
			.parent()
				.removeClass('checked');

		if( value === true )
		{
			this.addClass('checked');
			$radio.attr('checked', true).prop('checked', true);
		}

		$radio.trigger('change');
		};
	jQuery.fn.getFormElememtRequiredRadioAlfasintez = function()
	{
		return this.hasClass('required');
	};
	jQuery.fn.setFormElememtRequiredRadioAlfasintez = function(value)
		{
		     if( value == 'on' )  this.addClass('required');
		else if( value == 'off' ) this.removeClass('required');
		};
	jQuery.fn.getFormElememtAlertRadioAlfasintez = function()
	{
		return this.hasClass('alert-input');
	};
	jQuery.fn.setFormElememtAlertRadioAlfasintez = function(value)
		{
		     if( value == 'on' )  this.addClass('alert-input');
		else if( value == 'off' ) this.removeClass('alert-input');
		};
	})(jQuery);
/* -------------------------------------------------------------------- */
/* ------------- 'av_form_elements' methods registration -------------- */
/* -------------------------------------------------------------------- */
SetFormElementsFunction('alfasintez', 'radio', 'getFormElememtName',     'getFormElememtNameRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'setFormElememtName',     'setFormElememtNameRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'getFormElememtValue',    'getFormElememtValueRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'setFormElememtValue',    'setFormElememtValueRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'getFormElememtRequired', 'getFormElememtRequiredRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'setFormElememtRequired', 'setFormElememtRequiredRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'getFormElememtAlert',    'getFormElememtAlertRadioAlfasintez');
SetFormElementsFunction('alfasintez', 'radio', 'setFormElememtAlert',    'setFormElememtAlertRadioAlfasintez');
/* -------------------------------------------------------------------- */
/* ----------------------------- handlers ----------------------------- */
/* -------------------------------------------------------------------- */
$(function()
{
	$(document).on('vclick', '.alfasintez-form-radio', function()
	{
		$(this).setFormElememtValueRadioAlfasintez(true);
	});
});