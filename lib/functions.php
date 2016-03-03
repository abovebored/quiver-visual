<?php
	// ------------
	// json to array function
	function j2a($json) {
		return @json_decode(@file_get_contents($json), true);
	}

	$qImgRegex = "/quiver-image-url\/(?P<file>[\S\W][^'|\"]+)/im";
?>