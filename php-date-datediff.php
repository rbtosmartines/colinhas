<?php

$d = new DateTime('NOW', new DateTimeZone('America/Cuiaba'));
echo $d->format('d/m/Y\TH:i:s.u')."<br>";

$di = new DateTime('2021-09-15 01:02:16.993550', new DateTimeZone('America/Cuiaba'));
$df = new DateTime('2021-09-15 01:02:33.430238', new DateTimeZone('America/Cuiaba'));

var_dump(date_diff($di, $df));