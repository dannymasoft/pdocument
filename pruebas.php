<?php
$clave_fecha_hoy = date("Y-m-d");
echo $clave_fecha_hoy;
$clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 1 month"));
echo $clave_fecha_siguiente_mes;

/*for($i=361;$i<=10000;$i++){
    echo'-';echo $i;echo',';
}*/
?>