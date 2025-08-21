<?php
// Start the session
session_start();
session_unset();
session_destroy();
header("Location: \Kristal Function hall/static/login.php"); 
exit();
?>
