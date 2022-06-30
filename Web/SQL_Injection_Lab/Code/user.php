<!DOCTYPE html>
<html>
    <head>
        <title>SQL Injection Demo</title>
        <link rel="stylesheet" href="../css/index.css">
    </head>
    <body>
            <?php include('header.php');?>
            <div class="main-content"> 
            <div class="wrapper" >
            <h1>Use this site to find the password and then login as Tom to find the secret</h1>
            <div>
                    <form method="post">
                        <div style="padding-inline:10px;" > 
                           <input id="text" type="text" name="search_user" placeholder="Search for user" required>
                           <input id="button" type="submit" value="Search">
                        </div>
                    </form>
                            
            </div>
            <div>
                    <?php   
                        session_start();
                        include("connection.php");
                        include ("function.php");
                        if ($_SERVER['REQUEST_METHOD']=='POST'){
                            $search_user = $_POST['search_user'];
                            $query = "select Username from login where Username=? limit 1";
                            
                            //prepare the statement
                            $prep = $con->prepare($query);
                            $prep->bind_param("s",$search_user); // s: String, i:Int, d:Double, b: BLOB
                            $prep->execute([$search_user]);
                            $result=$prep->get_result();    
                        if ($result && mysqli_num_rows($result)>0)
                        {           
                            $user = mysqli_fetch_assoc($result);
                            echo "<table>
                                <tr>
                                    <th>Username</th>
                                    <th>Passwd</th>
                                    <th>user_id</th>
                                </tr>
                                <tr>
                                    <td>{$user['Username']}</td>
                                    <td>Unknown</td>
                                    <td>Unknown</td>
                                </tr>
                            
                            </table>";
                            
                        }

                        else echo "Not found !";
                        }
                        //implement blind sqli based on cookie
                        if (isset($_COOKIE['userID'])){
                            $cookie = $_COOKIE['userID'];
                            $query1= "select * from login where user_id='{$cookie}'";
                            $result1= mysqli_query($con,$query1);
                            if($result1){
                                echo "<h2>You are an user !</h2>";
                            }
                            
                        }
                        //get the secret
                        if (isset($_COOKIE['userID']) && md5($_COOKIE['userID']) === '8aa99b1f439ff71293e95357bac6fd94'){
                        $query2="select * from products where Category='Secret'";
                        $result2 = mysqli_query($con,$query2);
                        if ($result2 && mysqli_num_rows($result2)>0){
                            $secret = mysqli_fetch_assoc($result2);
                            echo "<img src='{$secret["Picture"]}' width='300px' height='300px' alt='cai nit'>";
                
            }
        }
                        
                                        
                                
                    ?> 
            </div>
            </div>
        </div>
        <?php include('footer.php');?>
    </body>
</html>
