<?php 

include('../functions/articleFunctions.php');



  $title=$_GET['title'];
  $query=getArticleByTitle($title);
  
if(isset($_GET['title'])) 
{
    if($query->rowCount() >0) {

    
        $articles=$query->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        header('location:../outils/error.php');
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>DemoV1</title>
</head>

<?php include('../includes/navbar.php')  ?>

<div class="container py-2">
 
<?php   foreach($articles as $article){

    ?>
 
  <div class="card">
            <div class="card-header">
                Detail artcile
            </div>
            <img src="../upload/article<?php echo $article['image'] ?>" alt="pic" style="    max-width: 300px;
    max-height: 200px;
    margin-bottom: 20px;
    margin-left: 500px;
    margin-top: 10px;">
            <hr>
            <div class="card-body" style="margin-left: 600px; 
             margin-top: 20px;">
            
            
                <h5 class="card-title"  style="margin-bottom: 30px;"><?php   echo $article['title'];  ?></h5>
                <p class="card-text" style="margin-bottom: 50px;"><?php   echo $article['description'];  ?></p>
                
                
                
            </div>
        </div>
  <?php
}   

?>
        
</div>
    
</body>
</html>