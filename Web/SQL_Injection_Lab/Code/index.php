<?php
 session_start();
 include("connection.php");
 include("function.php");
 if ($_SERVER['REQUEST_METHOD']=='POST')
{
$_SESSION["search"] = $_POST['search'];
check_search($_SESSION["search"]);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SQL Injection demo</title>
        <link rel="stylesheet" href="../css/index.css">
    </head>
    <body style="background-color: #f1f2f6;">
        <script>alert("Welcome, you have logged in successfully!")</script>

        <?php include("header.php");?>
        <div class="main-content"> 
            <div class="wrapper" >
            <h1>Products: 🎮Toy, 🌼Flower , 🎁Gift</h1>
            <div>
                    <form method="post">
                        <div style="padding-inline:10px;" > 
                           <input id="text" type="text" name="search" placeholder="Search the product you want" required>
                           <input id="button" type="submit" value="Search">
                        </div>
                    </form>        
            </div>
                <div>
                <table>

                </table>
                </div>
            </div>
        </div>

        
<?php include("footer.php");?>