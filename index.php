<?php 
  
  include('functions/cnx.php'); 
  $db=cnx();
  $q=$db->query("SELECT a.id,a.title,a.description,a.image,u.name,u.email 
  FROM article a ,user u WHERE a.user_id=u.id and isActif=1");
 
  //pagination
  if(isset($_GET['page']))
{
  $page=$_GET['page'];
}
  
  if(empty($_GET['page']))
  {
    $page=1;
  }
  $cpt=$q->rowCount();
  $nbr_elements_par_page=5;
  $nbr_de_page=  ceil($cpt/$nbr_elements_par_page);
  $debut=($page-1)*$nbr_elements_par_page;
   
  $query=$db->query("SELECT a.id,a.title,a.description,a.image,u.name,u.email 
  FROM article a ,user u WHERE a.user_id=u.id  Limit {$debut},{$nbr_elements_par_page} ");
  


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
<body>

<!--navbar-->
<?php  
 session_start();
 $connected=false;
 
 if(isset($_SESSION['utilisateur']))
 {
  $admin=$_SESSION['utilisateur']['isAdmin'];
  $connected=true;
 }
 else{
  $connected=false;
 }

?>
  <!--Navbar--->
  <nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
   <img src="assets/icons8-logo-64.png" alt="" width="40px;">
    <a class="navbar-brand" href="#">DemoV1</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <?php  
            if($connected)
            {
              ?>
         <?php   if($admin==1){   ?> 
        <li class="nav-item">
       
          <a class="nav-link" href="Admin/home.php">Espace Admin</a>
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
      <form class="d-flex" role="search" method="GET" action="result.php">
        <input class="form-control me-2" type="search" placeholder="Search by title" aria-label="Search" name="title">
        <button class="btn btn-outline-secondary" type="submit" name="search">Search</button>
      </form>
      
    </div>
  </div>
</nav>
<!--endNavbar--->

<?php  
if ($query->rowCount() >0) {

    
  $articles=$query->fetchAll(PDO::FETCH_ASSOC);
  if(count($articles)==0)
  {
           echo "not found";
  }
  
}
else
{
echo "no article";
}

?>
<div class="container" style="margin-top: 50px;width:700px;" >

<!--carousel-->


<!--end carousel-->

<!--card--->
<?php  
if(isset($articles))
{


foreach($articles as $article)  {

?>
<div class="card">
  <div class="card-pic" data-mdb-ripple-init data-mdb-ripple-color="light">
   <img src="upload/article<?php echo $article['image'] ?>" alt="pic"  style="max-width: 300px;
    margin-left: 200px;
    margin-bottom: 10px;
    margin-top: 20px;" class="card-img-top">
    <hr>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
    <h3 class="card-title px-4"  style="display: ruby-text;"><?php echo $article['title']; ?></h3>
    <p class="card-text" style="overflow: hidden;"><?php echo $article['description']; ?></p>
    <p class="card-text"><small class="text-body-secondary">created by:<i class="bi bi-person"></i><a href="Article/articleByUser.php?name=<?php echo  $article['name'];?>"><?= $article['name']?></a></small></p>
    <a href="Article/articleDetails.php?id=<?php echo $article['id']; ?>" class="btn btn-secondary" style="width: -webkit-fill-available;">plus...</a>
   
  </div>
 
</div>
<br>
<?php }   ?>
<!--end card--->
<!--pagination-->
<div class="pagination" style="margin-bottom: 50px; margin-left:200px;">

    <?php 
       for($i=1;$i<=$nbr_de_page;$i++)
       {
        ?>
        <?php  if($page!=$i)
        {?>
         <a href="?page=<?php echo $i ?>"   style="margin-right: 5px;" class="btn btn-dark active"><?php echo $i;  ?><span>&nbsp</span></a>
        <?php }else{?>
          <a href="" class="btn btn-dark" style="margin-right: 5px;"><?php echo $i;  ?><span>&nbsp</span></a>
          <?php
        }
        ?>
        
      <?php }
}
    ?>
</div>
<!--endpagination-->

</div>
</body>
</html>