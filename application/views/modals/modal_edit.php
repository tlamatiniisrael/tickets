<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="ui modal" id="edit">
  
  <div class="header">Editar usuario:</div>
  <div class="content">
          <?= form_open('users/updateData', array('class' => 'add-user-form mt-xxs-10 mb-xxs-10', 'id' => 'formulario-update', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
            <?= form_input(array('id' => 'id', 'type'  => 'hidden','name'  => 'id'));?>
            <div class="form-group text-left">
                <?= form_label("Usuario","usuario", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'usuario', 'type'  => 'text','class'  => 'form-control required','name'  => 'usuario', 'placeholder'  => 'Usuario'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Contraseña","pass", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'pass', 'type'  => 'password','class'  => 'form-control pass-update','name'  => 'pass', 'placeholder'  => 'Contraseña'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Repetir contraseña","pass2", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'pass2', 'type'  => 'password','class'  => 'form-control','name'  => 'pass2', 'placeholder'  => 'Repite la contraseña'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Email","mail", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'mail', 'type'  => 'text','class'  => 'form-control required','name'  => 'mail', 'placeholder'  => 'Email'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Perfil","perfil", array('class' => 'text-negro'));?>
                <?= form_dropdown('perfil', $perfil, "", array('id' => 'perfil', 'class' => 'form-control')); ?>
            </div>
            <?= form_close();?>
  </div>
  <div class="actions">
    <div class="ui negative button">Cancelar </div>
    <button class="ui green right labeled icon button save-edit" type="submit">Guardar <i class="checkmark icon"></i> </button>
  </div>
</div>

<div class="ui modal" id="solventacion-modal">
  
  <div class="header">Solventar ticket:</div>
  <div class="content">
          <?= form_open('asign/updateSolventar', array('class' => 'solventacion-form mt-xxs-10 mb-xxs-10', 'id' => 'formulario', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
            <?= form_input(array('id' => 'id', 'type'  => 'hidden','name'  => 'id'));?>
            <div class="form-group text-left">
                <?= form_label("Solventación","solventacion", array('class' => 'text-negro'));?>
                <?= form_dropdown('solventacion', $solventacion, "", array('id' => 'solventacion', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group text-left">
              <?= form_label("Revisión","revision", array('class' => 'text-negro'));?>
              <?= form_textarea(array('id' => 'revision', 'class'  => 'form-control','name'  => 'revision', 'rows' => '5'));?>
            </div>
            <?= form_close();?>
  </div>
  <div class="actions">
    <div class="ui negative button">Cancelar </div>
    <button class="ui green right labeled icon button save-solventacion" type="submit">Guardar <i class="checkmark icon"></i> </button>
  </div>
</div>