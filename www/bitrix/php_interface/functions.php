<?
function clearComponentArray($array)
{
	if( !is_array($array) || count($array) <= 0 )
		return [];

	foreach( $array as $index => $value )
	{
		if( $index[0] == '~' )
		{
			unset($array[$index]);
			continue;
		}

		if( is_array($value) )
			$array[$index] = clearComponentArray($value);
	}

	return $array;
}