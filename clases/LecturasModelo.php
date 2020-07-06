<?php

// SELECT tbl_prestamos.*, CONCAT(tbl_lectores.APELLIDOS, ', ',tbl_lectores.NOMBRE, ' (', tbl_lectores.CODLEC, ')') AS LECTOR,  CONCAT(tbl_ejemplares.TITULO, ' (', tbl_ejemplares.CODEJ, ')') AS LIBRO
// FROM tbl_ejemplares
// INNER JOIN (
//     tbl_prestamos
//     INNER JOIN tbl_lectores ON tbl_prestamos.CODLEC = tbl_lectores.CODLEC
//     ) ON tbl_ejemplares.CODEJ = tbl_prestamos.CODEJ

// 1 	NUMPRES 	int(5) 	
// 2 	FECHA 	date 
// 3 	ENTREGA 	date 
// 4 	LIBRO 	varchar(110) 
// 5 	LECTOR 	varchar(39) 	
// 6 	ESTADO 	set('PRESTADO', 'DEVUELTO') 	
// 7 	CODLEC 	varchar(6)


require_once('Modelo.php');
class LecturasModelo extends Modelo {
        
    public function __construct() {
        $this->db_name = 'id11998558_bertateka';
        $this->nextid = '0';
        
    }
    public function crear( $lecturas_data = array()) {
        $consulta_tmp="";
    }
    public function leer( $id_lectura = '' ) {
         $selectqry = "SELECT lecturas.* FROM lecturas";
        if ($id_lectura =='') {
            $this->consulta = $selectqry;
        }
        elseif ($id_lectura == 0){
            $this->consulta = $selectqry . " WHERE ESTADO = 'PRESTADO'";
        } 
        else {
            $this->consulta = $selectqry . " WHERE NUMPRES = '$id_lectura'";
        }
        
        $this->get_query();
        
        $data = array();
        //http://php.net/manual/es/control-structures.foreach.php
        foreach ($this->filas as $value) {
            $data[]= $value;
            //$data[$key] =  $value;
        }
        return $data;
    }
    public function modificar() {
        $consulta_tmp="";
       
    }
 
    public function borrar( ) {
        $consulta_tmp="";
        
    }
    public function __destruct() {
       
    }
}