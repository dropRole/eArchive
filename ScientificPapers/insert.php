<?php

// namespace and class import declaration

use DBC\DBC;

// script import declaration

require_once '../DBC/DBC.php';
require_once './ScientificPapers.php';

// proceed with the session
session_start();

$id_attendances = $_POST['id_attendances'];
$topic = $_POST['topic'];
$type = $_POST['type'];
$written = $_POST['written'];
$documents = $_POST['documents'];

// if data for scientific paper and documents have been prosperously passed
if (isset($id_attendances, $topic, $type, $written, $documents)) {
    // establish a new database connection
    $DBC = new DBC($_SESSION['user'], $_SESSION['pass']);
    // attempt an insert
    $report = $DBC->insertScientificPaper($id_attendances, $topic, $type, (new DateTime($written)));
    echo $report['message'];
    // if an attempt was successful 
    if ($report['id_scientific_papers']) {
        // if there were partakers in writtin
        if ($_POST['partakers'])
            foreach ($_POST['partakers'] as $partaker)
                if ($DBC->insertPartakingsOnScientificPaper($report['id_scientific_papers'], $DBC->selectStudentsByIndex($partaker['index'])[0]->id_attendances, $partaker['part']))
                    echo "Soavtor {$DBC->selectStudentsByIndex($partaker['index'])[0]->fullname} je uspešno vstavljen.";
                else
                    echo "Soavtor {$DBC->selectStudentsByIndex($partaker['index'])[0]->fullname} ni uspešno vstavljen.";
        foreach ($documents as $document)
            echo $DBC->insertDocument($report['id_scientific_papers'], $document['version'], $document['name']);
    } // if
} // if  