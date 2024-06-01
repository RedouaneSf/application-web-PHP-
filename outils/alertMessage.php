<?php
   function success($msg)
   {
          $message="<div class='alert alert-success' role='alert' id='sucess-message'>".$msg."</div>";
          return $message;
   }

   function error($msg)
   {
          $message="<div class='alert alert-danger' role='alert' id='error-message' >".$msg."</div>";
          return $message;
   }
?>