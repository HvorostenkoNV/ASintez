<?
CJSCore::RegisterExt('font_awesome',        ['js'   => '/bitrix/js/av/fontawesome.js']);
CJSCore::RegisterExt('first_on_event',      ['js'   => '/bitrix/js/av/first_on_event.js']);
CJSCore::RegisterExt('jquery_mobile_click', ['js'   => '/bitrix/js/av/jquery_mobile_click.js']);
CJSCore::RegisterExt('jquery_cookie',       ['js'   => '/bitrix/js/av/jquery_cookie.js']);
CJSCore::RegisterExt
(
	'av',
	[
		'js'    => '/bitrix/js/av/main.js',
		'css'   => '/bitrix/css/av/main.css',
		'rel'   => ['jquery', 'first_on_event', 'jquery_mobile_click', 'jquery_cookie']
	]
);
CJSCore::RegisterExt
(
	'av_form_elements',
	[
		'js'    => '/bitrix/js/av/form_elements.js',
		'rel'   => ['av']
	]
);
CJSCore::RegisterExt
(
	'av_slider',
	[
		'js'    => '/bitrix/js/av/av_slider.js',
		'rel'   => ['jquery']
	]
);
CJSCore::RegisterExt
(
	'js_scrollbar',
	[
		'js'    => '/bitrix/js/av/js_scrollbar.js',
		'css'   => '/bitrix/css/av/js_scrollbar.css',
		'rel'   => ['jquery']
	]
);