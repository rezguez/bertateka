<?php

//Clase Abstracta que nos permitirá conectarnos a MySQL

abstract class Modelo {

    //Atributos
    private static $db_host = 'localhost';
    private static $db_user = 'id11998558_root';
    private static $db_pass = 'berta18007563';

    //private static $db_name = 'mexflix';
    protected $db_name = 'id11998558_bertateka';
    private static $db_charset = 'UTF-8';
    private $conn;
    protected $consulta;
    protected $filas = array();

    //Métodos
    //métodos abstractos para CRUD de clases que hereden
    abstract protected function crear();
    abstract protected function leer();
    abstract protected function modificar();
    abstract protected function borrar();

    //método privado para conectarse a la base de datos
    private function db_open() {

        //http://php.net/manual/es/class.mysqli.php
        //http://php.net/manual/es/mysqli.construct.php
        $this->conn = new mysqli(
            self::$db_host,
            self::$db_user,
            self::$db_pass,
            $this->db_name
            );

        //http://php.net/manual/es/mysqli.set-charset.php
        $this->conn->set_charset(self::$db_charset);
    }

    //método privado para desconectarse de la base de datos
    private function db_close() {
 
        //http://php.net/manual/es/mysqli.close.php
        $this->conn->close();
    }

    //establecer un query que afecte datos (INSERT, DELETE o UPDATE)
    protected function set_query() {
        $this->db_open();

        //http://php.net/manual/es/mysqli.query.php
        if (!$this->conn->query($this->consulta)){
            print_r ($this->conn->error);
        }
        $this->db_close();
    }

    //obtener datos de un query (SELECT)
    protected function get_query() {
        unset($this->filas);
        $this->db_open();
        $result = $this->conn->query($this->consulta);

        //http://php.net/manual/es/mysqli-result.fetch-assoc.php
        //http://php.net/manual/es/mysqli-result.fetch-row.php
        while( $this->filas[] = $result->fetch_assoc() );
        $result->close();
        $this->db_close();
        return array_pop($this->filas);
    }
}