<?php

//set_time_limit(0);

//$di = new DateTime('NOW', new DateTimeZone('America/Cuiaba'));
//echo $di->format('Y-m-d H:i:s.u')."<br>";

$dbe = "mysql"; 				
$dba = "localhost:3308";   		
$dbl = "test";  	
$dbu = "root";			
$dbp = "beta2020";

$conn = mysqli_connect($dba, $dbu, $dbp, $dbl);

if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }

$stmt1 = $conn->prepare("SELECT COUNT(*) AS qtd FROM tienda.d_categorias2 WHERE categoria = ?");
if(!$stmt1) {echo 'Error stmt1: '.$conn->error; }

$stmt2 = $conn->prepare("INSERT INTO tienda.d_categorias2 (categoria) VALUES (?)");
if(!$stmt2) {echo 'Error stmt2: '.$conn->error; }

$stmt1->bind_param("s", $categoria);
$stmt2->bind_param("s", $categoria);

$sql = "SELECT DISTINCT(Categoria) AS Categoria FROM test.tienda_transacoes";
$rsl1 = mysqli_query($conn, $sql);
while($lin = mysqli_fetch_assoc($rsl1)) 
    {
    extract($lin);
    $categoria = $Categoria;
    $stmt1->execute();
    $result = $stmt1->get_result();
    $lin =  $result->fetch_array(MYSQLI_NUM);
    $qtd = $lin[0];  
        if ($qtd == 0)
        {
        try {
            $categoria = $Categoria;
            $stmt2->execute();
            }
        catch (mysqli_sql_exception $e) 
            { 
                echo "MySQLi Error Code: " . $e->getCode() . "<br />";
                echo "Exception Msg: " . $e->getMessage();
                exit; // exit and close connection.
            }
        
        }
    }

$stmt1->close();
$stmt2->close();    
$conn->close();
?>