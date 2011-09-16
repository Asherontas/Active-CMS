<?php

  /**
   * File Manager
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: filemanager.php,v 1.00 2010-07-20 10:12:05 gewa Exp $
   */
	  
  include_once("manager/functions.php");
  $base_dir = ABSPATH. '/uploads';

  if (isset($_GET['rel_dir'])) {
      $rel_dir = str_replace("../", "", $_GET['rel_dir']);
      $rel_dir = str_replace(".", "", $_GET['rel_dir']);
  } else {
      $rel_dir = '';
  }

  if (isset($_GET['rel_dir'])) {
      if ($_GET['rel_dir'] == $base_dir) {
          $show_dir = $base_dir;
          $_GET['rel_dir'] = "";
      } else {
          $rel_dir = urldecode($_GET['rel_dir']);
          $show_dir = $base_dir . $_GET['rel_dir'];
      }
  } else {
      $show_dir = $base_dir;
      $_GET['rel_dir'] = "";
  }
  
  //delete multiple folders
  if (isset($_POST['del_m'])) {
      if (isset($_POST['sel_d'])) {
          foreach ($_POST['sel_d'] as $dir_to_del) {
              purge($base_dir . $dir_to_del . "/");
              $all = rmdir($base_dir . $dir_to_del);
          }
      }
      //delete multiple files  
      if (isset($_POST['sel_f'])) {
          foreach ($_POST['sel_f'] as $file_to_del) {
              $all = unlink($file_to_del);
          }
      }
      
      if ($all) {
          $msgOk = _FM_DELOK;
	  } else {
		  $msgError = _FM_DEL_ERR;
	  }
  }
  
  //multiple cut / copy
  if (isset($_POST['m_cut']) || isset($_POST['m_copy'])) {
      if (isset($_POST['m_cut']))
          $act = "cut";
      else
          $act = "copy";
      $_SESSION['action'] = $act;
      if (isset($_POST['sel_d'])) {
          $_SESSION['sel_dirs'] = $_POST['sel_d'];
      }
      if (isset($_POST['sel_f'])) {
          $_SESSION['sel_files'] = $_POST['sel_f'];
      }
  }
  //create file
  if (isset($_POST['file'])) {
      if ($_POST['file'] == "") {
          $file = $base_dir . $rel_dir . $_POST['file'];
          $msgError = _FM_FILENAME_R;
      } elseif (touch($file)) {
          $msgOk = _FM_FILENAME1 . $file . _FM_FILENAME2;
      } else {
          $msgError = _FM_FILENAME_ERR . $file;
      }
  }
  //multiple paste
  if (isset($_POST['m_paste'])) {
      if (isset($_SESSION['sel_dirs'])) {
          foreach ($_SESSION['sel_dirs'] as $dir_to_copy) {
              mkdir($base_dir . $rel_dir . $dir_to_copy);
              xcopy($base_dir . $dir_to_copy, $base_dir . $rel_dir . $dir_to_copy, $_SESSION['action']);
              if ($_SESSION['action'] == "cut")
                  rmdir($base_dir . $dir_to_copy);
          }
      }
	  
      if (isset($_SESSION['sel_files'])) {
          foreach ($_SESSION['sel_files'] as $file_to_copy) {
              copy($file_to_copy, $base_dir . $rel_dir . basename($file_to_copy));
              if ($_SESSION['action'] == "cut")
                  unlink($file_to_copy);
          }
      }
      if ($_SESSION['action'] == "cut")
          $_SESSION['action'] = '';
  }
  //multiple chmod
  if (isset($_POST['chmod_all'])) {
       if (isset($_POST['sel_d'])) {
		   foreach ($_POST['sel_d'] as $dir_name)
		   $all = chmoddir($base_dir . $dir_name, intval($_POST['chmod_val']));
       }
       if (isset($_POST['sel_f'])) {
		   foreach ($_POST['sel_f'] as $file_name)
       $all = chmod($file_name, intval($_POST['chmod_val']));
       }
	   
      if ($all) {
          $msgOk = _FM_DIRPER_OK;
	  } else {
		  $msgError = _FM_DIRPER_ERR;
	  }
  }
  
  //create directory
  if (isset($_POST['dir'])) {
      $directory = $base_dir . $rel_dir . trim($_POST['dir']);
      if ($_POST['dir'] == "") {
          $msgError = _FM_DIR_NAME_R;
      } elseif (mkdir($directory)) {
          $msgOk = _FM_DIR_OK1 . $directory . _FM_DIR_OK2;
      } else {
          $msgError = _FM_DIR_ERR . $directory;
      }
  }
  
  //delete directory
  if (isset($_GET['ddel'])) {
      purge($base_dir . $rel_dir . $_GET['ddel'] . "/");
      if (rmdir($base_dir . $rel_dir . $_GET['ddel'])) {
          $msgOk = _FM_DIR_DEL_OK1 . $_GET['ddel'] . _FM_DIR_DEL_OK2;
      } else {
          $msgError = _FM_DIR_DEL_ERR . $_GET['ddel'];
      }
  }
  //single chmod
  if (isset($_GET['cpath'])) {
      if (chmod($base_dir . $rel_dir . $_GET['cpath'], $_GET['cmode'])) {
          $msgOk = _FM_PER_OK1 . $_GET['cpath'] . _FM_PER_OK2;
      } else {
          $msgError = _FM_PER_ERR . $_GET['cpath'];
      }
  }
  
  //delete file
  if (isset($_GET['del'])) {
      if (unlink($base_dir . $rel_dir . $_GET['del'])) {
          $msgOk = _FM_FILE_OK1 . $_GET['del'] . _FM_FILE_OK2;
      } else {
          $msgError = _FM_FILE_ERR . $_GET['del'];
      }
  }
  
  $dir_list = array();
  $file_list = array();
  $dir_count = 0;
  $file_count = 0;
  
  if (!is_dir($show_dir)) {
      
      die(_FM_NO_DIR1 . $show_dir . _FM_NO_DIR2);
  }
  if (!($dir = opendir($show_dir))) {
      die(_FM_ACCESS1 . $show_dir . _FM_ACCESS2);

  }
  while ($name = readdir($dir)) {
      if ($name == ".." || $name == "." || $name == "index.php" || $name == "index.html" || $name == "Thumbs.db" || $name == ".htaccess")
          continue;
      if (is_dir($show_dir . $name))
          $dir_list[$dir_count++] = $name;
      if (is_file($show_dir . $name))
          $file_list[$file_count++] = $name;
  }
  closedir($dir);
?>
<script type="text/javascript">
// <![CDATA[
// Simgle CHMOD
function chmod(link_del, rel_path) {
    $("#dialog-chmod").dialog({
        resizable: false,
        height: "auto",
        modal: true,
        buttons: {
            "CHMOD Item": function () {
                var c = $("#cmode_single").val();
                if (c != "" && c != null) window.location.href = "index.php?do=filemanager&rel_dir=" + rel_path + "&cpath=" + link_del + "&cmode=" + c;
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
    });
}

// Multiple CHMOD
function chmodAll() {
    $("#dialog-chmodall").dialog({
        resizable: false,
        height: "auto",
        modal: true,
        buttons: {
            "CHMOD Multiple": function () {
                var c = $("input#cmode_multi").val();
                if (c != "" && c != null) {
                    $('form#filelist').append("<input type=\"hidden\" name=\"chmod_val\" value=\"" + c + "\">");
                    document.filelist.submit();
                }
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
    });

    $('form#filelist').submit(function () {
        $('form#filelist').append("<input type=\"hidden\" name=\"chmod_all\" value=\"1\">");
        return false;
    });

}

// Single Delete File
function confirm_del(link_del, rel_path) {
    $("#dialog-delfile").dialog({
        resizable: false,
        height: "auto",
        modal: true,
        buttons: {
            "Delete Item": function () {
                window.location.href = "index.php?do=filemanager&rel_dir=" + rel_path + "&del=" + link_del;
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
    });
}
// Single Delete Directory
function dir_del(dir_del, rel_path) {
    $("#dialog-deldir").dialog({
        resizable: false,
        height: "auto",
        modal: true,
        buttons: {
            "Delete Directory": function () {
                window.location.href = "index.php?do=filemanager&rel_dir=" + rel_path + "&ddel=" + dir_del;
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
    });
}
// Page Refresh 
function refresh_page(rel_path){
    window.location.href ="index.php?do=filemanager&rel_dir="+rel_path;
}
// Multiple File/Directory Delete 
function deleteAll() {
    $("#dialog-confirm").dialog({
        resizable: false,
        height: "auto",
        modal: true,
        buttons: {
            "Delete Multiple": function () {
                document.filelist.submit();
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
    });

    $('form#filelist').submit(function () {
        $('form#filelist').append("<input type=\"hidden\" name=\"del_m\" value=\"1\">");
        return false;
    });
}

function ToggleAll(e) {
    if (e.checked) {
        CheckAll();
    } else {
        ClearAll();
        refresh_page('<?php echo $rel_dir;?>');
    }
}

function Check(e) {
    e.checked = true;
}

function Clear(e) {
    e.checked = false;
}

function CheckAll() {
    var ml = document.filelist;
    var len = ml.elements.length;
    for (var i = 0; i < len; i++) {
        var e = ml.elements[i];
        if (e.name == "sel_f[]" || e.name == "sel_d[]") {
            Check(e);
        }
    }
}

function ClearAll() {
    var ml = document.filelist;
    var len = ml.elements.length;
    for (var i = 0; i < len; i++) {
        var e = ml.elements[i];
        if (e.name == "sel_f[]" || e.name == "sel_d[]") {
            Clear(e);
        }
    }
}
// ]]>
</script>
<div id="dialog-delfile" title="<?php echo _FM_DELFILE_D;?>" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_DELFILE_DM;?></p>
</div>

<div id="dialog-deldir" title="<?php echo _FM_DELDIR_D;?>" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_DELDIR_DM;?></p>
</div>

<div id="dialog-confirm" title="<?php echo _FM_DELMUL_D;?>" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_DELMUL_DM;?></p>
</div>

<div id="dialog-chmod" title="<?php echo _FM_CHMOD_D;?>" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_CHMOD_DM;?>
    <span style="display:block; margin-top:5px; text-align:center"><input name="cmode_single" type="text" class="inputbox" id="cmode_single" size="10" /></span></p>
</div>

<div id="dialog-chmodall" title="<?php echo _FM_CHMOD_D;?>" style="display:none">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo _FM_CHMOD_DM;?>
    <span style="display:block; margin-top:5px; text-align:center"><input name="cmode_multi" type="text" class="inputbox" id="cmode_multi" size="10" /></span></p>
</div>
<?php if (isset($_GET['fmaction'])): ?>
<?php if ($_GET['fmaction'] == "view"): ?>
      <?php include_once("manager/view.php"); ?>
  <?php endif; ?>
<?php if ($_GET['fmaction'] == "edit"): ?>
      <?php include("manager/edit.php"); ?>
  <?php endif; ?>
 <?php else: ?>
<?php 
/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Geastionnaire des fichiers', 'images/title/32/filemanager.png', '1' );
?>
<div class="box">
    <table cellpadding="0" cellspacing="0" class="display">
      <tr style="background-color:transparent">
        <td><strong><?php echo _FM_CURDIR;?>:</strong>&nbsp;&nbsp;<a href="index.php?do=filemanager&amp;rel_dir=<?php echo $rel_dir; ?>"><?php echo $show_dir; ?></a></td>
        <td class="right">
        <a href="index.php?do=filemanager"><img src="manager/images/icons/home.png" alt="" title="Home" class="tooltip" style="margin-right:8px"/></a> 
        <a href="javascript:void(0);" onclick="$('#dialog').dialog('open'); return false"><img src="manager/images/icons/upload.png" alt="" title="<?php echo _UPLOAD;?>" class="tooltip" style="margin-right:8px" /></a> 
        <a href="javascript:refresh_page('<?php echo $rel_dir;?>');"><img src="manager/images/icons/refresh.png" alt="" title="<?php echo _REFRESH;?>" class="tooltip"/></a>
        </td>
      </tr>
    </table>
</div>
<div id="dialog" title="<?php echo _FM_MFILEUPL;?>">
    <?php include ("manager/upload.php"); ?>
</div>
<form action="" method="post" name="filelist" id="filelist">
    <table cellpadding="0" cellspacing="0" class="display">
      <thead>
        <tr>
          <th colspan="5" class="left"><?php echo _FM_VIEW_ALL;?></th>
        </tr>
        <tr>
          <th width="25">&nbsp;</th>
          <th class="left"><?php echo _FM_NAME;?></th>
          <th width="15%" class="left" nowrap="nowrap"><?php echo _FM_SIZE;?></th>
          <th width="15%" class="left" nowrap="nowrap"><?php echo _FM_PERM;?></th>
          <th width="15%" class="right"><?php echo _ACTIONS;?></th>
        </tr>
      <tr>
        <td><img src="manager/images/mime/folder.gif" alt="" /></td>
        <td>
        <a href="
		<?php
			$p_ar = explode("/", $rel_dir, strlen($rel_dir));
			$prev_dir = "";
			for ($i = 0; $i < count($p_ar) - 2; $i++) :
				$prev_dir = $prev_dir . $p_ar[$i];
				if ($i != count($p_ar) - 2)
					$prev_dir = $prev_dir . "/";
			endfor;
			if ($prev_dir == "") :
				echo "index.php?do=filemanager&amp;page=fm";
				$prev_dir = "/";
			 else :
				echo "index.php?do=filemanager&amp;rel_dir=" . $prev_dir;
			endif;?>" ><strong>...</strong>
        </a>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="right"><input type="checkbox" name="toggleAll" class="tooltip" title="<?php echo _FM_SEL_ALL;?>" onclick="ToggleAll(this);" /></td>
      </tr>
      </thead>
      <?php
		  sort($dir_list);
		  $cdirs = 0;
		  $cfiles = 0;
		  
		  for ($i = 0; $i < $dir_count; $i++) {
			  if ($cdirs % 2 == 0) {
				  $color = "even";
			  } else {
				  $color = "odd";
			  }
			  include("manager/dbar.php");
			  $cdirs++;
		  }
		  sort($file_list);
		  for ($i = 0; $i < $file_count; $i++) {
			  if ($cfiles % 2 == 0) {
				  $color = "even";
			  } else {
				  $color = "odd";
			  }
			  include("manager/fbar.php");
			  $cfiles++;
		  }
	  ?>
    </table>

  <div style="margin-top:5px">
    <div style="padding:5px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong><?php echo _FM_DIRS;?>:
            <?php  echo $cdirs; ?>
            <?php echo _FM_FILES;?>:
            <?php  echo $cfiles; ?>
          </strong></td>
          <td style="text-align:right">
            <input name="m_cut" type="submit" class="button" id="m_cut" value="<?php echo __('Couper'); ?>" />
            <input name="m_copy" type="submit" class="button" id="m_copy" value="<?php echo __('Copier'); ?> " />
            <?php if(isset($_SESSION['action']) && $_SESSION['action']!=''):?>
            <input name="m_paste" type="submit" class="button" id="m_paste" value="<?php echo __('Coller'); ?>" />
            <?php endif; ?>
            <input name="m_chmod" type="submit" class="button" value="<?php echo __('Chmod'); ?>" onclick="chmodAll();" />
            <input name="m_delete" type="submit" class="button" id="m_delete" value="<?php echo __('Supprimer'); ?>" onclick="deleteAll();" /></td>
        </tr>
      </table>
    </div>
  </div>
</form>
<div style="margin-top:5px" class="box">
  <table cellpadding="0" cellspacing="0" class="display">
    <tbody>
      <tr style="background-color:transparent">
        <td colspan="2"><img src="manager/images/icons/delete.png" alt="" class="tooltip" title="<?php echo _FM_DELFILE;?>"/> <?php echo _FM_DELFILE;?>&nbsp;&nbsp;&nbsp;<img src="manager/images/icons/view.png" alt="" class="tooltip" title="<?php echo _FM_VIEWFILE;?>" /> <?php echo _FM_VIEWFILE;?></td>
        <td align="right"><strong><?php echo _FM_NEWFILE;?>:</strong></td>
        <td align="right" style="width:320px"><form name="form1" method="post" action="index.php?do=filemanager&amp;rel_dir=<?php echo $rel_dir; ?>">
            <input name="file" type="text" class="inputbox" id="file2" style="width:220px"  />
            <input name="submit" type="submit" class="button" value="<?php echo _SUBMIT; ?>" />
          </form></td>
      </tr>
      <tr style="background-color:transparent">
        <td colspan="2"><img src="manager/images/icons/lock.png" alt="" class="tooltip" title="<?php echo _FM_CHGPER;?>" /> <?php echo _FM_CHGPER;?>&nbsp;&nbsp;&nbsp;<img src="manager/images/icons/edit.png" alt="" class="tooltip" title="<?php echo _FM_EDITFILE;?>" /> <?php echo _FM_EDITFILE;?></td>
        <td align="right"><strong><?php echo _FM_NEWDIR;?>:</strong></td>
        <td colspan="2" align="right"><form name="form2" method="post" action="index.php?do=filemanager&amp;rel_dir=<?php echo $rel_dir; ?>">
            <input name="dir" type="text" class="inputbox" id="dir2" size="40"  style="width:220px"/>
            <input name="submit2" type="submit" class="button" value="<?php echo _SUBMIT;?>" />
          </form></td>
      </tr>
    </tbody>
  </table>
</div>
<?php endif; ?>