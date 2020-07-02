<?php
require_once('Modelo.php');
class LectoresModelo extends Modelo {
    public $CODIGOLECTOR;
    public $APELLIDOS;
    public $NOMBRE;
    public $CURSO;
    public $catcurso;
    public $nextid;
    
    public function __construct() {
        $this->db_name = 'id11998558_bertateka';
        $this->nextid = '0';
        
    }
    public function crear( $lectores_data = array()) {
        
        $this->consulta = "INSERT INTO tbl_lectores (CODIGOLECTOR, APELLIDOS, NOMBRE, FECHAALTA, NACIMIENTO, CURSO) VALUES ('". $lectores_data['CODIGOLECTOR'] ."', '" . $lectores_data['APELLIDOS'] ."', '" . $lectores_data['NOMBRE'] ."', CURDATE(), '" .$lectores_data['NACIMIENTO'] ."', '" .$lectores_data['CURSO'] . "')";
        $this->set_query();
    }
    public function leer( $id_lector = '' ) {
        $this->consulta = ($id_lector != '')
        ?"SELECT * FROM tbl_lectores WHERE CODIGOLECTOR = '$id_lector'"
        :"SELECT * FROM tbl_lectores";
        
        $this->get_query();
        
        $data = array();
        //http://php.net/manual/es/control-structures.foreach.php
        foreach ($this->filas as $value) {
            $data[]= $value;
            //$data[$key] =  $value;
        }
        // CALCULO $nextid y los valores posibles de CURSO
        for ($n = 0; $n < count($data); $n++) {
            if (!is_null($data[$n]['CURSO'])) {
                $this->catcurso[] = $data[$n]['CURSO'] ;
            }
            if ( $this->nextid < $data[$n]['CODIGOLECTOR'] ) {
                $this->nextid = $data[$n]['CODIGOLECTOR'];
            }
        }
        // Calcula la letra del codigo del lector del nextid
        $miLetra = Array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E');
        
        $valor= substr($this->nextid,0,-1) + 1;
        $resto= $valor - (23 * floor($valor/23));
        $this->nextid = sprintf("%'.05d", $valor).$miLetra[$resto];
        // depuro los valores de CURSO y los ordeno
        $this->catcurso=array_unique($this->catcurso, SORT_REGULAR);
        $this->catcurso=array_values($this->catcurso);
        array_multisort($this->catcurso,SORT_ASC, SORT_STRING);
        return $data;
    }
    public function modificar( $lectores_data = array() ) {
        $consulta_tmp="";
        foreach ($lectores_data as $key => $value) {
            if($key!='CODIGOLECTOR') {
           $consulta_tmp .= "$key". " = ". "'$value', ";
            }
        }
        $consulta_tmp = substr($consulta_tmp, 0, -2);
        $sqlstring= "UPDATE tbl_lectores SET $consulta_tmp WHERE CODIGOLECTOR ='" . $lectores_data['CODIGOLECTOR']."'";
        $this->consulta = $sqlstring;
        $this->set_query();
    }
    public function borrar( $CODIGOLECTOR = '' ) {
        if ($CODIGOLECTOR != '') {
            $this->consulta = "DELETE FROM tbl_lectores WHERE CODIGOLECTOR = '$CODIGOLECTOR'";
            $this->set_query();
        }
        
    }
    public function __destruct() {
    
    }
}