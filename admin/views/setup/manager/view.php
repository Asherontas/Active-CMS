<?php
  $view = $base_dir . $rel_dir . $_GET['view'];
  $fsize = filesize($view);
  $fmodified = date("d-M-y G:i:s", filemtime($view));
  $faccessed = date("d-M-y G:i:s", fileatime($view));
  $ext = array();
  $ext = explode(".", $view, strlen($view));
  $extn = $ext[count($ext) - 1];
?>
<?php display_msg();?>

<h1><img src="images/filemngr-lrg.png" alt="" /><?php echo _FM_TITLE;?></h1>
<h2><?php echo _FM_VIEWING.' &rsaquo '.basename($view) ;?></h2>
<table cellspacing="0" cellpadding="0" class="formtable">
  <tfoot>
    <tr>
      <td colspan="4"><input class="button" type="button" name="button" value="<?php echo _BACK;?>" onclick="window.location='index.php?do=filemanager&amp;page=fm&amp;rel_dir=<?php echo $rel_dir; ?>'" /></td>
    </tr>
  </tfoot>
  <tbody>
    <tr>
      <td width="20%"><strong><?php echo _FM_FILE;?></strong></td>
      <td colspan="3"><?php echo $view; ?></td>
    </tr>
    <tr>
      <td><strong><?php echo _FM_FILSIZE;?>:</strong></td>
      <td width="30%"><?php echo getSize($fsize); ?></td>
      <td width="20%"><strong><?php echo _FM_FILEOWNER;?>:</strong></td>
      <td width="30%"><?php echo fileowner($view); ?></td>
    </tr>
    <tr>
      <td><strong><?php echo _FM_FILELM;?>:</strong></td>
      <td><?php echo $fmodified; ?></td>
      <td><strong><?php echo _FM_FILEGROUP;?>: </strong></td>
      <td><?php echo filegroup($view); ?></td>
    </tr>
    <tr>
      <td><strong><?php echo _FM_FILLA;?>:</strong></td>
      <td><?php echo $faccessed; ?></td>
      <td><strong><?php echo _FM_PERM;?>: </strong></td>
      <td><?php printf( "%o", fileperms($view) ) ; ?></td>
    </tr>
    <tr>
      <?php if (isimage($extn)):?>
      <?php $filename = basename($view);?>
      <?php $iurl = SITEURL . "/uploads/" . $rel_dir . $filename;?>
      <td colspan="4" align="center"><img src="<?php echo $iurl;?>" name="preview" class="tooltip" alt="<?php echo $filename;?>" title="<?php echo $filename;?>" /></td>
      <?php else:?>
      <?php $line_num = 0;?>
      <td colspan="4"><?php echo  get_sourcecode($view, $line_num);?></td>
      <?php endif;?>
    </tr>
  </tbody>
</table>