<?php  
include('../functions/articleFunctions.php');
session_start();
$id=0;
   
   if(isset($_POST['ajouter']))
   {
    $title =htmlspecialchars($_POST['title']);
    $description =htmlspecialchars($_POST['description']);
    
    
    if(!empty($title) && !empty($description) && !empty($_FILES['image']))
    {

        if(isset($_FILES['image']))
        {

            
            $file =$_FILES['image'];
            $image =$_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            $fileExt= explode('.', $image);
            $fileActualExt=strtolower(end($fileExt));

            $allowed= array('jpg','jpeg','png');

        if(in_array($fileActualExt,$allowed))
        {
                if($fileError===0)
                {
                    $data = $_SESSION['user'];

                    foreach($data as $dt)
                    {
                        $id=$dt['id'];
                    }
                    
                    $filename= uniqid().$image;
                    move_uploaded_file($_FILES['image']['tmp_name'],'../upload/article'.$filename);
                    $query=addArticle($title,$description, $filename,$id);
                    header('location:../User/userArticle.php');
                
                }
                else
                {
                    echo "There was an error  uploading your file";
                }
        }
        else
        {
            echo "You  cannot  upload file of this type";
        }
            
        
                
    }
     
   
    }
    else
     {
        echo "empty fields";
     }

}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>ADD ARTILCE</title>
</head>


<body>
    

<div class="container py-2">
    
    <form action="" method="POST" class="form-control" enctype="multipart/form-data">
    <h2 class="">Ajouter un Article</h2>
    <br>
    
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">title</label>
        <div class="col-sm-10">
        <input type="text" class="form-control"  name="title">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">description</label>
        <div class="col-sm-10">
        <textarea class="form-control" placeholder="Leave contenu" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">image</label>
        <div class="col-sm-10">
        <input type="file" class="form-control" name="image" >
        </div>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary btn-lg my-2" name="ajouter">Ajouter</button>
    </div>
    </form>
</div> 

</bod>
</html>