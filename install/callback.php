<?php 


// ACTIVE CMS INSTALLATION
// ACTIVE CMS VERSION 1.2.0 2010-2011

session_start();

error_reporting(E_ALL ^ E_NOTICE);

sleep(2);

$data 		= array(); // json array
$my_sql	  	= array(); // db array
$now 		= time(); // Datetime
$file_connexion = '../admin/db_connexion.php'; // File BDD

$data['response'] 	= false;
$data['step'] 		= false;


if ( $_GET['step'] == 2 ) {
		
	if (isset($_POST['dbname'])) { // BDD Params
		
		$db_host 		= addslashes($_POST['dbhost']);
		$db_username 		= addslashes($_POST['dbuser']);
		$db_password 		= addslashes($_POST['dbpass']);
		$db_name 		= addslashes($_POST['dbname']);
		$db_prefix 		= addslashes($_POST['dbprefix']);
		
		$_SESSION['host'] 	= $db_host;
		$_SESSION['username'] 	= $db_username;
		$_SESSION['password'] 	= $db_password;
		$_SESSION['name'] 	= $db_name;
		$_SESSION['prefix'] 	= $db_prefix;
		
		$connexion = mysql_connect($db_host, $db_username, $db_password);
		
		if ( ! $connexion ) {
		
			$data['message']  = 'Impossible de se connecter a la base de donnees';
			$data['response'] = false;
		}
		else {
			
			// This part sets up the database if not set up already
			mysql_query("DROP DATABASE IF EXISTS `$db_name`", $connexion);
			mysql_query("CREATE DATABASE IF NOT EXISTS `$db_name`;", $connexion);
		
			$configuration	= fopen($file_connexion, 'a');
			$donnees	= '
			<?php
			
			// ACTIVE CMS
			// PARAMETRES LA BASE DE DONNEES
			
			define(\'DB_HOST\', \''.$db_host.'\'); // MySQL Hostname
			define(\'DB_USER\', \''.$db_username.'\'); // MySQL Username
			define(\'DB_PASSWORD\', \''.$db_password.'\'); // MySQL Password
			define(\'DB_NAME\', \''.$db_name.'\'); // MySQL Database
			define(\'DB_PREFIX\', \''.$db_prefix.'\'); // MySQL Database Prefix
			
			?>';

			if ( file_exists($file_connexion) AND is_writable($file_connexion) ) {
				
				fwrite($configuration, $donnees);
				fclose($configuration);
				
				$data['response']	= true;
			}
			else {

				$data['message']	= 'Le fichier db_connexion.php n\'est pas eccessible en écriture !';
				$data['response']	= false;
			}
		}
	}
}
	
if ( $_GET['step'] == 3	) {
	
	if (isset($_POST['site_name'])) {

		// User Params
		$site_name              = $_POST['site_name'];
		$user_email 		= trim(addslashes($_POST['user_email']));
		$user_login		= trim(addslashes($_POST['user_login']));
		$user_password	 	= trim(addslashes($_POST['user_password']));
		$user_password_confirm 	= trim(addslashes($_POST['user_password_confirm']));
		
		if ( $user_password !== $user_password_confirm ) {
			
			$data['message']	= 'Les mot de passe sont différent !';
			$data['response']	= false;
		}
		else {
		
			$user_password_hash = md5($user_password);
			
			$connexion = mysql_connect($_SESSION['host'] , $_SESSION['username'], $_SESSION['password']) or die("Serveur mysql inaccessible");
	
			if (!$connexion) {

				$data['message']	= 'Impossible de se connecter a la base de donnees';
				$data['response']	= false;
			}
			else {
				mysql_select_db($_SESSION['name']) or die("base de données inaccessible");
				
				$my_sql[] = "DROP TABLE IF EXISTS `".$_SESSION['prefix']."pages`";
				$my_sql[] = "DROP TABLE IF EXISTS `".$_SESSION['prefix']."mailing`";
				$my_sql[] = "DROP TABLE IF EXISTS `".$_SESSION['prefix']."users`";
				$my_sql[] = "DROP TABLE IF EXISTS `".$_SESSION['prefix']."settings`";
				
				$my_sql[] = "CREATE TABLE `".$_SESSION['prefix']."pages` (
							  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
							  `page_content` longtext COLLATE utf8_unicode_ci NOT NULL,
							  `page_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
							  `page_status` int(1) NOT NULL DEFAULT '0',
							  `page_modified` int(11) NOT NULL,
							  `page_published` int(11) NOT NULL,
							  `page_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
							  PRIMARY KEY (`ID`)
							) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
						
				
				$my_sql[] = "CREATE TABLE `".$_SESSION['prefix']."mailing` (
							  `ID` int(11) NOT NULL AUTO_INCREMENT,
							  `sub_email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `sub_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `sub_date` int(11) DEFAULT NULL,
							  PRIMARY KEY (`ID`)
							) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
				
				$my_sql[] = "CREATE TABLE `".$_SESSION['prefix']."users` (
							  `ID` int(11) NOT NULL AUTO_INCREMENT,
							  `user_login` varchar(60) NOT NULL DEFAULT '',
							  `user_pass` varchar(64) NOT NULL DEFAULT '',
							  `user_email` varchar(100) NOT NULL DEFAULT '',
							  `user_avatar` varchar(100) NOT NULL DEFAULT '',
							  `user_registered` int(11) NOT NULL DEFAULT '0',
							  `user_status` int(11) NOT NULL DEFAULT '0',
							  `user_firstname` varchar(250) NOT NULL DEFAULT '',
							  `user_lastname` varchar(250) NOT NULL DEFAULT '',
							  `user_level` int(11) NOT NULL DEFAULT '0',
							  PRIMARY KEY (`ID`),
							  KEY `user_firstname` (`user_firstname`)
							) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
						
				
				$my_sql[] = "CREATE TABLE `".$_SESSION['prefix']."settings` (
							  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
							  `setting_title` varchar(50) NOT NULL,
							  `setting_name` varchar(64) NOT NULL DEFAULT '',
							  `setting_type` varchar(50) NOT NULL,
							  `setting_value` longtext NOT NULL,
							  `setting_info` varchar(255) NOT NULL,
							  `setting_published` int(11) NOT NULL,
							  `setting_order` int(11) NOT NULL,
							  `setting_status` int(11) NOT NULL DEFAULT '1',
							  PRIMARY KEY (`ID`)
							) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
						
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('1', 'Nom du site', 'site_name', 'string', '$site_name', 'Nom de votre site', '0', '1', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('2', 'Slogan', 'site_slogan', 'string', 'Company Name', 'Décrivez en quelques mots, le contenu de votre ce site.', '0', '2', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('4', 'Keywords', 'site_keywords', 'text', '', 'info bulle', '0', '4', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('5', 'Description', 'site_description', 'text', 'site discreption, site name voila', 'info bulle', '0', '5', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('6', 'Email Administrateur', 'site_email', 'mail', '$user_email', 'Cette adresse est utilisée par exemple, pour l\'envoi des mail.', '0', '3', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('7', 'Publier le site', 'site_status', 'radio', '0', '', '0', '7', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('8', 'Seo URL', 'site_seo', 'radio', '0', '', '0', '8', '1');";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."settings` VALUES ('9', 'Template', 'site_template', 'template_path', 'default', 'tmp', '0', '6', '1')";
				$my_sql[] = "INSERT INTO `".$_SESSION['prefix']."users` (`ID`, `user_login`, `user_pass`, `user_email`, `user_registered`, `user_status`) VALUES ('', '$user_login', '$user_password_hash', '$user_email', '$now', '1');";
	
										
				foreach( $my_sql as $key=>$Query ) {
						
					$result = mysql_query($Query) or die("Erreur dans la requête SQL $key.");
					
					if ( $result ) {
						$data['response'] = true;
					}
					else{
						$data['message'] = 'Erreur lors de la création des tables !';
						$data['response'] = false;
					}	
				}
			}
		}	
	}
	else {
		
		$data['message'] = 'Données manquantes !';
	} 
}

if ($_GET['step'] == 4 OR $_GET['step'] == 5){

	$data['response'] = true;
}
	
echo json_encode($data);