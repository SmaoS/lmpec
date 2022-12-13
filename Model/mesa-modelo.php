<?php
class Mesa
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

			$stm = $this->pdo->prepare("SELECT * FROM mesas");
			$stm->execute();

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
			          ->prepare("SELECT * FROM mesas WHERE secuencia = ?");
			          

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
			            ->prepare("DELETE FROM mesas WHERE secuencia = ?");			          

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
			$sql = "UPDATE mesas SET 
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
		$sql = "INSERT INTO `mesas` (nombre,estado) 
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
