<?php
class Producto
{
	private $pdo;
    
    public $id_pro;
    public $nombre_pro;
    public $tipo_pro;
    public $ref_pro;
    public $descrip_pro;
    public $precio_pro;
	public $cant_pro;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Conexion::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("select id_pro, tipo_pro, ref_pro, nombre_pro, descrip_pro, precio_pro, 
			cant_pro - ifnull((select sum(cantidad) from mesa_det where id_producto = id_pro and estado = 0),0) as cant_pro from producto order by nombre_pro");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getting($id_pro)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT  id_pro, tipo_pro, ref_pro, nombre_pro, descrip_pro, precio_pro, 
					  cant_pro - ifnull((select sum(cantidad) from mesa_det where id_producto = id_pro and estado = 0),0) as cant_pro from producto WHERE id_pro = ?");
			          

			$stm->execute(array($id_pro));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id_pro)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM producto WHERE id_pro = ?");			          

			$stm->execute(array($id_pro));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE producto SET 
						nombre_pro          = ?, 
						tipo_pro        = ?,
                        ref_pro        = ?,
						descrip_pro            = ?, 
						precio_pro = ?,
						cant_pro = ?
				    WHERE id_pro = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre_pro, 
                        $data->tipo_pro,
                        $data->ref_pro,
                        $data->descrip_pro,
                        $data->precio_pro,
						$data->cant_pro,
                        $data->id_pro
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar($data)
	{
		try 
		{
		$sql = "INSERT INTO `producto` (nombre_pro,tipo_pro,ref_pro,descrip_pro,precio_pro, cant_pro) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombre_pro, 
                    $data->tipo_pro,
                    $data->ref_pro,
                    $data->descrip_pro,
                    $data->precio_pro,              
					$data->cant_pro ? $data->cant_pro : 0
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
}
?>
