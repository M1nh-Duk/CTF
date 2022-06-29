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
            <h1>Products for <?php session_start();$search = $_SESSION['search'];echo $search;?></h1>
            <div>
            <?php
                    include("connection.php");
                    include ("function.php");
                    $search = $_SESSION['search'];
                    $query = "select * from products where Category='$search' limit 2";
                    $result = mysqli_query($con,$query);
                    if ($result && mysqli_num_rows($result)>0)
                    {
                    
                        while($product = mysqli_fetch_assoc($result))
                        {
                                echo "<h3>{$product['Product_name']}</h3>";
                                echo "<h3>{$product['Price']}</h3>";
                                echo "<img src='{$product['Picture']}' width='100px' height='100px' alt='{$product['Product_name']}'>";
                                echo "<h3>{$product['Category']}</h3>";
                        }

                        
                    }
                    else echo "Not found !";
                    
            ?>           
            </div>
                <div>
                <table>

                </table>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
    </body>
</html>

