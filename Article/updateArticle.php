<?php 
 require_once('../functions/cnx.php');
 $db=cnx();
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $getId =$_GET['id'];
    $recupArticle = $db->prepare('SELECT * FROM  article WHERE id =?');
    $recupArticle->execute(array($getId));
    
    if($recupArticle->rowCount()>0)
    {
          $articleInfo = $recupArticle->fetch();
          $id =$articleInfo['id'];
          $title =$articleInfo['title'];
          $description =$articleInfo['description'];
          $image =$articleInfo['image'];

          if (isset($_POST['modifier']))
          {
            $filename='';
      if(!empty($_FILES['image']))
       {
        
        $image =$_FILES['image']['name'];
        $filename= uniqid().$image;
        move_uploaded_file($_FILES['image']['tmp_name'],'../upload/article'.$filename);
        
        

        
      }
      
          $titre_in = htmlspecialchars($_POST['title']);
          $description_in = htmlspecialchars($_POST['description']);
          
          
          if(!empty($i =$_FILES['image']['name']))
          {
          
           $query=$db->prepare('UPDATE article SET title = ?  , description = ? ,image = ? WHERE id = ?');
           $query->execute(array($titre_in,$description_in,$filename,$id));
           header("Location:articleDetails.php?id=$id");
          }
          else
          if(empty($i =$_FILES['image']['name']))
          {
            
           $query=$db->prepare('UPDATE article SET title = ?  , description = ?  WHERE id = ?');
           $query->execute(array($titre_in,$description_in,$id));
           header("Location:articleDetails.php?id=$id");
            
          }
          
           
           
           

        }
    }else
    {
        echo "error";
    }
    
}
else
{
    echo "aucun identifiant";
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
<body>

<?php include('../includes/navbar.php')  ?>
<h1 style="margin-left: 500px;">UPDATE ARTCILE</h1>
<div class="container">
        <form action="" method="POST" class="form-control" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $articleInfo['title'];?>">
                
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">description</label>
                <div class="col-sm-10">
                <textarea class="form-control" placeholder="Leave contenu" id="floatingTextarea2" style="height: 100px" name="description">
                <?php echo $articleInfo['description'];?>
               </textarea>
                </div>
           </div>
            <div class="mb-3">
                <label  class="form-label">image</label>
                
                <img src="../upload/article<?php echo $articleInfo['image'] ?>" class="img-thumbnail" alt="..." style="width: 100px;">
                <br>
                <br>
                <input type="file" class="form-control" name="image" >
                
                
            </div>

            
            <button type="submit" class="btn btn-primary" name="modifier" style="margin-left: 500px;
    margin-top: 30px;
    margin-bottom: 30px;
    width: 300px;">Modifier</button>
        </form>
</div>
</body>
</html>