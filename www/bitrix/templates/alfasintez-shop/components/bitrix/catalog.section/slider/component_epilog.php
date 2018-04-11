<?
if( !defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();

CJSCore::Init(['av', 'font_awesome', 'av_slider']);

AvComponentsIncludings::getInstance()
	->setIncludings('bitrix', 'catalog.item');