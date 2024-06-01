<?php
/**
 
 * 2-ReadArticles
 * 3-UpdateArticle
 * 4-DeleteArticle
 * 5-getArtileById
 * 6-getArticleByUser
 */
include('cnx.php');
include('../outils/alertMessage.php');
 
//add article function
function addArticle($title,$description,$image ,$user_id )
 {
    $db=cnx();
    $query=0;
    if(!empty($title) &&  !empty($description) && !empty($image) && !empty($user_id) )
     {
          
          $query= $db->prepare('INSERT INTO article (title,description,image,user_id)  VALUES (?,?,?,?)');
          $query->execute(array($title,$description,$image,$user_id));
          $msg="article added";
          echo success($msg);

     }
     else
     {
        $msg="error";
        echo error($msg);
     }
     return $query;
 }
 //////////////////////////
 // list of articls function
 //////////////////////
function listArticle()
{
    $db=cnx();
    $query=0;
    
   
    $query=$db->query('SELECT * FROM article');

    return $query;
    
 }

  // article by title
 //////////////////////
function ArticleByTitle($title)
{
   $db=cnx();
   $query=0;
   
  
   $query=$db->prepare('SELECT * FROM article  WHERE title =?');
   $query->execute(array($title));

   return $query;
   
}

// article by ID
 //////////////////////
 function ArticleByID($id)
 {
    $db=cnx();
    $query=0;
    
   
    $query=$db->prepare('SELECT * FROM article  WHERE id =?');
    $query->execute(array($id));
 
    return $query;
    
 }

 // article by user
 //////////////////////
 function ArticleByUser($id)
 {
    $db=cnx();
    $query=0;
    
   
    $query=$db->prepare('SELECT * FROM article  WHERE  user_id=? ');
    $query->execute(array($id));
 
    return $query;
    
 }
 
 /* delete articlr function */
function deleteArticle($id){
    $bannirArticle=0;
    $id= $_GET['id'];
    $db=cnx();
    $recupArticle= $db->prepare('SELECT * FROM article where id =?');
    $recupArticle->execute(array($id));
    if($recupArticle->rowCount()>0){
        $bannirArticle=$db->prepare('DELETE FROM article WHERE id =?');
        $bannirArticle->execute(array($id));
        $msg="Article deleted";
        echo success($msg);
     }
     else
     {
        $msg="not found";
        echo error($msg);
     }
    return $bannirArticle;
   }

   // article by user all details
 //////////////////////
 function ArticleByUserAll($name)
 {
    $db=cnx();
    $query=0;
    
   
    $query=$db->prepare('SELECT a.title,a.description,a.image,u.name FROM article a , user u  WHERE  a.user_id=u.id AND  u.name=? ');
    $query->execute(array($name));
 
    return $query;
    
 }

 // get all information about article and user
 //////////////////////
 function getAllinformation($id)
 {
    $db=cnx();
    $query=0;
    
   
    $query=$db->prepare('SELECT a.title,a.description,a.image,u.name FROM article a , user u  WHERE  a.user_id=u.id AND  a.id=? ');
    $query->execute(array($id));
 
    return $query;
    
 }
 function getArticleByTitle($title)
 {
    $db=cnx();
    $query=0;
    
   
    $query=$db->prepare('SELECT * FROM article   WHERE   title=? ');
    $query->execute(array($title));
 
    return $query;
    
 }

?>