<?php 
	
include_once 'functions.php';

include	INCLUDES . 'head.php';
include	INCLUDES . 'header.php';


if ( isset($_GET['id']) AND is_numeric($_GET['id']) ) include 'content.php';
else include 'frontpage.php';

include INCLUDES . 'footer.php'; 