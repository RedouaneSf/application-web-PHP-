<?php 
  include('../functions/articleFunctions.php');
  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    
    $articles=ArticleByID($id);

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
    <title>Article Details:</title>
</head>
<body>
    <?php include('../includes/navbar.php'); ?>
    <!--container-->
   <div class="container" style="margin-top: 20px;
    width: 800px;
    padding: 10px;">
    <a href="../User/userArticle.php" style="width: 100px;"><i class="bi bi-caret-left-fill"></i> return</a>
     <h3>Article Details:</h3>
       
         
         
         <br>
       <?php  $article=$articles->fetch(); ?>
         
         <h3 class="card-title px-4"  style="display: block;
    margin-left: 300px;
    margin-top: 20px;
    margin-bottom: 40px;"><?php echo $article['title']; ?></h3>
<div class="card">

  <div class="card-pic" data-mdb-ripple-init data-mdb-ripple-color="light">
   <img src="../upload/article<?php echo $article['image'] ?>" alt="pic"  style="max-width: 300px;
    margin-left: 200px;
    margin-bottom: 10px;
    margin-top: 20px;" class="card-img-top">
    <hr>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
     <h5>Description</h5>
     <br>
    <p class="card-text" ><?php echo $article['description']; ?></p>
    
    
   
  </div>
 
</div>
<br>

<!--end card--->
       <!--end table-->
   </div>
   <!--container-->
</body>
</html>