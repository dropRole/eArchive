<?php

// namespace and class import declaration

use DBC\DBC;

// script import declaration

require_once '../DBC/DBC.php';
require_once '../Programs/Programs.php';

$id_universities = $_GET['id_universities'];

// if id of a university is prosperously passed 
if (isset($id_universities)) {
    // create a new instance
    $DBC = new DBC();
    $postalCodes = $DBC->selectPrograms($id_universities);
?>
    <?php
    foreach ($programs as $program) {
    ?>
        <option value="<?php echo $program->getIdPrograms(); ?>"><?php echo "{$program->getName()}({$postalCode->getField()})"; ?></option>
    <?php
    } // foreach
    ?>
<?php
} // if
