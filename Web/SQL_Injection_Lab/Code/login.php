<?php
 session_start();
 include("connection.php");
 include("function.php");
if ($_SERVER['REQUEST_METHOD']=='POST')
{
        
    $username=$_POST['username'];
    $password=$_POST['password'];
        
     if (!empty($username)&&!empty($password)&&!is_numeric($username))
     {  
        $query="select * from login where Username='$username' and Passwd='$password' ";
        $result = mysqli_query($con,$query);
        
        if ($result && mysqli_num_rows($result)>0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['Passwd']===$password){
                    $_SESSION['user_id']= $user_data['user_id'];
                    
                
            }
            else 
                {
                    echo "Incorrect username or password!<br />";
                    echo "SQL Query: $query" ;
                }
            header("Location: index.php");
            die;
         }
        else 
        {
            echo "Incorrect username or password!\n";
            echo "SQL Query: $query" ;
        }
        
     }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SQL Injection demo</title>
    </head>
    <body>
        <style type="text/css">
        #text{
            height:25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }
        #button{
            padding:10px;
            width: 100px;
            color: white;
            background-color: #3742fa;
            border:white;
            border-radius:20px;
        }
        #box{
            background-color: #ff4757;
            margin: auto;
            width: 300px;
            padding: 30px;
        }
        </style>
        <div id ="box" style="border-radius:20px;">
            <form method="post">
                <div style="font-size: 20px;margin:10px;color:white;padding-left:110px;">Login</div>
                <input id="text" type="text" name="username" placeholder="Username" required><br><br>
                <input id="text" type="password" name="password" placeholder="Password" required><br>
                <br>
                <div style="padding-left:100px;" ><input id="button" type="submit"  value="Submit"><br></div>
            </form>        
    </div>
    </body>
</html>