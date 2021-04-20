<?php
   session_start();
   unset($_SESSION["id"]);
   
   echo 'Ctesutyun';
   // header('Refresh: 1; URL = index.php');
   header('Location:index.php');
?>