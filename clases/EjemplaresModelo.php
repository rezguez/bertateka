<?php
require_once('Modelo.php');
class EjemplaresModelo extends Modelo {
    public $catidioma;
    public $catfondo;
    public $cattipo;
    public $catcolumna;
    public $catfila;
    public $nextid;
    
    public function __construct() {
        $this->db_name = 'id11998558_bertateka';
        $this->nextid = '0';
        
    }
    public function crear( $ejemplares_data = array()) {
        
        $this->consulta = "INSERT INTO tbl_ejemplares (CODEJEM, TITULO, SERIE, FECHAALTA, AUTOR, EDITORIAL, FONDO, TIPO, PRESTADO, FILA, COLUMNA, IDIOMA) VALUES ('". $ejemplares_data['CODEJEM'] ."', '" . $ejemplares_data['TITULO'] ."', '" . $ejemplares_data['SERIE'] ."', CURDATE(), '" .$ejemplares_data['AUTOR'] ."', '" .$ejemplares_data['EDITORIAL'] ."', '" .$ejemplares_data['FONDO'] ."', '" .$ejemplares_data['TIPO'] ."', 'DISPONIBLE', '" .$ejemplares_data['FILA'] ."', '" .$ejemplares_data['COLUMNA'] ."', '" .$ejemplares_data['IDIOMA'] . "')";
        $this->set_query();
    }
    public function leer( $id_ejemplar = '' ) {
        $this->consulta = ($id_ejemplar != '')
        ?"SELECT * FROM tbl_ejemplares WHERE CODEJEM = '$id_ejemplar'"
        :"SELECT * FROM tbl_ejemplares";
        
        $this->get_query();
        
        $data = array();
        //http://php.net/manual/es/control-structures.foreach.php
        foreach ($this->filas as $value) {
            $data[]= $value;
            //$data[$key] =  $value;
        }
        // CALCULO $nextid y los valores posibles de IDIOMA
        for ($n = 0; $n < count($data); $n++) {
            if (!is_null($data[$n]['IDIOMA'])) {
                $this->catidioma[] = $data[$n]['IDIOMA'] ;
            }
            if (!is_null($data[$n]['FONDO'])) {
                $this->catfondo[] = $data[$n]['FONDO'] ;
            }
            if (!is_null($data[$n]['TIPO'])) {
                $this->cattipo[] = $data[$n]['TIPO'] ;
            }
            if (!is_null($data[$n]['FILA'])) {
                $this->catfila[] = $data[$n]['FILA'] ;
            }
            if (!is_null($data[$n]['COLUMNA'])) {
                $this->catcolumna[] = $data[$n]['COLUMNA'] ;
            }
            if ( $this->nextid < $data[$n]['CODEJEM'] ) {
                $this->nextid = $data[$n]['CODEJEM'];
            }
        }
        // Calcula la letra del codigo del ejemplar del nextid
        $miLetra = Array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E');
        
        $valor= substr($this->nextid,0,-1) + 1;
        $resto= $valor - (23 * floor($valor/23));
        $this->nextid = sprintf("%'.06d", $valor).$miLetra[$resto];
        
        // depuro los valores de IDIOMA y los ordeno
        $this->catidioma=array_unique($this->catidioma, SORT_REGULAR);
        $this->catidioma=array_values($this->catidioma);
        array_multisort($this->catidioma,SORT_ASC, SORT_STRING);
        
        // depuro los valores de fondo y los ordeno
        $this->catfondo=array_unique($this->catfondo, SORT_REGULAR);
        $this->catfondo=array_values($this->catfondo);
        array_multisort($this->catfondo,SORT_ASC, SORT_STRING);
        
        // depuro los valores de tipo y los ordeno
        $this->cattipo=array_unique($this->cattipo, SORT_REGULAR);
        $this->cattipo=array_values($this->cattipo);
        array_multisort($this->cattipo,SORT_ASC, SORT_STRING);
        
        // depuro los valores de fila y los ordeno
        $this->catfila=array_unique($this->catfila, SORT_REGULAR);
        $this->catfila=array_values($this->catfila);
        array_multisort($this->catfila,SORT_ASC, SORT_STRING);
        
        // depuro los valores de columna y los ordeno
        $this->catcolumna=array_unique($this->catcolumna, SORT_REGULAR);
        $this->catcolumna=array_values($this->catcolumna);
        array_multisort($this->catcolumna,SORT_ASC, SORT_STRING);
        
        
        return $data;
    }
    public function modificar( $ejemplares_data = array() ) {
        $consulta_tmp="";
        foreach ($ejemplares_data as $key => $value) {
            if($key!='CODEJEM') {
           $consulta_tmp .= "$key". " = ". "'$value', ";
            }
        }
        $consulta_tmp = substr($consulta_tmp, 0, -2);
        $sqlstring= "UPDATE tbl_ejemplares SET $consulta_tmp WHERE CODEJEM ='" . $ejemplares_data['CODEJEM']."'";
        $this->consulta = $sqlstring;
        $this->set_query();
    }
    public function borrar( $CODEJEM = '' ) {
        if ($CODEJEM != '') {
            $this->consulta = "DELETE FROM tbl_ejemplares WHERE CODEJEM = '$CODEJEM'";
            $this->set_query();
        }
        
    }
    public function __destruct() {
       
    }
}