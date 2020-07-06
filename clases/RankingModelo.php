<?php
// SELECT sum( NUM_LEC ) AS TT_LEC, OBRA, CICLO
// FROM ranking_obras
// GROUP BY OBRA
// HAVING CICLO = '3 CICLO'
// ORDER BY `TT_LEC` DESC

// select count(`tbl_prestamos`.`NUMPRES`) AS `NUM_LEC`,`tbl_ejemplares`.`TITULO` AS `OBRA`,
// `ciclos`.`CICLO` AS `CICLO`,`tbl_ejemplares`.`EDITORIAL`, 
// `tbl_ejemplares`.`AUTOR`,`tbl_ejemplares`.`SERIE`  
//     from ((`tbl_ejemplares` 
//         join (`tbl_prestamos` 
//             join `tbl_lectores` 
//              on((`tbl_prestamos`.`CODLEC` = `tbl_lectores`.`CODIGOLECTOR`))) 
//                 on((`tbl_ejemplares`.`CODEJEM` = `tbl_prestamos`.`CODEJ`))) 
//                 join `ciclos` 
//                     on((`ciclos`.`CURSO` = `tbl_prestamos`.`CURSO`))) 
// group by `tbl_ejemplares`.`TITULO`,`ciclos`.`CICLO` 
//     order by `ciclos`.`CICLO`



require_once('Modelo.php');
class RankingModelo extends Modelo {
   
    
    
    public function crear() {
        
    }
    public function leer() {
        $strsql="SELECT sum( NUM_LEC ) AS TT_LEC, OBRA FROM ranking_obras GROUP BY OBRA ORDER BY `TT_LEC` DESC";
        $this->consulta = $strsql;
       
        $this->get_query();

        return $this->filas;
    }
    public function leerciclos() {
        $strsqlciclo="SELECT sum( NUM_LEC ) AS TT_LEC, OBRA, CICLO FROM ranking_obras
                        GROUP BY OBRA , CICLO  ORDER BY `TT_LEC` DESC";
        $this->consulta = $strsqlciclo;
        
        $this->get_query();
        
        return $this->filas;
    }
    public function leereditorial() {
        $strsqlciclo="SELECT sum( NUM_LEC ) AS TT_LEC, EDITORIAL, CICLO FROM ranking_obras
                        GROUP BY EDITORIAL , CICLO  ORDER BY `TT_LEC` DESC";
        $this->consulta = $strsqlciclo;
        
        $this->get_query();
        
        return $this->filas;
    }
    public function leerserie() {
        $strsqlciclo="SELECT sum( NUM_LEC ) AS TT_LEC, SERIE, CICLO FROM ranking_obras
                        GROUP BY SERIE , CICLO  ORDER BY `TT_LEC` DESC";
        $this->consulta = $strsqlciclo;
        
        $this->get_query();
        
        return $this->filas;
    }
    public function leerautor() {
        $strsqlciclo="SELECT sum( NUM_LEC ) AS TT_LEC, AUTOR, CICLO FROM ranking_obras
                        GROUP BY AUTOR , CICLO  ORDER BY `TT_LEC` DESC";
        $this->consulta = $strsqlciclo;
        
        $this->get_query();
        
        return $this->filas;
    }
    public function modificar() {
    }
    public function borrar( ) {
        
    }
   
    
   
}