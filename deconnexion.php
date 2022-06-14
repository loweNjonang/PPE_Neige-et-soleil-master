
<?php
require "partie_commune_haute.php";
// Initialiser la session
session_start();
$_SESSION = array();
// Détruire la session.
session_destroy();  
echo "<div class=\"bg-success text-white font-weight-bold text-center overflow\"><h5>
               Vous êtes déconnecté </h5></div>";

unset($_SESSION);

require"footer.php";
?>
