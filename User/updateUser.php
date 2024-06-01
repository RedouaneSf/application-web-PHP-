<?php
include_once('../functions/userFunctions.php');
include_once('../functions/cnx.php');

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $getId =$_GET['id'];
    $db=cnx();
    $recupUser = $db->prepare('SELECT * FROM  user WHERE id =?');
    $recupUser->execute(array($getId));
    
    if($recupUser->rowCount()>0)
    {
   

    
      $userInfo = $recupUser->fetch();
      if (isset($_POST['update']))
      {
        $getId =$_GET['id'];
        $email=$_POST['email'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        $password2=$_POST['password2'];

        
        if(isset($_POST['password2']) && !empty($_POST['password2']))
        {
          updateUser( $name,$email, $password2,$getId);
          
        }
        else
        {
          updateUser( $name,$email,$password,$getId);
        }
        
      }
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
    <link rel="stylesheet" href="../public/style/user.css">
    <title>Update User</title>
</head>
<body>
<?php include('../includes/navbar.php')   ?>
<div class="container" id="update-container">
  <h3 id="update-title">Update User</h3>
    <!--form-->
      <form method="post" action="">
      <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">User Name</label>
              
              <input type="text" class="form-control" name="name" value="<?php echo $userInfo['name']; ?>">
            
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              
              <input type="text" class="form-control" name="email" value="<?php echo $userInfo['email']; ?>">
            
            </div>
            <div class="mb-3">
              
              <input hidden type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $userInfo['password'];?>">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input  type="password" class="form-control" id="exampleInputPassword1" name="password2"">
            </div>
            
            <button type="submit" class="btn btn-primary" name="update" id="register-btn">Update</button>
      </form>
      <!--end form-->
   </div>
</body>
</html>