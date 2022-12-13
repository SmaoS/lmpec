<?php
class Facturacion
{
	private $pdo;
    
    public $secuencia;
    public $nombre;
    public $estado;
 
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

			$stm = $this->pdo->prepare(" SELECT *,    (select insta_cliente from cliente where cliente.id_cliente = ventas.id_cliente_vent) as nombre_cliente,    if(estado_vent = 1, 'PAGADA', 'ANULADA') as estado, (select nombre from mesas where secuencia = mesa) as nombre_mesa 	FROM ventas where fecha_vent >=  (select ifnull((select max(fecha_final) from cierre), fecha_sistema) from fecha_sistema) order by id_vent desc");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarDet($id_venta)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare(" SELECT *, (select nombre_pro from producto where id_pro = mesa_det.id_producto) as nombre_pro FROM mesa_det where id_venta = ?");
			$stm->execute(array($id_venta));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getting($secuencia)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM mesa_det WHERE id_venta = ?");
			          

			$stm->execute(array($secuencia));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($secuencia)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM facturacions WHERE secuencia = ?");			          

			$stm->execute(array($secuencia));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE facturacions SET 
						nombre          = ?, 
						estado        = ?
				    WHERE secuencia = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre, 
                        $data->estado,
						$data->secuencia,
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
		$sql = "INSERT INTO `facturacions` (nombre,estado) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombre, 
                    $data->estado                   
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>
