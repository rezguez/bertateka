<?php

// INSERT INTO `id11998558_bertateka`.`users` (`usuario`, `password`, `nombre`, `email`, `role`) VALUES ('profepaco', MD5('bertaadmin'), 'Francisco P�rez', 'rezguez@gmail.com', 'admin');
require_once('Modelo.php');
class UsuariosModelo extends Modelo {
    
    public function __construct() {
       return;
        
    }
    public function crear( $usuarios_data = array()) {
        
        $this->consulta = "INSERT INTO users (usuario, password, nombre, email, role) VALUES ('". $usuarios_data['usuario'] ."', '" 
            . MD5($usuarios_data['password']) ."', '" . $usuarios_data['nombre'] ."', '" .$usuarios_data['email'] ."', '" .$usuarios_data['role'] . "')";
        $this->set_query();
    }
    public function leer( $id_usuario = '' ) {
        $this->consulta = ($id_usuario != '')
        ?"SELECT * FROM users WHERE usuario = '$id_usuario'"
        :"SELECT * FROM users";
        
        $this->get_query();

        return $this->filas;
    }
    public function modificar( $usuarios_data = array() ) {
        $consulta_tmp="";
        foreach ($usuarios_data as $key => $value) {
            if($key!='usuario') {
           $consulta_tmp .= "$key". " = ". "'$value', ";
            }
        }
        $consulta_tmp = substr($consulta_tmp, 0, -2);
        $sqlstring= "UPDATE users SET $consulta_tmp WHERE usuario ='" . $usuarios_data['usuario']."'";
        $this->consulta = $sqlstring;
        $this->set_query();
    }
    public function validar($login_data){
        if (!empty($login_data)){
            $this->consulta = "SELECT * FROM users WHERE usuario = '". $login_data['usuario'] ."' AND password='".MD5($login_data['password'])."'";
            $this->get_query();
            return $this->filas;
        }
        
    }
    public function borrar( $usuario = '' ) {
        if ($usuario != '') {
            $this->consulta = "DELETE FROM users WHERE usuario = '$usuario'";
            $this->set_query();
        }
        
    }
    public function __destruct() {
    
    }
}