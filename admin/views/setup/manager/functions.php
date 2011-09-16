<?php
  /**
   * Functions
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: functions.php,v 1.00 2010-07-20 10:12:05 gewa Exp $
   */

  function isimage($str)
  {
      $image_file = array("gif", "jpg", "jpeg", "png", "GIF", "JPG", "JPEG", "PNG");
      for ($f = 0; $f < count($image_file); $f++) {
          if ($str == $image_file[$f])
              return true;
      }
      return false;
  }
  
  function iseditable($str)
  {
      $edit_file = array("php", "txt", "htm", "html", "php3", "asp", "xml", "css", "inc", "js");
      for ($f = 0; $f < count($edit_file); $f++) {
          if ($str == $edit_file[$f])
              return true;
      }
      return false;
  }
  
  function isviewable($str)
  {
      $edit_file = array("php", "txt", "htm", "html", "php3", "asp", "xml", "css", "inc", "js");
      for ($f = 0; $f < count($edit_file); $f++) {
          if ($str == $edit_file[$f])
              return true;
      }
      return false;
  }
  
  function getPerms($in_Perms)
  {
      $sP = '';
      // owner
      $sP .= (($in_Perms & 0x0100) ? 'r' : '&minus;') . (($in_Perms & 0x0080) ? 'w' : '&minus;') . (($in_Perms & 0x0040) ? (($in_Perms & 0x0800) ? 's' : 'x') : (($in_Perms & 0x0800) ? 'S' : '&minus;'));
      
      // group
      $sP .= (($in_Perms & 0x0020) ? 'r' : '&minus;') . (($in_Perms & 0x0010) ? 'w' : '&minus;') . (($in_Perms & 0x0008) ? (($in_Perms & 0x0400) ? 's' : 'x') : (($in_Perms & 0x0400) ? 'S' : '&minus;'));
      
      // world
      $sP .= (($in_Perms & 0x0004) ? 'r' : '&minus;') . (($in_Perms & 0x0002) ? 'w' : '&minus;') . (($in_Perms & 0x0001) ? (($in_Perms & 0x0200) ? 't' : 'x') : (($in_Perms & 0x0200) ? 'T' : '&minus;'));
      return $sP;
  }
  
  function purge($dir)
  {
      $handle = opendir($dir);
      while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != "..") {
              if (is_dir($dir . $file)) {
                  purge($dir . $file . "/");
                  rmdir($dir . $file);
              } else {
                  unlink($dir . $file);
              }
          }
      }
      closedir($handle);
  }
  
  function chmoddir($dir, $perm)
  {
      $handle = opendir($dir);
      while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != "..") {
              if (is_dir($dir . $file)) {
                  chmoddir($dir . $file . "/", $perm);
                  chmod($dir . $file, $perm);
              } else {
                  chmod($dir . $file, $perm);
              }
          }
      }
      closedir($handle);
  }
  
  function xcopy($basedir, $txtFolderName, $action)
  {
      if ($handle = @opendir($basedir)) {
          while (false !== ($dir = readdir($handle))) {
              if ($dir != '.' && $dir != '..') {
                  if (is_dir($basedir . "/" . $dir)) {
                      $mkSuccess = mkdir($txtFolderName . "/" . $dir);
                      xcopy($basedir . "/" . $dir, $txtFolderName . "/" . $dir, $action);
                      if ($action == "cut")
                          purge($basedir . "/" . $dir);
                  } else {
                      copy($basedir . "/" . $dir, $txtFolderName . "/" . $dir);
                      if ($action == "cut")
                          unlink($basedir . "/" . $dir);
                  }
              }
          }
          closedir($handle);
      }
  }
  
  function get_sourcecode($filename, $first_line_num = 1, $num_color = "#1DA4F3")
  {
      $html_code = highlight_file($filename, true);
      
      if (substr($html_code, 0, 6) == "<code>") {
          $html_code = substr($html_code, 6, strlen($html_code));
      }
      
      $xhtml_convmap = array('<font' => '<span', '</font>' => '</span>', 'color="' => 'style="color:');
      
      $html_code = strtr($html_code, $xhtml_convmap);
      
      $arr_html_code = explode("<br />", $html_code);
      $total_lines = count($arr_html_code);
      
      $retval = "";
      $line_counter = 0;
      $last_line_num = $first_line_num + $total_lines;
      foreach ($arr_html_code as $html_line) {
          $current_line = $first_line_num + $line_counter;
          
          $retval .= str_repeat("&nbsp;", strlen($last_line_num) - strlen($current_line)) . "<span style=\"color:{$num_color}\">{$current_line}: </span>" . $html_line . "<br />";
          
          $line_counter++;
      }
      
      $retval = "<code>" . $retval;
      
      return $retval;
  }
  
  function getSize($size, $precision = 2, $long_name = false, $real_size = true)
  {
      $base = $real_size ? 1024 : 1000;
      $pos = 0;
      while ($size > $base) {
          $size /= $base;
          $pos++;
      }
      $prefix = _getSizePrefix($pos);
      @$size_name = ($long_name) ? $prefix . "bytes" : $prefix[0] . "B";
      return round($size, $precision) . ' ' . ucfirst($size_name);
  }

  function _getSizePrefix($pos)
  {
      switch ($pos) {
          case 00:
              return "";
          case 01:
              return "kilo";
          case 02:
              return "mega";
          case 03:
              return "giga";
          default:
              return "?-";
      }
  }
?>