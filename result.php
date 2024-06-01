
<?php  

require_once('functions/cnx.php');
require_once('outils/alertMessage.php');


if(isset($_GET['search']))
{
  $db=cnx();
  $title=$_GET['title'];

  $q=$db->prepare("SELECT * FROM article WHERE title = ? ");
   $q->execute(array($title));
  
  if ($q->rowCount() >0) {

    
    $articles=$q->fetchAll(PDO::FETCH_ASSOC);
    
    
}
else
{
    header('location:outils/error.php');
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
   
    <title>Demo</title>
</head>
<body>
    <!--navbar-->

  <!--Navbar--->
    <!--navbar-->
    <!--Navbar--->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <img src="assets/icons8-logo-64.png" alt="" width="40px;">
   <a class="navbar-brand" href="#">DemoV1</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <?php  
            if(isset($connected))
            {
              ?>
              <?php   if($admin==1){   ?> 
        <li class="nav-item">
       
          <a class="nav-link" href="../admin/home.php">Espace Admin</a>
        </li>
        
        <?php  }?>
        <li class="nav-item">
          <a class="nav-link" href="../utilisateur/readUser.php">My Profile <i class="bi bi-person-badge"></i></a>
        </li>
       
        
        
        <li class="nav-item">
          <a class="nav-link" href="../auth/logout.php">Logout<i class="bi bi-box-arrow-in-right"></i></a>
        </li>
        <?php  } else{ ?>
          <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home <i class="bi bi-house-door-fill"></i></a>
        </li>
        
          <li class="nav-item" >
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php  
           
        }
        ?>
      
      </ul>
      
      
    </div>
  </div>
</nav>
<!--endNavbar--->
    <!--end navbar--->
<!--card-->
  <div class="container" style="width: 700px;
    margin-left: 400px;
    padding: 10px;">
  <h1>search result:</h1>
    <div class="row">
        <?php  foreach($articles as $article){
            
         ?>
        <div class="col-sm-6">
            <div class="card">
            <img src="upload/article<?php echo $article['image'];  ?>" class="card-img-top"  style="width: 300px;
    margin-left: 12px;
    margin-top: 10px;
    margin-bottom: 15px;" alt="img"/>
            <div class="card-body">
                 
                <h5 class="card-title"  style="margin-left: 100px;
    margin-bottom: 20px;
}"><?php echo $article['title'];  ?></h5>
               
                <a href="./Article/articleDetails.php?id=<?php echo $article['id'];  ?>"  style="width: 200px;
    margin-left: 40px;" class="btn btn-secondary" data-mdb-ripple-init>Plus..</a>
            </div>
            </div>
        </div>
  <?php  }  ?>
       
    </div>
  </div>
<!--endCard-->
</body>
</html>

