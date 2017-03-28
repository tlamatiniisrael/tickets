$(document).ready(function(){
	//Centrar ventanas
	function verticalAlign(contenedor){
		var anchoVentana 	= $(document).height();
		var anchoContenedor	= $(contenedor).height();
		switch(contenedor){
			case ".vertical-align":
				if(anchoVentana-1 >= anchoContenedor){
					var margenArriba 	= (anchoVentana - anchoContenedor)/2;
					$(contenedor).css("margin-top",margenArriba)
				}else{
					$(contenedor).css("margin-top","40px")
					$(contenedor).css("margin-bottom","40px")
				}
				break;
			case "#form-content.vertical-align-ms":
				if(anchoVentana-1 >= anchoContenedor){
					var margenArriba 	= (anchoVentana - anchoContenedor)/2-46;
					$(contenedor).css("margin-top",margenArriba)
				}else{
					$(contenedor).css("margin-top","40px")
					$(contenedor).css("margin-bottom","40px")
				}
				break;
			case ".vertical-align-ms":
				if(anchoVentana-1 >= anchoContenedor){
					var margenArriba 	= (anchoVentana - anchoContenedor)/2-46;
					$(contenedor).css("margin-top",margenArriba)
				}else{
					$(contenedor).css("margin-top","40px")
					$(contenedor).css("margin-bottom","40px")
				}
				break;
			default:
				break;

		}
	}

	function alignContainers(){
		verticalAlign(".vertical-align");
		verticalAlign(".vertical-align-ms");
		verticalAlign("#form-content.vertical-align-ms");
	}
	
	//centrado vertical con resize
	$( window ).resize(function() {
		alignContainers();
	});
	//Inicializar centrado vertical
	alignContainers();


	// Control de tabs
	$(document).on("click", ".tab", function(){
		var id = $(this).attr("id");
		$(".tab").removeClass("active");
		$(this).addClass("active");
		switch(id){
			case "add":
				$("#form-content").show();
				$("#table-content").hide();
				break;
			case "show":
				$("#form-content").hide();
				$("#table-content").show();
				break;
			default:
				break;
		}
	});

	//Iniciar datatable
	var datatable;
	initTable('.data-table');
	
	function initTable(table){
		$(document).ready(function(){
		    datatable = $(table).DataTable({
		    	responsive: true,
		        "language": {
				    "sProcessing":     "Procesando...",
				    "sLengthMenu":     "Mostrar _MENU_ registros",
				    "sZeroRecords":    "No se encontraron resultados",
				    "sEmptyTable":     "Ningún dato disponible en esta tabla",
				    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				    "sInfoPostFix":    "",
				    "sSearch":         "Buscar:",
				    "sUrl":            "",
				    "sInfoThousands":  ",",
				    "sLoadingRecords": "Cargando...",
				    "oPaginate": {
				        "sFirst":    "Primero",
				        "sLast":     "Último",
				        "sNext":     "Siguiente",
				        "sPrevious": "Anterior"
				    },
				    "oAria": {
				        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
				    }
				}
		    });
		});
	}
	function destroyTable(){
		$(document).ready(function(){
		   datatable.destroy();
		});
	}

	//Abrir modal de opciones
	var selectRow;
	$(document).on("click", ".option-field", function(){
		var usuario = $(this).attr('data-id');
		selectRow 	= $(this);
		$('.ui.basic.modal#menu').modal('show');
		$('#actionEdit').attr('data-id', usuario);
		$('#actionRemove').attr('data-id', usuario);
	});
	$(document).on("click", "#actionEdit", function(){
		var usuario = $(this).attr('data-id');
		$('.ui.modal#edit').modal('show');
		
		$.ajax({
			type: "POST",
			url: base_url+"index.php/json/jsonUser",
			data: { user : usuario },
			success: function (success) {
			    //console.log(success);
			    json = jQuery.parseJSON(success);
			    if(json.status != "fail"){
			    	console.log(json[0]);
				    $('#formulario-update #id').val(json[0].usuario_id);
				    $('#formulario-update #usuario').val(json[0].usuario);
				    $('#formulario-update #mail').val(json[0].email);
				    $('#formulario-update #perfil').val(json[0].perfil_id);	
			    }
			}
		}); 
	});
	$(document).on("click", "#actionRemove", function(){
		var id = $(this).attr('data-id');
		console.log("activar modal remove");
		console.log(id);
		$('.ui.small.modal#delete')
		.modal('show');
		$('.button-accept').attr('data-id',id);
	});

	$(document).on("click", ".button-cancel", function(){
		$('.ui.small.modal#delete')
		.modal('hide');
	});

	$(document).on("click", ".button-accept", function(){
		var id 	= $(this).attr('data-id');
		$.ajax({
			type: "POST",
			url: base_url+"index.php/users/deleteData",
			data: {"usuario" : id},
			success: function (success) {
			    console.log(success);
			    json = jQuery.parseJSON(success);
			    // console.log(json);
			    switch(json.status){
			        case 'success':
			        	$(".alert-msg").text(json.msg);
			        	$(".positive.message").show().delay(5000).fadeOut();
			        	datatable
				        .row( selectRow )
				        .remove()
				        .draw();
			        	$('.ui.small.modal#delete')
						.modal('hide');
			            break;
			        case 'fail':
			            $(".alert-msg").text(json.msg);
			            $(".error.message").show().delay(5000).fadeOut();
			            break;
					default:
			            
			            break;
			    }
			}
		});  
	});
	// Input files
	// Tomamos el evento de todos los elementos file
	$(document).on('change', ':file', function() {
		console.log("Cambio");
	    var input = $(this),
	        numFiles = input.get(0).files ? input.get(0).files.length : 1,
	        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	    input.trigger('fileselect', [numFiles, label]);
	  });

	  // We can watch for our custom `fileselect` event like this
	  $(document).ready( function() {
	      $(':file').on('fileselect', function(event, numFiles, label) {

	          var input = $(this).parents('.input-group').find(':text'),
	              log = numFiles > 1 ? numFiles + ' files selected' : label;

	          if( input.length ) {
	              input.val(log);
	          } else {
	              if( log ) alert(log);
	          }

	      });
	  });

	// Formulario ticket
	// Valida formulario
		$(".login-form#formulario").validate({
		 	rules: {
		 		user: {
			      	required: true,
			    },
			    contrasena: {
			    	required: true,
			    }
		  	},
		  	messages: {
		  		user: {
			      	required: "El usuario no debe estar vacío",
			    },
			    contrasena: {
			    	required: "La contraseña no debe estar vacía",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		form.submit();
		  	}
		});


	// Formulario ticket
	// Valida formulario
		$(".ticket-form#formulario").validate({
		 	rules: {
		 		categoria: {
			      	required: true,
			    },
			    proridad: {
			    	required: true,
			    },
			    sumario: {
			      	required: true,
			    },
			    descripcion: {
			    	required: true,
			    }
		  	},
		  	messages: {
		  		categoria: {
			      	required: "Seleccione una categoría",
			    },
			    proridad: {
			    	required: "Seleccione un nivel de prioridad",
			    },
			    sumario: {
			      	required: "El campo Sumario es obligatorio",
			    },
			    descripcion: {
			    	required: "El campo Descripción es obligatorio",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		var formData = new FormData();
		  		var formulario = $('form').serializeArray();
			    $.each(formulario,function(key,input){
			        formData.append(input.name,input.value);
			    });
			    formData.append('userfile', $('input[type=file]')[0].files[0]);
			    formData.append('descripcion',tinyMCE.activeEditor.getContent());
			    for (var pair of formData.entries()) {
    				console.log(pair[0]+ ', ' + pair[1]); 
				}
		  		$.ajax({
			        type 		: "POST",
			        url: base_url+"index.php/tickets/insertData",
			        data 		: formData,
			        mimeType 	: "multipart/form-data",
			        contentType : false,
			        processData : false,
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	// console.log(json);
			          	switch(json.status){
				            case 'success':
				            	$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("textarea").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
				            	break;
				            case 'fail':
				            	$(".alert-msg").text(json.msg);
				            	$(".error.message").show().delay(5000).fadeOut();
				            	break;
				            default:
				              	break;
			          	}
			        }
			    });  
		  	}
		});


	// Formulario add user
	// Validar formulario
	$(".add-user-form#formulario").validate({
		 	rules: {
		 		usuario: {
			      	required: true,
			      	remote: {
				        url: base_url+"index.php/users/checkUser",
				        type: "post",
				        data: 
				        {
				        	user: function(){ return $("#usuario").val(); }
				        }
				    }
			    },
			    pass: {
			    	required: true,
			    },
			    pass2: {
			    	equalTo: ".pass-insert"
			    },
			    mail: {
			    	required: true,
			    	email: true,
			    },
			    perfil: {
			    	required: true,
			    }
		  	},
		  	messages: {
		  		usuario: {
			    	required:"El campo Usuario no puede estar vacío",
			    	remote:"Usuario repetido",
			    },
			    pass: {
			    	required:"El campo Contraseña no puede estar vacío"
			    },
			    pass2: {
			    	equalTo:"Las contraseñas no coinciden"
			    },
			    mail: {
			    	required:"El campo Email no puede estar vacío",
			    	email:"Formato de email invalido",
			    },
			    perfil: {
			    	required:"Seleccione un perfil",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log( $(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/users/insertData",
			        data: $(form).serialize(),
			        success: function (success) {
			        console.log(success);
			          json = jQuery.parseJSON(success);
			          // console.log(json);
			          switch(json.status){
			            case 'success':
			            	$(".alert-msg").text(json.msg);
			            	$(".alert.alert-success").show().delay(5000).fadeOut();
			            	$("input").not(".non-active").val('');
			            	$("select").val('');
			            	$("select option[value='']").attr("selected",true);
			            	var row = 	datatable.row.add( [
					            			json.usuario,
					            			json.email,
					            			json.perfil
				        				])
				        				.draw()
				        				.nodes()
    									.to$()
				        				.addClass('option-field')
				        				.attr("data-id",json.id_usuario);
				        	$( row ).find('td').eq(0).addClass('visible-xs visible-sm visible-md visible-lg');
				        	$( row ).find('td').eq(1).addClass('visible-sm visible-md visible-lg');
				        	$( row ).find('td').eq(2).addClass('visible-sm visible-md visible-lg');
			            	break;
			            case 'fail':
			            	$(".alert-msg").text(json.msg);
			            	$(".alert.alert-danger").show().delay(5000).fadeOut();
			            	break;
			            default:
			              break;
			          }
			        }
			    });  
		  	}
		});
		//Validar formulario update
		$( document ).on("click", ".save-edit", function(){
			$(".add-user-form#formulario-update").submit();
		});
		$(".add-user-form#formulario-update").validate({
		 	rules: {
		 		usuario: {
			      	required: true,
			      	remote: {
				        url: base_url+"index.php/users/checkUser",
				        type: "post",
				        data: 
				        {
				        	user: function(){ return $("#usuario").val(); }
				        }
				    }
			    },
			    pass2: {
			    	equalTo: ".pass-update"
			    },
			    mail: {
			    	required: true,
			    	email: true,
			    },
			    perfil: {
			    	required: true,
			    }
		  	},
		  	messages: {
		  		usuario: {
			    	required:"El campo Usuario no puede estar vacío",
			    	remote:"Usuario repetido",
			    },
			    pass2: {
			    	equalTo:"Las contraseñas no coinciden"
			    },
			    mail: {
			    	required:"El campo Email no puede estar vacío",
			    	email:"Formato de email invalido",
			    },
			    perfil: {
			    	required:"Seleccione un perfil",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/users/updateData",
			        data: $(form).serialize(),
			        success: function (success) {
			        console.log(success);
			          json = jQuery.parseJSON(success);
			          // console.log(json);
			          switch(json.status){
			            case 'success':
			            	$(".alert-msg").text(json.msg);
			            	$(".alert.alert-success").show().delay(5000).fadeOut();
			            	$("input").not(".non-active").val('');
			            	$("select").val('');
			            	$("select option[value='']").attr("selected",true);
			            	$('.ui.modal#edit').modal('hide');
			            	break;
			            case 'fail':
			            	$(".alert-msg").text(json.msg);
			            	$(".alert.alert-danger").show().delay(5000).fadeOut();
			            	break;
			            default:
			              break;
			          }
			        }
			    });  
		  	}
		});

		// Ventana home
		$(document).on("click", ".ticket-field", function(){
			var ticket = $(this).attr("data-id");
			$.ajax({
			    type: "POST",
			    url: base_url+"index.php/json/jsontickets",
			    data: { ticket : ticket },
			    success: function (success) {
			        // console.log(success);
			        json = jQuery.parseJSON(success);
			       	if(json.status != "fail"){
				    	var datos = json[0];
				    	$('.notes-tab').css('display', 'flex');
				    	$('#table-content.home').hide();
				    	$('#ticket-preview').show();
				    	var ticket_id 		= "&nbsp;";
				    	var categoria 		= "&nbsp;";
				    	var fecha_registro 	= "&nbsp;";
				    	var solventacion 	= "&nbsp;";
				    	var usuario 		= "&nbsp;";
				    	var asignado 		= "&nbsp;";
				    	var prioridad 		= "&nbsp;";
				    	var estado 			= "&nbsp;";
				    	var sumario 		= "&nbsp;";
				    	var descripcion 	= "&nbsp;";
				    	var code 			= "&nbsp;";
				    	var tipoCambio 		= 0;

				    	if(datos.ticket_id)
				    		ticket_id 		= datos.ticket_id;
				    	if(datos.categoria)
				    		categoria 		= datos.categoria;
				    	if(datos.fecha_registro)
				    		fecha_registro 	= datos.fecha_registro;
				    	if(datos.solventacion)
				    		solventacion 	= datos.solventacion;
				    	if(datos.usuario)
				    		usuario 		= datos.usuario;
				    	if(datos.asignado)
				    		asignado 		= datos.asignado;
				    	if(datos.prioridad)
				    		prioridad 		= datos.prioridad;
				    	if(datos.estado)
				    		estado 			= datos.estado;
				    	if(datos.sumario)
				    		sumario 		= datos.sumario;
				    	if(datos.descripcion)
				    		descripcion 	= datos.descripcion;
				    	if(datos.codigo)
				    		code 			= datos.codigo;
				    	if(datos.tipo_cambio_id)
				    		tipoCambio 		= datos.tipo_cambio_id;

				    	tipoCambio = (tipoCambio >>> 0).toString(2);

				    	if( tipoCambio[0] == 1)
				    		$('.ticket-card-change-type .checkbox-type[data-value="1"]').prop('checked', true);
				    	if( tipoCambio[1] == 1)
				    		$('.ticket-card-change-type .checkbox-type[data-value="2"]').prop('checked', true);
				    	if( tipoCambio[2] == 1)
				    		$('.ticket-card-change-type .checkbox-type[data-value="3"]').prop('checked', true);

					    $('#ticket-preview .ticket-card-id').html(ticket_id);
					    $('#ticket-preview .ticket-card-id').attr("data-id", ticket_id);
					    $('#ticket-preview .ticket-card-category').html(categoria);
					    $('#ticket-preview .ticket-card-registro').html(fecha_registro);
					    $('#ticket-preview .push-solv button').attr("data-id", ticket_id);
					    $('#ticket-preview .ticket-card-solv').html(solventacion);
					    $('#ticket-preview .ticket-card-code').html(code);
					    $('#ticket-preview #ticket-card-report').html(usuario);	
					    $('#ticket-preview #ticket-card-asign').html(asignado);	
					    $('#ticket-preview #ticket-card-priority').html(prioridad);	
					    $('#ticket-preview #ticket-card-state').html(estado);	
					    $('#ticket-preview #ticket-card-summary').html(sumario);	
					    $('#ticket-preview #ticket-card-description').html(descripcion);
					    $('.ticket').val(ticket_id);
					    $(".inicio .item").removeClass("active");
						$("[data-tab='tab-nota']").addClass("active");
					    alignContainers();

			    	}
			    },
			    complete: function(){
			    	$.ajax({
					    type: "POST",
					    url: base_url+"index.php/json/jsonTabCount",
					    data: { ticket : ticket },
					    success: function (success) {
					        json = jQuery.parseJSON(success)[0];
					       	if(json.status != "fail"){
							    $('#notas-tab .badge').text(json.conteo_notas);
							    $('#adjuntos-tab .badge').text(json.conteo_adjuntos);
							    $('#historial-tab .badge').text(json.conteo_historial);
					    	}
					    }
					});
			    }
			});
		});
		// Regresar de ticket a tabla tickets
		$(document).on("click", ".back-ticket", function(){
			$('.notes-tab').css('display', 'none');
			$('#table-content.home').show();
			$('.detail-ticket').hide();
			$(this).removeClass("active");
			$("#peticion-tab").addClass("active");
		});

		$(document).on("click", "#peticion-tab", function(){
			$('.detail-ticket').hide();
			$('#ticket-preview').show();
			$(".inicio .item").removeClass("active");
			$("[data-tab='tab-nota']").addClass("active");
		});

		$(document).on("click", "#notas-tab", function(){
			var ticket 	= $('#ticket-preview .ticket-card-id').attr("data-id");
			var table 	= '';
			var loop 	= '';
			$.ajax({
			    type: "POST",
			    url: base_url+"index.php/json/jsonNotes",
			    data: { ticket : ticket },
			    success: function (success) {
			        // console.log(success);
			        json = jQuery.parseJSON(success);
			       	if(json.status != "fail"){
				    	var conteo = json.length;
				    	for(var i = 0; i < conteo; i++){
				    		loop += '<tr class="notas-field" data-id="'+json[i].nota_id+'">';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].nota_id+'</th>';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].fecha_nota+'</th>';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].usuario+'</th>';
				    		loop += '	<th class="visible-xs visible-sm visible-md visible-lg">'+json[i].nota+'</th>';
				    		loop += '</tr>';
				    	}	
				    	table += '<table id="notes_table" class="display dinamyc-table" cellspacing="0" width="100%">';
				    	table += '	<thead>';
				    	table += '		<tr>';
				    	table += '			<th class="visible-sm visible-md visible-lg">id.</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Registro</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Reporto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Nota</th>';
				    	table += '		</tr>';
				    	table += '	</thead>';
				    	table += '	<tbody>';
				    	table += loop;
				    	table += '	</tbody>';
				    	table += '</table>';
				    	$('#table-notes').empty();
				    	$('#table-notes').html(table);
				    	initTable('.dinamyc-table#notes_table');
				    	$('.detail-ticket').hide();
						$('#table-notes').show();
			    	}else{
			    		table += '<table id="notes_table" class="display dinamyc-table" cellspacing="0" width="100%">';
				    	table += '	<thead>';
				    	table += '		<tr>';
				    	table += '			<th class="visible-sm visible-md visible-lg">id.</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Registro</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Reporto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Nota</th>';
				    	table += '		</tr>';
				    	table += '	</thead>';
				    	table += '	<tbody>';
				    	table += '	</tbody>';
				    	table += '</table>';
				    	$('#table-notes').empty();
				    	$('#table-notes').html(table);
				    	initTable('.dinamyc-table#notes_table');
				    	$('.detail-ticket').hide();
						$('#table-notes').show();
			    	}
			    }
			});
		});

		$(document).on("click", "#adjuntos-tab", function(){
			var ticket = $('#ticket-preview .ticket-card-id').attr("data-id");
			var table 	= '';
			var loop 	= '';
			$.ajax({
			    type: "POST",
			    url: base_url+"index.php/json/jsonAttached",
			    data: { ticket : ticket },
			    success: function (success) {
			        console.log(success);
			    	json = jQuery.parseJSON(success);
			       	if(json.status != "fail"){
				    	var conteo = json.length;
				    	for(var i = 0; i < conteo; i++){
				    		loop += '<tr class="adjuntos-field" data-id="'+json[i].archivo_ticket_id+'">';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].archivo_ticket_id+'</th>';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].fecha_archivo+'</th>';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].usuario+'</th>';
				    		loop += '	<th class="visible-xs visible-sm visible-md visible-lg">'+json[i].nombre_original+'</th>';
				    		loop += '	<th class="visible-xs visible-sm visible-md visible-lg">';
				    		loop += '		<a class="ui button" href="'+base_url+'assets/adjuntos/'+json[i].nombre+'" download="'+json[i].nombre_original+'"><i class="download icon non-margin"></i></a>';
				    		loop += '	</th>';
				    		loop += '</tr>';

				    	}	
				    	table += '<table id="adjuntos_table" class="display dinamyc-table" cellspacing="0" width="100%">';
				    	table += '	<thead>';
				    	table += '		<tr>';
				    	table += '			<th class="visible-sm visible-md visible-lg">id.</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Registro</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Reporto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Adjunto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Descargar</th>';
				    	table += '		</tr>';
				    	table += '	</thead>';
				    	table += '	<tbody>';
				    	table += loop;
				    	table += '	</tbody>';
				    	table += '</table>';
				    	$('#table-adjuntos').empty();
				    	$('#table-adjuntos').html(table);
				    	initTable('.dinamyc-table#adjuntos_table');
				    	$('.detail-ticket').hide();
						$('#table-adjuntos').show();
			    	}else{
			    		table += '<table id="adjuntos_table" class="display dinamyc-table" cellspacing="0" width="100%">';
				    	table += '	<thead>';
				    	table += '		<tr>';
				    	table += '			<th class="visible-sm visible-md visible-lg">id.</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Registro</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Reporto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Adjunto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Descargar</th>';
				    	table += '		</tr>';
				    	table += '	</thead>';
				    	table += '	<tbody>';
				    	table += '	</tbody>';
				    	table += '</table>';
				    	$('#table-adjuntos').empty();
				    	$('#table-adjuntos').html(table);
				    	initTable('.dinamyc-table#adjuntos_table');
				    	$('.detail-ticket').hide();
						$('#table-adjuntos').show();
			    	}
			    }
			});
		});

		$(document).on("click", "#historial-tab", function(){
			var ticket 	= $('#ticket-preview .ticket-card-id').attr("data-id");
			var table 	= '';
			var loop 	= '';
			$.ajax({
			    type: "POST",
			    url: base_url+"index.php/json/jsonHistory",
			    data: { ticket : ticket },
			    success: function (success) {
			        // console.log(success);
			        json = jQuery.parseJSON(success);
			       	if(json.status != "fail"){
				    	var conteo = json.length;
				    	for(var i = 0; i < conteo; i++){
				    		loop += '<tr class="history-field" data-id="'+json[i].historial_id+'">';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].historial_id+'</th>';
				    		loop += '	<th class="visible-sm visible-md visible-lg">'+json[i].fecha_movimiento+'</th>';
				    		loop += '	<th class="visible-xs visible-sm visible-md visible-lg">'+json[i].usuario+'</th>';
				    		loop += '	<th class="visible-xs visible-sm visible-md visible-lg">'+json[i].movimiento+'</th>';
				    		loop += '</tr>';
				    	}	
				    	table += '<table id="history_table" class="display dinamyc-table" cellspacing="0" width="100%">';
				    	table += '	<thead>';
				    	table += '		<tr>';
				    	table += '			<th class="visible-sm visible-md visible-lg">id.</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Registro</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Reporto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Nota</th>';
				    	table += '		</tr>';
				    	table += '	</thead>';
				    	table += '	<tbody>';
				    	table += loop;
				    	table += '	</tbody>';
				    	table += '</table>';
				    	$('#table-history').empty();
				    	$('#table-history').html(table);
				    	initTable('.dinamyc-table#history_table');
				    	$('.detail-ticket').hide();
						$('#table-history').show();
			    	}else{
			    		table += '<table id="history_table" class="display dinamyc-table" cellspacing="0" width="100%">';
				    	table += '	<thead>';
				    	table += '		<tr>';
				    	table += '			<th class="visible-sm visible-md visible-lg">id.</th>';
				    	table += '			<th class="visible-sm visible-md visible-lg">Registro</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Reporto</th>';
				    	table += '			<th class="visible-xs visible-sm visible-md visible-lg">Nota</th>';
				    	table += '		</tr>';
				    	table += '	</thead>';
				    	table += '	<tbody>';
				    	table += '	</tbody>';
				    	table += '</table>';
				    	$('#table-history').empty();
				    	$('#table-history').html(table);
				    	initTable('.dinamyc-table#history_table');
				    	$('.detail-ticket').hide();
						$('#table-history').show();
			    	}
			    }
			});
		});

		// Crear txt
		$( document ).on('click','#reporte-sql', function() {
			var name 	= $(this).attr('data-name');
			var id 		= $('#ticket-preview .ticket-card-id').attr('data-id');
        	var data 	= {'ticket' : id};
	        $.ajax({
	            type: "POST",
	            url: base_url+"index.php/txt/generateSQL",
	            data: data,
	            success: function(success) {
	            	// console.log(success);
	                $.generateFile({
						filename	: name+'-ticket-'+id+'.txt',
						content		: success,
						script		: base_url+'index.php/txt/download'
					});
	            }
	        });
	    });

	    $( document ).on('click','#reporte-revision', function() {
			var name 	= $(this).attr('data-name');
			var id 		= $('#ticket-preview .ticket-card-id').attr('data-id');
        	var data 	= {'ticket' : id};
	        $.ajax({
	            type: "POST",
	            url: base_url+"index.php/txt/generateRevision",
	            data: data,
	            success: function(success) {
	            	// console.log(success);
	                $.generateFile({
						filename	: name+'-ticket-'+id+'.txt',
						content		: success,
						script		: base_url+'index.php/txt/download'
					});
	            }
	        });
	    });


		// Formularios
		// 
		$("#nota-form").validate({
		 	rules: {
		 		nota: {
			      	required: true,
			    }
		  	},
		  	messages: {
		  		nota: {
			      	required: "El campo nota no puede estar vacío",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/insertNote",
			        data: $(form).serialize(),
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("textarea").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});


		$("#adjunto-form").validate({
		 	rules: {
		 		userfile :{
		 			required: true
		 		}
		  	},
		  	messages: {
		  		userfile :{
		 			required: "Debes enviar por lo menos un archivo"
		 		}
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
        		var formData = new FormData($('#adjunto-form')[0]);
    			
    			$.ajax({
			        type 		: "POST",
			        url 		: base_url+"index.php/asign/uploadFile",
			        data 		: formData,
			        mimeType 	: "multipart/form-data",
			        contentType : false,
			        processData : false,
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});

		$("#estado-form").validate({
		 	rules: {
			    estado: {
			    	required: true,
			    }
		  	},
		  	messages: {
			    estado: {
			    	required: "Seleccione un estado del ticket",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/updateStatus",
			        data: $(form).serialize(),
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$("#ticket-card-state").text($("#estado option:selected").text());
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("textarea").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});

		$("#tecnicos-form").validate({
		 	rules: {
			    asignar: {
			      	required: true,
			    }
		  	},
		  	messages: {
			    asignar: {
			      	required: "Seleccione un técnico para asignar la tarea",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/updateAsing",
			        data: $(form).serialize(),
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$("#ticket-card-asign").text($("#asignar option:selected").text());
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("textarea").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});

		$(document).on('click', '.item.pointer[data-tab="tab-sql"]', function(){
			var ticket = $('.ticket-card-id').attr('data-id');
			$.ajax({
			        type: "POST",
			        url: base_url+"index.php/json/jsonSQL",
			        data: {ticket:ticket},
			        success: function (success) {
			          	json = jQuery.parseJSON(success)[0];
			          	$('textarea#sql').val(json.sql);
			        }
			});
		});
		$(document).on('click', '.item.pointer[data-tab="tab-revision"]', function(){
			var ticket = $('.ticket-card-id').attr('data-id');
			$.ajax({
			        type: "POST",
			        url: base_url+"index.php/json/jsonRev",
			        data: {ticket:ticket},
			        success: function (success) {
			        	json = jQuery.parseJSON(success)[0];
			          	$('textarea#revision').val(json.revision);
			        }
			});
		});

		$("#sql-form").validate({
		 	rules: {
			    sql: {
			      	required: true,
			    }
		  	},
		  	messages: {
			    sql: {
			      	required: "No puede enviar un sql sin contenido",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/updateSQL",
			        data: $(form).serialize(),
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});

		$("#revision-form").validate({
		 	rules: {
			    revision: {
			      	required: true,
			    }
		  	},
		  	messages: {
			    revision: {
			      	required: "No puede enviar una revisión sin contenido",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/updateRevision",
			        data: $(form).serialize(),
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});

		$("#ambiente-form").validate({
		 	rules: {
		 		ambiente: {
			      	required: true,
			    }
		  	},
		  	messages: {
		  		ambiente: {
			      	required: "Debes seleccionar un ambiente de desarrollo",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/updateAmbiente",
			        data: $(form).serialize(),
			        success: function (success) {
			        	// console.log(success);
			          	json = jQuery.parseJSON(success);
			          	// console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active").val('');
				            	$("textarea").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});
		// Guardar solventacion
		$( document ).on("click", ".push-solv button", function(){
			console.log("solventar");
			var id = $(this).attr("data-id");
			console.log(id);
			$('.ui.modal#solventacion-modal #id').val(id);
			$('.ui.modal#solventacion-modal').modal('show');
		});
		$( document ).on("click", ".save-solventacion", function(){
			$(".solventacion-form#formulario").submit();
		});
		$(".solventacion-form#formulario").validate({
		 	rules: {
			    solventacion: {
			      	required: true,
			    },
			    revision: {
			    	required: true,
			    }
		  	},
		  	messages: {
			    solventacion: {
			      	required: "Necesita elegir una solventación",
			    },
			    revision: {
			    	required: "Agregue una descripción de la solventación",
			    }
		  	},
			highlight: function(element) {
			    // $(element).parent('.form-group').addClass('validate-error');
			},
		  	success: function (element) {
			    // $(element).parent('.form-group').removeClass('validate-error');
			    $(element).parent('.form-group').find('.error').remove();
		  	},
		  	submitHandler: function(form) {
		  		console.log($(form).serialize());
		  		$.ajax({
			        type: "POST",
			        url: base_url+"index.php/asign/updateSolventacion",
			        data: $(form).serialize(),
			        success: function (success) {
			        	console.log(success);
			          	json = jQuery.parseJSON(success);
			          	console.log(json);
			         	switch(json.status){
			            	case 'success':
			            		var id 		= $('.ui.modal select#solventacion option:selected').text();
			            		var status 	= $('.ui.modal select#solventacion option:selected').text();
			            		$(".alert-msg").text(json.msg);
				            	$(".positive.message").show().delay(5000).fadeOut();
				            	$("input").not(".non-active");
				            	$("textarea").val('');
				            	$("select").val('');
				            	$("select option[value='']").attr("selected",true);
				            	$(".push-solv").attr('data-id', id);
				            	$(".push-solv .ticket-card-solv").text(status);
				            	$('.ui.modal#solventacion-modal').modal('hide');
			            		break;
			            	case 'fail':
			            		$(".alert-msg").text(json.msg);
			            		$(".error.message").show().delay(5000).fadeOut();
			            		break;
			            	default:
			              		break;
			          	}
			        }
			    });  
		  	}
		});
	// Tab medio
	$('.tabular.menu.inicio .item').tab();
	$('.ui.accordion').accordion();
	// Change button solventacion
	$(document).on("mouseover", ".push-solv", function(){
		var texto = $(this).find(".ticket-card-solv").text().trim();
		if(texto === '')
			$(".button-solv").show();
	}).on("mouseout",".push-solv", function(){
		$(".button-solv").hide();
	});
});