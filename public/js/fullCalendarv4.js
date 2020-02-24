	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: ['dayGrid', 'interaction','timeGrid','list'],
			// defaultView:'timeGridDay'
			header:{
				left: 'MiBoton',
				center:'title',
				right:'timeGridDay, prev, next'
			},
			// customButtons:{
			// 	MiBoton:{
			// 		text:'Boton',
			// 		click:function(){
			// 		}
			// 	}
			// },
			eventClick:function(info){
				console.log(info.event.title);
				console.log(info.event.start);
				console.log(info.event.extendedProps.descripcion);

			},
			dateClick:function(info){
				$('#ModalOrdenservicio').modal('toggle');
				calendar.addEvent({ title:"Evento x", date:info.dateStr });
			},
			events:[
			{
				title:"Mi evento 1",
				start: "2020-02-16 12:30:00",
				descripcion: "la descripcion"
			},
			{
				title:"Mi evento 2",
				start: "2020-02-16 12:30:00"
			}]
		});
		calendar.setOption('locale','Es');

		calendar.render();

		$('#btnAgregarOrdServ').click(function(){
			ObjEvento=recolectarDatosGUI("POST");
			EnviarInformacion('',ObjEvento)
		});

		function recolectarDatosGUI(method){

			var f = new Date();

			nuevoEvento={
				inmueble:$('#dirlist').val(),
				empresa:$('#empresa').val(),
				usuarioId:$('#usuarioId').val(),
				estadoOrden:1,
				fechaOrden:f.getDate(),
				inicioOrden:$('#hora').val(),
				finOrden:$('#hora').val(),
				tipoOrden:1,
				descripcion:$('#descri').val(),
				'_method':method
			}
			return(nuevoEvento);
		}

		function EnviarInformacion(accion,objEvento){

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		        }
		    });

			$.ajax(
				{
					type:"POST",
					url:"{{ url('agergarItem')}}",
					data:objEvento,
					succes:function(msg){console.log(msg);},
					error:function(){ alert("Hay un error");}
				}
			);
		}

	});