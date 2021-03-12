<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=c0140411_bgtoner",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

	

}