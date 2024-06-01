<?php
   include('cnx.php');
   require_once('./outils/alertMessage.php');
   /*  make connection with db function */
   
   /*  register function */
   function register($name,$email,$password)
   {
    $query=0;
    $db = cnx();
    if(!empty($email) && !empty($password) && !empty($name))
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
                
            }
            else
            {
               if (preg_match("/([<|>])/",$name)) {
                  // If disallowed characters are found, 
                  // return an error message.
               
                  $msg= "< and > characters are not allowed";
                  echo error($msg);
              }else
              {

              
               $query= $db->prepare('INSERT INTO user (name,email,password) values(?,?,?)');
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $query->execute([$name,$email,$hashed_password]);
               if($query)
               {
               $msg="Registration successfully go to login page";
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

      }

            
            
    else
    {
        $msg="remplir tous les champs";
        echo error($msg);
    }
    
   
    

    return $query;


   }
   ////////////////////////////////
   /*  login function   */
   function login($email, $password) {
      // Establish a database connection.
      $mysqli = cnx();
      $data=0;
      // Trim leading and trailing whitespaces 
      // from username and password.
      $email = trim($email);
      $password = trim($password);
   
      // Check if either username or password is empty.
      if ($email == "" || $password == "") {
          $msg= "Both fields are required";
          echo error($msg);
      }
   
      // Sanitize username and password to prevent SQL injection.
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
      $password = filter_var($password, FILTER_UNSAFE_RAW);
   
      // Prepare SQL statement to select username 
      // and password from users table.
      
 
   
      // Check if the username exists in the database.
      if(!empty($email) && !empty($password))
      {
         $stmt = $mysqli->prepare("SELECT id,name,email ,password,isAdmin,isActif FROM user WHERE email = ?");
         // Execute the prepared statement to query the database.
         $stmt->execute(array($email));
         // Fetch the associative array representing the first
         // row of the result set.
         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
         if ($data == NULL) {
            
            $msg= "Wrong EMAIL or password";
            echo error($msg);
         }
         else
         {
            $pwd=0;
            foreach($data as $dt)
            {
               $pwd=$dt['password'];
            }
            if (password_verify($password,$pwd) == FALSE) {
               
               $msg= "Wrong EMAIL or password";
               echo error($msg);
            } else {
               
               // If authentication is successful, 
               // set the user session and redirect to account page.
                  $isAdmin=0;
                  session_start();
                  $_SESSION['user'] =$data;

                  foreach($data as  $dt)
                  {
                    $isAdmin=$dt['isAdmin'];  
                  }
                  if($isAdmin==1)
                  {
                    //Set session variables
                    header('Location:./Admin/profile.php');
                  }
                  else
                  {
                     header('Location:./User/profile.php');
                  }
                 
        
            }
      }
   }
   
      // Verify the provided password against the 
      // hashed password in the database.
      
      return $data;
   }
////////////////////////////////
   /*  login function   */
 function logout()
{

         session_start();
         session_unset();
         session_destroy();
         header('Location:login.php');

}
 ////////////////////////////////
?>