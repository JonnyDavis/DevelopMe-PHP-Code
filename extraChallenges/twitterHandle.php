<?php function twitter_handle($name) {
	$handle = '@' . strtolower($name);

	return $handle;
}

echo twitter_handle('JONNYDAVIS');



?>