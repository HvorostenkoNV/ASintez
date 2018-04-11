/* -------------------------------------------------------------------- */
/* --------------------- autolide interval object --------------------- */
/* -------------------------------------------------------------------- */
avSlideresInterval = {};
/* -------------------------------------------------------------------- */
/* --------------------------- params info ---------------------------- */
/* -------------------------------------------------------------------- */
avSliderParamsInfo =
	[
		{
		"name"         : "slidesCount",
		"attributeName": "data-slides-count",
		"type"         : "integer",
		"defaultValue" : 1
		},
		{
		"name"         : "slidesPerIteration",
		"attributeName": "data-slides-per-iteration",
		"type"         : "integer",
		"defaultValue" : 1
		},
		{
		"name"         : "slideAnimation",
		"attributeName": "data-slide-animation",
		"type"         : "array",
		"values"       : ["slide", "fade"],
		"defaultValue" : "slide"
		},
		{
		"name"         : "direction",
		"attributeName": "data-direction",
		"type"         : "array",
		"values"       : ["horizontal", "vertical"],
		"defaultValue" : "horizontal"
		},
		{
		"name"         : "cyclicity",
		"attributeName": "data-cyclicity",
		"type"         : "boolean",
		"defaultValue" : false
		}
	];
/* -------------------------------------------------------------------- */
/* ----------------------------- methods ------------------------------ */
/* -------------------------------------------------------------------- */
(function($)
	{
	/* =========================================== */
	/* =============== set slider ================ */
	/* =========================================== */
	$.fn.setAvSlider = function(params)
		{
		return this.each(function()
			{
			$(this)
				.addClass("av-slider")
				.children()
					.addClass("av-slider-slide");

			if(typeof params === "object") $(this).setAvSliderParams(params);
			});
		};
	/* =========================================== */
	/* ================ set params =============== */
	/* =========================================== */
	$.fn.setAvSliderParams = function(params)
		{
		var
			sliderParams            = typeof params                         === "object" ? params                         : {},
			slidesBreakpoints       = typeof sliderParams.slidesBreakpoints === "object" ? sliderParams.slidesBreakpoints : {},
			slidesBreakpointsArray  = [],
			result                  = [];
		/* ---------------------------- */
		/* --------- checking --------- */
		/* ---------------------------- */
		avSliderParamsInfo.forEach(function(paramInfo)
			{
			if(typeof paramInfo != "object" || !paramInfo.name || !paramInfo.attributeName) return;

			var
				getedValue      = sliderParams[paramInfo.name],
			    checkedValue    = null,
				arrayValues     = Array.isArray(paramInfo.values) ? paramInfo.values : [],
				defaultValue    = paramInfo.defaultValue;

			switch(paramInfo.type)
				{
				case "integer":
					checkedValue = parseInt(getedValue);
					if(!checkedValue)                                       checkedValue = parseInt(defaultValue);
					if(!checkedValue || typeof checkedValue !== "number")   checkedValue = 1;
					break;
				case "array":
					checkedValue = getedValue;
					if($.inArray(checkedValue, arrayValues) == -1)          checkedValue = defaultValue;
					if(!checkedValue || typeof checkedValue !== "string")   checkedValue = "";
					break;
				case "boolean":
					checkedValue = getedValue === true ? "Y" : "N";
					break;
				default:
					break;
				}

			result.push
				({
				"attr" : paramInfo.attributeName,
				"value": checkedValue
				});
			});
		/* ---------------------------- */
		/* ----- breakpoints param ---- */
		/* ---------------------------- */
		$.each(slidesBreakpoints, function(index, value)
			{
			slidesBreakpointsArray.push(index+":"+value);
			});
		result.push
			({
			"attr" : "data-slides-breakpoints",
			"value": slidesBreakpointsArray.join(";")
			});
		/* ---------------------------- */
		/* --------- setting ---------- */
		/* ---------------------------- */
		return this.each(function()
			{
			var $slider = $(this).filter(".av-slider");

			result.forEach(function(attrInfo)
				{
				$slider.attr(attrInfo.attr, attrInfo.value);
				});

			$slider.buildAvSlider();
			});
		};
	/* =========================================== */
	/* ================ get params =============== */
	/* =========================================== */
	$.fn.getAvSliderParams = function()
		{
		var
			$slider                 = this.filter(".av-slider"),
			result                  = {"slidesBreakpoints": {}},
			windowWidth             = $(window).width(),
			slidesBreakpointsArray  = [],
			breakpointsValues       = $slider.attr("data-slides-breakpoints").split(";");
		/* ---------------------------- */
		/* --------- checking --------- */
		/* ---------------------------- */
		avSliderParamsInfo.forEach(function(paramInfo)
			{
			if(typeof paramInfo != "object" || !paramInfo.name || !paramInfo.attributeName || !paramInfo.type) return;
			var
				getedValue      = $slider.attr(paramInfo.attributeName),
				checkedValue    = null,
				arrayValues     = Array.isArray(paramInfo.values) ? paramInfo.values : [],
				defaultValue    = paramInfo.defaultValue;

			switch(paramInfo.type)
				{
				case "integer":
					checkedValue = parseInt(getedValue);
					if(!checkedValue)                                       checkedValue = defaultValue;
					if(!checkedValue || typeof checkedValue !== "number")   checkedValue = 1;
					break;
				case "array":
					checkedValue = getedValue;
					if($.inArray(checkedValue, arrayValues) == -1)          checkedValue = defaultValue;
					if(!checkedValue || typeof checkedValue !== "string")   checkedValue = "";
					break;
				case "boolean":
					checkedValue = getedValue == "Y";
					break;
				default:
					break;
				}

			result[paramInfo.name] =
				{
				"value"       : checkedValue,
				"values"      : arrayValues,
				"defaultValue": defaultValue
				};
			});
		/* ---------------------------- */
		/* ----- breakpoints param ---- */
		/* ---------------------------- */
		if(!Array.isArray(breakpointsValues)) breakpointsValues = [];
		breakpointsValues.forEach(function(value)
			{
			var
				valueExplode            = value.split(":"),
				breakpouintValue        = parseInt(valueExplode[0]),
				breakpouintSlidesCount  = parseInt(valueExplode[1]);
			if(!breakpouintValue || !breakpouintSlidesCount) return;

			result.slidesBreakpoints[breakpouintValue] = breakpouintSlidesCount;
			});
		$.each(result.slidesBreakpoints, function(index)
			{
			slidesBreakpointsArray.push(index);
			});
		slidesBreakpointsArray
			.sort(function(a, b) {return b - a})
			.forEach(function(value)
				{
				if(windowWidth <= value)
					result.slidesCount.value = result.slidesBreakpoints[value];
				});
		/* ---------------------------- */
		/* ---------- result ---------- */
		/* ---------------------------- */
		return result;
		};
	/* =========================================== */
	/* ============== build slider =============== */
	/* =========================================== */
	$.fn.buildAvSlider = function()
		{
		return this.each(function()
			{
			var
				$slider         = $(this).filter(".av-slider"),
			    $slides         = $slider.find(".av-slider-slide"),
				sliderParams    = $slider.getAvSliderParams(),
				randomString    = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

			$slides
				.each(function()
					{
					$(this).attr("data-slide-id", $(this).index() + 1);
					});
			$slider
				.css
					({
					"display"           : "flex",
					"overflow"          : "hidden",
					"flex-direction"    : sliderParams.direction.value == "vertical" ? "column" : "row"
					})
				.attr("data-slides-display-type", $slides.css("display"))
				.attr("data-slider-id", randomString)
				.setAvSliderSlidesCount();
			});
		};
	/* =========================================== */
	/* ============= set slides count ============ */
	/* =========================================== */
	$.fn.setAvSliderSlidesCount = function(value)
		{
		var valueSeted = parseInt(value);

		return this.each(function()
			{
			var
				$slider             = $(this).filter(".av-slider"),
				$slides             = $slider.find(".av-slider-slide"),
				$slideFirstActive   = $slides.filter(".slide-active").length ? $slides.filter(".slide-active").first() : $slides.first(),
				slideDisplayType    = $slider.attr("data-slides-display-type"),
				sliderParams        = $slider.getAvSliderParams(),
				slidesCount         = valueSeted ? valueSeted : sliderParams.slidesCount.value,
				slideWidth          = 0,
				slideHeight         = 0,
				slideWidthArray     = [],
				slideHeightArray    = [],
				slidesActiveNew     = [];
			if($slider.attr("data-in-process") == "Y" || !$slider.is(":visible")) return;
			/* ---------------------------- */
			/* ---------- start ----------- */
			/* ---------------------------- */
			$slides
				.css
					({
					"display": slideDisplayType,
					"width"  : "",
					"height" : ""
					})
				.each(function()
					{
					slideWidthArray .push($(this).width());
					slideHeightArray.push($(this).height());
					});
			/* ---------------------------- */
			/* ----- slide size calc ------ */
			/* ---------------------------- */
			if(sliderParams.direction.value == "horizontal")
				{
				slideWidth  = ($slider.width()  - (parseFloat($slideFirstActive.css("margin-left")) + parseFloat($slideFirstActive.css("margin-right")))  * slidesCount) / slidesCount;
				slideHeight = Math.max.apply(Math, slideHeightArray);
				}
			else
				{
				slideHeight = ($slider.height() - (parseFloat($slideFirstActive.css("margin-top"))  + parseFloat($slideFirstActive.css("margin-bottom"))) * slidesCount) / slidesCount;
				slideWidth  = Math.max.apply(Math, slideWidthArray);
				}
			/* ---------------------------- */
			/* -- new active slides calc -- */
			/* ---------------------------- */
			var $currentSlide = $slideFirstActive;

			while(slidesActiveNew.length < slidesCount && $currentSlide.length)
				{
				slidesActiveNew.push($currentSlide.attr("data-slide-id"));
				$currentSlide = $currentSlide.next();
				if(!$currentSlide.length) $currentSlide = $slideFirstActive.prev();
				}
			/* ---------------------------- */
			/* ----------- end ------------ */
			/* ---------------------------- */
			$slides
				.css
					({
					"width" : slideWidth,
					"height": slideHeight
					})
				.addClass("slide-active")
				.each(function()
					{
					if($.inArray($(this).attr("data-slide-id"), slidesActiveNew) == -1)
						$(this)
							.hide()
							.removeClass("slide-active");
					});
			$slider
				.controlAvSliderCondition();
			});
		};
	/* =========================================== */
	/* ============ control condition ============ */
	/* =========================================== */
	$.fn.controlAvSliderCondition = function()
		{
		return this.each(function()
			{
			var
				$slider                 = $(this).filter(".av-slider"),
				$slides                 = $slider.find(".av-slider-slide"),
				$slidesActive           = $slides.filter(".slide-active"),
				sliderParams            = $slider.getAvSliderParams(),
				slidingForwardUnable    = !sliderParams.cyclicity.value && $slidesActive.last() .next().length <= 0,
				slidingBackUnable       = !sliderParams.cyclicity.value && $slidesActive.first().prev().length <= 0,
			    notEnoughSlides         = $slides.length < sliderParams.slidesCount.value;

			$slider
				.attr("data-sliding-forward-enable",  slidingForwardUnable  || notEnoughSlides ? "N" : "Y")
				.attr("data-sliding-back-enabled",    slidingBackUnable     || notEnoughSlides ? "N" : "Y");

			if(slidingForwardUnable)    $slider.trigger("slidingForwardUnable");
			else                        $slider.trigger("slidingForwardEnable");
			if(slidingBackUnable)       $slider.trigger("slidingBackUnable");
			else                        $slider.trigger("slidingBackEnable");
			});
		};
	/* =========================================== */
	/* ================== slide ================== */
	/* =========================================== */
	$.fn.slideAvSlider = function(direction, animation, count, autoplay)
		{
		var
			slideDirection  = $.inArray(direction, ["back", "forward"]) == -1 ? "forward" : direction,
			slidesCount     = parseInt(count),
			caledByAutoplay = autoplay === true;

		return this.each(function()
			{
			var
				$slider                 = $(this).filter(".av-slider"),
				$slides                 = $slider.find(".av-slider-slide"),
				$slidesActive           = $slides.filter(".slide-active"),
				sliderParams            = $slider.getAvSliderParams(),
				slideDisplayType        = $slider.attr("data-slides-display-type"),
				slidesPerIteration      = slidesCount ? slidesCount : sliderParams.slidesPerIteration.value,
				slideAnimationType      = $.inArray(animation, sliderParams.slideAnimation.values) == -1
					? sliderParams.slideAnimation.value
					: animation,
				slideSize               = sliderParams.direction.value == "horizontal"
					? parseFloat($slider.width())  / sliderParams.slidesCount.value
					: parseFloat($slider.height()) / sliderParams.slidesCount.value,
				newActiveSlidesArray    = [],
				triggerNameStart        = "",
				triggerNameEnd          = "";
			/* ---------------------------- */
			/* ------ breaking action ----- */
			/* ---------------------------- */
			if(!$slider.length || !$slides.length || $slider.attr("data-in-process") == "Y")        return;
			if(!sliderParams.cyclicity.value && $slides.length < sliderParams.slidesCount.value)    return;
			if(slideDirection == "forward" && $slider.attr("data-sliding-forward-enabled")  == "N") return;
			if(slideDirection == "back"    && $slider.attr("data-sliding-back-enabled")     == "N") return;
			/* ---------------------------- */
			/* -------- action name ------- */
			/* ---------------------------- */
			if(slideDirection == "forward"      && !caledByAutoplay)
				{
				triggerNameStart   = "sliding-forward-start";
				triggerNameEnd     = "sliding-forward-end";
				}
			else if(slideDirection == "forward" &&  caledByAutoplay)
				{
				triggerNameStart   = "sliding-forward-autoplay-start";
				triggerNameEnd     = "sliding-forward-autoplay-end";
				}
			else if(slideDirection == "back"    && !caledByAutoplay)
				{
				triggerNameStart   = "sliding-back-start";
				triggerNameEnd     = "sliding-back-end";
				}
			else if(slideDirection == "back"    &&  caledByAutoplay)
				{
				triggerNameStart   = "sliding-back-autoplay-start";
				triggerNameEnd     = "sliding-back-autoplay-end";
				}
			/* ---------------------------- */
			/* ------ cyclicity case ------ */
			/* ---------------------------- */
			if(sliderParams.cyclicity.value)
				{
				var $currentSlide = slideDirection == "forward" ? $slides.first() : $slides.last();

				for(var $i = 1;$i <= slidesPerIteration;$i++)
					{
					var $newSlide = $currentSlide.clone();

					$newSlide.hide().removeClass("slide-active");
					if(slideDirection == "forward") $newSlide.appendTo($slider);
					else                            $newSlide.prependTo($slider);

					$currentSlide.addClass("av-slider-slide-temp");
					$currentSlide = slideDirection == "forward" ? $currentSlide.next() : $currentSlide.prev();
					}

				$slides = $slider.find(".av-slider-slide");
				}
			/* ---------------------------- */
			/* -- new active slides calc -- */
			/* ---------------------------- */
			var
				newActiveSlideFirstIndex = slideDirection == "forward"
					? $slidesActive.first().index() + slidesPerIteration
					: $slidesActive.last() .index() - slidesPerIteration - sliderParams.slidesCount.value + 1,
				newActiveSlideLastIndex  = slideDirection == "forward"
					? $slidesActive.first().index() + slidesPerIteration + sliderParams.slidesCount.value
					: $slidesActive.last() .index() - slidesPerIteration + 1;

			if(newActiveSlideFirstIndex < 0)
				{
				newActiveSlideFirstIndex = 0;
				newActiveSlideLastIndex  = sliderParams.slidesCount.value;
				slidesPerIteration       = $slidesActive.first().index();
				}
			if(newActiveSlideLastIndex > $slides.last().index())
				{
				newActiveSlideFirstIndex = $slides.last().index() - sliderParams.slidesCount.value + 1;
				newActiveSlideLastIndex  = $slides.last().index() + 1;
				slidesPerIteration       = $slides.last().index() - $slidesActive.last().index();
				}

			$slides
				.slice(newActiveSlideFirstIndex, newActiveSlideLastIndex)
				.each(function()
					{
					newActiveSlidesArray.push($(this).attr("data-slide-id"));
					});
			/* ---------------------------- */
			/* ----------- start ---------- */
			/* ---------------------------- */
			$slider
				.attr("data-in-process", "Y")
				.trigger(triggerNameStart)
				.css
					({
					"position"  : "relative",
					"width"     : $slider.width(),
					"height"    : $slider.height()
					});
			/* ---------------------------- */
			/* ------ animation slide ----- */
			/* ---------------------------- */
			if(slideAnimationType == "slide")
				$slides.each(function()
					{
					var
						cssParamType    = sliderParams.direction.value == "horizontal" ? "left" : "top",
						valueStart      = slideSize * ($(this).index() - $slidesActive.first().index()),
						valueEnd        = valueStart,
						startCss        =
							{
							"display" : slideDisplayType,
							"position": "absolute"
							},
						animateCss      = {};

					for($i = 1;$i <= slidesPerIteration;$i++)
						{
						if(slideDirection == "forward") valueEnd -= slideSize;
						else                            valueEnd += slideSize;
						}

					startCss  [cssParamType] = valueStart+"px";
					animateCss[cssParamType] = valueEnd  +"px";

					$(this)
						.css(startCss)
						.animate(animateCss, 600);
					});
			/* ---------------------------- */
			/* ------ animation fade ------ */
			/* ---------------------------- */
			if(slideAnimationType == "fade")
				{
				var $slidesToShow = $();

				newActiveSlidesArray.forEach(function(slideId, index)
					{
					var
						$newSlide       = $slides.filter("[data-slide-id=\""+slideId+"\"]").clone(),
						cssParamType    = sliderParams.direction.value == "horizontal" ? "left" : "top",
						cssParams       =
							{
							"display" : slideDisplayType,
							"opacity" : 0,
							"position": "absolute"
							};
					cssParams[cssParamType] = slideSize * index;

					$newSlide
						.css(cssParams)
						.addClass("av-slider-slide-temp")
						.appendTo($slider);
					$slidesToShow = $slidesToShow.add($newSlide);
					});

				$slides = $slider.find(".av-slider-slide");
				$slidesActive.animate({"opacity": 0}, 600);
				$slidesToShow.animate({"opacity": 1}, 600);
				}
			/* ---------------------------- */
			/* ----------- end ------------ */
			/* ---------------------------- */
			setTimeout(function()
				{
				$slides.filter(".av-slider-slide-temp")
					.remove();
				$slides
					.removeClass("slide-active")
					.css
						({
						"display" : "none",
						"opacity" : "",
						"position": "",
						"top"     : "",
						"left"    : ""
						})
					.each(function()
						{
						if($.inArray($(this).attr("data-slide-id"), newActiveSlidesArray) != -1)
							$(this)
								.css("display", slideDisplayType)
								.addClass("slide-active");
						});
				$slider
					.css
						({
						"position"  : "",
						"width"     : "",
						"height"    : ""
						})
					.controlAvSliderCondition()
					.removeAttr("data-in-process")
					.trigger(triggerNameEnd);
				}, 700);
			});
		};
	/* =========================================== */
	/* ============== jump to slide ============== */
	/* =========================================== */
	$.fn.jumpToSlideAvSlider = function($slide, animation)
		{
		var $slideNeed = $slide instanceof jQuery ? $slide.filter(".av-slider-slide") : $();
		if(!$slideNeed.length) return this;

		return this.each(function()
			{
			var
				$slider                 = $(this).filter(".av-slider"),
				slideActiveFirstIndex   = $slider.find(".av-slider-slide").filter(".slide-active").first().index(),
				slideNeedIndex          = $slideNeed.index(),
				slideDirection          = slideActiveFirstIndex < slideNeedIndex ? "forward" : "back",
				slidesCount             = Math.abs(slideActiveFirstIndex - slideNeedIndex);

			if(slideActiveFirstIndex !== slideNeedIndex)
				$slider.slideAvSlider(slideDirection, animation, slidesCount);
			});
		};
	/* =========================================== */
	/* ================ autoslide ================ */
	/* =========================================== */
	$.fn.slideAutoAvSlider = function(direction, delay, animation, slidesCount)
		{
		var
			slideDirection  = $.inArray(direction, ["back", "forward"]) == -1 ? "forward" : direction,
		    autoSlideDelay  = parseInt(delay);

		if(!autoSlideDelay || autoSlideDelay < 100) autoSlideDelay = 100;

		return this.each(function()
			{
			var
				$slider  = $(this).filter(".av-slider"),
			    sliderId = $slider.attr("data-slider-id");
			if(!$slider.length || $slider.attr("data-autoslide-enable") == "Y" || !sliderId) return;

			$slider.attr("data-autoslide-enable", "Y");
			avSlideresInterval[sliderId] = setInterval(function()
				{
				$slider
					.slideAvSlider(slideDirection, animation, slidesCount, true)
					.on("slidingBackUnable slidingForwardUnable", function()
						{
						$(this).stopSlideAutoAvSlider();
						});
				}, autoSlideDelay);
			});
		};
	/* =========================================== */
	/* ============= autoslide stop ============== */
	/* =========================================== */
	$.fn.stopSlideAutoAvSlider = function()
		{
		return this.each(function()
			{
			var $slider = $(this).filter(".av-slider");

			$slider.removeAttr("data-autoslide-enable");
			clearInterval(avSlideresInterval[$slider.attr("data-slider-id")]);
			});
		};
	/* =========================================== */
	/* ================ get slide ================ */
	/* =========================================== */
	$.fn.getAvSliderSlide = function(value)
		{
		var
			$slider         = $(this).filter(".av-slider"),
			$slides         = $slider.find(".av-slider-slide"),
			showFirst       = value == "first",
		    showFirstActive = value == "first-active",
			showLast        = value == "last",
			showLastActive  = value == "last-active",
		    slideIndex      = parseInt(value),
			$result         = $();

		if(!slideIndex) slideIndex = 1;

		     if(showFirst)       $result = $slides.first();
		else if(showFirstActive) $result = $slides.filter(".slide-active").first();
		else if(showLast)        $result = $slides.last();
		else if(showLastActive)  $result = $slides.filter(".slide-active").last();
		else                     $result = $slides.filter("[data-slide-id=\""+slideIndex+"\"]");

		return $result;
		};
	})($);
/* -------------------------------------------------------------------- */
/* ----------------------------- handlers ----------------------------- */
/* -------------------------------------------------------------------- */
$(function()
	{
	$(window).resize(function()
		{
		$(".av-slider").setAvSliderSlidesCount();
		});
	});