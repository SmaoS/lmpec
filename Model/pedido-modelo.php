<?php
class Pedido
{
	private $pdo;
    
	public $secuencia;
    public $id_pedido;
    public $id_producto;
    public $cantidad;
    public $valor;
    public $valor_total;
    public $referencia;	

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

			$stm = $this->pdo->prepare("SELECT *, ifnull((select sum(valor_total) from pedidos_det where pedidos_det.id_pedido = pedidos.id_pedido),valor) as valor_total FROM pedidos order by id_pedido desc");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarDet($id_pedido)
	{
		try
		{			
			$stm = $this->pdo->prepare("SELECT *, (select nombre_pro from producto where id_pro = pedidos_det.id_producto) as nombre_pro, (select estado from pedidos where pedidos.id_pedido = pedidos_det.id_pedido) as estado FROM pedidos_det WHERE id_pedido = ?");
			$stm->execute(array($id_pedido));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getting($id_pedido)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM pedidos_det WHERE id_pedido = ?");
			          

			$stm->execute(array($id_pedido));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function gettingDet($id_pedido)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT *, (select nombre_pro from producto where id_pro = pedidos_det.id_producto) as nombre_pro FROM pedidos_det WHERE secuencia = ?");
			          

			$stm->execute(array($id_pedido));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id_pedido)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM pedidos_det WHERE secuencia = ?");			          

			$stm->execute(array($id_pedido));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE pedidos_det SET 
						id_producto          = ?, 
						cantidad        = ?,
                        valor        = ?,
						valor_total            = ?, 
						referencia = ?,
						id_pedido = ?
				    WHERE secuencia = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->id_producto, 
                        $data->cantidad,
                        $data->valor_total/$data->cantidad,
                        $data->valor_total,
                        $data->referencia,
						$data->id_pedido,
                        $data->secuencia
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
		$sql = "INSERT INTO `pedidos_det` (id_pedido,id_producto,cantidad,valor,valor_total, referencia) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->id_pedido, 
                    $data->id_producto,
                    $data->cantidad,
					$data->valor_total/$data->cantidad,
                    $data->valor_total,              
					$data->referencia
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarPedido()
	{	
			$secuencia = $this->pdo->prepare("SELECT ifnull(max(id_pedido),0)+1 as id_pedido FROM pedidos");
			$secuencia->execute(array());
			$stm = $secuencia->fetch(PDO::FETCH_OBJ);
			
		try 
		{
		$sql = "INSERT INTO `pedidos` (id_pedido,fecha,estado,usuario,referencia, valor) 
		        VALUES (?, sysdate(), 0, 1121853083, 'prueba',0)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $stm->id_pedido                 
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		return $stm;
	}
	
	public function gettingProductos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM producto order by nombre_pro asc");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function CerrarDet($id_pedido)
	{			
			$stm = $this->pdo->prepare("SELECT sum(valor_total) as valor_total FROM pedidos_det WHERE id_pedido = ?");
			$stm->execute(array($id_pedido));
			$pedido = $stm->fetch(PDO::FETCH_OBJ);
			// $pedido = $stm[0];
			try 
		{
			$sql = "UPDATE pedidos SET 
						valor          = ?, 
						estado        = 1
				    WHERE id_pedido = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $pedido->valor_total, 
                        $id_pedido
                        
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

		$det = $this->pdo->prepare("SELECT * FROM pedidos_det WHERE id_pedido = ?");
		$det->execute(array($id_pedido));
		$productos =  $det->fetchAll(PDO::FETCH_OBJ);

		foreach($productos as $p){		
		$this->InsertaMovimientos($p);	
		$this->ActualizaProductos($p);		 
		};


	}

	public function InsertaMovimientos($stm)
	{
		try 
		{
		$sql = "INSERT INTO `teso_movimientos` (forma_pago, id_tipo, id_producto, cantidad , valor, fecha, referencia) 
		        VALUES (1, 1, ?, ?, ?, sysdate(), ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(                    
                    $stm->id_producto,
                    $stm->cantidad,
					$stm->valor_total,
                    'pedido'.$stm->id_pedido
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function ActualizaProductos($data)
	{
		try 
		{
			$sql = "UPDATE producto SET 
						cant_pro          = cant_pro+?
				    WHERE id_pro = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->cantidad, 
                        $data->id_producto
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function obtenerPedido($id_pedido)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM pedidos WHERE id_pedido = ?;");
			          

			$stm->execute(array($id_pedido));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}
?>
