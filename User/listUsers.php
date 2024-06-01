<?php 
include('../functions/userFunctions.php'); 
require_once('../outils/alertMessage.php'); 
   
   $users=readUsers();
   $user=0;
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
    <title>List of users</title>
</head>
<body>
    <!--container-->
   <div class="container">
     <h3>List of users</h3>
       
         <a class="btn btn-primary" href="addUser.php">Add User</a>
         <!--Search form-->
         <form class="d-flex" role="search" style="width: 500px;"  method="GET" action="searchResult.php">
                <input class="form-control me-2" type="text" placeholder="ex:User Name" aria-label="Search" name="email">
                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </form>
         <!-- end search form---->
     <!--table-->
            <table>
                <thead>
                    <th>#</th>
                    <th>email</th>
                    <th>password</th>
                    <th>operations</th>
                </thead>
                <tbody>
                    <?php 
                    
                    if ($users->rowCount() ==0) {
      
          
                        $users->fetchAll(PDO::FETCH_ASSOC);
                        
                      }
                      else
                      {
                          $msg="No users found";
                          error($msg);
                      }
                    ?>
                    <?php  foreach($users as $u){  ?>
                    <tr>
                        
                        <td><?= $u['id'];  ?> </td>
                        <td><?= $u['email'];  ?> </td>
                        <td><?= $u['password'];  ?> </td>
                        <td><a class="btn btn-info" href="updateUser.php?id=<?php echo $u['id'];?>">Update</a>|
                        <a class="btn btn-danger" href="deleteUser.php?id=<?php echo $u['id'];?>">Delete</a>
                        <a class="btn btn-warning" href="userDetails.php?id=<?php echo $u['id'];?>">Details</a>
                    </td>
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
       <!--end table-->
   </div>
   <!--container-->
</body>
</html>