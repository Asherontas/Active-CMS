<?php
  if (empty($_GET['rel_dir'])) {
      $upldir = $base_dir;
  } else {
      $upldir = $base_dir . htmlspecialchars($_GET['rel_dir'], ENT_QUOTES);
  }
  
  $maxfiles = 5;
  $maxsize = 151200;
  $fileext = array(".gif", ".jpg", ".jpeg", ".png", ".txt", ".nfo", ".doc", ".htm", ".zip", ".rar", ".css", ".pdf");
  
  if (!is_dir($upldir))
      die(_FM_UPLOAD_ERR1);
  
  if (!is_writeable($upldir))
      die(_FM_UPLOAD_ERR2);
  
  
  if (isset($_POST['upload_form'])) {
      
      for ($i = 1; $i <= $maxfiles; $i++) {
          
          $newfile = $_FILES['file' . $i];
          $filename = $newfile['name'];
          
          $filename = str_replace(' ', '_', $filename);
          $filetmp = $newfile['tmp_name'];
          $filesize = $newfile['size'];
          
          if (!is_uploaded_file($filetmp)) {
              $msgError =  _FM_FILE . $i . _FM_UPLOAD_ERR3;
          } else {
              
              $ext = strrchr($filename, '.');
              if (!in_array(strtolower($ext), $fileext)) {
                  $msgError = _FM_FILE . $i.' ('.$filename.') '._FM_UPLOAD_ERR4;
              } else {
                  
                  if ($filesize > $maxsize) {
                      $msgError = _FM_FILE . $i.' ('.$filename.') '._FM_UPLOAD_ERR5 . $maxsize / 1024;
                  } else {
                      
                      if (file_exists($upldir . $filename)) {
                          $msgError = _FM_FILE . $i.' ('.$filename.') '._FM_UPLOAD_ERR6;
                      } else {
                          
                          if (move_uploaded_file($filetmp, $upldir . $filename)) {
                              $msgOk = _FM_FILE . $i.' ('.$filename.') '._FM_UPLOAD_ERR7;
							  //redirect_to("index.php?do=filemanager&rel_dir=".$_GET['rel_dir']);
                          } else {
                              $msgError = _FM_FILE . $i . _FM_UPLOAD_ERR8;
                          }
                      }
                  }
              }
          }
      }
	  redirect_to("index.php?do=filemanager&rel_dir=".$_GET['rel_dir']);
  }
?>
<form action="" method="post" enctype="multipart/form-data">
  <table cellpadding="0" cellspacing="0" class="display">
    <tr style="background-color:transparent">
      <td><?php for ($i = 1; $i <= $maxfiles; $i++): ?>
        <div style="display:block; margin-bottom:3px"><?php echo _FM_FILE . $i; ?>:
          <input name="file<?php echo $i; ?>" type="file" class="inputbox" size="45" />
        </div>
        <?php endfor;?>
        <input type = "hidden" name="maxsize" value = "<?php echo $maxsize; ?>" /></td>
    </tr>
    <tr class="tfoot">
      <td><button name="upload_form" type="submit" class="button"><?php echo _UPLOAD;?></button></td>
    </tr>
  </table>
</form>