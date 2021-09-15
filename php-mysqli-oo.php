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
$conn = new mysqli($dba, $dbu, $dbp, $dbl);
// Check connection
if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }

$sql = "SELECT DISTINCT(Categoria) AS Categoria FROM test.tienda_transacoes";
$rsl1 = $conn->query($sql);
while($lin = $rsl1->fetch_assoc()) 
    {
    extract($lin);
    $sql = "SELECT COUNT(*) AS qtd FROM tienda.d_categorias2 WHERE categoria = '$Categoria'";
    $rsl2 = $conn->query($sql);
    $lin = $rsl2->fetch_assoc();
    extract($lin);
    if ($qtd == 0)
        {
        $sql = "INSERT INTO tienda.d_categorias2 (categoria) VALUES ('$Categoria')"; 
        if ($conn->query($sql) === TRUE) 
            {
            //echo "New record created successfully";
            } 
        else 
            {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }   
        }    
    }

$conn->close();
?>