<?php
  $path = $base_dir . $rel_dir  . $file_list[$i];
  $modified = filemtime($path);
  $size = filesize($path);
  @$fsize = getSize($size);
?>
<tbody>
<tr class="<?php echo $color; ?>">
  <td><img src="manager/images/mime/<?php
  $ext = array();
  
  $ext = explode(".", $file_list[$i], strlen($file_list[$i]));
  $extn = $ext[count($ext) - 1];
  switch (($extn)) {
      case "css":
          echo "css.png";
          break;
          
      case "csv":
          echo "csv.png";
          break;
          
      case "fla":
      case "swf":
          echo "fla.png";
          break;
          
      case "mp3":
      case "wav":
          echo "mp3.png";
          break;
          
      case "jpg":
      case "JPG":
      case "gif":
      case "png":
          echo "jpg.png";
          break;
          
      case "bmp":
      case "dib":
          echo "bmp.png";
          break;
          
      case "txt":
      case "log":
          echo "txt.png";
          break;
          
      case "js":
          echo "js.png";
          break;
          
      case "pdf":
          echo "pdf.png";
          break;
          
      case "zip":
      case "rar":
      case "tgz":
      case "gz":
          echo "zip.png";
          break;
          
      case "doc":
      case "rtf":
          echo "doc.png";
          break;
          
      case "asp":
      case "jsp":
          echo "asp.png";
          break;
          
      case "php":
      case "php3":
          echo "php.png";
          break;
          
      case "htm":
      case "html":
          echo "htm.png";
          break;
          
      case "ppt":
          echo "ppt.png";
          break;
          
      case "exe":
      case "bat":
      case "com":
          echo "exe.png";
          break;
          
      case "wmv":
      case "mpg":
      case "mpeg":
      case "wma":
      case "asf":
          echo "wmv.png";
          break;
          
      case "midi":
      case "mid":
          echo "midi.png";
          break;
          
      case "mov":
          echo "mov.png";
          break;
          
      case "psd":
          echo "psd.png";
          break;
          
      case "ram":
      case "rm":
          echo "rm.png";
          break;
          
      case "xml":
          echo "xml.png";
          break;
          
      default:
          echo "ukn.png";
          break;
  }
?>" alt="" border="0" class="tooltip" title="
    <?php
	  echo "Path:".$path;
		   $fmodified = date("d/M/y G:i:s", filemtime($path));
     	   $faccessed = date("d/M/y G:i:s", fileatime($path));
	  echo "<br />File size: " . $fsize;
	  echo "<br />Last modified: " . $fmodified ;
	  echo "<br />Last accessed: " . $faccessed ;
	  echo "<br />Owner: " . fileowner($path);
	  echo "<br />Group: " . filegroup($path) ;
	  echo "<br />Permissions: " ;
	  echo printf( "%o", fileperms($path));
	  ?>" />
      </td>

  <td><a href="<?php echo SITEURL."/uploads/".$rel_dir . $file_list[$i]; ?>" rel="prettyPhoto" title="<?php echo $file_list[$i]; ?>"><?php echo $file_list[$i]; ?></a></td>
  <td><?php echo $fsize; ?></td>
  <td><?php echo getPerms(fileperms($path));?></td>
  <td class="right">
  <?php if(iseditable($extn)):?>
    <a href="index.php?do=filemanager&amp;fmaction=edit&amp;rel_dir=<?php echo $rel_dir;?>&amp;edit=<?php echo $file_list[$i];?>"><img src="manager/images/icons/edit.png" class="tooltip" alt="" title="<?php echo _FM_EDITFILE;?>" /></a>
  <?php endif;?>
  <?php if(isviewable($extn) || isimage($extn)):?>
    <a href="index.php?do=filemanager&amp;fmaction=view&amp;rel_dir=<?php echo $rel_dir;?>&amp;view=<?php echo $file_list[$i];?>"><img src="manager/images/icons/view.png" class="tooltip" alt="" title="<?php echo _FM_VIEWFILE;?>" /></a>
  <?php endif;?>           
    <a href="javascript:chmod('<?php echo $file_list[$i]; ?>','<?php echo $rel_dir; ?>');"><img src="manager/images/icons/lock.png" alt="" class="tooltip" title="<?php echo _FM_CHGPER;?>" /></a>
    <a href="javascript:confirm_del('<?php echo $file_list[$i]; ?>','<?php echo $rel_dir; ?>');"><img src="manager/images/icons/delete.png" alt="" class="tooltip" title="<?php echo _FM_DELFILE;?>" /></a>
<input name="sel_f[]" type="checkbox" id="sel_f-<?php echo $i;?>" value="<?php echo $path; ?>" />
  </td>
</tr>
</tbody>