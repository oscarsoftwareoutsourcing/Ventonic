/* Set todays date */
var calDate = new Date;
// var today = formatDate(calDate, true);
var today = moment(calDate).format('DD-MM-YYYY');

/* Label bullets data. */
var labelBullets = {
    B: { label: 'Eventos', color: 'success', code: '#28c76f'},
    W: { label: 'Recordatorios', color: 'warning', code: '#ff9f43'},
    P: { label: 'Tareas', color: 'danger', code: '#ea5455'},
    O: { label: 'Otros', color: 'primary', code: '#7367f0'},
}

var categoryBullets = $(".cal-category-bullets").html();

/* Get data from server. */
var data = $('span#eventsData').data('info');

/* Calendar element to init */
var calendarEl = document.getElementById('fc-default');

/* Remove the element with the data */
$('span#eventsData').remove();

// date picker
$(".pickadate").pickadate({
    format: 'dd-mm-yyyy'
});

// Time picker
var $startsAt = $('#cal-start-time' ).pickatime({
    format: 'hh:i A',
    interval: 15
}),
$endsAt = $('#cal-end-time').pickatime({
    format: 'hh:i A',
    interval: 15
}),
pickerSetStartsAt = $startsAt.pickatime( 'picker' ),
pickerSetEndsAt = $endsAt.pickatime( 'picker' );

/* Configure the calendar */
var calendar = new FullCalendar.Calendar(calendarEl, {
    events: data,
    plugins: ["dayGrid", "timeGrid", "interaction"],
    customButtons: {
        addNew: {
            text: ' Agregar',
            click: function() {
                $("#modalForm").modal("show");
                $("#cal-start-date").val(today);
                $("#cal-end-date").val(today);
                
                // Set actual time.
                pickerSetStartsAt.set( 'select', moment(today).format('hh:mm a'));
                pickerSetEndsAt.set( 'select', moment(today).format('hh:mm a'));
            }
        }
    },
    header: {
        left: "addNew",
        center: "dayGridMonth,timeGridWeek,timeGridDay",
        right: "prev,title,next"
    },
    displayEventTime: false,
    navLinks: true,
    editable: true,
    allDay: true,
    dateClick: function(info) {

        $("#calendarForm #cal-start-date").val(moment(info.dateStr).format('DD-MM-YYYY'));
        $("#calendarForm #cal-end-date").val(moment(info.dateStr).format('DD-MM-YYYY'));
        
        // Set actual time.
        if(info.view.type === 'dayGridMonth') {
            pickerSetStartsAt.set( 'select', moment(today).format('hh:mm a'));
            pickerSetEndsAt.set( 'select', moment(today).format('hh:mm a'));
        } else {
            pickerSetStartsAt.set( 'select', moment(info.dateStr).format('hh:mm a'));
            pickerSetEndsAt.set( 'select', moment(info.dateStr).format('hh:mm a'));
        }

        $("#modalForm").modal("show");
    },
    eventClick: function(info) {

        /* Hide buttons */
        $('#saveBtn, #deleteBtn').addClass('d-none');
        $('#updateBtn, #deleteBtn').removeClass('d-none');
        $("#modalForm").modal("show");
        info.event._def.hasEnd = true;

        $('#cal-event-id').val(info.event.id);
        $('#cal-event-title').val(info.event.title);
        $('#cal-start-date').val(moment(info.event.start).format('DD-MM-YYYY'));
        $('#cal-start-time').val(moment(info.event.start).format('hh:mm a'));
        $('#cal-end-date').val(moment(info.event.end).format('DD-MM-YYYY'));
        $('#cal-end-time').val(moment(info.event.end).format('hh:mm a'));
        $('#cal-description').val(info.event.extendedProps.description);
        $('#cal-event-place').val(info.event.extendedProps.place);
        
        let key = info.event.extendedProps.category;
        renderBullet(key);
    }
});

// render calendar
calendar.render();

// appends bullets to left class of header
$("#calendarSection .fc-right").append(categoryBullets);

/* Labels dropdown menu */
$('#labelsBtn').dropdown();

/* Add Bullet */
$('.bulletOpt').on('click', function(event) {
    selectBullet(event);
});

/* Closing modal */
$('.closeBtn').on('click', function() {
    resetModal();    
});

// calendar add event
$('#saveBtn').on('click', function() {
    
    var errors = {};
    axios.post('/events', {
        title: $('#cal-event-title').val(),
        start_at: $('#cal-start-date').val(),
        start_time: $('#cal-start-time').val(),
        end_at: $('#cal-end-date').val(),
        end_time: $('#cal-end-time').val(),
        notes: $('#cal-description').val(),
        place: $('#cal-event-place').val(),
        category: $('#categoriesContainer .selected').data('key')
    }).then(response => {
        if (response.data.result) {
            calendar.addEvent({
                id: response.data.event.id,
                title: response.data.event.title,
                start: moment(response.data.event.start).format('YYYY-MM-DD'),
                end: moment(response.data.event.end).format('YYYY-MM-DD'),
                description: (response.data.event.description === null) ? '' : response.data.event.description,
                color: response.data.event.color,
                dataEventColor: response.data.event.dataEventColor,
                place: (response.data.event.place === null) ? '' : response.data.event.place,
                category: response.data.event.category,
                allDay: true
            });

            // calendar.refetchEvents();
            resetModal();
        }
    }).catch(error => {
        if(error.response.status === 422) { // Validation

            /* Delete all the validations rendered before */
            $('.form-group .help-block').children().remove();

            /* Render validations */
            $.each(error.response.data.errors, function (key, val) {
                $('#' + key + '-error').append('<i class="text-danger">'+val[0]+'</i>');
            });
        }
    });
});

// calendar update event
$("#updateBtn").on("click", function() {
    axios.put('/events/' + $('#cal-event-id').val(), {
        title: $('#cal-event-title').val(),
        start_at: $('#cal-start-date').val(),
        start_time: $('#cal-start-time').val(),
        end_at: $('#cal-end-date').val(),
        end_time: $('#cal-end-time').val(),
        notes: $('#cal-description').val(),
        place: $('#cal-event-place').val(),
        category: $('#categoriesContainer .selected').data('key')
    }).then(response => {
        if (response.data.result) {
            resetModal();
            calendar.refetchEvents();
        }
    }).catch(error => {
        if (typeof(error.response) !="undefined") {
            for (var index in error.response.data.errors) {
                if (error.response.data.errors[index]) {
                    $(`#cal_event_${index}_error`).find('strong').html(`${error.response.data.errors[index][0]}`);
                    $(`#cal_event_${index}_error`).show();
                }
            }
        }
    });
});

// Remove Event
$("#deleteBtn").on("click", function() {
    let id = $('#cal-event-id').val();
    if ($('#cal-event-id').val()){
        axios.delete('/events/' + id).then(response => {
            if (response.data.result) {

                console.log('ELIMINÉ!');
                calendar.removeEvent(id);
                resetModal();
            }
        }).catch(error => {
            console.error(error);
        });
    }
});

function cleanBulletList() {
    /* Remove selected class from all and add to the clicked one */
    $('#categoriesContainer .dropdown-item').removeClass('selected');
}

function selectBullet(element) {
    let key = element.target.dataset.key;

    cleanBulletList();

    $(element.target).addClass('selected');

    /* Remove the bullet */
    $("#labelBullet").children().remove();
    let bullet = '<div class="chip chip-' + labelBullets[key].color + '">' + '<div class="chip-body">' + '<span class="chip-text">' + labelBullets[key].label + '</span>' + '</div>' + '</div>';
    $("#labelBullet").append(bullet);
}

function renderBullet(key) {

    /* Remove the bullet */
    $("#labelBullet").children().remove();
    let bullet = '<div class="chip chip-' + labelBullets[key].color + '">' + '<div class="chip-body">' + '<span class="chip-text">' + labelBullets[key].label + '</span>' + '</div>' + '</div>';
    $("#labelBullet").append(bullet);

    $('span.bulletOpt[data-key="'+key+'"]').addClass('selected');
}

function resetModal() {
    /* Reset the form */
    $("#calendarForm")[0].reset();

    /* Remove the bullet */
    $("#labelBullet").children().remove();

    /* Remove validation messages */
    $(".help-block").children().remove();

    /* Remove selected class from all bullet labels */
    cleanBulletList();

    /* Close modal */
    $('#modalForm').modal('hide');

    $('#saveBtn, #updateBtn, #deleteBtn').addClass('d-none');
}