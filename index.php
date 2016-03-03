<?php
require_once('lib/config.php');
require_once('lib/functions.php');

// ------------
//Notebooks
$notebooks = array_diff(scandir($libPath.$lib), array('..', '.', 'Trash.qvnotebook'));
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php echo $headline ?> powered by Quiver</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="David Longworth (mr@longworth.to)">
	<meta name="copyright" content="">
	
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<meta property="og:title" content="Title" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://.../" />
	<meta property="og:image" content="" />
	<meta property="og:description" content="" />
	<meta property="og:site_name" content="Title" />

	<meta name="dcterms.publisher" content="davidlongworth.com" />
	<meta name="dcterms.abstract" content="" />
	<meta name="geo.placename" content="London, UK" />
	<meta name="dc.language" content="en" />
	<meta name="geo.country" content="gb" />

	<link rel="stylesheet" type="text/css" href="assets/min/main.min.css" />
</head>

<body>
	<div class="notebooks">
		<h1 class="container title"><?php echo $headline ?></h1>

		<?php 
		foreach ($notebooks as $notebook):
			$notebookPath 		= $libPath.$lib.'/'.$notebook;
			$meta 				= j2a($notebookPath.'/meta.json');
			$notes				= array_diff(scandir($notebookPath), array('..', '.'));
		?>
		<div class="notebook">
			<a class="openNotebook" href="/pages/notebook.php?notebook=<?php echo str_replace('.qvnotebook', '', $notebook); ?>">
				<div class="container">
					<?php echo $meta['name']; ?>
					<span class="count"><?php echo count($notes) ?></span>
				</div>
			</a>
		</div>

		<?php endforeach; ?>
	</div>

	<div id="page">

	</div>

	<!-- Scripts et al. -->
	<script src="assets/min/plugins.min.js"></script>
	<script src="assets/min/main.min.js"></script>
</body>
</html>