<tbody>
  <tr class="<?php echo $color; ?>">
    <td><img src="manager/images/mime/folder.png" alt="folder" /></td>
    <td><a href="<?php if($rel_dir=="")	$path=$rel_dir.$dir_list[$i]; else $path=$rel_dir.$dir_list[$i]; echo "index.php?do=filemanager&amp;rel_dir=".$path."/";?>"><?php echo $dir_list[$i]; ?></a></td>
    <td>&nbsp;</td>
    <td><?php echo getPerms(fileperms($base_dir.$path));?></td>
    <td class="right"><a href="javascript:chmod('<?php echo $dir_list[$i]; ?>','<?php echo $rel_dir; ?>');"><img src="manager/images/icons/lock.png" alt="" class="tooltip" title="<?php echo _FM_CHGPER;?>" /></a>
    <a href="javascript:dir_del('<?php echo $dir_list[$i]; ?>','<?php echo $rel_dir; ?>');"><img src="manager/images/icons/delete.png" alt="" class="tooltip" title="<?php echo _FM_DELFILE;?>" /></a>
    <input name="sel_d[]" type="checkbox" id="seld-<?php echo $i?>" value="<?php echo $path; ?>" /></td>
  </tr>
</tbody>
