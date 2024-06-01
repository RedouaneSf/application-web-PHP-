<?php 
  include('../functions/userFunctions.php');
  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    echo $id ;
    $users=getUserByID($id);

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
    <title>User Details:</title>
</head>
<body>
    <!--container-->
   <div class="container">
     <h3>ser Details:</h3>
       
         
         <!--Search form-->
       
         <!-- end search form---->
     <!--table-->
            <table>
                <thead>
                    <th>#</th>
                    <th>email</th>
                    <th>password</th>
                    
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
                        
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
       <!--end table-->
   </div>
   <!--container-->
</body>
</html>