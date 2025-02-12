<?php
class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	
	private $dbh;
	private $error;
	private $stmt;
	
	public function __construct() {
		// Set DSN (Data source Name)- set the database Driver create string
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		// Set options
		$options = array (
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
		);
		// Create a new PDO instanace
		try {
			$this->dbh = new PDO ($dsn, $this->user, $this->pass, $options);
		}		// Catch any errors
		catch ( PDOException $e ) {
			$this->error = $e->getMessage();
		}
	}
	
// Pass the main SQL query statement by this function 
	public function query($query) {
		$this->stmt = $this->dbh->prepare($query);
	}
// This binding parameters function prevents SQL injection & uses bindValue method to input parameters to SQL
	
	public function bind($param, $value, $type = null) {
		if (is_null ( $type )) {
			switch (true) {
				case is_int ( $value ) :
					$type = PDO::PARAM_INT;
					break;
				case is_bool ( $value ) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null ( $value ) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue ( $param, $value, $type );
	}
	
	
	public function execute(){
		return $this->stmt->execute();
	}
	
	
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}
	
	
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}
	
	
	public function rowCount(){
		return $this->stmt->rowCount();
	}
	
	
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}
	
	
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	
	public function endTransaction(){
		return $this->dbh->commit();
	}
	
	
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}
}