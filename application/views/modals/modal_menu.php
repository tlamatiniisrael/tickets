<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="ui basic modal" id="menu">
  <div class="ui icon header">
    <i class="user icon"></i>
    ¿Qué desea hacer?
  </div>
  <div class="content text-center">
    <p>Selecciones alguna de las siguientes opciones</p>
  </div>
  <div class="actions">
    <div class="four wide column ui green ok inverted button" id="actionEdit">
      <i class="edit icon hidden-xs"></i>
      <span >Editar</span>
    </div>
    <div class="four wide column ui red ok inverted button" id="actionRemove">
      <i class="remove user icon hidden-xs"></i>
      <span >Eliminar</span>
    </div>
    <div class="four wide column ui yellow cancel inverted button">
      <i class="undo icon hidden-xs"></i>
      <span >Salir</span>
    </div>
  </div>
</div>