<?php
session_start();

//define ("DB_HOST", "ec2-23-20-42-201.compute-1.amazonaws.com");  //env[DB_HOST] = ec2-23-20-42-201.compute-1.amazonaws.com
//define ("DB_NAME", "sobeyspush");   //env[DB_NAME] = sobeyspush
//define ("DB_USER", "deploy");  //env[DB_USER] = deploy
//define ("DB_PASS", "JQvxZgFeL");   //env[DB_PASS] = JQvxZgFeL

<<<<<<< HEAD
//env[DB_HOST] = ec2-23-20-42-201.compute-1.amazonaws.com
//env[DB_NAME] = sobeyspush
//env[DB_USER] = deploy
//env[DB_PASS] = JQvxZgFeL

putenv("PHP_ENV=production");
putenv("DB_HOST=ec2-23-20-42-201.compute-1.amazonaws.com");
putenv("DB_NAME=sobeyspush");
putenv("DB_USER=deploy");
putenv("DB_PASS=JQvxZgFeL");
=======
env[PHP_ENV] = production
env[DB_HOST] = ec2-23-20-42-201.compute-1.amazonaws.com
env[DB_NAME] = sobeyspush
env[DB_USER] = deploy
env[DB_PASS] = JQvxZgFeL
>>>>>>> origin/master

class Database {

    var $_db = null;

    public function __construct() {
//        $this -> _db = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this -> _db = new mysqli( getenv(DB_HOST), getenv(DB_USER), getenv(DB_PASS), getenv(DB_NAME));

		if (!$this -> _db)
			die('Could not connect: ' . mysql_error());

		mysqli_set_charset($this -> _db, "utf8");
	}

	public function __desctruct() {
		//mysql_close($this -> _db);
	}

	public function get_fields($table_name) {
		$result = $this -> result("SHOW COLUMNS FROM " . $table_name);

		$fieldnames = array();
		for ($i = 0; $i < count($result); $i++) :
			$fieldnames[] = $result[$i]["Fields"];
		endfor;

		return $fieldnames;
	}

	public function execute($sql) {
		if ($sql == "") :
			return false;
		else :
			return $this -> _db -> query($sql);
		endif;

	}

	public function single($sql) {
		$b = $this -> result($sql);

		return count($b) > 0 ? $b[0] : array();
	}

	public function result($sql) {
		$result = $this -> _db -> query($sql);

		if (!$result)
			echo 'Could not run query: ' . $this -> _db -> error;

		$b = array();
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) :
			$b[] = $row;
		endwhile;

		return $b;
	}

}
