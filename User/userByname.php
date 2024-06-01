<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>DemoV1</title>
</head>
<?php 

include('../functions/userFunctions.php');
include('../includes/navbar.php');

  $name=$_GET['name'];
  
  
if(isset($_GET['search'])) 
{
    $query=getUserByName($name);
    if($query->rowCount() >0) {

    
        $users=$query->fetch();
    }
    else
    {
        header('location:../outils/error.php');
    }
    
}
?>
<div class="container py-2">
 

 
  <div class="card">
            <div class="card-header">
                Detail user
            </div>
            
            <div class="card-body" style="margin-left: 400px;">
            
                <h5 class="card-title"><?php   echo $users['email'];  ?></h5>
                <h5 class="card-title"><?php   echo $users['name'];  ?></h5>
               
                
                
                
            </div>
        </div>

        
</div>
    
</body>
</html>