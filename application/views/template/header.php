<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$window = json_decode($tab);
$tab 	= $window->tab;
switch ($tab) {
	case 'login':
		break;
	default:
?>
	<!-- Navigation bar  -->
	<nav class="navbar navbar-default non-margin-b">
	  <div class="container-fluid">
	    <div class="navbar-header">
	    	<button class="mini ui button content icon" onclick="$('.sidebar').sidebar('toggle')"><i class="content icon"></i></button>
	    	<img class="nav-logo ml-lg-15" src="<?= base_url('assets/images/edomex-logo.png'); ?>">
	    </div>
	    <ul class="nav navbar-nav navbar-right hidden-xs">
	      <li class="capitalize-case"><a href="#"><span class="glyphicon glyphicon-user"></span>  <?=$this->session->userdata('nombre');?> </a></li>
	    </ul>
	  </div>
	</nav>
	<?php
	$tabHome 	= "";
	$tabTicket 	= "";
	$tabAddUser = "";
	$tabProfile = "";
	$tabAbout 	= "";
	switch ($tab) {
	case 'login':
		break;
	case 'home':
		$tabHome 	= "active";
		break;
	case 'ticket':
		$tabTicket 	= "active";
		break;
	case 'addUser':
		$tabAddUser = "active";
		break;
	case 'profile':
		$tabProfile = "active";
		break;
	case 'about':
		$tabAbout 	= "active";
		break;
	}
	?>
	<!-- SideBar -->
	<div class="ui green vertical sidebar menu">
	  <a href="<?=base_url();?>/index.php/welcome/home" class="<?=$tabHome?> item">
	    <i class="home icon"></i>
	    <span>Inicio</span>
	  </a>
	  <a href="<?=base_url();?>/index.php/welcome/ticket" class="<?=$tabTicket?> item">
	    <i class="ticket icon"></i>
	    <span>Nuevo Ticket</span>
	  </a>
	  <a class="item" href="<?=base_url();?>/index.php/welcome/profile" class="<?=$tabProfile?> item">
	    <i class="user icon"></i>
	    <span>Mi cuenta</span>
	  </a>
	  <!--
	  <a class="item">
	    <i class="area chart icon"></i>
	    <span>Análisis</span>
	  </a>
	  -->
	  <?php
	  if($this->session->userdata('rol') == '1'){
	  ?>
	  <a href="<?=base_url();?>/index.php/welcome/addUser" class="<?=$tabAddUser?> item">
	    <i class="group icon"></i>
	    <span>Agregar Usuario</span>
	  </a>
	  <?php
	  }
	  ?>
	  <a href="<?=base_url();?>/index.php/welcome/about" class="<?=$tabAbout?> item">
	    <i class="info icon"></i>
	    <span>Acerca De</span>
	  </a>
	  <a href="<?=base_url();?>/index.php/login/closeSession" class="item">
	    <i class="chevron circle down icon"></i>
	    <span>Cerrar Sesión</span>
	  </a>
	</div>
<?php
		break;
}
?>	