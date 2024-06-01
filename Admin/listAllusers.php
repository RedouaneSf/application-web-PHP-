<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>DemoV1</title>
</head>
<?php 

include('../includes/navbar.php');
include('../functions/userFunctions.php');     



  
  $query=readUsers();
  
   
  if ($query->rowCount() >0) {

    
    $utilisateurs=$query->fetchAll(PDO::FETCH_ASSOC);
    
}

?>
<div class="container py-2">

 <h2>list of users</h2>
 <a href="../User/addUser.php"><button type="submit" class="btn btn-info btn-lg my-4" ><i class="bi bi-plus-circle"></i>Ajouter un utilisateur</button></a>
 <form class="d-flex" role="search" style="width: 500px;"  method="GET" action="../User/userByname.php">
        <input class="form-control me-2" type="text" placeholder="ex:name" aria-label="Search" name="name">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
  </form>
 <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">operation</th>
    </tr>
  </thead>
  <tbody>
  <?php   foreach($utilisateurs as $utilisateur){ ?>
    <tr>
      <th scope="row"><?= $utilisateur['id'] ?></th>
      <td><?= $utilisateur['name'] ?></td>
      <td><?=  $utilisateur['email'] ?></td>
      
      <td>
        <a href="../User/updateUser.php ? id=<?php echo $utilisateur['id']; ?>" class="btn btn-info">Update</a>
        <a href="../User/deleteUser.php?id=<?php  echo $utilisateur['id'] ?>" class="btn btn-danger" onclick="return confirm('Do you want this user? ');"> <i class="bi bi-trash"></i></a>
      </td>
    </tr>
    <?php
        }   

        ?>
  </tbody>
</table>


   
  

        
</div>
    
</body>
</html>