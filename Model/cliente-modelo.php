<?php
class Cliente
{
	private $pdo;
    
    public $id_cliente;
    public $insta_cliente;
    public $cc_cliente;
    public $tel_cliente;
    public $dire_resid_cliente;
    public $email_cliente;

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

			$stm = $this->pdo->prepare("SELECT * FROM cliente");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function getting($id_cliente)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM cliente WHERE id_cliente = ?");
			          

			$stm->execute(array($id_cliente));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id_cliente)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM cliente WHERE id_cliente = ?");			          

			$stm->execute(array($id_cliente));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE cliente SET 
						insta_cliente          = ?, 
						cc_cliente        = ?,
                        tel_cliente        = ?,
						dire_resid_cliente            = ?, 
						email_cliente = ?
				    WHERE id_cliente = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->insta_cliente, 
                        $data->cc_cliente,
                        $data->tel_cliente,
                        $data->dire_resid_cliente,
                        $data->email_cliente,
                        $data->id_cliente
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
		$sql = "INSERT INTO `cliente` (insta_cliente,cc_cliente,tel_cliente,dire_resid_cliente,email_cliente) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->insta_cliente, 
                    $data->cc_cliente,
                    $data->tel_cliente,
                    $data->dire_resid_cliente,
                    $data->email_cliente                    
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
?>
