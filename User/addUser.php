<?php
     include('../functions/userFunctions.php');
     include('../includes/navbar.php');
     
     if(isset($_POST['ajouter']))
     {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
          
        

        $query=addUser($name,$email,$password);

        if($query)
        {
          header('location:../Admin/listAllusers.php');
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>AddUser</title>
</head>
<body>
<div class="container" id="register-container" style="    width: 600;
    border-style: solid;
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;">
  <h3 id="register-title" style="width: 200px;
    margin-left: 200px;
    margin-top: 20px;
    margin-bottom: 20px;">Add User</h3>
    <!--form-->
      <form method="post" action="">
      
      <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">User Name</label>
              <input type="text" class="form-control" name="name">
            
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" class="form-control"  name="email">
            
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            
            
            <button type="submit" class="btn btn-primary" name="ajouter" id="register-btn" style="    width: 200px;
    margin-left: 150px;
    margin-top: 20px;">Add</button>
      </form>
      <!--end form-->
   </div>
    
</body>
</html>