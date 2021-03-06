<?php
/**
* Get all the folder from current path. 
* For data or test
* @return void.
*/
function getAllApps(){
	$dir1 = scandir('.');

    foreach($dir1 as $element) {
	    if (is_dir($element) && $element != '.' && $element != '..' && $element != 'scripts' && $element != 'batch') {
	        echo '<option value="'.$element .'">'.$element .'</option>';
	    }
    }
}

Function getAllEnv() {
    $Env= array("integration","integration2","preprod","production");
    foreach($Env as $element) {
        echo '<option value="'.$element.'">'.$element.'</option>';
    }
}

function getAllTest() {
	if (isset($_GET['application'])) {
        $application=htmlentities($_GET['application']);
        $path = $application;
    }
    //liste les fichiers dans les dossiers de donnees
    $nb_fichier = 0;
    if($dossier = opendir($path)) {
        while(false !== ($fichier = readdir($dossier))){
            if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.DS_Store' && $fichier != 'template.csv'){                    
                $nb_fichier++;
                $nomFichier = substr($fichier, 0, -5);
                echo '<option value="'. $nomFichier .'">'. $nomFichier .'</option>';
            }            
        }      
        closedir($dossier);
    } else {
   		echo'<option value="erreur">erreur</option>';
	}
}

/**
* Get all the files of a selected application's folder.
* Only for data folder 
* @return $html, HTML.
*/
function getAllDatas() {
        if (isset($_GET['application'])) {
        $application=htmlentities($_GET['application']);
        $path = "../data/".$application;
    }
    //liste les fichiers dans les dossiers de donnees
    $nb_fichier = 0;
    if($dossier = opendir($path)) {
        while(false !== ($fichier = readdir($dossier))){
            if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.DS_Store' && $fichier != 'template.csv'){                    
                $nb_fichier++;
                $nomFichier = substr($fichier, 0, -4);
                echo '<option value="'. $nomFichier .'">'. $nomFichier .'</option>';
            }            
        }      
        closedir($dossier);
    } else {
   		echo'<option value="erreur">erreur</option>';
	}
}

function getAllTestInUl() {
	if (isset($_POST['application'])) {
        $application=htmlentities($_POST['application']);
    }
    //liste les fichiers dans les dossiers de donnees
    $nb_fichier = 0;
    $html = '<ul>';
    if($dossier = opendir($application)) {
        while(false !== ($fichier = readdir($dossier))){
            if($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.DS_Store' && $fichier != 'template.csv'){                    
                $nb_fichier++;
                $nomFichier = substr($fichier, 0, -5);
                $html .= '<div id="data"><li>'. $nomFichier .'</li></div>';

            }            
        }
        $html .= '</ul>';
        $html .= 'Il y a <strong>' . $nb_fichier .'</strong> tests dans la base pour cette application</div>';
        closedir($dossier);
    } else {
   		$html .= 'Le dossier n\' a pas pu être ouvert';
	}
        echo $html;
}

function startTest() {
    if (isset($_GET['application'])) {$application=htmlentities($_GET['application']);}
    else {echo 'paramètres manquant <br>';}
    if (isset($_GET['environnement'])) {$environnement=htmlentities($_GET['environnement']);}
    else {echo 'paramètres manquant <br>';}
    if (isset($_GET['Donnees'])) {$Donnees=htmlentities($_GET['Donnees']);}
    else {echo 'paramètres manquant <br>';}
    if (isset($_GET['Test'])) {$Test=htmlentities($_GET['Test']);}
    else {echo 'paramètres manquant <br>';}
    // if host OS is linux 
        //$execution = "do_build.sh"." ".$application." ".$environnement." ".$Donnees." ".$Test;
    //if host OS is windows
    $execution = 'start batch/do_build_1.bat'.' '.$application.' '.$environnement.' '.$Donnees.' '.$Test;
    $output = shell_exec($execution);
    if(shell_exec($execution!= NULL)) {
        echo "Votre test est lancé, il s'affichera dans l'historique, dès qu'il sera achevé.";
    }
    else {
        echo "Une erreur est survenue, échec dans le lancement du test <br>";
        #TODO delete these 2 (just for test)
        echo 'vars : <br>';
        echo $execution;
        echo $output;
    }
}