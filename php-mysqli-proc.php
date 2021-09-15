<?php

//set_time_limit(0);

//$di = new DateTime('NOW', new DateTimeZone('America/Cuiaba'));
//echo $di->format('Y-m-d H:i:s.u')."<br>";

$dbe = "mysql"; 				
$dba = "localhost:3308";   		
$dbl = "test";  	
$dbu = "root";			
$dbp = "beta2020";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = mysqli_connect($dba, $dbu, $dbp, $dbl);
// Check connection
if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }

$sql = "SELECT DISTINCT(Categoria) AS Categoria FROM test.tienda_transacoes";
$rsl1 = mysqli_query($conn, $sql);
while($lin = mysqli_fetch_assoc($rsl1)) 
    {
    extract($lin);
    $sql = "SELECT COUNT(*) AS qtd FROM tienda.d_categorias2 WHERE categoria = '$Categoria'";
    $rsl2 = mysqli_query($conn, $sql);
    $lin = mysqli_fetch_assoc($rsl2);
    extract($lin);
    if ($qtd == 0)
        {
        $sql = "INSERT INTO tienda.d_categorias2 (categoria) VALUES ('$Categoria')"; 
        if (mysqli_query($conn, $sql))
            {
            //echo "New record created successfully";
            } 
        else 
            {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }   
        }    
    }

mysqli_close($conn);
?>