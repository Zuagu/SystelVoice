<?php
function conectar_bd() {
	try {
        $base=new PDO('mysql:host=localhost:8889; dbname=AudioElastixDialerBD', 'root', 'root');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET UTF8");
    } catch (Exception $e) {
        die('Error' . $e->getMessage());
        echo "Linea del error" . $e->getLine();

        
    }
    return $base;
}

function desconectar_bd($conector) {
		mysql_close($conector);

}

function consultar_bd($sentencia) {
	try {
		$conector=conectar_bd();
		$resultado = $conector->query($sentencia);
		return $resultado;

	} catch (Exception $e) {
		die('Error' . $e->getMessage());
        echo "Linea del error" . $e->getLine();
	}

}

function insert_db($sentencia) {
	try {
		$conector = conectar_bd();
		$prepare = $conector->prepare($sentencia);
		$prepare->execute();
	} catch(Exception $e) {
		die('Error' . $e->getMessage());
        echo "Linea del error" . $e->getLine();
	}
}

function insertar_modificar_eliminar_bd($sentencia) {
	$conector=conectar_bd();	
	if(!($resultado=mysql_query($sentencia,$conector))) {
		echo "Error en transacción de base de datos";
		exit();
	 }
	 desconectar_bd($conector);
}

function calcular_nuevo_codigo_bd($nombretabla,$codigocampo) {
	$sentencia="select max(".$codigocampo.") as num from ".$nombretabla.";";
	$result=consultar_bd($sentencia);
	$resultado = $result->fetchAll(PDO::FETCH_OBJ);
	foreach ($resultado as $dato) {
		echo $dato->num + 1;
	}
}

?>






