/* -------------------------------------------------------------------- */
/* --------------------- av_form_elements methods --------------------- */
/* -------------------------------------------------------------------- */
(function($)
	{
	jQuery.fn.getFormElememtNameCheckboxAlfasintez = function()
	{
		return this.find(':checkbox').attr('name');
	};
	jQuery.fn.setFormElememtNameCheckboxAlfasintez = function(value)
	{
		this.find(':checkbox').attr('name', value);
	};
	jQuery.fn.getFormElememtValueCheckboxAlfasintez = function()
		{
		var
			$parent     = this.closest('form'),
			$checkbox   = this.find(':checkbox');

		if( !$parent.length )
			$parent = this.parent();

		return $parent
			.find(':checkbox[name="'+$checkbox.attr('name')+'"]:checked')
			.length;
		};
	jQuery.fn.setFormElememtValueCheckboxAlfasintez = function(value)
		{
		var $checkbox = this.find(':checkbox');

		if( value === true )
		{
			this.addClass('checked');
			$checkbox.attr('checked', true).prop('checked', true);
		}
		else
		{
			this.removeClass('checked');
			$checkbox.removeAttr('checked').prop('checked', false);
		}

		$checkbox.trigger('change');
		};
	jQuery.fn.getFormElememtRequiredCheckboxAlfasintez = function()
	{
		return this.hasClass('required');
	};
	jQuery.fn.setFormElememtRequiredCheckboxAlfasintez = function(value)
		{
		     if( value == 'on' )  this.addClass('required');
		else if( value == 'off' ) this.removeClass('required');
		};
	jQuery.fn.getFormElememtAlertCheckboxAlfasintez = function()
	{
		return this.hasClass('alert-input');
	};
	jQuery.fn.setFormElememtAlertCheckboxAlfasintez = function(value)
		{
		     if( value == 'on' )  this.addClass('alert-input');
		else if( value == 'off' ) this.removeClass('alert-input');
		};
	})(jQuery);
/* -------------------------------------------------------------------- */
/* ------------- 'av_form_elements' methods registration -------------- */
/* -------------------------------------------------------------------- */
SetFormElementsFunction('alfasintez', 'checkbox', 'getFormElememtName',     'getFormElememtNameCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'setFormElememtName',     'setFormElememtNameCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'getFormElememtValue',    'getFormElememtValueCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'setFormElememtValue',    'setFormElememtValueCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'getFormElememtRequired', 'getFormElememtRequiredCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'setFormElememtRequired', 'setFormElememtRequiredCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'getFormElememtAlert',    'getFormElememtAlertCheckboxAlfasintez');
SetFormElementsFunction('alfasintez', 'checkbox', 'setFormElememtAlert',    'setFormElememtAlertCheckboxAlfasintez');
/* -------------------------------------------------------------------- */
/* ----------------------------- handlers ----------------------------- */
/* -------------------------------------------------------------------- */
$(function()
{
	$(document).on('vclick', '.alfasintez-form-checkbox', function()
	{
		$(this).setFormElememtValueCheckboxAlfasintez(!$(this).getFormElememtValueCheckboxAlfasintez());
	});
});