<?php
	// ------------
	// json to array function
	function j2a($json) {
		return @json_decode(@file_get_contents($json), true);
	}

	$qImgRegex = "/quiver-image-url\/(?P<file>[\S\W][^'|\"]+)/im";


	// ------------
	// desc date
	function sortByDate($a, $b) {
		if (isset($a['updated_at'])): $t1 = $a['updated_at'];
		else: $t1 = $a['created_at']; endif;

		if (isset($b['updated_at'])): $t2 = $b['updated_at'];
		else: $t2 = $b['created_at']; endif;

		return $t2 - $t1;
	}
?>