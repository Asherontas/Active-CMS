<?php echo $html->doctype('xhtml1-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr-FR">
<head>
    <title><?php echo __($html_title); ?></title>
    <?php
		echo $html->meta('Content-type', 'text/html; charset=UTF-8', 'equiv');
		echo $html->link(BASEURL.'images/favicon.ico', 'shortcut icon', 'image/ico');
		echo $html->link(BASEURL.'styles/style.css');
    ?>
</head>