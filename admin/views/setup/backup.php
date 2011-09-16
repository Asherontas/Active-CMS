<?php

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'BDD Sauvegarde', 'images/title/32/backup.png', '1' );

require_once("./core/classes/dbtools.class.php");
$tools = new dbTools();

if (isset($_GET['backupok']) && $_GET['backupok'] == "1")
  $message = __('Sauvgardé !');

if (isset($_GET['restore']) && $_GET['restore'] == "1")
  $message = __('Restauré !');

if (isset($_GET['create']) && $_GET['create'] == "1")
  $tools->doBackup('', false);

if (isset($_POST['backup_file']))
  $tools->doRestore($_POST['backup_file']);

#display_msg();

$page_info = __('Le dossier module est vide <br />
			Aucun module à été ajouté, Merci de m\'envoyer un mail pour la création des modules !');

get_result($message, $erreur, $page_info);

?>
<button onclick="window.location='backup&create=1';" type="button" class="button">Créer un backup</button>
<div id="backup">
<?php
	
	$file = new Explorer();

	$file->SetPath(ABSPATH . '/admin/backups/');
	
	$BackupFolder = $file->Listing($exclude_extension = array('php', 'html'));
	
	#print_r($BackupFolder);
	
	foreach ( $BackupFolder as $Backup ) { 

		if ($Backup == '') {
			echo '<div class="db-backup new">';
		echo '<span class="filename">';
		echo str_replace(".sql", "", $file) . '</span>';
		echo '<a href="' . ADMINURL . '/backups/' . $file . '" title="Télécharger: ' . $file . '" class="download">Télécharger</a>';
		echo '</div>';
		} 
		else {
			echo '<div class="db-backup" id="list-' . $Backup['filename'] . '">';
		echo '<span class="filename">' . str_replace(".sql", "", $Backup['filename']) . '</span>';
		echo '<a href="' . ADMINURL . '/backups/' . $Backup['filename'] . '" title="Suprimer: ' . $Backup['filename'] . '" class="download_backup">Réstaurer</a>';
		echo '<a href="#" title="Delete: ' . $Backup['filename'] . '" class="delete">Supprimer</a>';
		echo '</div>';

		}
	}
?>
</div>
<br clear="left" />
<div class="box">
  <form action="" method="post" id="admin_form" name="admin_form">
    <strong>Tous les backups :</strong>
    <?php
		echo '<select name="backup_file" class="select" style="width:250px">';
		foreach ( $BackupFolder as $Backup ) { 
		    echo '<option value="'. $Backup['filename'] .'">'. $Backup['filename'] .'</option>';
		}
		echo '</select>';
      ?>

    <button type="submit" class="button">Backup to this</button>
  </form>
</div>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function () {
    $('a.delete').click(function (e) {
        if (confirm("êtes vous sûre de vouloir supprimer ce backup ?")) {
            e.preventDefault();
            var parent = $(this).parent();
            $.ajax({
                type: 'post',
                url: "../actions.php",
                data: 'deleteBackup=' + parent.attr('id').replace('list-',''),
                beforeSend: function () {
                    parent.animate({
                        'backgroundColor': '#FFBFBF'
                    }, 400);
                },
                success: function () {
                    parent.fadeOut(400, function () {
                        parent.remove();
                    });
                }
            });
        }
    });
});
// ]]>
</script>