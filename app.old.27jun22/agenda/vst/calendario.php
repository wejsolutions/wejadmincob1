<?php require '../../../cfg/base.php'; ?>
<?php $fec = $cagenda->gotoCalendar() ?>
<div id="calendar"></div>
<script type="text/javascript">
	jQuery(function($) {
		/* initialize the calendar
		----------------------------------------------------------------*/
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var calendar = $('#calendar').fullCalendar({
			 buttonText: {
				prev: '<i class="icon-chevron-left"></i>',
				next: '<i class="icon-chevron-right"></i>'
			},
			defaultView: 'agendaWeek',
		
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			events: [
			<?php foreach($magenda->lista($medico) as $r): ?>
				{
					allDay: false,
					id: '<?php echo $r->cita_ide ?>',
					title: '<?php echo $r->paci_apelli1 ?>, <?php echo $r->paci_nombre1 ?> - <?php echo $r->cita_observa ?> - <?php echo $r->trat_descrip ?>',
					start: '<?php echo $r->cita_inicio ?>',
					end: '<?php echo $r->cita_fin ?>',
					className: '<?php echo strtolower($r->cita_etiquet) ?> '
					//label-<?php echo $r->cita_etiquet; ?>'
				},
			<?php endforeach; ?>
			]
			,
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				var $extraEventClass = $(this).attr('data-class');
				
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			}
			,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				datos = 'inicio='+start+'&fin='+end+'&medico=<?php echo $medico ?>';
				//alert(datos);
				load('vst-agenda-buscar',datos,'#calendario');
			}
			,
			eventClick: function(calEvent, jsEvent, view) {
				var cita_ide = calEvent.id
				modal('vst-agenda-detalle','cita_ide='+cita_ide);
			},
			eventDrop : function(calEvent, $event) {
				var cita_ide = calEvent.id
				var inicio = calEvent.start
				var fin = calEvent.end
				var datos = 'cita_ide='+cita_ide+'&inicio='+inicio+'&fin='+fin
				var preg = confirm('¿Realmente desea cambiar la fecha de la cita?');
				if(preg==true) {
					$.post('prc-cagenda-cupdate',datos,function(data){
						if(data==1) {
							load('vst-agenda-calendario','medico=<?php echo $medico ?>&inicio='+inicio,'#calendario');
						} else {
							alert(data);
							load('vst-agenda-calendario','medico=<?php echo $medico ?>&inicio='+inicio,'#calendario');
						}
					})
				}
			},
			eventResize : function(calEvent, $event) {
				var cita_ide = calEvent.id
				var inicio = calEvent.start
				var fin = calEvent.end
				var datos = 'cita_ide='+cita_ide+'&inicio='+inicio+'&fin='+fin
				var preg = confirm('¿Realmente desea cambiar la fecha de la cita?');
				if(preg==true) {
					$.post('prc-cagenda-cupdate',datos,function(data){
						if(data==1) {
							load('vst-agenda-calendario','medico=<?php echo $medico ?>&inicio='+inicio,'#calendario');
						} else {
							alert(data);
							load('vst-agenda-calendario','medico=<?php echo $medico ?>&inicio='+inicio,'#calendario');
						}
					})
				}
			},
		});
		$('#calendar').fullCalendar('gotoDate', <?php echo $fec['ano'] ?>,<?php echo $fec['mes'] ?>,<?php echo $fec['dia'] ?>);
	})
</script>