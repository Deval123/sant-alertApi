<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
 
  require "dbconnect.php";
$data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);

        $id = $request->id;
        $newnom = $request->newnom;
        $newtelephone = $request->newtelephone;
        $newprenom = $request->newprenom;
        $newanneeNais = $request->newanneeNais;
        $newlieuNais = $request->newlieuNais;
        $newprofession = $request->newprofession;
        $newfilename = $request->newfilename;
        $newlieuService = $request->newlieuService;
        $newtelBureau = $request->newtelBureau;
        $newresidencePrincipal = $request->newresidencePrincipal;
        $newresidenceSecondaire = $request->newresidenceSecondaire;
        $newnomPere = $request->newnomPere;
        $newtelPere = $request->newtelPere;
        $newemailPere = $request->newemailPere;
        $newprofessionPere = $request->newprofessionPere;
        $newquartierPere = $request->newquartierPere;
        $newruePere = $request->newruePere;
        $newnomMere = $request->newnomMere;
        $newtelMere = $request->newtelMere;
        $newemailMere = $request->newemailMere;
        $newprofessionMere = $request->newprofessionMere;
        $newquartierMere = $request->newquartierMere;
        $newrueMere = $request->newrueMere;
        $newnomTuteur = $request->newnomTuteur;
        $newtelTuteur = $request->newtelTuteur;
        $newemailTuteur = $request->newprofessionTuteur;
        $newprofessionTuteur = $request->newprofessionTuteur;
        $newquartierTuteur = $request->newquartierTuteur;
        $newrueTuteur = $request->newrueTuteur;
        $newproche1 = $request->newproche1;
        $newtel_proche1 = $request->newtel_proche1;
        $newemailProche1 = $request->newemailProche1;
        $newresidenceProche1 = $request->newresidenceProche1;
        $newprofessionProche1 = $request->newprofessionProche1;
        $newproche2 = $request->newproche2;
        $newtel_proche2 = $request->newtel_proche2;
        $newemailProche2 = $request->newemailProche2;
        $newresidenceProche2 = $request->newresidenceProche2;
        $newprofessionProche2 = $request->newprofessionProche2;
        $newproche3 = $request->newproche3;
        $newtel_proche3 = $request->newtel_proche3;
        $newemailProche3 = $request->newemailProche3;
        $newresidenceProche3 = $request->newresidenceProche3;
        $newprofessionProche3 = $request->newprofessionProche3;
        $newgroupeSanguin = $request->newgroupeSanguin;
        $newallergie = $request->newallergie;
        $newincapacite = $request->newincapacite;
        $newmedecinFamille = $request->newmedecinFamille;
        $newassurance = $request->newassurance;
        $newrhesus = $request->newrhesus;
        $newobservationPhisyque = $request->newobservationPhisyque;
        $newsigneParticulier = $request->newsigneParticulier;

    }

$sql = "UPDATE Patients SET 
        
        nom = '$newnom',
        telephone = '$newtelephone',
        prenom = '$newprenom',
        anneeNais = '$newanneeNais',
        lieuNais = '$newlieuNais',
        profession = '$newprofession',
        filename = '$newfilename',
        lieuService = '$newlieuService',
        telBureau = '$newtelBureau',
        residencePrincipal = '$newresidencePrincipal',
        residenceSecondaire = '$newresidenceSecondaire',
        nomPere = '$newnomPere',
        telPere = '$newtelPere',
        emailPere = '$newemailPere',
        professionPere = '$newprofessionPere',
        quartierPere = '$newquartierPere',
        ruePere = '$newruePere',
        nomMere = '$newnomMere',
        telMere = '$newtelMere',
        emailMere = '$newemailMere',
        professionMere = '$newprofessionMere',
        quartierMere = '$newquartierMere',
        rueMere = '$newrueMere',
        nomTuteur = '$newnomTuteur',
        telTuteur = '$newtelTuteur',
        emailTuteur = '$newemailTuteur',
        professionTuteur = '$newprofessionTuteur',
        quartierTuteur = '$newquartierTuteur',
        rueTuteur = '$newrueTuteur',
        proche1 = '$newproche1',
        tel_proche1 = '$newtel_proche1',
        emailProche1 = '$newemailProche1',
        residenceProche1 = '$newresidenceProche1',
        professionProche1 = '$newprofessionProche1',
        proche2 = '$newproche2',
        tel_proche2 = '$newtel_proche2',
        emailProche2 = '$newemailProche2',
        residenceProche2 = '$newresidenceProche2',
        professionProche2 = '$newprofessionProche2',
        proche3 = '$newproche3',
        tel_proche3 = '$newtel_proche3',
        emailProche3 = '$newemailProche3',
        residenceProche3 = '$newresidenceProche3',
        professionProche3 = '$newprofessionProche3',
        groupeSanguin = '$newgroupeSanguin',
        allergie = '$newallergie',
        incapacite = '$newincapacite',
        medecinFamille = '$newmedecinFamille',
        assurance = '$newassurance',
        rhesus = '$newrhesus',
        observationPhisyque = '$newobservationPhisyque',
        signeParticulier = '$newsigneParticulier'
   WHERE id ='$id';";


    if ($con->query($sql) === TRUE) {
        $response= "data update successfull";

    } else {
        $response= "Error:". $sql . "<br>" . $con->error;
    }
  
	echo json_encode( $response);

 
?>
