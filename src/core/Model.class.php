<?php
	require_once("/../db/Db.class.php");
	class Model extends Db{
		function __construct($name = '') {
			$config = require_once('/../conf/config.php');
			$this->connect($config); //连接数据库
			if(empty($name))
				$name = substr(get_class($this),0,-5);
			$table_name = $config['prefix'].$name;
			$this->table($table_name);
		}
	}
?>