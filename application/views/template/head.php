<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE HTML>
<html lang="es-mx">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css')?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap-theme.css')?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/semantic/dist/semantic.min.css')?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/plugins/datatables.min.css')?>"/>
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css')?>">
		<script type="text/javascript" src="<?= base_url('assets/js/plugins/jquery.min.js')?>"></script>
		
		<title>Mesa de Ayuda</title>
	</head>
	<body>
<?php 
	$sessionUser 	= $this->session->userdata('usuario');
	$sessionName 	= $this->session->userdata('nombre');
	$sessionRol 	= $this->session->userdata('rol');
	$sessionAct 	= $this->session->userdata('activo');
?>