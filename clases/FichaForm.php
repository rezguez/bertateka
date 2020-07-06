<?php 

class Encabezado {
    var $titulo;
    var $boton;
    var $tipoboton;
    var $target;
    var $prefijoclase;
    
    public function __construct ( $titulo, $boton, $tipoboton, $target, $prefijoclase){
        $this->titulo=$titulo;
        $this->boton=$boton;
        $this->tipoboton=$tipoboton;
        $this->target=$target;
        $this->prefijoclase=$prefijoclase;
    }
    
    public function getEncabezado() {
        $data='';
        if (is_null($this->boton)) {
            $data = "<h5 style='font-weight: 500;'>$this->titulo</h5>\n";
            return $data;
        }
        $data = "<div class='row'>\n
            <div class='col'> </div>\n
            <div class='col-6'><h5 style='font-weight: 500;'>$this->titulo</h5></div>\n
            <div class='col'>";
        if ($this->target == 'submit') {
            $data .= "<button class='btn btn-md m-0 " . $this->prefijoclase . "but2' " . "type='submit'>$this->boton</button></div>\n</div>\n";
        } else {
            $data .= "<button type='button' class='btn btn-md m-0 " . $this->prefijoclase . "but2' " . "data-toggle='modal' data-target='$this->target'>$this->boton</button></div>\n</div>\n";
        }
        return $data;
    }
    
}

class FichaCard {
    //Atributos
    var $id;
    var $Encab;
    var $definition;
    var $header;
    var $body;
    var $footer;
    var $ending;
    
    
    
    //M�todos
    public function __construct($id,  $titulo, $boton, $tipoboton, $target, $prefijoclase){
        $this->id=$id;
        $this->Encab=new Encabezado( $titulo, $boton, $tipoboton, $target, $prefijoclase);
    }
    
    public function setDefinition($definition=''){
        $this->definition = "<!-- ************ CARD $this->id  ************* -->\n<div id='$this->id' class='card card-sm sombra'>\n" . $definition;
    }
    
    public function setHeader()
    {
        $this->header = "<div class='card-header mb-0 text-center ".$this->Encab->prefijoclase."'>\n".$this->Encab->getEncabezado()."</div>\n";

    }
    public function setBody($body)
    {
        $this->body = "<div style='padding-top: 10px;' class='card-body pb-3 " . $this->Encab->prefijoclase . "fondo'>\n\n".$body."\n</div>\n";
    }
    
    public function setFooter($footer='')
    {
        if ($footer=='') {
            $this->footer ="";
            return "";
        }
        $this->footer = "<div class='card-footer " . $this->Encab->prefijoclase . "fondo' style='width: 100%'>".$footer."</div>\n";
    }
    public function setEnding($ending='')
    {
        $this->ending = $ending . "</div>\n<!-- ************ END $this->id  ************* -->";
    }

    public function setCard($body, $definition='', $footer='', $ending=''){
        $this->setDefinition($definition);
        $this->setHeader();
        $this->setBody($body);
        $this->setFooter($footer);
        $this->setEnding($ending);
    }
    public function getCard(){
        return $this->definition .$this->header.$this->body.$this->footer.$this->ending;
    }
}

class FichaModal{
    //Atributos
    var $id;
    var $Encab;
    var $definition;
    var $header;
    var $body;
    var $footer;
    var $ending;
    
    
    
    //M�todos
    public function __construct($id,  $titulo,  $prefijoclase, $boton='', $tipoboton='', $target=''){
        $this->id=$id;
        $this->Encab=new Encabezado( $titulo, $boton, $tipoboton, $target, $prefijoclase);
    }
    
    public function setDefinition($definition=''){
        $this->definition = " <!-- ************ Modal $this->id ************* -->"
            ."<div class='modal fade sombra' id='$this->id' tabindex='-1' role='dialog'>"
            ."<div class='modal-dialog modal-lg modal-dialog-centered' role='document'>"
            ."<div class='modal-content'>". $definition;
    }
    
    public function setHeader()
    {
        $this->header = "<div class='modal-header text-center ".$this->Encab->prefijoclase ."'><h5 style='font-weight: 500;'>" .$this->Encab->titulo. "</h5></div>";
        
    }
    public function setBody($body)
    {
        $this->body = "<div style='padding-top: 10px;' class='modal-body pb-3 " . $this->Encab->prefijoclase . "fondo'>\n\n".$body."\n</div>\n";
    }
    
    public function setFooter($footer='')
    {
        if (is_null($footer)) { 
            $this->footer ="";
            return ;
        }
    
        $this->footer = "<div class='modal-footer " . $this->Encab->prefijoclase . "fondo' style='width: 100%'>
            <div>".$footer."</div><button class='btn btn-dark' class='close' data-dismiss='modal'>
            Cancelar</button> <button class='btn " . $this->Encab->prefijoclase . "' type='submit'>Guardar</button></div>\n";

    }
    public function setEnding($ending='')
    {
        $this->ending = $ending . "</div>\n	</div>\n  </div>\n\n
            <!-- ************ FIN Modal  $this->id ************* -->\n\n";
    }
    
    public function setCard($body, $definition='', $footer='', $ending=''){
        $this->setDefinition($definition);
        $this->setHeader();
        $this->setBody($body);
        $this->setFooter($footer);
        $this->setEnding($ending);
    }
    public function getCard(){
        return $this->definition .$this->header.$this->body.$this->footer.$this->ending;
    }
}

class Campo {
    // Atributos
    var $nombre;
    var $tipo;      // text, date, select, pass
    var $label;
    var $options= [];    // Array con los valores del select
    var $placeholder;
    var $required=false;  // boolean
    var $readonly=false;  // boolean
    
    //M�todos
    public function Iniciar($nombre, $tipo, $label, $options, $placeholder='', $required=false, $readonly=false){
        $this->nombre=$nombre;
        $this->tipo=$tipo; 
        $this->label=$label; 
        $this->placeholder=$placeholder; 
        $this->required=$required;
        $this->readonly=$readonly;
        $this->options=$options;
    }
 }   

class CampoForm {
        //Atributos
        var $Campo;
        var $display;           // fila, col, hidden
        var $value = '';
        var $size='';           // '' sm lg
        var $class='';
        
        //Metodos
        public function __construct($display, $nombre, $tipo, $label, $options, $value='', $placeholder='', $required=false, $readonly=false){
            $this->Campo = new Campo();
            $this->Campo->Iniciar($nombre, $tipo, $label, $options, $placeholder, $required, $readonly);
            $this->display=$display;
            $this->setValue($value);
         }
        public function setEstilo($class, $size)   {
            $this->size=$size;
            $this->class=$class;
        }
        public function setValue($value){
            $this->value=$value;
        }
        public function getCampoForm(){
            if ($this->display=='fila') $data=$this->getCampoFormfila();
            else $data=$this->getCampoFormcol();
            return $data;
        }
        public function getCampoFormcol() {
            $tamlab = ($this->size != '') ? "col-form-label-".$this->size : '';
            $tamcon = ($this->size != '') ? "form-control-".$this->size : '';
            $required = ($this->Campo->required) ? ' required ' : '';
            $readonly= ($this->Campo->readonly) ? ' readonly ' : '';
            if ($this->Campo->tipo != 'select') {
                $data = "\n<!-- 		Campo col ". $this->Campo->nombre."	 -->\n"
                        ."<div class='form-group col mb-0 pl-0'>\n"
                        ."<label for='" . $this->Campo->nombre . "' class='col-form-label ".$tamlab." label pl-2 " . $this->class . "label' style='width:100%; border-top-left-radius: .25rem;border-top-right-radius: .25rem;'>"
                        .$this->Campo->label."</label>\n"
                        ."<input type='" . $this->Campo->tipo . "' ".$required.$readonly." class='form-control ".$tamcon."' name='" . $this->Campo->nombre."' placeholder='" . $this->Campo->placeholder . "' value='" . $this->value . "'>\n"
                        ."</div>\n\n";
            } 
            else {
                $data =  "\n<!-- 		Select col ".$this->Campo->nombre."	 -->\n";
                $data .= "<div class='form-group col mb-1 pl-0'>";
                $data .= "<label for='".$this->Campo->nombre."' class='col-form-label ".$tamlab." mb-0 label pl-2 " . $this->class . "label' style=' border-top-left-radius: .25rem;border-top-right-radius: .25rem; width:100%;'>".$this->Campo->label."</label>";
                $data .= "<select $required class='form-control ".$tamcon."' name='".$this->Campo->nombre."' ".$readonly.">\n";
                foreach ($this->Campo->options as $ops){
                    $data .= "<option ";
                    if ($ops == $this->value) {
                        $data .=  " selected='selected'";
                    }
                    $data .=  ">" . $ops . "</option>\n";
                }
                $data .=  "</select>\n</div>\n"; 
            }
            return $data;
            
        }
        public function getCampoFormfila(){
            $tamlab = ($this->size != '') ? "col-form-label-".$this->size : '';
            $tamcon = ($this->size != '') ? "form-control-".$this->size : '';
            $tamgroup =  ($this->size != '') ? "input-group-".$this->size : '';
            $required = ($this->Campo->required) ? ' required ' : '';
            $readonly= ($this->Campo->readonly) ? ' readonly ' : '';
            if ($this->Campo->tipo != 'select') {
                $data = "\n<!-- 		Campo fila ".$this->Campo->nombre."	 -->\n"
                ."<div class='input-group ".$tamgroup." mb-3 pl-0'>\n"
                ."<div class='input-group-prepend col-2 pl-0 pr-0'><div class='input-group-text " . $this->class . "label col col-form-label ".$tamlab."' style='border-top-right-radius: 0; border-bottom-right-radius: 0;'>".$this->Campo->label."</div></div>\n"
                    ."<input type='" . $this->Campo->tipo . "' ".$required." class='form-control ".$tamcon."' name='" . $this->Campo->nombre . "' placeholder='".$this->Campo->placeholder."' value='".$this->value."' ".$readonly.">\n"
                ." </div>\n\n";
            } else {
                $data= "<!-- 		Select fila ".$this->Campo->nombre."	 -->\n";
                $data .= "<div class='input-group ".$tamgroup." mb-3'>\n";
                $data .= "<div class='input-group-prepend col-2 pl-0 pr-0'><span class='input-group-text " . $this->class . "label col col-form-label ".$tamlab."' style='border-top-right-radius: 0; border-bottom-right-radius: 0;'>".$this->Campo->label."</span></div>\n";
                $data .= "<select ".$required." class='form-control ".$tamcon."' name='".$this->Campo->nombre."' ".$readonly.">\n";
                foreach ($this->Campo->options as $ops){
                    $data .= "<option ";
                    if ($ops == $this->value) {
                        $data .=  " selected='selected'";
                    }
                    $data .=  ">" . $ops . "</option>\n";
                }
                $data .=  "</select>\n</div>\n";              
            }
            return $data;
         }
    }

class FilaForm {
    var $col= [];
    var $size;
    var $class;
    var $anchocol=[];
    
    public function __construct(CampoForm $CampoForm, $anchocol=0, $class='', $size=''){
        $this->class=$class;
        $this->size=$size;
        $this->col[]= $CampoForm;
        $this->anchocol[]=$anchocol;
    }
    public function addCol (Campoform $Campoform, $anchocol=0){
        $this->col[]=$Campoform;
        $this->anchocol[]=$anchocol;
    }
    public function getFilaForm(){
        $data="<div class='row mx-auto'>\n";
        
        foreach ($this->col as $key => $value){
            $colclass= ($this->anchocol[$key]!=0) ? "col pl-0 pr-0 col-".$this->anchocol[$key] : 'col pl-0 pr-0' ;
            $value->setEstilo($this->class, $this->size);
            $data .= "<div class='".$colclass."'>";
            $data .= $value->getCampoForm();
            $data .= "</div>\n";
        }
        $data .= "</div>\n";
        return $data;
    }
    
        
}
    
class Form {
    var $idform;
    var $action;
    var $size;
    var $class;
    var $filas = [];
    var $onsubmit='';
    var $metodo='post';
    var $botones= ["no"=>"CANCELAR", "yes"=>"GUARDAR"];
    
    public function __construct($idform, $action, $size, $class, $onsubmit='', $metodo='post', $botones =["no"=>"CANCELAR", "yes"=>"GUARDAR"]){
        $this->idform=$idform;
        $this->action=$action;
        $this->size=$size;
        $this->class=$class;
        $this->onsubmit=$onsubmit;
        $this->metodo=$metodo;
        $this->botones=$botones;
  
    }
    
    public function addFilas(FilaForm $Filaform){
        $this->filas[]=$Filaform;
    }
    
    public function getInicioForm(){
        $submit= ($this->onsubmit != '') ? "onsubmit=".chr(34).$this->onsubmit.chr(34) : "";
        $data = "\n<!-- ****** Fomulario ". $this->idform . " ***** -->\n";
        $data .= "<form role='form' method='".$this->metodo."' ".$submit." id='".$this->idform."' action='".$this->action."'>\n";
        return $data;
    }
    public function getBodyForm(){
        $data='';
        foreach ($this->filas as $value){
            if ($value->class == '') $value->class=$this->class;
            if ($value->size == '') $value->size=$this->size;
            $data .= $value->getFilaForm();
        }
        return $data;
    }
    public function getFinalForm(){
        $data="\n</form>\n<!-- ****** Final del Fomulario ". $this->idform . " ***** -->\n";
        return $data;
    }
    public function getForm(){
        $data = $this->getInicioForm() . $this->getBodyForm() . $this->getFinalForm();
        return $data;
    }
}

class FormModal {
    var $Form;
    var $FichaModal;
    
    public function __construct(Form $Form, FichaModal $FichaModal){
        $this->Form=$Form;
        $this->FichaModal=$FichaModal;
    }
    public function setFormModal(){
        $this->FichaModal->setDefinition($this->Form->getInicioForm());
        $this->FichaModal->setHeader();
        $this->FichaModal->setBody($this->Form->getBodyForm());
        $this->FichaModal->setFooter('');
        $this->FichaModal->setEnding($this->Form->getFinalForm());
    }
    public function  getFormModal(){
        $this->setFormModal();
        $data = $this->FichaModal->getCard();
        return $data;
    }
}

class FormCard {
    var $Form;
    var $FichaCard;
    
    public function __construct(Form $Form, FichaCard $FichaCard){
        $this->Form=$Form;
        $this->FichaCard=$FichaCard;
    }
    public function setFormCard($footer){
        $this->FichaCard->setDefinition($this->Form->getInicioForm());
        $this->FichaCard->setHeader();
        $this->FichaCard->setBody($this->Form->getBodyForm());
        $this->FichaCard->setFooter($footer);
        $this->FichaCard->setEnding($this->Form->getFinalForm());
    }
    public function  getFormCard(){
        $data = $this->FichaCard->getCard();
        return $data;
    }
}

// $Card= new FichaCard('geslector', 'GESTI�N DE LECTORES', 'Nuevo', 'button', '#addlector', 'oxb');

// $APELLIDOS = new CampoForm('fila','APELLIDOS', 'text', 'APELLIDOS', Array(),'Apellidos...', true);
// $NOMBRE = new CampoForm('fila','NOMBRE', 'text', 'NOMBRE', Array(),'NOMBRE...', true);
// $CURSO = new CampoForm( 'col', 'CURSO','select', 'CURSO', $global_cursos);
// $FECHAALTA = new CampoForm( 'col', 'FECHAALTA','date', 'ALTA', Array(), '', true);
// $CODIGOLECTOR = new CampoForm( 'col','CODIGOLECTOR', 'text', 'CODIGO', Array(),'',true);
// $NACIMIENTO = new CampoForm( 'col','NACIMIENTO', 'date', 'NACIMIENTO', Array(), '');
// $Fila1= new FilaForm($APELLIDOS);
// $Fila2= new FilaForm($NOMBRE);
// $Fila3= new FilaForm($CODIGOLECTOR,3);
// $Fila3->addCol($FECHAALTA,3);
// $Fila3->addCol($NACIMIENTO,3);
// $Fila3->addCol($CURSO,3);

// $Miform = new Form('editalector', 'tabla.php?action=add', 'sm', 'oxb');
// echo $Miform->addFilas($Fila1);
// echo $Miform->addFilas($Fila2);
// echo $Miform->addFilas($Fila3);

// $body = $Miform->getForm();

// $Card->setCard($body);
// echo $Card->getCard();


?>
