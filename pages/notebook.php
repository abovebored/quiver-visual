<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/functions.php');

$notebook 			= $_GET['notebook'].'.qvnotebook';
$notebookPath 		= $libPath.$lib.'/'.$notebook;
$notebookMeta 		= j2a($notebookPath.'/meta.json');
$notes				= array_diff(scandir($notebookPath), array('..', '.', 'meta.json'));
$formattedNotes		= array();

foreach ($notes as $note):

	$notePath 			= $notebookPath.'/'.$note;
	$meta 				= j2a($notePath.'/meta.json');
	$content 			= j2a($notePath.'/content.json');
	$resources 			= $lib.'/'.$notebook.'/'.$note.'/resources/';

	$images 			= array();
	$tmpImages			= array();
	$raw				= array();

	if (count($content['cells'])):
		foreach ($content['cells'] as $cell):

			$thisCell = $cell['data'];

			// Push all data into one array
			array_push($raw, $thisCell);

			// Image cells
			preg_match_all($qImgRegex, $thisCell, $thisCellImages);
			$thisCellImages = $thisCellImages['file'];
		
			if (isset($thisCellImages)):
				foreach ($thisCellImages as $allImages):
					array_push($tmpImages, $allImages);
				endforeach;

				foreach ($tmpImages as $image):
					@list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'].$resources.$image);

					@array_push($images, array(
						"file" => $resources.$image,
						"dimensions" => array($width, $height),
						"aspect" => (round(($height / $width * 100), 2)
					)));
				endforeach;
			endif;

		endforeach;

	endif;		

	// Create the note array
	array_push($formattedNotes, array(
		"title" => $meta['title'],
		"file" => $note,
		"created_at" => $meta['created_at'],
		"updated_at" => $meta['updated_at'],
		"tags" => $meta['tags'],
		"raw" => $raw,
		"images" => $images,
		"images_count" => count($images)
	));
		
endforeach;

// echo '<pre style="color:#fff">';
// print_r(json_encode($formattedNotes, JSON_PRETTY_PRINT));
// echo '</pre>';

$r = array_rand($formattedNotes, 1);
if ($formattedNotes[$r]['images']) $bg = $formattedNotes[$r]['images']{0}['file'];
?>
<div class="view">
	<div class="view__bg" style="background-image:url(<?php echo $bg ?>)"></div>
	<div class="title"><?php echo $notebookMeta['name'] ?></div>
	<div class="notes">
	<?php foreach ($formattedNotes as $n): ?>

		<?php if (count($n['images'])): ?>
			<div class="note note--image"><a class="openNote" href="/pages/note.php?notebook=<?php echo $_GET['notebook']?>&amp;note=<?php echo str_replace('.qvnote', '', $n['file']); ?>">
				<?php if ($n['images_count'] > 1): ?><span class="note__imagecount"><?php echo $n['images_count'] ?></span><?php endif; ?>
				<div class="note__image" style="padding-top:<?php echo $n['images']{0}['aspect'] ?>%"><img class="delayed-image-load" data-src="<?php echo $n['images']{0}['file'] ?>"></div>
				<span class="note__title"><?php echo $n['title'] ?></span>
			</a></div>
		<?php else: ?>
			<div class="note note--text"><a class="openNote" href="/pages/note.php?notebook=<?php echo $_GET['notebook']?>&amp;note=<?php echo str_replace('.qvnote', '', $n['file']); ?>">
				<span class="note__title"><?php echo $n['title'] ?></span>
			</a></div>
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
</div>