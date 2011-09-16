<?php
  $path = $base_dir . $rel_dir . $_GET['edit'];
  $fsize = filesize($path);
  $fmodified = date("d/M/y G:i:s", filemtime($path));
  $laccessed = date("d/M/y G:i:s", fileatime($path));

  if (isset($_POST['save'])) {
      $fp = fopen($path, "w");
      {
          if (fwrite($fp, $_POST['filecontent'], strlen($_POST['filecontent']))) {
				 $msgOk = _FM_FILESAVEOK1 . $path . _FM_FILESAVEOK2;
		  } else {
                 $msgError = _FM_FILESAVEERR1 . $path . _FM_FILESAVEERR2;
          }
      }
      fclose($fp);
  }
?>
<?php display_msg();?>
<h1><img src="images/filemngr-lrg.png" alt="" /><?php echo _FM_TITLE;?></h1>
<h2><?php echo _FM_EDITING . ' &rsaquo; ' . basename($path) ;?></h2>
<table cellspacing="0" cellpadding="0" class="formtable">
  <thead>
    <tr>
      <td width="20%"><strong><?php echo _FM_FILE;?> </strong></td>
      <td colspan="3"><?php echo $path; ?></td>
    </tr>
  </thead>
  <tbody>
    <tr class="even">
      <td><strong><?php echo _FM_FILSIZE;?> </strong></td>
      <td width="30%"><?php echo getSize($fsize); ?></td>
      <td width="20%"><strong><?php echo _FM_FILEOWNER;?> </strong></td>
      <td width="30%"><?php echo fileowner($path); ?></td>
    </tr>
    <tr class="odd">
      <td><strong><?php echo _FM_FILELM;?> </strong></td>
      <td><?php echo $fmodified; ?></td>
      <td><strong><?php echo _FM_FILEGROUP;?> </strong></td>
      <td><?php echo filegroup($path); ?></td>
    </tr>
    <tr class="even">
      <td><strong><?php echo _FM_FILLA;?></strong></td>
      <td><?php echo $laccessed; ?></td>
      <td><strong><?php echo _FM_PERM;?> </strong></td>
      <td><?php printf( "%o", fileperms($path) ) ; ?></td>
    </tr>
  </tbody>
</table>
<form name="form" method="post" action="">
  <table cellpadding="0" cellspacing="0" class="display">
    <tfoot>
      <tr style="background-color:transparent">
        <td colspan="2"><input type="submit" name="save" class="button" value="<?php echo _SAVE;?>" />
          <input class="button" type="button" name="Button" value="<?php echo _BACK;?>" onclick="window.location='index.php?do=filemanager&amp;page=fm&amp;rel_dir=<?php echo $rel_dir; ?>'" /></td>
      </tr>
    </tfoot>
    <tbody>
      <tr style="background-color:transparent">
        <td colspan="2" valign="top">
        <textarea name="filecontent" cols="10" rows="20" class="textarea" id="textarea" style="width:99%">
	  <?php 
        $line_num = 0;
        $fp = fopen($path, "r");
        while (!feof($fp)) :
            $line = fgets($fp, 1024);
			echo htmlspecialchars($line);
            $line_num++;
        endwhile;
        fclose($fp);
      ?>
      </textarea>
        </td>
      </tr>
    </tbody>
  </table>
</form>