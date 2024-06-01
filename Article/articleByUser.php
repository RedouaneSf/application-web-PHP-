<?php 
include('../includes/navbar.php')  ; 
include('../functions/articleFunctions.php');
 

$name=$_GET['name'];
$query= ArticleByUserAll($name);
if ($query->rowCount() >0) {

    
    $articles=$query->fetchAll(PDO::FETCH_ASSOC);
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

<div class="container py-2" style="width: 500px;
    margin-top: 50px;">
 
 <?php   foreach($articles as $article){

?>
<h2>Article by User:<?php echo $article['name'] ?> </h2>
 <div class="card mb-3">
  <img src="../upload/article<?php echo $article['image'] ?>" style="    max-width:300px;
    max-height: 400;
    margin-left: 100px;
    margin-top: 10px;
    margin-bottom: 20px;"  class="card-img-top" alt="img"/>
    <hr>
  <div class="card-body">
    <h5 class="card-title"><?php   echo $article['title'];  ?></h5>
    
    
    <p class="card-text">
      <small class="text-muted">Last updated 3 mins ago</small>
    </p>
    <p class="card-text">
      <small class="text-muted">created by: <i class="bi bi-person"></i> <?php echo $article['name'] ?> </small>
    </p>
    <a href="../User/articleByTitle.php?title=<?php echo $article['title']?>"  style="    width: 300px;
    margin-left: 60px;" class="btn btn-secondary" name="search">Read more...</a>
  </div>
</div>

  <?php
}   

?>
        
</div>
    
</body>
</html>