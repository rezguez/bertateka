<?php $charset='ISO-8859-1';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"   "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php echo $charset; ?>">
<!--   <meta charset="ISO-8859-1"> -->
<!-- <meta charset="UTF-8"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Bertateka</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Font Fontdinner Swamky -->
  <link href="https://fonts.googleapis.com/css?family=Fontdiner+Swanky&display=swap" rel="stylesheet"> 
  <!-- Font Quicksand -->
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet"> 
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- MDBootstrap Datatables  -->
<link href="css/datatables.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
<link href="css/open-iconic-bootstrap.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
<link rel="stylesheet" media="all" href="css/berta.css">
  <!-- Your custom styles (optional) -->
<link rel="stylesheet" media="all" href="css/berta2.css">
</head>

<!-- ************ BODY INICIO *************-->
<body>

<!-- ************ Inicio MENU NAVEGACION *************--> 

<input type='checkbox' id='menu' />
<label for='menu' class='menu'>
	<span></span>
	<span></span>
	<span></span>
</label>
<nav class='mynav' style='background-color:#584D46'>
	<ul>
		
<?php 
echo "<li><a href='index.php' onclick=".chr(34)."despedida('$st_consulta')". chr(34).">Consulta</a></li>";
echo "<li><a href='stats.php' onclick=".chr(34)."despedida('$st_stats')". chr(34).">Estadísticas</a></li>";

?>
</ul>		
</nav>
<!-- ************ Fin MENU NAVEGACION *************-->