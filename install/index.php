<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="fr-FR" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Active CMS | Installation</title>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/validate.js"></script>
<script type="text/javascript" src="assets/js/hoverIntent.js"></script>
<script type="text/javascript" src="assets/js/install.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var wizard = $("#wizard").wizardPro();
	$("#ContactWizard").wizardPro();
	//Remote Next/Prev Step 
	//wizard.openstep(2);
	//Block interaction
	//wizard.interactionBlock(1);
});
</script>
<link href="assets/css/wizardPro.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <h2>Active CMS Installation !</h2>
  <p>ActiveCMS 2010-2011 version 1.2.0 <br />
    Bienvenue dans l'installation de ActiveCMS, pour que l'installation soit réussie, veuillez suivez les informations suivantes.</p>
  <div id="wizard" class="wizard-default-style js">
    <ul class="steps">
      <li>1. Introduction</li>
      <li>2. Information de la BDD</li>
      <li>3. Information du site</li>
      <li>4. Finalisation</li>
    </ul>
    <div class="step_content"> 
      
      <!-- Wizard - Step 1 -->
      <div id="step-1" class="step one_column">
        <div class="column_one">
          <h3>&Eacute;tape 1 - Introduction</h3>
          <p><strong>Vous êtes maintenant prêt à installer activeCMS !<br />
             Avant de commencer, nous avons besoin de certaines informations. vous aurez besoin de connaître les points suivants avant de poursuivre.</strong></p>
          <ol>
            <li>Nom de la base de données</li>
            <li>Nom d'utilisateur de la base de données</li>
            <li>Mot de passe de l'utilisateur</li>
            <li>Nom du serveurs (hôte)</li>
            <li>Le préfixe des tables (si vous souhaitez faire tourner plusieurs sites dans une seule base de données)</li>
            <li>Donner le droit d'ecriture 777 pour le fichier admin/<strong>db_connexion.php</strong></li>
          </ol>
          <p>Selon toute vraisemblance, ces coordonnées vous ont été fournies par votre hébergeur.
             Si vous n'avez pas cette information, alors vous aurez besoin de les contacter avant de pouvoir continuer.
             Si vous savez tous, alors on est prêt...</p>
           <br />  
          <button class="next"><span>&Eacute;tape suivante</span></button>
        </div>
      </div>
      <!-- </Wizard - Step 1 --> 
      <!-- Wizard - Step 2 -->
      <div id="step-2" class="step two_column"> 
        
        <!-- Helper -->
        <div id="help-dbname" class="helper">
          <div class="text">
            <h3>Nom de la base de données</h3>
            <p>Le nom de la base de données que vous souhaitez exécuter ActiveCMS (La table sera créer automatiquement).</p>
          </div>
        </div>
        <!-- </Helper --> 
        
        <!-- Helper -->
        <div id="help-dbprefix" class="helper">
          <div class="text">
            <h3>Préfix des tables</h3>
            <p>Si vous souhaitez installer plusieurs sites en une seule base de données, changer cette préfix.</p>
          </div>
        </div>
        <!-- </Helper -->
        
        <div class="column_one">
          <h3>&Eacute;tape 2 - Informations de la BDD</h3>
          <p>Sur les champs a droite, vous devez saisir vos informations de connexion à la base de données.<br />
             Si vous n'êtes pas sûr de ceux-ci, contactez votre hébergeur. </p>
          <p style="color:red;"><strong>N'oublier pas d'affecter 777 au fichier db_connexion.php</strong></p>
        </div>
        <div class="column_two">
          <form action="callback.php?step=2" class="defaultRequest" method="post">
            <fieldset>
              <p>
                <label><a href="#help-dbname" class="show_helper"><span>(?)</span> Nom de la BDD</a></label>
                <input type="text" name="dbname" class="required" value="" />
              </p>
			  <p>
                <label>hôte du serveur</label>
                <input type="text" name="dbhost" value="localhost" />
              </p>
              <p>
                <label>Nom d'utilisateur</label>
                <input type="text" name="dbuser" value="root" />
              </p>
              <p>
                <label>Mot de passe</label>
                <input type="text" name="dbpass" value="" />
              </p>
              <p>
                <label><a href="#help-dbprefix" class="show_helper"><span>(?)</span>Préfix des tables</a></label>
                <input type="text" name="dbprefix" value="active_" />
              </p>
            </fieldset>
            <fieldset>
              <p>
                <label>&nbsp;</label>
                <button type="submit"><span>&Eacute;tape suivante</span></button>
              </p>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- </Wizard - Step 2 --> 
      <!-- Wizard - Step 3 -->
      <div id="step-3" class="step two_column"> 
        
        <!-- Helper -->
        <div id="help-username" class="helper">
          <div class="text">
            <h3>Nom d'utilisateur</h3>
            <p>Ceci est votre nom d'utilisateur pour se connecter après à l'dministration.</p>
          </div>
        </div>
        <!-- </Helper --> 
        
        <!-- Helper -->
        <div id="help-password" class="helper">
          <div class="text">
            <h3>Mot de passe</h3>
            <p><strong>Ceci est votre mot de passe pour se connecter après à l'dministration.</strong></p>
            <p>Astuce : Pour la rendre plus forte, utilisez des majuscules et des minuscules, des chiffres et des symboles comme ! "? $% ^ &).</p>
          </div>
        </div>
        <!-- </Helper -->
        
        <div class="column_one">
          <h3>&Eacute;tape 3 - Informations du CMS</h3>
          <p>Pour finaliser l'installation, <br />
          veuillez remplir les champs suivantes, afin de pouvoir se connecter après à l'administration (activecms).</p>
        </div>
        <div class="column_two">
          <form action="callback.php?step=3" class="defaultRequest" method="post">
            <fieldset>
              <p>
                <label>Nom du site</label>
                <input type="text" name="site_name" class="" value="" />
              </p>
              <p>
                <label><a href="#help-username" class="show_helper"><span>(?)</span> Nom d'utilisateur</a></label>
                <input type="text" name="user_login" class="required" value="" />
              </p>
              <p>
                <label><a href="#help-password" class="show_helper"><span>(?)</span> Mot de passe</a></label>
                <input type="password" name="user_password" value="" class="required" />
              </p>
              <p>
                <label>Retappez le Mode passe</label>
                <input type="password" name="user_password_confirm" class="required" value="" />
              </p>
              <p>
                <label>Addresse Email</label>
                <input type="text" name="user_email" class="required email" value="" />  
              </p>
                <label>&nbsp;</label>
                <br />
                <button type="submit"><span>Lancer l'installation</span></button>
              </p>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- </Wizard - Step 3 --> 
      
      <!-- Wizard - Step 4 -->
      <div id="step-4" class="step one_column">
        <div class="column_one">
          <h3>Succèss !</h3>
          <p>Active CMS a été correctment installé. Vous attendiez-vous plus d'étapes ? <br />
          
          </p>
          <br />
          <p>
           <a href="../admin/"> <button><span>Se connecter</span></button></a>
          </p>
        </div>
      </div>
      <!-- </Wizard - Step 4 --> 
    </div>
    <div class="no_javascript"> <img src="assets/img/warning.png" alt="Javascript Required" />
      <p>Javascript est nécessaire pour pouvoir utiliser cet assistant.<br />
        <a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654">Comment activer javascript</a> - <a href="http://www.mozilla.com/firefox/">Mettre à jour le navigateur</a></p>
    </div>
  </div>
</div>
</body>
</html>