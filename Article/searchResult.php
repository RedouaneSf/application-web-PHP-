<?php 
  include('../functions/articleFunctions.php');
  
  if(isset($_GET['search']))
  {
    $title=$_GET['title'];
    
    $articles=ArticleByTitle($title);

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
    <title>Search Result</title>
</head>
<body>
<?php include('../includes/navbar.php');?>
    <!--container-->
   <div class="container">
     <h3>Search Key :<?php  echo $_GET['title'] ?>Result :</h3>
       
         
         <!--Search form-->
       
         <!-- end search form---->
     <!--table-->
            <table>
                <thead>
                    <th>#</th>
                    <th>title</th>
                    <th>description</th>
                    <th>image</th>
                    <th>user_id</th>
                    
                </thead>
                <tbody>
                    <?php 
                    
                    if ( $articles->rowCount() ==0) {
      
          
                        $articles->fetchAll(PDO::FETCH_ASSOC);
                        
                      }
                      else
                      {
                          $msg="No article found";
                          error($msg);
                      }
                    ?>
                    <?php  foreach( $articles as $a){  ?>
                    <tr>
                        
                        <td><?= $a['id'];  ?> </td>
                        <td><?= $a['title'];  ?> </td>
                        <td><?= $a['description'];  ?> </td>
                        <td> <img src="../upload/article<?= $a['image'];  ?>" alt="" width="50px;"> </td>
                        <td><?= $a['user_id'];  ?> </td>
                        
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
       <!--end table-->
   </div>
   <!--container-->
</body>
</html>