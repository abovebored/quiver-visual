<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/functions.php');

$formattedNotes		= array();

$notebook 			= $_GET['notebook'].'.qvnotebook';
$notebookPath 		= $libPath.$lib.'/'.$notebook;
$notebookMeta 		= j2a($notebookPath.'/meta.json');

$note 				= $_GET['note'].'.qvnote';
$notePath 			= $notebookPath.'/'.$note;
$noteMeta 			= j2a($notePath.'/meta.json');
$noteContent 		= j2a($notePath.'/content.json');
$noteResources		= $lib.'/'.$notebook.'/'.$note.'/resources';

?>

<div class="view view--note">
	<div class="title">
		<a href="/pages/notebook.php?notebook=<?php echo $_GET['notebook'] ?>" class="openNotebook">&larr; Back to notebook</a><br>

		<?php echo $noteMeta['title'] ?>
	</div>
	<div class="content">

		<?php 
			if (count($noteContent['cells'])):
				foreach ($noteContent['cells'] as $cell):

					$cont = $cell['data'];
					$cont = str_replace("quiver-image-url", $noteResources, $cont);

					echo $cont;
				endforeach;
			endif;
		?>
	</div>
</div>