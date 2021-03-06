/* -------------------------------------------------------------------- */
/* ---------------------------- variables ----------------------------- */
/* -------------------------------------------------------------------- */
AV_FORM_ELEMENTS_CURRENT_LIB = "basic";
AV_FORM_ELEMENTS_LIBRARIES   =
	{
	"basic":
		{
		"input":
			{
			"getFormElememtName"    : "getFormElememtNameInput",
			"setFormElememtName"    : "setFormElememtNameInput",

			"getFormElememtValue"   : "getFormElememtValueInput",
			"setFormElememtValue"   : "setFormElememtValueInput",

			"getFormElememtRequired": "getFormElememtRequiredInput",
			"setFormElememtRequired": "setFormElememtRequiredInput",

			"getFormElememtAlert"   : "getFormElememtAlertInput",
			"setFormElememtAlert"   : "setFormElememtAlertInput"
			}
		}
	};
/* -------------------------------------------------------------------- */
/* ----------------------------- functions ---------------------------- */
/* -------------------------------------------------------------------- */
function SetFormElementsFunction(libraryType, inputType, functionType, functionName)
	{
	if(!libraryType || !inputType || !functionType || !functionName)
		{
		console.log("SetFormElementsFunction - params required: libraryType, inputType, functionType, functionName");
		return;
		}

	if(!AV_FORM_ELEMENTS_LIBRARIES[libraryType])            AV_FORM_ELEMENTS_LIBRARIES[libraryType]            = {};
	if(!AV_FORM_ELEMENTS_LIBRARIES[libraryType][inputType]) AV_FORM_ELEMENTS_LIBRARIES[libraryType][inputType] = {};
	AV_FORM_ELEMENTS_LIBRARIES[libraryType][inputType][functionType] = functionName;
	}
function GetFormElementsFunction(libraryType, inputType, functionType)
	{
	var result = AV_FORM_ELEMENTS_LIBRARIES[libraryType];
	if(result) result = result[inputType];
	if(result) result = result[functionType];

	if(!result)
		{
		console.log("AvFormElements - "+libraryType+" - "+inputType+" - "+functionType+" - no function registered");
		return;
		}

	return result;
	}
/* -------------------------------------------------------------------- */
/* ---------------------- "basic" library methods --------------------- */
/* -------------------------------------------------------------------- */
(function($)
	{
	/* ------------------------------------------- */
	/* ------------------ input ------------------ */
	/* ------------------------------------------- */
	jQuery.fn.getFormElememtNameInput     = function()      {return this.attr("name")};
	jQuery.fn.setFormElememtNameInput     = function(value) {this.attr("name", value)};
	jQuery.fn.getFormElememtValueInput    = function()      {return this.val()};
	jQuery.fn.setFormElememtValueInput    = function(value) {this.attr("value", value).val(value)};
	jQuery.fn.getFormElememtRequiredInput = function()      {return this.attr("requiredfield")};
	jQuery.fn.setFormElememtRequiredInput = function(value)
		{
		if(value == "on")  this.attr("requiredfield", true);
		if(value == "off") this.removeAttr("requiredfield");
		};
	jQuery.fn.getFormElememtAlertInput    = function()      {return this.attr("input-alert")};
	jQuery.fn.setFormElememtAlertInput    = function(value)
		{
		if(value == "on")  this.attr("input-alert", true);
		if(value == "off") this.removeAttr("input-alert");
		};
	})(jQuery);
/* -------------------------------------------------------------------- */
/* --------------------------- work methods --------------------------- */
/* -------------------------------------------------------------------- */
(function($)
	{
	/* ------------------------------------------- */
	/* ------------ get form element ------------- */
	/* ------------------------------------------- */
	jQuery.fn.getFormElememt = function(searchParams)
		{
		var
			searchParams = $.extend({}, searchParams),
			result       = this.find("[data-av-form-item]");

		if(searchParams.type)      result = result.filter("[data-av-form-item=\""+searchParams.type+"\"]");
		if(searchParams.attribute) result = result.filter("["+searchParams.attribute+"]");

		if(searchParams.name && result)
			{
			var newResult = $();
			result.each(function()
				{
				if($(this).getFormElememtParam("name") == searchParams.name)
					{
					if(!newResult) newResult = $(this);
					else           newResult = $(newResult).add($(this));
					}
				});
			result = newResult;
			}

		return result;
		};
	/* ------------------------------------------- */
	/* -------------- get parameter -------------- */
	/* ------------------------------------------- */
	jQuery.fn.getFormElememtParam = function(paramType)
		{
		var
			library      = this.attr("data-av-form-library"),
			inputType    = this.attr("data-av-form-item"),
			functionName = "";

		switch(paramType)
			{
			case "name"    : functionName = "getFormElememtName";    break;
			case "value"   : functionName = "getFormElememtValue";   break;
			case "required": functionName = "getFormElememtRequired";break;
			case "alert"   : functionName = "getFormElememtAlert";   break;
			}

		if(functionName) functionName = GetFormElementsFunction(library, inputType, functionName);
		if(functionName) return this.first()[functionName]();
		};
	/* ------------------------------------------- */
	/* -------------- set parameter -------------- */
	/* ------------------------------------------- */
	jQuery.fn.setFormElememtParam = function(paramType, value)
		{
		return this.each(function()
			{
			var
				library      = $(this).attr("data-av-form-library"),
				inputType    = $(this).attr("data-av-form-item"),
				functionName = "";

			switch(paramType)
				{
				case "name"    : functionName = "setFormElememtName";    break;
				case "value"   : functionName = "setFormElememtValue";   break;
				case "required": functionName = "setFormElememtRequired";break;
				case "alert"   : functionName = "setFormElememtAlert";   break;
				}

			if(functionName) functionName = GetFormElementsFunction(library, inputType, functionName);
			if(functionName) $(this)[functionName](value);
			});
		};
	/* ------------------------------------------- */
	/* ---------- check form validation ---------- */
	/* ------------------------------------------- */
	jQuery.fn.checkFormValidation = function()
		{
		var
			$form          = this,
			valuesArray    = {},
			formValidation = true;

		$form.getFormElememt().each(function()
			{
			$(this).setFormElememtParam("alert", "off");
			if(!$(this).getFormElememtParam("required")) return true;

			var
				fieldName  = $(this).getFormElememtParam("name"),
				fieldValue = $(this).getFormElememtParam("value");

			if(!valuesArray[fieldName]) valuesArray[fieldName] = [];
			if(fieldValue)              valuesArray[fieldName].push(fieldValue);
			});

		$.each(valuesArray, function(index, value)
			{
			if(value[0]) return true;
			$form.getFormElememt({"name": index}).each(function() {$(this).setFormElememtParam("alert", "on")});
			formValidation = false;
			});

		return formValidation;
		};
	})(jQuery);