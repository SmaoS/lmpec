<?php
class Login
{
	private $pdo;
    
    public $usuario;
    public $contrasena;   
	public $ind_fuerza;

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

	public function Consultar($data)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM cliente WHERE cc_cliente = ? and contrasena = ?");
			          

			$stm->execute(array(
				$data->usuario, 
				$data->contrasena
		));
			return $stm->fetch(PDO::FETCH_OBJ);
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
	
}
?>
