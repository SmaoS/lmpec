<?php
require 'ticket/ticket.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Venta
{
	private $pdo;
    
	public $secuencia;
    public $mesa;
    public $id_producto;
    public $cantidad;
    public $valor;
    public $valor_total;
    public $referencia;	
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
			$stm = $this->pdo->prepare("SELECT *, ifnull((select sum(valor_total) from mesa_det where mesa_det.mesa = mesas.secuencia and estado = 0),0) as valor_total FROM mesas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarDet($mesa)
	{
		try
		{			
			$stm = $this->pdo->prepare("SELECT *, (select nombre_pro from producto where id_pro = mesa_det.id_producto) as nombre_pro FROM mesa_det WHERE mesa = ? and estado = 0 order by secuencia desc");
			$stm->execute(array($mesa));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getting($mesa)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM mesa_det WHERE mesa = ?");
			          

			$stm->execute(array($mesa));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function gettingDet($mesa)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT *, (select nombre_pro from producto where id_pro = mesa_det.id_producto) as nombre_pro FROM mesa_det WHERE secuencia = ?");
			          

			$stm->execute(array($mesa));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($mesa)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM mesa_det WHERE secuencia = ?");			          

			$stm->execute(array($mesa));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE mesa_det SET 
						id_producto          = ?, 
						cantidad        = ?,
                        valor        = ?,
						valor_total            = ?, 
						referencia = ?,
						mesa = ?
				    WHERE secuencia = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->id_producto, 
                        $data->cantidad,
                        $data->valor_total/$data->cantidad,
                        $data->valor_total,
                        $data->referencia,
						$data->mesa,
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
		$sql = "UPDATE mesas SET estado = 1	WHERE secuencia = ?";
		$this->pdo->prepare($sql)->execute(array($data->mesa));

		try 
		{
		$sql = "INSERT INTO `mesa_det` (mesa,id_producto,cantidad,valor,valor_total, referencia) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->mesa, 
                    $data->id_producto,
                    $data->cantidad,
					$data->valor,
                    $data->valor*$data->cantidad,              
					$data->referencia
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarVenta()
	{	
			$secuencia = $this->pdo->prepare("SELECT ifnull(max(mesa),0)+1 as mesa FROM ventas");
			$secuencia->execute(array());
			$stm = $secuencia->fetch(PDO::FETCH_OBJ);
			
		try 
		{
		$sql = "INSERT INTO `ventas` (mesa,fecha,estado,usuario,referencia, valor) 
		        VALUES (?, sysdate(), 0, 1121853083, 'prueba',0)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $stm->mesa                 
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
			$stm = $this->pdo->prepare("SELECT * FROM (select id_pro, tipo_pro, ref_pro, nombre_pro, descrip_pro, precio_pro, 
			cant_pro - ifnull((select sum(cantidad) from mesa_det where id_producto = id_pro and estado = 0),0) as cantidad from producto)a where cantidad > 0 order by nombre_pro asc");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function gettingPrecioProducto($id_pro)
	{
		try
		{			
			$stm = $this->pdo->prepare("SELECT * FROM producto where id_pro = ?");
			$stm->execute(array($id_pro));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function CerrarDet($mesa, $tipo)
	{
		// libera mesa
			try 
		{
			$sql = "UPDATE mesas SET 						
						estado        = 0
				    WHERE secuencia = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(                        
                        $mesa                        
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		// total de venta
		
		$stm = $this->pdo->prepare("SELECT sum(valor_total) as valor_total FROM mesa_det WHERE mesa = ? and estado = 0");
		$stm->execute(array($mesa));
		$venta = $stm->fetch(PDO::FETCH_OBJ);

		//inserta info venta

		try 
		{
		$sql = "INSERT INTO `ventas` (id_cliente_vent, estado_vent, fecha_vent , total_vent, mesa) 
		        VALUES (12, 1, sysdate(), ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(                    
                    $venta->valor_total,
                    $mesa
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

		$det = $this->pdo->prepare("SELECT *, (select max(id_vent) from ventas) as id_venta FROM mesa_det WHERE mesa = ? and estado = 0");
		$det->execute(array($mesa));
		$productos =  $det->fetchAll(PDO::FETCH_OBJ);
		// consulta para factura
		$detFac = $this->pdo->prepare("select valor, sum(valor_total) as valor_total, (select max(id_vent) from ventas) as id_venta, (select nombre from mesas where secuencia = mesa) as nombre_mesa, 	(select nombre_pro from producto where id_pro = id_producto) as nombre_pro,  sum(cantidad) as cant_total FROM mesa_det WHERE mesa = ? and estado = 0 group by id_producto");
		$detFac->execute(array($mesa));
		$productosFac =  $detFac->fetchAll(PDO::FETCH_OBJ);

		if($tipo == 1){
			$this->imprimirFactura($venta->valor_total, $productosFac);	
		}
		// else{
		// 	$this->abrirCaja($venta->valor_total, $productosFac);	
		// }
		

		foreach($productos as $p){		
		$this->InsertaMovimientos($p);	
		$this->ActualizaProductos($p);		 
		};

		try 
		{
			$sql = "UPDATE mesa_det SET 						
						estado        = 1,
						id_venta = ?
				    WHERE mesa = ? and estado = 0";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(          
						$productos[0]->id_venta,
                        $mesa                        
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function InsertaMovimientos($stm)
	{
		try 
		{
		$sql = "INSERT INTO `teso_movimientos` (forma_pago, id_tipo, id_producto, cantidad , valor, fecha, referencia) 
		        VALUES (1, 2, ?, ?, ?, sysdate(), ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(                    
                    $stm->id_producto,
                    $stm->cantidad,
					$stm->valor_total,
                    'venta'.$stm->id_venta
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
						cant_pro          = cant_pro-?
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

	public function gettingMesas()
	{
		try
		{			
			$stm = $this->pdo->prepare("select * from mesas where estado = 0");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function postTraslado($mesaNueva, $mesaAnterior)
	{
		try 
		{
			$sql = "UPDATE mesa_det set mesa = ? where estado = 0 and mesa = ?";

			$this->pdo->prepare($sql)
			     ->execute(array($mesaNueva, $mesaAnterior));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		try 
		{
			$sql = "UPDATE mesas set estado = 1 where secuencia = ?";

			$this->pdo->prepare($sql)->execute(array($mesaNueva));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		try 
		{
			$sql = "UPDATE mesas set estado = 0 where secuencia = ?";

			$this->pdo->prepare($sql)
			     ->execute(array($mesaAnterior));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	// public function gettingNombreMesa($mesa)
	// {
	// 	try
	// 	{			
	// 		$sql = "select * from mesas where secuencia = ?";
	// 		$stm = $this->pdo->prepare($sql)->execute(array($mesa));		
	// 		return $stm->fetch(PDO::FETCH_OBJ);
	// 	}
	// 	catch(Exception $e)
	// 	{
	// 		die($e->getMessage());
	// 	}
	// }

	public function gettingNombreMesa($mesa)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("select * from mesas where secuencia = ?");
			$stm->execute(array($mesa));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function imprimirFactura($total, $ventaDet)
	{
		try 
		{
			$nombre_impresora = "XP-58"; 
 
 
			$connector = new WindowsPrintConnector($nombre_impresora);
			$printer = new Printer($connector);
			 
			/*
				Imprimimos un mensaje. Podemos usar
				el salto de línea o llamar muchas
				veces a $printer->text()
			*/			
			$printer->text(str_pad("Los Mal Portados",32," ",STR_PAD_BOTH));			
			$printer->text("\n");			
			$printer->text(str_pad("Estanco y Cigarreria",32," ",STR_PAD_BOTH));			
			$printer->text("\n");			
			$printer->text(str_pad("Nit: 1121853083-1",32," ",STR_PAD_BOTH));			
			$printer->text("\n");						

			$printer->text("--------------------------------");			
			$printer->text(" N° Factura: ".$ventaDet[0]->id_venta."      ".$ventaDet[0]->nombre_mesa."  \n");
			$printer->text("--------------------------------");
			$printer->text("Producto      Cant.        Valor\n");
			$printer->text("--------------------------------");


			foreach($ventaDet as $r){ 
				$linea = $this->justificaProducto($r->nombre_pro, $r->cant_total, $r->valor_total);	
				$printer->text($linea);
			}; 
			$printer->text("\n--------------------------------\n");
			$printer->text("             Total:".str_pad("$".number_format($total),13," ",STR_PAD_LEFT));
			$printer->text("\n\n");
			$printer->text(str_pad(" Gracias por Preferirnos ",32,"-",STR_PAD_BOTH));
			/*
				Hacemos que el papel salga. Es como 
				dejar muchos saltos de línea sin escribir nada
			*/
			$printer->feed(5);			
			/*
				Cortamos el papel. Si nuestra impresora
				no tiene soporte para ello, no generará
				ningún error
			*/
			$printer->cut();
			 
			/*
				Por medio de la impresora mandamos un pulso.
				Esto es útil cuando la tenemos conectada
				por ejemplo a un cajón
			*/
			$printer->pulse();
			 
			/*
				Para imprimir realmente, tenemos que "cerrar"
				la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
			*/
			$printer->close();

			

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function justificaProducto($nombre, $cant, $valor)
	{

		$col1 = str_pad($nombre,13," ");
		$col1 = substr($col1, 0, 13);
		$col2 = str_pad($cant,3,"0",STR_PAD_LEFT);
		$col2 = str_pad($cant,6," ",STR_PAD_LEFT);
		$col3 = str_pad("$".number_format($valor),13," ",STR_PAD_LEFT);

		return "{$col1}{$col2}{$col3}";

	}

	public function abrirCaja($total, $ventaDet)
	{

		$nombre_impresora = "XP-58";  
 
			$connector = new WindowsPrintConnector($nombre_impresora);
			$printer = new Printer($connector);

			$printer->text(" N° Factura: ".$ventaDet[0]->id_venta."      ".$ventaDet[0]->nombre_mesa."  \n");			
			$printer->text("             Total:".str_pad("$".number_format($total),13," ",STR_PAD_LEFT));
			$printer->feed(3);		
			$printer->cut();
			$printer->pulse();
			 
			/*
				Para imprimir realmente, tenemos que "cerrar"
				la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
			*/
			$printer->close();
	}


}
?>
