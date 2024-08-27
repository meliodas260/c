<?php 
setcookie("RepSesID", "", time() - 1, "/");
setcookie("Email", "", time() - 1, "/");
setcookie("ResearchNya", "", time() - 1, "/");



// Redirect the user to the logout page or any other page
header("Location: index.php");
exit;
?>