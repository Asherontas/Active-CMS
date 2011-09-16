<?php 

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Newsletters', 'images/title/32/mailing.png', '1' );

$page_info = __('Voici la liste des internautes inscrits dans la newsletters.<br /> Dans la colonne Actions, vous pouvez supprimer et envoyer un email pour les abonnées !');
get_result(null, null, $page_info); 
	
$Requete = $Mysql->TabResSQL('SELECT COUNT(*) AS count FROM '.TBL_MAILING);

foreach ( $Requete as $nbItems ) {
    $nbItems = $nbItems['count'];
}

$itemsParPage = $ini->setVariables($ini_file, $site_section, 'NbItemsPerPage');

//Nombre de pages
$nbPages = $nbItems/$itemsParPage;

//Numéro de Page courante
if(!isset($_GET['page'])) {
	$pageCourante = 1;

}elseif(is_numeric($_GET['page']) && $_GET['page']<=$nbPages) {
	$pageCourante = $_GET['page'];

}else {
	$pageCourante = $nbPages;
}

//Calcul de la clause LIMIT
$limitstart = $pageCourante*$itemsParPage-$itemsParPage;
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_sorter" class="tablesorter table_liste">
    <tr>
      <th width="5%" align="center"><?php echo __('ID'); ?></th>
      <th width="25%" align="center"><?php echo __('Nom'); ?></th>
      <th width="50%" align="center"><?php echo __('Address Email'); ?></th>
      <th width="20%" align="center"><?php echo __('Inscription'); ?></th>
      <th width="10%" align="center" colspan="2"><?php echo __('Actions'); ?></th>
    </tr>
    <?php
        $Resultat = $Mysql->TabResSQL('SELECT * FROM '.TBL_MAILING.' ORDER BY id DESC LIMIT '.$limitstart.','.$itemsParPage.'');

        foreach ( $Resultat as $Donnees ) {

            $SubscribeID    = $Donnees['ID'];
            $SubscribeName  = $Donnees['sub_name'];
            $SubscribeMail  = $Donnees['sub_email'];
            $SubscribeDate  = $Donnees['sub_date'];
    ?>
     <tr id="row_<?php echo $SubscribeID; ?>" class="vertical_rows">
      <td align="center"><?php echo $SubscribeID; ?></td>
      <td align="center"><?php echo $SubscribeName; ?></td>
      <td align="center"><?php echo $SubscribeMail; ?></td>
      <td align="center"><?php echo date($PublishedDateFormat, $SubscribeDate); ?></td>
      <td align="center"><a href="?action=send_mail&id=<?php echo $SubscribeID ?>" class="tooltips"><img src="images/send.png" alt="Mettre à jour" /><span class="tooltip"><?php echo __('Lui envoyer un message'); ?></span></a></td>
      <td class="bg_blanc" align="center"><a href="#" class="tooltips"><img src="images/delete.png" class="delete_page" id="<?php echo $SubscribeID; ?>" alt="Suppression" /><span class="tooltip"><?php echo __('Supprimer ce compte !'); ?></span></a></td>
    </tr>
  <?php  } ?>
</table>
<?php
    if ( $nbItems >= $itemsParPage ) {
        include_once ( ABSBOPATH . DS . CLASSES . DS . 'paginate.class.php' ); // CLASSE PAGINATION
        Pagination::affiche('admin.php?action=liste_pages','&page', $nbPages, $pageCourante, 10);
    }
?>