<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$window = json_decode($tab);
$tab 	= $window->tab;
?>
<div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center fixed index-9999">
	<div class="row">
		<div class="ui positive message show-none">
			<div class="header">¡Correcto!</div>
				<p class="alert-msg"></p>
		</div>
	</div>
</div>
<div class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center fixed index-9999">
	<div class="row">
		<div class="ui error message show-none">
		  	<div class="header">¡Error!</div>
		  	<p class="alert-msg"></p>
		</div>
	</div>
</div>
<?php
switch ($tab) {
	case 'login':
?>
		<main class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4 text-center vertical-align">
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
					<img class="login nav-logo" id="logo-login" src="<?= base_url('assets/images/login-logo.png'); ?>">
				</div>
			</div>
			<?= form_open('login/startSession', array('class' => 'login-form', 'id' => 'formulario', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
				<div class="form-group text-left">
	                <?= form_label("Usuario","user", array('class' => 'text-negro'));?>
	                <?= form_input(array('id' => 'user', 'type'  => 'text','class'  => 'form-control required','name'  => 'user', 'placeholder'  => 'Usuario'));?>
	            </div>
	            <div class="form-group text-left">
	                <?= form_label("Contraseña","contrasena", array('class' => 'text-negro'));?>
	                <?= form_input(array('id' => 'contrasena', 'type'  => 'password','class'  => 'form-control required','name'  => 'contrasena', 'placeholder'  => 'Contraseña'));?>
	            </div>
	            <button type="submit" class="mt-15 btn btn-windows">
	                <i class="glyphicon glyphicon-ok"></i> Iniciar Sesión
	            </button>
	       	<?= form_close();?>
		</main>
<?php
		break;
		case 'home':
		$sessionRol 	= $this->session->userdata('rol');
?>
		<main id="table-content" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center mt-xxs-20 mb-xxs-40 mt-xs-20 mb-xs-40 mt-sm-20 mb-sm-40 mt-sm-20 mb-sm-40 home">
		<table id="user_table" class="display data-table" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th class="visible-xs visible-sm visible-md visible-lg">No.</th>
	                <th class="visible-sm visible-md visible-lg">Registro</th>
	                <th class="visible-sm visible-md visible-lg">Reportó</th>
	                <th class="visible-sm visible-md visible-lg">Estado</th>
	                <th class="visible-sm visible-md visible-lg">Sumario</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?php
	        if($tickets){
				foreach ($tickets->result() as $ticket) {
				?>
		            <tr class="ticket-field" data-id="<?=$ticket->ticket_id?>">
		                <th class="visible-xs visible-sm visible-md visible-lg"><?=$ticket->ticket_id?></th>
		                <th class="visible-sm visible-md visible-lg"><?=$ticket->fecha_registro?></th>
		                <th class="visible-sm visible-md visible-lg capitalize-case"><?=$ticket->usuario?></th>
		                <th class="visible-sm visible-md visible-lg capitalize-case"><?=$ticket->estado?></th>
		                <th class="visible-sm visible-md visible-lg"><?=$ticket->sumario?></th>

		            </tr>
		        <?php
		        }
		    }
			?>
	        </tbody>
    	</table>
	</main>
	<main class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center vertical-align-ms show-none detail-ticket mb-xs-40 mb-xxs-40" id="ticket-preview">
		<?php
		if($sessionRol != "2"){
		?>
		<div class="ui accordion mt-xxs-10 mb-xxs-10  mt-xs-10 mb-xs-10 mt-sm-10 mb-sm-10 mt-md-10 mb-md-10 mt-lg-10 mb-lg-10">
		  	<div class="active title text-left">
		    	<i class="dropdown icon"></i>
		    	Reportes
		  	</div>
		  	<div class="active content">
		  		<div class="row">
		  			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-xxs-10 mb-xxs-10 mt-xs-10 mb-xs-10 mt-sm-10 mb-sm-10 text-left">
		  				<div class="ui large buttons">
					  		<a href="javascript:void(0)" class="ui button primary-gem " id="reporte-sql" data-name="reporte-sql" role="button">
                				<i class="glyphicon glyphicon-check"></i> SQL
            				</a>
					  		<div class="or"></div>
						  	<a href="javascript:void(0)" class="ui button secondary-gem txt-blanco" id="reporte-revision" data-name="	reporte-revision" role="button">
                				<i class="glyphicon glyphicon-check"></i> Revisiones
            				</a>
						</div>
					</div>
		  		</div>
		  	</div>
		</div>
		<?php
		}
		?>
		<div class="panel panel-card">
		  	<div class="panel-heading secondary-gem txt-blanco bold">Datos del Ticket</div>
		  	<div class="panel-body padding-only-lr">
		  		<div class="row">
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Ticket:
		  			</div>
					<div class="col-xs-12 visible-xs card-body">
		  				<span class="ticket-card-id" data-id="">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Categoría:
		  			</div>
		  			<div class="col-xs-12 visible-xs card-body">
		  				<span class="ticket-card-category">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Fecha Registro:
		  			</div>
		  			<div class="col-xs-12 visible-xs card-body">
		  				<span class="ticket-card-registro">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Solventación:
		  			</div>
		  			<div class="col-xs-12 visible-xs card-body push-solv" data-id="">
		  				<span class="ticket-card-solv">&nbsp;</span>
		  			</div>
		  		</div>
		  		<div class="row hidden-xs">
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span class="ticket-card-id">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span class="ticket-card-category">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span class="ticket-card-registro">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body push-solv">
		  				<span class="ticket-card-solv">&nbsp;</span>
		  				<div class="button-solv">
		  					<button class="mini circular ui icon button">
								<i class="icon exchange"></i>
							</button>
		  				</div>
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Reportado por:
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span id="ticket-card-report" class=" capitalize-case">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Asignado a:
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span id="ticket-card-asign" class=" capitalize-case">&nbsp;</span>
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Prioridad:
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span id="ticket-card-priority">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Estado:
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-body">
		  				<span id="ticket-card-state">&nbsp;</span>
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Sumario:
		  			</div>
		  			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 card-body">
		  				<span id="ticket-card-summary">&nbsp;</span>
		  			</div>
		  			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 card-header">
		  				Descripción:
		  			</div>
		  			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 card-body">
		  				<span id="ticket-card-description">&nbsp;</span>
		  			</div>
		  		</div>
		  	</div>
		</div>
		<div class="ui tabular menu inicio">
			<?php
			switch ($sessionRol) {
				case '1':
					?>
					<div class="active item pointer" data-tab="tab-nota"><i class="icon sticky note outline"></i><span class="hidden-xs">Nota</span></div>
		  			<div class="item pointer" data-tab="tab-estado"><i class="icon info"></i><span class="hidden-xs">Estado</span></div>
		  			<div class="item pointer" data-tab="tab-tecnico"><i class="icon spy"></i><span class="hidden-xs">Técnico</span></div>
		  			<div class="item pointer" data-tab="tab-archivo"><i class="icon attach"></i><span class="hidden-xs">Archivo</span></div>
		  			<div class="item pointer" data-tab="tab-sql"><i class="icon database"></i><span class="hidden-xs">SQL</span></div>
		  			<div class="item pointer" data-tab="tab-revision"><i class="icon edit"></i><span class="hidden-xs">Revisión</span></div>
		  			<div class="item pointer" data-tab="tab-ambiente"><i class="icon code"></i><span class="hidden-xs">Ambiente</span></div>
					<?php
					break;
				case '2':
					?>
					<div class="active item pointer" data-tab="tab-nota"><i class="icon sticky note outline"></i><span class="hidden-xs">Nota</span></div>
		  			<div class="item pointer" data-tab="tab-archivo"><i class="icon attach"></i><span class="hidden-xs">Archivo</span></div>
					<?php
					break;
				case '3':
					?>
					<div class="active item pointer" data-tab="tab-nota"><i class="icon sticky note outline"></i><span class="hidden-xs">Nota</span></div>
					<div class="item pointer" data-tab="tab-estado"><i class="icon info"></i><span class="hidden-xs">Estado</span></div>
		  			<div class="item pointer" data-tab="tab-archivo"><i class="icon attach"></i><span class="hidden-xs">Archivo</span></div>
		  			<div class="item pointer" data-tab="tab-sql"><i class="icon database"></i><span class="hidden-xs">SQL</span></div>
		  			<div class="item pointer" data-tab="tab-revision"><i class="icon edit"></i><span class="hidden-xs">Revisión</span></div>
					<?php
					break;
				default:
					?>

					<?php
					break;
			}
			?>
		</div>
		<div class="ui bottom attached active tab segment" data-tab="tab-nota">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open('', array('id' => 'nota-form', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
					<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
					<div class="form-group text-left">
		                <?= form_label("Nota","nota", array('class' => 'text-negro'));?>
		                <?= form_textarea(array('id' => 'nota', 'class'  => 'form-control','name'  => 'nota', 'rows' => '5'));?>
		            </div>
		            <button type="submit" class="mt-15 btn btn-success">
                		<i class="glyphicon glyphicon-check"></i> Enviar Nota
            		</button>
		            <?= form_close();?>
				</div>
		  	</div>
		</div>
		<div class="ui bottom attached tab segment" data-tab="tab-archivo">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open_multipart('asign/uploadFile', array('id' => 'adjunto-form')); ?>
					<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
						<div class="form-group text-left">
							<?= form_label("Archivo","userfile", array('class' => 'text-negro'));?>
							<div class="input-group">
				                <label class="input-group-btn">
				                    <span class="btn btn-primary">
				                        Elige&hellip; <input id="userfile" name="userfile" type="file" style="display: none;">
				                    </span>
				                </label>
				                <input type="text" class="form-control" readonly>
				            </div>
				            <span class="help-block">
				                Selecciona un archivo para enviar
				            </span>
			            </div>
			            <button type="submit" class="mt-15 btn btn-success">
                			<i class="glyphicon glyphicon-check"></i> Enviar Archivo
            			</button>
			        <?= form_close();?>
				</div>	
		  	</div>
		</div>
		<div class="ui bottom attached tab segment" data-tab="tab-estado">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open('', array('id' => 'estado-form', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
						<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
						<div class="form-group text-left">
					        <?= form_label("Estado","estado", array('class' => 'text-negro'));?>
					        <?= form_dropdown('estado', $estados, "", array('id' => 'estado', 'class' => 'form-control')); ?>
					    </div>
					    <button type="submit" class="mt-15 btn btn-success">
		                	<i class="glyphicon glyphicon-check"></i> Enviar Estado
		            	</button>
					<?= form_close();?>
				</div>
		  	</div>
		</div>
		<div class="ui bottom attached tab segment" data-tab="tab-tecnico">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open('', array('id' => 'tecnicos-form', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
					<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
						<div class="form-group text-left">
							<?= form_label("Asignar técnico","asignar", array('class' => 'text-negro'));?>
							<?= form_dropdown('asignar', $tecnicos, "", array('id' => 'asignar', 'class' => 'form-control')); ?>
			            </div>
			            <button type="submit" class="mt-15 btn btn-success">
                			<i class="glyphicon glyphicon-check"></i> Asignar Técnico
            			</button>
					<?= form_close();?>
				</div>
		  	</div>
		</div>
		<div class="ui bottom attached tab segment" data-tab="tab-sql">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open('', array('id' => 'sql-form', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
						<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
						<div class="form-group text-left">
			            	<?= form_label("SQL","sql", array('class' => 'text-negro'));?>
			            	<?= form_textarea(array('id' => 'sql', 'class'  => 'form-control','name'  => 'sql', 'rows' => '5'));?>
			        	</div>
			        	<button type="submit" class="mt-15 btn btn-success">
	                		<i class="glyphicon glyphicon-check"></i> Enviar SQL
	           			</button>
			        <?= form_close();?>
				</div>
		  	</div>
		</div>
		<div class="ui bottom attached tab segment" data-tab="tab-revision">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open('', array('id' => 'revision-form', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
						<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
						<div class="form-group text-left">
		                	<?= form_label("Revisión","revision", array('class' => 'text-negro'));?>
		                	<?= form_textarea(array('id' => 'revision', 'class'  => 'form-control','name'  => 'revision', 'rows' => '5'));?>
		            	</div>
		            	<button type="submit" class="mt-15 btn btn-success">
                			<i class="glyphicon glyphicon-check"></i> Enviar Revisión
            			</button>
		            <?= form_close();?>
				</div>
		  	</div>
		</div>
		<div class="ui bottom attached tab segment" data-tab="tab-ambiente">
		  	<div class="row">
		  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?= form_open('', array('id' => 'ambiente-form', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
						<?= form_input(array('id' => 'ticket', 'type'  => 'hidden','name'  => 'ticket','class' => 'ticket non-active'));?>
						<div class="form-group text-left">
					        <?= form_label("Ambiente","ambiente", array('class' => 'text-negro'));?>
					        <?= form_dropdown('ambiente', $ambiente, "", array('id' => 'ambiente', 'class' => 'form-control')); ?>
					    </div>
					    <button type="submit" class="mt-15 btn btn-success">
		                	<i class="glyphicon glyphicon-check"></i> Enviar petición
		            	</button>
					<?= form_close();?>
				</div>
		  	</div>
		</div>
	</main>
	<main id="table-notes" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center mt-xxs-20 mb-xxs-40 mt-xs-20 mb-xs-40 mt-sm-20 mb-sm-40 mt-sm-20 mb-sm-40 show-none detail-ticket">
		
	</main>
	<main id="table-adjuntos" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center mt-xxs-20 mb-xxs-40 mt-xs-20 mb-xs-40 mt-sm-20 mb-sm-40 mt-sm-20 mb-sm-40 show-none detail-ticket">
	</main>
	<main id="table-history" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center mt-xxs-20 mb-xxs-40 mt-xs-20 mb-xs-40 mt-sm-20 mb-sm-40 mt-sm-20 mb-sm-40 show-none detail-ticket">
	</main>
<?php
		break;
	case 'ticket':
?>
	<main class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center vertical-align">
		<?= form_open_multipart('tickets/insertData', array('class' => 'ticket-form mt-xxs-10 mb-xxs-10', 'id' => 'formulario', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
			<div class="form-group text-left">
                <?= form_label("Número de control de cambios","codigo", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'codigo', 'type'  => 'text','class'  => 'form-control required','name'  => 'codigo', 'placeholder'  => 'Número de control de cambios'));?>
            </div>
            <div class="form-group text-center">
	            <label class="checkbox-inline"><input type="checkbox" name="archivo" value="1">Archivo</label>
				<label class="checkbox-inline"><input type="checkbox" name="base-datos" value="2">Base de Datos</label>
				<label class="checkbox-inline"><input type="checkbox" name="aplicativo" value="4">Aplicativo</label>
			</div>
			<div class="form-group text-left">
                <?= form_label("Categoría","categoria", array('class' => 'text-negro'));?>
                <?= form_dropdown('categoria', $categorias, "", array('id' => 'categoria', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Prioridad","proridad", array('class' => 'text-negro'));?>
                <?= form_dropdown('proridad', $prioridad, "", array('id' => 'proridad', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Sumario","sumario", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'sumario', 'type'  => 'text','class'  => 'form-control required','name'  => 'sumario', 'placeholder'  => 'Sumario'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Descripción","descripcion", array('class' => 'text-negro'));?>
                <?= form_textarea(array('id' => 'descripcion', 'class'  => 'form-control','name'  => 'descripcion', 'rows' => '5', 'placeholder'  => 'Descripción'));?>
            </div>
            <div class="form-group text-left">
				<?= form_label("Archivo","userfile", array('class' => 'text-negro'));?>
				<div class="input-group">
				    <label class="input-group-btn">
				        <span class="btn btn-primary">
				            Elige&hellip; <input id="userfile" name="userfile" type="file" style="display: none;">
				        </span>
				    </label>
				    <input type="text" class="form-control" readonly>
				</div>
				<span class="help-block">
				    Selecciona un archivo para enviar
				</span>
			</div>
            <button type="submit" class="mt-15 btn btn-windows">
                <i class="glyphicon glyphicon-check"></i> Enviar
            </button>
       	<?= form_close();?>
	</main>
<?php
		break;
	case 'addUser':
?>
	<main id="table-content" class="col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center mt-xxs-20 mb-xxs-40 mt-xs-20 mb-xs-40 mt-sm-20 mb-sm-40 mt-sm-20 mb-sm-40">
		<table id="user_table" class="display data-table" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th class="visible-xs visible-sm visible-md visible-lg">Usuario</th>
	                <th class="visible-sm visible-md visible-lg">Email</th>
	                <th class="visible-sm visible-md visible-lg">Perfil</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?php
	        if($usuarios){
				foreach ($usuarios->result() as $usuario) {
				?>
		            <tr class="option-field" data-id="<?=$usuario->usuario_id?>">
		                <th class="visible-xs visible-sm visible-md visible-lg"><?=$usuario->usuario?></th>
		                <th class="visible-sm visible-md visible-lg"><?=$usuario->email?></th>
		                <th class="visible-sm visible-md visible-lg"><?=$usuario->perfil?></th>
		            </tr>
		        <?php
		        }
		    }
			?>
	        </tbody>
    	</table>
	</main>
	<main id="form-content" class="show-none col-xs-offset-1 col-xs-10 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 text-center mt-sm-110 mb-sm-70 vertical-align-ms">
		<?= form_open('trade/datosRegistro', array('class' => 'add-user-form mt-xxs-10 mb-xxs-10', 'id' => 'formulario', 'data-toggle' => "validator", 'autocomplete' => 'off')); ?>
			<div class="form-group text-left">
                <?= form_label("Usuario","usuario", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'usuario', 'type'  => 'text','class'  => 'form-control required','name'  => 'usuario', 'placeholder'  => 'Usuario', 'maxlength' => '15'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Contraseña","pass", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'pass', 'type'  => 'password','class'  => 'form-control required pass-insert','name'  => 'pass', 'placeholder'  => 'Contraseña'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Repetir contraseña","pass2", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'pass2', 'type'  => 'password','class'  => 'form-control required','name'  => 'pass2', 'placeholder'  => 'Repite la contraseña'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Email","mail", array('class' => 'text-negro'));?>
                <?= form_input(array('id' => 'mail', 'type'  => 'text','class'  => 'form-control required','name'  => 'mail', 'placeholder'  => 'Email'));?>
            </div>
            <div class="form-group text-left">
                <?= form_label("Perfil","perfil", array('class' => 'text-negro'));?>
                <?= form_dropdown('perfil', $perfil, "", array('id' => 'perfil', 'class' => 'form-control')); ?>
            </div>
            
            <button type="submit" class="mt-15 btn btn-windows">
                <i class="glyphicon glyphicon-check"></i> Enviar Usuario
            </button>
       	<?= form_close();?>
	</main>
	<script type="text/javascript">
		
	</script>
<?php
		break;
	case 'about':
			?>
			<!--Aqui-->
			<img class="img-about" src="<?= base_url('assets/images/logo.png'); ?>">
			<div class="about-xxs-container about-xs-container about-sm-container about-md-container about-lg-container">
				<table class="about-xxs about-xs about-sm about-md about-lg">
					<tr>
						<td>
							<p>
								Plataforma independiente basada en web para generar tickets de petición y respuesta a problemas derivados y competentes a la Dirección de Desarrollo de Sistemas e Informática de la Dirección General de Recaudación.	
							</p>
						</td>
					</tr>
				</table>
			</div>
			<footer>
				<p>Compatible con:</p>
				<div>
					<i title="Internet Explorer" class="icon internet explorer"></i>
					<i title="Mozilla Firefox" class="icon firefox"></i>
					<i title="Safari" class="icon safari"></i>
					<i title="Google Chrome" class="icon chrome"></i>
				</div>
			</footer> 
			<!--Aqui-->
			<?php
		break;
	default:
		echo "default";
		break;
}
?>