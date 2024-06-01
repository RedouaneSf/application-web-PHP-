<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/style/user.css">
    
    <title>DemoV1</title>
</head>
<?php include('../includes/navbar.php')   ?>
<?php  
 
 
 if(!isset($_SESSION['user']))
 {
    echo 'access denied';
 }
 else{
    $data =$_SESSION['user'];
    foreach($data as $dt)
    {
        $name=$dt['name'];
        $isActif=$dt['isActif'];
    }
    if($isActif==1)
    {
        echo("<h1 id='welcome-user'> Welcome :" . $name. "</h1>");
    }
    else
    if($isActif==0)
    {
        header('location:../register.php');
    }
    
 }

?>


 <!--container-->
       <div class="container" id="container-profile">
         <div class="row row-cols-1 row-cols-md-2 g-4">
        <!---profile card--->
                 <div class="col">
                    <div class="card mb-3" style="max-width: 500px; height: 170px;">
                            <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="../assets/user.png" class="img-fluid rounded-start" alt="user.png">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">My Profile</h5>
                                            
                                            <a href="../User/readUser.php"><button type="submit" class="btn btn-primary btn-lg my-2" name="ajouter">Plus....</button></a> 
                                        </div>
                                    </div>
                            </div>
                    </div>
                 </div>    
         <!---end profile card--->  
         <!---profile article--->
         <div class="col">
                    <div class="card mb-3" style="max-width: 500px;">
                                <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="../assets/article.png" class="img-fluid rounded-start" alt="user.png">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">My Articles</h5>
                                                
                                                <a href="../User/userArticle.php"><button type="submit" class="btn btn-info btn-lg my-4" name="ajouter">Plus...</button></a>
                                            </div>
                                        </div>
                                </div>
                    </div>
        </div>
         <!---end profile article--->  

            
         </div>        
    </div>    

<!--endcontainer--->
</body>
</html>