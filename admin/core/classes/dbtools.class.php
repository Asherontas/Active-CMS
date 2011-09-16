<?php

  /**
   * DB Tools Class
   *
   * @package CMS Pro
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: class_dbtootls.php,v 1.00 2010-07-20 10:12:05 gewa Exp $
   */

define('nl', "\r\n");
  
class dbTools {
	  
      private $tables = array();
      private $suffix = 'd-M-Y_H-i-s';
      
      
      /**
       * dbTools::doBackup()
       * 
       * @param string $fname
       * @param bool $gzip
       * @return
       */
      function doBackup($fname = '', $gzip = true)
      {
          global $Mysql;
          
          if (!($sql = $this->fetch())) {
              return false;
          } else {
              $fname = ABSPATH . '/admin/backups/';
              $fname .= date($this->suffix);
              $fname .= ($gzip ? '.sql.gz' : '.sql');
              
              $this->save($fname, $sql, $gzip);
              
			  $ext = ($gzip ? '.sql.gz' : '.sql'); 
              $data['backup'] = date($this->suffix) . $ext;
              $Mysql->update("settings", $data);
              
              if ($Mysql->affected())
                  redirect_to("backup&backupok=1");
          }
      }

      /**
       * dbTools::doRestore()
       * 
       * @param string $fname
       * @return
       */
	  function doRestore($fname){
		  global $Mysql, $msgError;
		  
		  $filename = ABSPATH . '/admin/backups/'.trim($fname);
		  $templine = '';
		  $lines = file($filename);
		  foreach ($lines as $line_num => $line) {
			  if (substr($line, 0, 2) != '--' && $line != '') {
				  $templine .= $line;
				  if (substr(trim($line), -1, 1) == ';') {
					  if (!$Mysql->query($templine)) {
						  $msgError = false;
						  $msgError =  "<div class=\"qerror\">'".mysql_errno()." ".mysql_error()."' during the following query:</div> 
						  <div class=\"query\">{$templine} </div>";
					  }
					  $templine = '';
				  }
			  }
		  }
		  redirect_to("index.php?do=backup&restore=1");
	  }
        
      /**
       * dbTools::getTables()
       * 
       * @return
       */
      function getTables()
      {
          global $Mysql;
          
          $value = array();
          if (!($result = $Mysql->query('SHOW TABLES'))) {
              return false;
          }
          while ($row = $Mysql->fetchrow($result)) {
              if (empty($this->tables) or in_array($row[0], $this->tables)) {
                  $value[] = $row[0];
              }
          }
          if (!sizeof($value)) {
              $Mysql->error("No tables found in database");
              return false;
          }
          return $value;
      }
      
      
      /**
       * dbTools::dumpTable()
       * 
       * @param mixed $table
       * @return
       */
      function dumpTable($table)
      {
          global $Mysql;
          $damp = '';
          $Mysql->ExecuteSQL('LOCK TABLES ' . $table . ' WRITE');
          
          $damp .= '-- --------------------------------------------------' . nl;
          $damp .= '# -- Table structure for table `' . $table . '`' . nl;
          $damp .= '-- --------------------------------------------------' . nl;
          $damp .= 'DROP TABLE IF EXISTS `' . $table . '`;' . nl;
          
          if (!($result = $Mysql->query('SHOW CREATE TABLE ' . $table))) {
              return false;
          }
          $row = $Mysql->fetch($result);
          $damp .= str_replace("\n", nl, $row['Create Table']) . ';';
          $damp .= nl . nl;
          $damp .= '-- --------------------------------------------------' . nl;
          $damp .= '# Dumping data for table `' . $table . '`' . nl;
          $damp .= '-- --------------------------------------------------' . nl . nl;
          $damp .= $this->insert($table);
          $damp .= nl . nl;
          $Mysql->query('UNLOCK TABLES');
          return $damp;
      }
      
      
      /**
       * dbTools::insert()
       * 
       * @param mixed $table
       * @return
       */
	  function insert($table)
	  {
		  global $Mysql;
		  
		  $output = '';
		  if (!$query = $Mysql->fetch_all("SELECT * FROM `" . $table . "`")) {
			  return false;
		  }
		  foreach ($query as $result) {
			  $fields = '';
			  
			  foreach (array_keys($result) as $value) {
				  $fields .= '`' . $value . '`, ';
			  }
			  $values = '';
			  
			  foreach (array_values($result) as $value) {
				  $value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
				  $value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
				  $value = str_replace('\\', '\\\\', $value);
				  $value = str_replace('\'', '\\\'', $value);
				  $value = str_replace('\\\n', '\n', $value);
				  $value = str_replace('\\\r', '\r', $value);
				  $value = str_replace('\\\t', '\t', $value);
				  
				  $values .= '\'' . $value . '\', ';
			  }
			  
			  $output .= 'INSERT INTO `' . $table . '` (' . preg_replace('/, $/', '', $fields) . ') VALUES (' . preg_replace('/, $/', '', $values) . ');' . "\n";
		  }
		  return $output;
	  }
      
      /**
       * dbTools::fetch()
       * 
       * @return
       */
      function fetch()
      {
          global $Mysql;
          $dump = '';
          
		  $database = $Mysql->getDB();
		  $server = $Mysql->getServer();
		  
          $dump .= '-- --------------------------------------------------------------------------------' . nl;
          $dump .= '-- ' . nl;
          $dump .= '-- @version: ' . $database . '.sql ' . date('M j, Y') . ' ' . date('H:i') . ' gewa' . nl;
          $dump .= '-- @package CMS Pro' . nl;
          $dump .= '-- @author wojoscripts.com.' . nl;
          $dump .= '-- @copyright 2010' . nl;
          $dump .= '-- ' . nl;
          $dump .= '-- --------------------------------------------------------------------------------' . nl;
          $dump .= '-- Host: ' . $server . nl;
          $dump .= '-- Database: ' . $database . nl;
          $dump .= '-- Time: ' . date('M j, Y') . '-' . date('H:i') . nl;
          $dump .= '-- MySQL version: ' . mysql_get_server_info() . nl;
          $dump .= '-- PHP version: ' . phpversion() . nl;
          $dump .= '-- --------------------------------------------------------------------------------' . nl . nl;
          
		  $database = $Mysql->getDB();
          if (!empty($database)) {
              $dump .= '#' . nl;
              $dump .= '# Database: `' . $database . '`' . nl;
          }
          $dump .= '#' . nl . nl . nl;
          
          if (!($tables = $this->getTables())) {
              return false;
          }
          foreach ($tables as $table) {
              if (!($table_dump = $this->dumpTable($table))) {
                  $Mysql->error("mySQL Error : ");
                  return false;
              }
              $dump .= $table_dump;
          }
          return $dump;
      }
      
      
      /**
       * dbTools::save()
       * 
       * @param mixed $fname
       * @param mixed $sql
       * @param mixed $gzip
       * @return
       */
      function save($fname, $sql, $gzip)
      {
          global $msgError;
          if ($gzip) {
              if (!($zf = gzopen($fname, 'w9'))) {
                  $msgError = "<span>Error!</span>can not write to " . $fname;
                  return false;
              }
              gzwrite($zf, $sql);
              gzclose($zf);
          } else {
              if (!($f = fopen($fname, 'w'))) {
                  $msgError = "<span>Error!</span>can not write to " . $fname;
                  return false;
              }
              fwrite($f, $sql);
              fclose($f);
          }
          return true;
      }
      
      /**
       * dbTools::showTables()
       * 
       * @param mixed $Mysqltable
       * @return
       */
      function showTables($Mysqltable)
      {
          global $Mysql;
		  $database = $Mysql->getDB();
		  
          $sql = "SHOW TABLES FROM " . $database;
          $result = $Mysql->query($sql);
          $show = '';
          
          while ($row = $Mysql->fetchrow($result))
              : $selected = ($row[0] == $Mysqltable) ? " selected=\"selected\"" : "";
          $show .= "<option value=\"" . $row[0] . "\"" . $selected . ">" . $row[0] . "</option>\n";
          endwhile;
          
          $Mysql->free($result);
          
          return($show);
      }
      
      /**
       * dbTools::displayTable()
       * 
       * @param mixed $Mysqltable
       * @return
       */
      function displayTable($Mysqltable)
      {
          global $Mysql;
          if (isset($Mysqltable)) {
              if (!empty($Mysqltable)) {
                  $result = $Mysql->query("SELECT * FROM " . $Mysqltable);
                  $fields = $Mysql->numfields($result);
                  $rows = $Mysql->numrows($result);
                  $k = 0;
                  $Mysqltable = mysql_field_table($result, $k);
                  $display = '';
                  $display .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="display">';
                  $display .= '<thead>';
                  $display .= '<tr>';
                  $display .= '<td colspan="4">' . lang('SYS_TBL_PROP') . ' &rsaquo; ' . $Mysqltable . '</td>';
                  $display .= "</tr>\n";
                  $display .= '</thead>';
                  $display .= '<tr>';
                  $display .= '<th>' . lang('FIELD') . ' ' . lang('NAME') . '</th>';
                  $display .= '<th>' . lang('FIELD') . ' ' . lang('TYPE') . '</th>';
                  $display .= '<th>' . lang('FIELD') . ' ' . lang('LENGHT') . '</th>';
                  $display .= '<th>' . lang('FIELD') . ' ' . lang('FLAGS') . '</th>';
                  $display .= "</tr>\n";
                  
                  $alt = '0';
                  $display .= '<tbody>';
                  while ($k < $fields) {
                      $col = ($alt % 2) ? 'odd' : 'even';
                      $alt++;
                      
                      $display .= '<tr class="' . $col . '">';
                      $name = mysql_field_name($result, $k);
                      $type = mysql_field_type($result, $k);
                      $len = mysql_field_len($result, $k);
                      $flags = mysql_field_flags($result, $k);
                      
                      $display .= '<td>' . $name . '</td>';
                      $display .= '<td>' . $type . '</td>';
                      $display .= '<td>' . $len . '</td>';
                      $display .= '<td>' . $flags . '</td>';
                      $k++;
                      $display .= "</tr>\n";
                  }
                  $display .= '</tbody></table>';
              }
              return $display;
          }
      }
      
      /**
       * dbTools::optimizeDb()
       * 
       * @return
       */
      function optimizeDb()
      {
          global $Mysql;
		  $database = $Mysql->getDB();
		  
          $display = '';
          $display .= '<table border="0" cellspacing="0" cellpadding="0" class="display">';
          $display .= '<thead><tr>';
          $display .= '<td colspan="4">Database ' . $database . '</td>';
          $display .= '</tr>';
          $display .= '<tr>';
          $display .= '<th colspan="2">Repairing... </th>';
          $display .= '<th colspan="2">Optimizing... </th>';
          $display .= '</tr></thead><tbody>';
          
          $sql = "SHOW TABLES FROM " . $database;
          $result2 = $Mysql->query($sql);
          while ($row = $Mysql->fetchrow($result2)) {
              $table = $row[0];
              
              $display .= '<tr>';
              $display .= '<td width="300">' . $table . '</td>';
              $display .= '<td align="center" width="70">';
              
              $sql = "REPAIR TABLE `" . $table . "`";
              $result = $Mysql->query($sql);
              if (!$result) {
                  $Mysql->error("mySQL Error on Query : " . $sql);
              } else
                  $display .= 'Status <img src="' . ADMINURL . '/images/icons/checkmark.gif" title="Table ' . $table . ' Repaired" alt="Ok" class="tooltip" />';
				  
              $display .= '</td>';
              $display .= '<td width="300">' . $table . '</td>';
              $display .= '<td align="center" width="70">';
              
              $sql = "OPTIMIZE TABLE `" . $table . "`";
              $result = $Mysql->query($sql);
              if (!$result) {
                  $Mysql->error("mySQL Error on Query : " . $sql);
              } else
                  $display .= 'Status <img src="' . ADMINURL . '/images/icons/checkmark.gif" title="Table ' . $table . ' Optimized" alt="Ok" class="valign tooltip" />';
          
          $display .= '</td></tr>';
		  }
          $display .= '</tbody></table>';
          
          return $display;
      }
  }
?>