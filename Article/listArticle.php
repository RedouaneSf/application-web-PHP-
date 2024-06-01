<?php 
include('../functions/articleFunctions.php'); 
require_once('../outils/alertMessage.php'); 
   
   $articles=listArticle();
   
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
    <title>List of articles</title>
</head>
<body>
    <!--container-->
   <div class="container">
     <h3>List of articles</h3>
       
         <a class="btn btn-primary" href="addArticle.php">Add Article</a>
         <!--Search form-->
         <form class="d-flex" role="search" style="width: 500px;"  method="GET" action="searchResult.php">
                <input class="form-control me-2" type="text" placeholder="ex:article title" aria-label="Search" name="title">
                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </form>
         <!-- end search form---->
     <!--table-->
            <table>
                <thead>
                    <th>#</th>
                    <th>title</th>
                    <th>description</th>
                    <th>image</th>
                    <th>user_id</th>
                    <th>operations</th>
                </thead>
                <tbody>
                    <?php 
                    
                    if ( $articles->rowCount() ==0) {
      
          
                        $articles->fetchAll(PDO::FETCH_ASSOC);
                        
                      }
                      else
                      {
                          $msg="No users found";
                          error($msg);
                      }
                    ?>
                    <?php  foreach( $articles as $a){  ?>
                    <tr>
                        
                        <td><?= $a['id'];  ?> </td>
                        <td><?= $a['title'];  ?> </td>
                        <td><?= $a['description'];  ?> </td>
                        <td>  <img src="../upload/article<?= $a['image'];  ?> " alt="" width="100px;"></td>
                        <td><?= $a['user_id'];  ?> </td>
                        <td><a class="btn btn-info" href="updateArticle.php?id=<?php echo $a['id'];?>">Update</a>|
                        <a class="btn btn-danger" href="deleteArticle.php?id=<?php echo $a['id'];?>">Delete</a>
                        <a class="btn btn-warning" href="articleDetails.php?id=<?php echo $a['id'];?>">Details</a>
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