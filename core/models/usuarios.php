<?php
class Usuarios extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombres = null;
	private $apellidos = null;
	private $correo = null;
	private $alias = null;
	private $clave = null;
	private $block = 0;

	// Métodos para sobrecarga de propiedades
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->id = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNombres($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->nombres = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombres()
	{
		return $this->nombres;
	}

	public function setApellidos($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->apellidos = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getApellidos()
	{
		return $this->apellidos;
	}

	public function setCorreo($value)
	{
		if ($this->validateEmail($value)) {
			$this->correo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorreo()
	{
		return $this->correo;
	}

	public function setAlias($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->alias = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getAlias()
	{
		return $this->alias;
	}

	public function setClave($value)
	{
		if ($this->validatePassword($value)) {
			$this->clave = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getClave()
	{
		return $this->clave;
	}

	public function setBlock($value)
	{
		if ($this->validateId($value)) {
			$this->block = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getBlock()
	{
		return $this->block;
	}

	// Métodos para manejar la sesión del usuario
	public function checkAlias()
	{
		$sql = 'SELECT user_id, block FROM table_users WHERE user_name = ?';
		$params = array($this->alias);
		$data = Database::getRow($sql, $params);
		if ($data) {
			$this->id = $data['user_id'];
			$this->block = $data['block'];
			return true;
		} else {
			return false;
		}
	}

	public function checkPassword()
	{
		$sql = 'SELECT pass_word, name_adm, last_name FROM table_users WHERE user_id = ?';
		$params = array($this->id);
		$data = Database::getRow($sql, $params);
		if (password_verify($this->clave, $data['pass_word'])) {
			$this->nombres=$data['name_adm'];
			$this->apellidos=$data['last_name'];
			return true;
		} else {
			return false;
		}
	}

	public function changePassword()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'UPDATE table_users SET pass_word = ? WHERE user_id = ?';
		$params = array($hash, $this->id);
		return Database::executeRow($sql, $params);
	}

	// Metodos para manejar el SCRUD
	public function readUsuarios()
	{
		$sql = 'SELECT user_id, name_adm, last_name, e_mail, user_name FROM table_users ORDER BY last_name';
		$params = array(null);
		return Database::getRows($sql, $params);
	}

	public function searchUsuarios($value)
	{
		$sql = 'SELECT user_id, name_adm, last_name, e_mail, user_name FROM table_users WHERE last_name LIKE ? OR name_adm LIKE ? ORDER BY last_name';
		$params = array("%$value%", "%$value%");
		return Database::getRows($sql, $params);
	}

	public function createUsuario()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO table_users(name_adm, last_name, e_mail, user_name, pass_word) VALUES(?, ?, ?, ?, ?)';
		$params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $hash);
		return Database::executeRow($sql, $params);
	}

	public function getUsuario()
	{
		$sql = 'SELECT user_id, name_adm, last_name, e_mail, user_name FROM table_users WHERE user_id = ?';
		$params = array($this->id);
		return Database::getRow($sql, $params);
	}

	public function updateUsuario()
	{
		$sql = 'UPDATE table_users SET name_adm = ?, last_name = ?, e_mail = ?, user_name = ?, block = ? WHERE user_id = ?';
		$params = array($this->nombres, $this->apellidos, $this->correo, $this->alias, $this->block, $this->id);
		return Database::executeRow($sql, $params);
	}

	public function deleteUsuario()
	{
		$sql = 'DELETE FROM table_users WHERE user_id = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}

	public function summonBlock()
	{
		$sql = 'UPDATE table_users SET block = block+1 WHERE user_id = ?';
		$params = array($this->id);
		return Database::executeRow($sql, $params);
	}
}
?>