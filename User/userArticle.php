<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>DemoV1</title>
</head>
<?php 
include('../includes/navbar.php') ; 
include('../functions/articleFunctions.php') ; 
?>
<?php 


  $id=0;

  $data=$_SESSION['user'];
  foreach($data as $dt)
  {
       $id=$dt['id'];
  }
  $query=ArticleByUser($id);
  
   
  if ($query->rowCount() >0) {

    
    $articles=$query->fetchAll(PDO::FETCH_ASSOC);
}

?>
<div class="container py-2">
<h2>My articles</h2>
<form class="d-flex" role="search" style="width: 500px;"  method="GET" action="../Article/searchResult.php">
        <input class="form-control me-2" type="text" placeholder="ex:titre" aria-label="Search" name="title">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
  </form>
    <a href="../Article/addArticle.php"><button type="submit" class="btn btn-info btn-lg my-4" name="ajouter"><i class="bi bi-plus-circle"></i>Add Article</button></a>
 
<table>

<thead>
    <th>#</th>
    <th>title</th>
    
    <th>image</th>
    <th>operations</th>
</thead>

<tbody>
<?php if($query->rowCount() >0 ) { 
  foreach($articles as $article)
  {
            
 ?>
 <tr>
    <td> <?=$article['id'] ?></td>
    <td> <?=$article['title'] ?></td>
   
    <td> <img src="../upload/article<?=$article['image'] ?>" alt="" width="70px">  </td>
    <td><a class="btn btn-info" href="../Article/updateArticle.php?id=<?php echo $article['id'];?>">Update</a>|
                        <a class="btn btn-danger" href="../Article/deleteArticle.php?id=<?php echo $article['id'];?>">Delete</a>
                        <a class="btn btn-warning" href="../Article/articleDetails.php?id=<?php echo $article['id'];?>">Details</a>
    </td>

 </tr>
 <?php  }} ?>
</tbody>
    
   

</table>
</div>
    
</body>
</html>