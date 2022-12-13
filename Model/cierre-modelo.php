<?php
class Cierre
{
	private $pdo;
        
    public $fecha_cierre;
    public $fecha_inicial;
    public $fecha_final;
    public $saldo_sistema;
    public $saldo_caja;
	public $observaciones;

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

			$stm = $this->pdo->prepare("SELECT * FROM cierre order by secuencia desc");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function gettingCierre()
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("select fecha_sistema, ifnull((select max(fecha_final) from cierre), fecha_sistema) as fecha_inicial, (select sum(total_vent) from ventas 
					  where fecha_vent > ifnull((select max(fecha_final) from cierre), fecha_sistema)) as saldo_sistema from fecha_sistema");			          

			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	

	public function Registrar($data)
	{
		try 
		{
		$sql = "INSERT INTO `cierre` (fecha_cierre,fecha_inicial,fecha_final,saldo_sistema,saldo_caja, observaciones) 
		        VALUES (?, ?, sysdate(),?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->fecha_cierre, 
                    $data->fecha_inicial,                    
                    $data->saldo_sistema,
                    $data->saldo_caja,              
					$data->observaciones
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

		$sql = "update fecha_sistema set fecha_sistema = date_add(fecha_sistema, interval 1 day)";
		$this->pdo->prepare($sql)->execute();

	}
	
}
?>
