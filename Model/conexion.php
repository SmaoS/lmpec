<?php
class Conexion
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=localhost:3306;dbname=almacen;charset=utf8', 'root', '1234');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}
?>
