<div class="page_title"><?php echo __('Gestionnaire de Template'); ?></div>
<?php

$page_info =  __('Voici la liste de tout les utilisateurs inscrits sur le site.<br /> 
				  Dans la colonne Actions, vous pouvez activer, editer et supprimer un utilisateur !');

$config_disabled = 'bmp, ico, gif, jpg, png, psd, zi';
$config_excluded = 'favicon, .htaccess';

global $pagetitle; $pagetitle = '/';
if ((isset($_GET['i'])) && ($_GET['i'] !== '')) { $pagetitle = '/'.$_GET['i'].'/'; }
global $page; $page = 'index';
if (isset($_GET['p'])) { $page = $_GET['p']; }
if (@$_GET['i'] == '') { unset($_GET['i']); }


// DELETE FILE
if (isset($_GET['d'])) {
	$file = $_GET['d'];
	unlink($file);
	$message = 	__('Le Fichier a été supprimé avec succès.');
}

// EDIT
if (isset($_POST['filename'])) {
	$filename = $_POST['filename'];
	$content = stripslashes($_POST['content']);
	$fp = fopen($filename, 'w');
	if ($fp) {
		fwrite($fp, $content);
		fclose($fp);
	}
	$message = __('Le Fichier a été enregistré avec succés.');
}
if (isset($_GET['f'])) {
	$filename = stripslashes( $_GET['f'] );
	if (file_exists($filename)) {
		$page = 'edit';
		$pagetitle = 'Edit &ldquo;'.$filename.'&rdquo;';
		$fp = fopen($filename, 'r');
		if (filesize($filename) !== 0) {
			$loadcontent = fread($fp, filesize($filename));
			$loadcontent = htmlspecialchars($loadcontent);
		}
		fclose($fp);
	} else {
		$page = 'error';
		unset ($filename);
		$erreur = __('Le fichier n\'exsite pas !');
	}
}

get_result($message, $erreur, $page_info);

if ($page == "edit") { ?>
<h2><?php echo __('Editer'); ?> &ldquo;<a href="<?php echo $filename; ?>"><?php echo $filename; ?></a>&rdquo;</h2>
  <p><?php echo __('Taille de fichier'); ?> : <?php echo round(filesize($filename)/1000,2); ?> Kb <br />
    <?php echo __('Dérnière Modification'); ?> : <?php echo date("d-m-Y H:i:s", filemtime($filename)); ?></p>
  <form method="post" action="">
    <input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
    <?php $lfile = strtolower($filename); if (strpos($config_disabled,end(explode(".", $lfile)))) { ?>
    <p>
      <textarea name="content" class="textinput disabled" cols="70" rows="25" disabled="disabled">Désactivé !</textarea>
    </p>
    <p class="buttons_right">
      <input type="submit" class="button" name="save_file" value="Enregistrer" 
			disabled="disabled" />
      <?php } else { ?>
    <p>
      <input type="hidden" name="filename" id="filename" class="textinput" 
		value="<?php echo $filename; ?>" />
      <textarea name="content" class="textinput" id="ajaxfilemanager" 
		cols="70" rows="25"><?php echo $loadcontent; ?></textarea>
    </p>
    <div id="submit_form">
            <input style="float:left;" name="submit"type="submit" id="submit_new" value="Valider">
          </div>
            <a href="javascript:history.back()" class="back">Retour</a>
          <div style="display:none;" id="loading"><img src="images/loading.gif" ></div>
      <?php } ?>
  </form>
  <?php }else { ?>
  <table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_sorter" class="tablesorter table_liste">
    <tr>
      <th width="5%" align="center"><?php echo __('Ext'); ?></th>
      <th width="50%" align="center"><?php echo __('Nom'); ?></th>
      <th width="30%" align="center"><?php echo __('Dérnière modification'); ?></th>
      <th width="10%" align="center"><?php echo __('Taille'); ?></th>
      <th width="5%"align="center" colspan="2"><?php echo __('Actions'); ?></th>
    </tr>
    <?php
if ($page == "index") {
	$varvar = ABSPATH .'/templates/'. FRONT_LAYOUT.''; // chemin des templates
	if (isset($_GET["i"])) { 
		$varvar = $_GET["i"]."/"; 
	}
?>
     <h2><?php echo basename($varvar); ?></h2>
    <span class="index_folders">
    
    <?php if ((isset($_GET["i"])) && ($_GET["i"] !== "")) { ?>
    <a href="javascript:history.back()" class="folder">.. /</a>
    <?php } 
				  $files = glob($varvar."*",GLOB_ONLYDIR); sort($files); foreach ($files as $file) { ?>
    <a href="template&i=<?php echo $file; ?>"
		class="folder"><?php echo basename($file); ?></a>
    <?php } 
				  $files = glob($varvar."{,.}*", GLOB_BRACE); sort($files);
	foreach ($files as $file) {
		$excludeme = 0;
		$config_excludeds = explode(",", $config_excluded);
		foreach ($config_excludeds as $config_exclusion) {
			if (strrpos(basename($file),$config_exclusion) !== False && 
			strrpos(basename($file),$config_exclusion) !== "") { 
				$excludeme = 1;
			}
		}
		
		if (!is_dir($file) && $excludeme == 0) {
				  ?>
    <tr>
      <?php              
			$file_class = "";
			$lfile = strtolower($file);
			if ((strrpos(strtolower($lfile),".jpg")) || (strrpos($lfile,".gif")) || (strrpos($lfile,".png")) || (strrpos($lfile,".ico"))) { $file_class = "img"; 
			}
			if (strrpos($lfile,".css")) { 
				$file_class = "css"; 
				}
			if (strrpos($lfile,".php")) {
				$file_class = "php"; 
				} 
				?>
      <td class="index" align="left"><span class="<?php echo $file_class ?>"></span></td>
      <td align="center"><?php echo basename($file); ?></td>
      <td align="center"><?php echo date("d-m-Y H:i:s", filemtime($file)); ?></td>
      <td align="center"><?php echo round(filesize($file)/1000,2);?> kb</td>
      <td align="center"><a href="admin.php?action=editeur&f=<?php echo $file; ?>" id="<?php echo $file_class ?>" class="tooltips"><img src="images/edit.png" alt="edit" border="0" /><span class="tooltip"><?php echo __('Modifier ce fichier !'); ?></span></a></td>
      <td align="center"><a href="#" class="tooltips" onclick="if (confirm('Voulez-vous vraiment supprimer ces données ?'))parent.location='admin.php?action=editeur&d=<?php echo $file; ?>'"><img src="images/delete.png"  alt="delete" border="0" /><span class="tooltip"><?php echo __('Supprimer ce fichier !'); ?></span></a></td>
    </tr>
    <?php } } } ?>
  </table>
  <?php } ?>