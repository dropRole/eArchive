 <?php

    // namespace and class import declaration

    use DBC\DBC;

    // script import declaration

    require_once '../DBC/DBC.php';
    require_once '../Students/Students.php';

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $municipality = $_POST['municipality'];
    $country = $_POST['country'];

    var_dump($address);

    /* $attendances = $_POST['attendances']; */

    /* // if mandatory data is passed
    if (isset($name, $surname, $addresses, $attendances)) {
        // create a new instance
        $DBC = new DBC($_SESSION['user'], $_SESSION['pass']);
    } // if */

    ?>