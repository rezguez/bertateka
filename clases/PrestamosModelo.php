<?php

// SELECT tbl_prestamos.*, CONCAT(tbl_lectores.APELLIDOS, ', ',tbl_lectores.NOMBRE, ' (', tbl_lectores.CODLEC, ')') AS LECTOR,  CONCAT(tbl_ejemplares.TITULO, ' (', tbl_ejemplares.CODEJ, ')') AS LIBRO
// FROM tbl_ejemplares
// INNER JOIN (
//     tbl_prestamos
//     INNER JOIN tbl_lectores ON tbl_prestamos.CODLEC = tbl_lectores.CODLEC
//     ) ON tbl_ejemplares.CODEJ = tbl_prestamos.CODEJ



require_once('Modelo.php');
class PrestamosModelo extends Modelo {
        
    public function __construct() {

        $this->nextid = '0';
        
    }
    public function crear( $prestamos_data = array()) {
        $miqry = "INSERT INTO tbl_prestamos ( FECHAPRESTAMO,  ESTADO, CODEJ, CODLEC, CURSO ) VALUES (";
        $this->consulta = $miqry ." '" . $prestamos_data['FECHAPRESTAMO'] ."', 'PRESTADO', '" .$prestamos_data['CODEJ'] ."', '" .$prestamos_data['CODLEC'] ."', '" . $prestamos_data['CURSO'] . "')";
        $this->set_query();
        $miqry2 = "UPDATE tbl_ejemplares SET PRESTADO = 'PRESTADO' WHERE CODEJEM = '" .$prestamos_data['CODEJ'] ."'";
        $this->consulta = $miqry2;
        $this->set_query();
    }
    public function leer( $id_prestamo = '' ) {
         $selectqry = "SELECT tbl_prestamos.*, CONCAT(tbl_lectores.APELLIDOS, ', ',tbl_lectores.NOMBRE, ' (', tbl_lectores.CODIGOLECTOR, ')') AS LECTOR,  
                        CONCAT(tbl_ejemplares.TITULO, ' (', tbl_ejemplares.CODEJEM, ')') AS LIBRO
                        FROM tbl_ejemplares
                        INNER JOIN (tbl_prestamos  INNER JOIN tbl_lectores ON tbl_prestamos.CODLEC = tbl_lectores.CODIGOLECTOR ) 
                        ON tbl_ejemplares.CODEJEM = tbl_prestamos.CODEJ";
        if ($id_prestamo =='') {
            $this->consulta = $selectqry;
        }
        elseif ($id_prestamo == 0){
            $this->consulta = $selectqry . " WHERE ESTADO = 'PRESTADO'";
        } 
        else {
            $this->consulta = $selectqry . " WHERE NUMPRES = '$id_prestamo'";
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
    public function modificar( $prestamos_data = array() ) {
        $consulta_tmp="";
        foreach ($prestamos_data as $key => $value) {
            if($key!='NUMPRES') {
                $consulta_tmp .= "$key". " = ". "'$value', ";
            }
        }
        $consulta_tmp = substr($consulta_tmp, 0, -2);
        $sqlstring= "UPDATE tbl_prestamos SET $consulta_tmp WHERE NUMPRES ='" . $prestamos_data['NUMPRES']."'";
        $this->consulta = $sqlstring;
        $this->set_query();
    }
    public function devolver( $NUMPRES = '', $CODEJ ='') {
        $sqlstring1="UPDATE tbl_prestamos SET FECHADEVOLUCION=CURDATE(), ESTADO='DEVUELTO' WHERE NUMPRES = $NUMPRES";
        $this->consulta = $sqlstring1;
        $this->set_query();
        $sqlstring2="UPDATE tbl_ejemplares SET PRESTADO='DISPONIBLE' WHERE CODEJEM ='$CODEJ'";
        $this->consulta = $sqlstring2;
        $this->set_query();
    }
    public function borrar( $NUMPRES = '' ) {
        if ($NUMPRES != '') {
            $this->consulta = "DELETE FROM tbl_prestamos WHERE NUMPRES = '$NUMPRES'";
            $this->set_query();
        }
        
    }
    public function __destruct() {
      
    }
}