<?php echo $html->doctype('xhtml1-trans'); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr-FR">
<head>
	<?php
		echo $html->title($html_title);
		echo $html->meta('Content-type', 'text/html; charset=UTF-8', 'equiv');
		echo $html->link(BASEURL.'images/favicon.ico', 'shortcut icon', 'image/ico');
		echo $html->link(BASEURL.'styles/style.css');
		echo $html->scripts('jscripts/jquery-1.6.1.min.js');
		echo $html->scripts('jscripts/jquery-ui-1.8.13.min.js');
		#https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js
		#https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js
		echo $html->scripts('jscripts/jquery.radioSwitch.js');
		#echo $html->scripts('jscripts/wysiwyg.js');
		echo $html->scripts('jscripts/admin.custom.2.0.js');
	?>
</head>