<?php
/**
 * 
 * 3-EditUser
 * 4-DeleteUser
 * 
 * 
 */
include('cnx.php');
require_once('../outils/alertMessage.php');
   /*  Add User function */
  
function addUser($name,$email,$password)
{
    $query=0;
    $db = cnx();
    if(!empty($name) && !empty($email) && !empty($password)  )
    {
      // Check if the email already exists in the database.
      $stmt = $db->prepare("SELECT email FROM user WHERE email = ?");
      
      $stmt->execute(array($email));
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
         if ($data != NULL) {
            // If email already exists, return an error message.
            
            $msg="Email already exists";
             echo error($msg);
         }
         else
         {  // Validate email format.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               if (preg_match("/([<|>])/", $email)) {
                  // If disallowed characters are found, 
                  // return an error message.
               
                  $msg= "< and > characters are not allowed";
                  echo error($msg);
               }
                // If email is not valid, return an error message.
                $msg="Email is not valid";
                echo error($msg);
                // Validate UserName format.
            
                // If email is not valid, return an error message.
                $msg="Email is not valid";
                echo error($msg);
                
            }
            else
            {
               $query= $db->prepare('INSERT INTO user (name,email,password) values(?,?,?)');
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $query->execute([$name,$email,$hashed_password]);
               if($query)
               {
               $msg="added successfully ";
               echo success($msg);
               }
               else
               {
               $msg="error";
               echo success($msg);
           
           
            }
         }

      }
   }
            
            
    else
    {
        $msg="remplir tous les champs";
        echo error($msg);
    }
    
   
    

    return $query;


   }

   /*  List of Users function */
  
function readUsers()
  {
        
        $db=cnx();
        $isActif=1;
        $query=$db->prepare('SELECT * FROM user where isActif =?');
        $query->execute(array($isActif));
       
        return $query;

   } 
    /*  Update user function */
    function updateUser($name,$email,$password,$id)
   {
    $query=0;
    $db = cnx();
    if(!empty($email) && !empty($password))
    {
        
        $stmt = $db->prepare("SELECT email FROM user WHERE email = ?");
      // Check if the email already exists in the database.
      
      
      $stmt->execute(array($email));
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
         if ($data != NULL) {
            // If email already exists, return an error message.
            
            $msg="Email already exists";
             echo error($msg);
         }
         else
         {  // Validate email format.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               if (preg_match("/([<|>])/", $email)) {
                  // If disallowed characters are found, 
                  // return an error message.
               
                  $msg= "< and > characters are not allowed";
                  echo error($msg);
              }
                // If email is not valid, return an error message.
                $msg="Email is not valid";
                echo error($msg);
                
            }
            else
            {
               $query= $db->prepare('UPDATE user SET name=?,email = ?,password = ? Where id=?');
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $query->execute([$name,$email,$hashed_password,$id]);
               if($query)
               {
               $msg="updated successfuly";
               echo success($msg);
               header('location:../User/readUser.php');
               }
               else
               {
               $msg="error";
               echo success($msg);
               }
           
           
            }
         }
         return $query;

      }

            
            
    else
    {
        $msg="remplir tous les champs";
        echo error($msg);
    }
    
   
    

    return $query;


   }
   /*  delete user function */
   function deleteUser($id)
   {
    $bannirUser=0;
    $id= $_GET['id'];
    $status=0;
    $db=cnx();
    $recupUser= $db->prepare('SELECT * FROM user where id =?');
    $recupUser->execute(array($id));
    if($recupUser->rowCount()>0){
        $bannirUser=$db->prepare('UPDATE user  SET isActif =?  WHERE id =?');
        $bannirUser->execute(array($status,$id));
        $deleteArticles=$db->prepare('DELETE FROM article WHERE user_id =?');
        $deleteArticles->execute(array($id));
        $msg="user deleted";
        echo success($msg);
     }
     else
     {
        $msg="not found";
        echo error($msg);
     }
    return  $bannirUser;
   }
   /*  get  user information by id function */
   function getUserByID($id)
   {


       $db=cnx();
        
        $query=$db->prepare('SELECT * FROM user Where id = ?');
        $query->execute(array($id));
       
        return $query;
     } 


     /*  get  user information by email function */
   function getUserByName($name)
   {
         $db=cnx();
        
        $query=$db->prepare('SELECT * FROM user Where name = ?');
        $query->execute(array($name));
       
        return $query;
     } 



?>