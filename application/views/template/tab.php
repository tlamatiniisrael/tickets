<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$window = json_decode($tab);
$tab 	= $window->tab;
switch ($tab) {
	case 'home':
?>
	<div class="ui green five item menu non-margin-tb notes-tab" style="display:none;">
		<a id="back-tab" class="item tab back-ticket"><i class="long arrow left icon"></i><span class="hidden-xs">Regresar</span></a>
	  	<a id="peticion-tab" class="item tab active"><i class="plus square outline icon"></i> <span class="hidden-xs">Petición</span> </a>
	  	<a id="notas-tab" class="item tab"><i class="file text outline icon"></i> <span class="hidden-xs">Notas</span> </a>
	  	<a id="adjuntos-tab" class="item tab"><i class="folder outline icon"></i> <span class="hidden-xs">Adjuntos</span> </a>
	  	<a id="historial-tab" class="item tab"><i class="history icon"></i> <span class="hidden-xs">Historial</span> </a>
	</div>
<?php
		break;
	case 'addUser':
?>
	<div class="ui green two item menu non-margin-tb">
	  <a id="show" class="item tab active"><i class="ordered list icon"></i> Mostrar </a>
	  <a id="add" class="item tab"><i class="add user icon"></i> Agregar </a>
	</div>
<?php
		break;
	default:
?>

<?php
		break;
}
?>
