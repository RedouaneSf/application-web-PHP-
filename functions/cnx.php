<?php
/**make connection between application and database */
   function cnx()
   {
     return $db= new PDO('mysql:host=localhost;dbname=miniprojet;','root',''); 

     if($db)
     {
      echo 'connect';
     }
     else
     {
      echo 'error';
     }
     
   }
?>