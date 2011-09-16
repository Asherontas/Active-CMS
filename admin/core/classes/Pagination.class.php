<?php

class Pagination {
   		/**
   		 * Fonction qui retourne une div de pagination en fonction de plusieurs paramètres
   		 * @return $html une chaine contenant une div.
   		 * @param object $chemin
   		 * @param object $nomget
   		 * @param object $total
   		 * @param object $courante[optional]
   		 * @param object $affichage[optional]
   		 */
		public static function affiche($chemin,$nomget,$total,$courante=1,$affichage=2){

			$html = '';			//variable contenant le code HTML a retourner

			if($total<=1)
				return $html;			//Si il n'y a pas plus d'une page on renvoit rien...
			
			$precedent = $courante-1;
			$suivant = $courante+1;
			$textePrecedent = __('« préc');
			$texteSuivant = __('suiv »');
			
			$html .= '<div class="pagination">';
			
			
			/*Boutons précédent*/
			if ($courante == 2) // si on est sur la page 2, Nous retournons sur la page initiale (permet d'éviter les doublons index.php et index.php?page=1)
            	$html.= Pagination::lien($chemin,$textePrecedent);
       		elseif($courante > 2) // si la page courante est supérieure à 2 le bouton précédent renvoit sur la page dont le numéro est immédiatement inférieur
            	$html.= Pagination::lien($chemin,$textePrecedent,$nomget,$precedent);
        	else // sinon on désactive le bouton précédent
            	$html.= '<span class="desactive">'.$textePrecedent.'</span>';


				
			/*Affichage des numéros des pages*/
			
			
			if($total < 7 + $affichage*2){
				//affiche tous les numéros
				$html.= ($courante == 1) ? '<span class="courante">1</span>' : Pagination::lien($chemin,'1',$nomget,1);

	            // On boucle toutes les pages restantes boucle for
	            for ($i = 2; $i <= $total; $i++){
	                if ($i == $courante) // La page courante est affichée différemment
	                    $html.= '<span class="courante">'.$i.'</span>';
	                else
	                    $html.= Pagination::lien($chemin,$i,$nomget,$i);
	            }
			} elseif($total > 5 + ($affichage * 2)){
				/*Il y'en a trop donc il va falloir des "..." */
				if($courante < 1+($affichage * 2)){
					$html.= ($courante == 1) ? '<span class="courante">1</span>' : Pagination::lien($chemin,'1',$nomget,1);

		             // On boucle toutes les pages restantes boucle for
		           for($i = 2; $i < 4 + ($affichage * 2); $i++){
		                if ($i == $courante)// La page courante est affichée différemment
		                    $html.= '<span class="courante">'.$i.'</span>';
		                else
		                    $html.= Pagination::lien($chemin,$i,$nomget,$i);
					}
					  // les ... pour marquer la troncature
                	$html.= " ... ";

	                // et enfin les deux dernières pages
	                $html.= Pagination::lien($chemin,$total-1,$nomget,$total-1);
	                $html.= Pagination::lien($chemin,$total,$nomget,$total);
				}elseif($total - ($affichage * 2) > $courante && $courante > ($affichage * 2)){
	                // on affiche les deux premières pages
	                $html.= Pagination::lien($chemin,'1',$nomget,1);
	                $html.= Pagination::lien($chemin,'2',$nomget,2);
	
	                // les ... pour marquer la troncature
	                $html.= " ... ";
	
	                // puis sept pages : les trois précédent la page courante, la page courante, puis les trois lui succédant
	                for ($i= $courante - $affichage; $i<= $courante + $affichage; $i++){
	                    if ($i== $courante)
	                        $html.= '<span class="courante">'.$i.'</span>';
	                    else
	                        $html.= Pagination::lien($chemin,$i,$nomget,$i);
	                }
	
	                // les ... pour marquer la troncature
	                $html.= " ... ";

                	// et enfin les deux dernière spages
                	$html.= Pagination::lien($chemin,$total-1,$nomget,$total-1);
                	$html.= Pagination::lien($chemin,$total,$nomget,$total);
            	}
				 else{
	                // on affiche les deux premières pages
	                $html.= Pagination::lien($chemin,'1',$nomget,1);
	                $html.= Pagination::lien($chemin,'2',$nomget,2);
	
	                // les ... pour marquer la troncature
	                $html.= " ... ";
	
	                // et enfin les neuf dernières pages
	                for ($i = $total - (2 + ($affichage * 2)); $i <= $total; $i++){
	                    if ($i == $courante)
	                        $html.= '<span class="courante">'.$i.'</span>';
	                    else
	                        $html.= Pagination::lien($chemin,$i,$nomget,$i);
	                }
 	           }
			}
            
			/*Bouton suivant*/
			if ($courante < $total)
            	$html.= Pagination::lien($chemin,$texteSuivant,$nomget,$suivant);
        	else
			    $html.= '<span class="desactive">'.$texteSuivant.'</span>';


			
			$html .= '</div>';
			
			echo $html;
   		}
		
		/**
		 * Méthode qui renvoit un lien en fonction de plusieurs paramètres
		 * @return $lien un lien 
		 * @param object $chemin notre fichier
		 * @param object $texte texte du lien
		 * @param object $parametre[optional] parametre GET
		 * @param object $valeur[optional] valeur du parametre GET
		 */
		public static function lien($chemin,$texte,$parametre='',$valeur=''){
			$lien = '<a href="'.$chemin;
			
			if(!empty($parametre))
				$lien .= $parametre.'='.$valeur;
			
			$lien .= '">'.$texte.'</a>';
			return $lien;
		}
		
}