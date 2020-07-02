// Variables globales
nivel = parseInt(document.getElementById("nivel").innerHTML);
tiempo = parseInt(document.getElementById("tiempo").innerHTML);
palabras = parseInt(document.getElementById("palabras").innerHTML);
maxaciertos = parseInt(document.getElementById("aciertos").innerHTML);

a=new AudioContext(); // browsers limit the number of concurrent audio contexts, so you better re-use'em
var cuentapalabras = 0;

// Arranca el cronómetro si la opción no es cero
if (tiempo!== 0) {
	$(function() {	cuentatiempo(); });
}
else document.getElementById("reloj").classList.add('invisible');

//Cronómetro
function cuentatiempo()
{

	contador_s =0;
	contador_m =0;
	s = document.getElementById("segundos");
	m = document.getElementById("minutos");

	cronometro = setInterval(
		function(){
			if(contador_s==60)
			{
				contador_s=0;
				contador_m++;
				m.innerHTML = contador_m + ' m';

				if(contador_m==tiempo)
				{
					contador_m=0;
					finturno();
					
				}
			}

			s.innerHTML = contador_s + ' s';
			contador_s++;

		}
		,1000);

}

function repetir(){
	cuentapalabras = 0;

	document.getElementById('acumulado').innerHTML='';
	document.getElementById('idcontador').innerHTML='0';
	document.getElementById('idaciertos').innerHTML='0';
	document.getElementById('iderrores').innerHTML='0';
	document.getElementById('tecleado').focus();
	document.getElementById('minutos').innerHTML='0 m';
	document.getElementById('segundos').innerHTML='0 s';
	clearInterval(cronometro);
		if (tiempo != 0) {
			$(function() {	cuentatiempo(); });
		};
}

function beep(vol, freq, duration){
  v=a.createOscillator()
  u=a.createGain()
  v.connect(u)
  v.frequency.value=freq
  v.type="square"
  u.connect(a.destination)
  u.gain.value=vol*0.01
  v.start(a.currentTime)
  v.stop(a.currentTime+duration*0.001)
}

//Espera milisegundos
function sleep(ms) {
	  return new Promise(resolve => setTimeout(resolve, ms));
}

function sinacentos(str){
	str = str.replace('Á','A');
	str = str.replace('É','E');
	str = str.replace('Í','I');
	str = str.replace('Ó','O');
	str = str.replace('Ú','U');
	return str;
}

function finturno(){
	var x1 = document.getElementById('idcontador').innerHTML;
	var x2 = document.getElementById('idaciertos').innerHTML;
	var x3 = document.getElementById('iderrores').innerHTML;
	var marcador = "<ul class='list-group'>	<li class='list-group-item'>Intentos<span id='idcontador'	class='badge badge-sm badge-primary ml-2 p-2' style='font-size: 1.2rem; font-weight: 700;'>" + x1 
	+ "</span></li>	<li class='list-group-item'>Aciertos<span id='idaciertos'	class='badge badge-sm badge-success ml-2 p-2' style='font-size: 1.2rem; font-weight: 700;'>" + x2 
	+ "</span></li>	<li class='list-group-item'>Errores<span id='iderrores'	class='badge badge-sm badge-danger ml-2 p-2' style='font-size: 1.2rem; font-weight: 700;'>" + x3 
	+ "</span>	</li></ul> <ul class='list-group'>  <li class='list-group-item'>Nivel:<span class='marca badge-dark badge-pill' id='nivel'>" + nivel 
	+ "</span>	</li><li class='list-group-item'>Min:	<span class='marca badge-dark badge-pill' id='tiempo'>" + tiempo 
	+ "</span>	</li><li class='list-group-item'>Palabras:<span class='marca badge-dark badge-pill' id='palabras'>" + palabras 
	+ "</span>	</li><li class='list-group-item'>Aciertos:<span class='marca badge-dark badge-pill' id='aciertos'>" + maxaciertos 
	+ "</span>	</li></ul>";
document.getElementById('despedir-body').innerHTML=marcador;
	$('#despedir').modal('show');
}


