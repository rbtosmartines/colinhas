<?php

//set_time_limit(0);

//$di = new DateTime('NOW', new DateTimeZone('America/Cuiaba'));
//echo $di->format('Y-m-d H:i:s.u')."<br>";

$dbe = "mysql"; 				
$dba = "localhost:3308";   		
$dbl = "test";  	
$dbu = "root";			
$dbp = "beta2020";

## ..dtaccess: Mysql, PDO
$pdomysql = new PDO("$dbe:host=$dba;dbname=$dbl",$dbu,$dbp,array(PDO::ATTR_PERSISTENT => true));

if(!$pdomysql)
	{
    die("EAPP0001-Erro ao criar a conexão PDO - MySQL");
	}

# ------------------ categorias

$sql = "SELECT DISTINCT(Categoria) FROM test.tienda_transacoes";
$qa = $pdomysql->prepare($sql);
$qa->execute();
while ($lin = $qa->fetch())
	{
	extract($lin);
    $sql = "SELECT COUNT(*) AS qtd FROM tienda.d_categorias2 WHERE categoria = '$Categoria'";
    $qb = $pdomysql->prepare($sql);
    $qb->execute();
    $lin = $qb->fetch();
    extract($lin);
    if ($qtd == 0)
        {
        $sql = "INSERT INTO tienda.d_categorias2 (categoria) VALUES ('$Categoria')"; 
        $qb = $pdomysql->prepare($sql);
        $qb->execute();   
        }
    }

//$df = new DateTime('NOW', new DateTimeZone('America/Cuiaba'));
//echo $df->format('Y-m-d H:i:s.u')."<br>";

//var_dump(date_diff($di, $df));
?>