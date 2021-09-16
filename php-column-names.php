<?php

$dbe = "mysql"; 				
$dba = "localhost:3308";   		
$dbl = "test";  	
$dbu = "root";			
$dbp = "beta2020";

$conn = new mysqli($dba, $dbu, $dbp, $dbl);

if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }

if ($conn->connect_errno) 
    {
    printf("connection failed: %s\n", $con->connect_error());
    exit();
    }

$query = "SELECT * FROM tienda.d_categorias";

if ($res = $conn->query($query)) {

    $num_rows = $res->num_rows;
    $num_fields = $res->field_count;

    printf("Select query returned %d rows.<br>\n", $num_rows);
    printf("Select query returned %d columns.<br><br>\n", $num_fields);

    $fields = $res->fetch_fields();

    while ($row = $res->fetch_row()) {

        for ($i = 0; $i < $num_fields; $i++) {

            echo $fields[$i]->name . ": " . $row[$i] . "<br>\n";
        }

        echo "*******************************<br>\n";
    }

    $res->close();
} else {

    echo "failed to fetch data\n";
}

$conn->close();