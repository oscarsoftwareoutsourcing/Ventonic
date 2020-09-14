// Varibales globales
var url = $(location).attr('origin');

// Buscador tabla de oportunidades guardadas
$(document).ready(function () {
    $("#textSearch").on('keyup', function () {
        _this = this;
        // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
        $.each($("#oportunityTable tbody tr"), function () {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });

    // Buscador de contactos se cambio porque aqui uso la clase oportunityTable en lugar del id
    $("#textSearch").on('keyup', function () {
        _this = this;
        // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
        $.each($(".oportunityTable tbody tr"), function () {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
    // Ordenar columnas
    $('th').click(function () {
        var table = $(this).parents('table').eq(0)
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
        this.asc = !this.asc
        if (!this.asc) {
            rows = rows.reverse()
        }
        for (var i = 0; i < rows.length; i++) {
            table.append(rows[i])
        }
        setIcon($(this), this.asc);
    })

    function comparer(index) {
        return function (a, b) {
            var valA = getCellValue(a, index),
                valB = getCellValue(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
        }
    }

    function getCellValue(row, index) {
        return $(row).children('td').eq(index).html()
    }

    function setIcon(element, asc) {
        $("th").each(function (index) {
            $(this).removeClass("sorting");
            $(this).removeClass("asc");
            $(this).removeClass("desc");
        });
        element.addClass("sorting");
        if (asc) element.addClass("asc");
        else element.addClass("desc");
    }

});

// Validacion de select2 para que no admita mas de 3 opciones
$("#sectors").on('change', function (e) {
    if (Object.keys($(this).val()).length > 3) {
        $('option[value="' + $(this).val().toString().split(',')[3] + '"]').prop('selected', false);
    }
});

// Para usar el evento click en una fila que se comporta como url
$('#deleteButton').on('click', function () {
    $('#deleteModal').modal({
        show: 'false'
    });
});

function showModalDelete() {
    $('#deleteModal').modal({
        show: 'false'
    });
}

// Filas de tablas como enlaces a pagina
$('tr').on("click", function () {
    if ($(this).attr('href') !== undefined) {
        document.location = $(this).attr('href');
    }
});

// Cambios de estatus postulados
$('.status_postulation').on("change", function () {
    var status_id = $('#status_postulation').val();
    $.ajax({
        url: url + '/estatus/' + $(this).data('id') + '/' + status_id,
        type: 'GET',
        success: function (response) {
            $(".alert-success").css("display", "block");
            setTimeout(function () {
                $('.alert-success').hide();
            }, 5000);

        }
    });
});

// Borrar contactos
// Lleno los valores del modal con los datos del contactoa eliminar
function asignarValores(value) {
    var contact_id = $('#contact_id' + value).val();
    var user_id = $('#user_id' + value).val();
    $('#contact_id_modal').val(contact_id);
    $('#user_id_modal').val(user_id);
};

$('#buttonDelete').on("click", function () {
    var contact_id = $('#contact_id_modal').val();
    var user_id = $('#user_id_modal').val();
    $.ajax({
        url: url + '/contacto/eliminar/' + contact_id + '/' + user_id,
        type: 'GET',
        success: function (response) {
            alert('Contacto eliminado exitosamente');
            location.reload();
        },
        error: function (xhr, status) {
            alert('Disculpe, no esta autorizado para eliminar este contacto');
        },
    });
});

// Message flash despues del cambio de estado
$('#dismiss').on("click", function () {
    $('.alert-success').css('color', 'transparent');
    $('.alert-success').hide();
});

// Filtros busqueda contactos por type

$('#type-contact').on("change", function () {
    var select = $('#type-contact').val();
    var tipo = $('.tipoContacto');
    $.each(tipo, function (i, item) {
        var data = $(item).data('id');
        var existTipo = $(item).val();
        if (existTipo !== select) {
            console.log('Son iguales');
            $('#fila' + data).hide();
        }
        if (select == "Busqueda por tipo de cliente") {
            $('.fila').show();
        }
    });
});

// Filtros de postulados

$('#customCheck1').on("change", function () {
    if ($(this).prop('checked')) {
        var moviles = $('.movil');
        $.each(moviles, function (i, item) {
            var data = $(item).data('id');
            var existMovil = $(item).val();

            if (!existMovil) {
                $('#row' + data).hide();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('#customCheck2').on("change", function () {
    if ($(this).prop('checked')) {
        var photos = $('.photo');
        $.each(photos, function (i, item) {
            var data = $(item).data('id');
            var existphoto = $(item).val();
            if (!existphoto) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('#customCheck3').on("change", function () {
    if ($(this).prop('checked')) {
        var videos = $('.video');
        $.each(videos, function (i, item) {
            var data = $(item).data('id');
            var existvideo = $(item).val();
            if (!existvideo) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('#customCheck4').on("change", function () {
    if ($(this).prop('checked')) {
        var likeinds = $('.likeind');
        $.each(likeinds, function (i, item) {
            var data = $(item).data('id');
            var existlike = $(item).val();
            if (!existlike) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('.aniosFilter').on("change", function () {
    if ($(this).prop('checked')) {
        var i = $(this).data('id');
        var aniosFil = $('#aniosFilter' + i).val();
        var aniosAnswer = $('.anios');
        $.each(aniosAnswer, function (i, item) {
            var data = $(item).data('id');
            var exist = $(item).val();
            if (exist !== aniosFil) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('.experienciaFilter').on("change", function () {
    if ($(this).prop('checked')) {
        var i = $(this).data('id');
        var experienciaFil = $('#experienciaFilter' + i).val();
        var experienciaAnswer = $('.experiencia');
        $.each(experienciaAnswer, function (i, item) {
            var data = $(item).data('id');
            var exist = $(item).val();
            if (exist !== experienciaFil) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('.disponibilidadFilter').on("change", function () {
    if ($(this).prop('checked')) {
        var i = $(this).data('id');
        var disponibilidadFil = $('#disponibilidadFilter' + i).val();
        var disponibilidadAnswer = $('.disponibilidad');
        $.each(disponibilidadAnswer, function (i, item) {
            var data = $(item).data('id');
            var exist = $(item).val();
            if (exist !== disponibilidadFil) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})

$('.colaboracionFilter').on("change", function () {
    if ($(this).prop('checked')) {
        var i = $(this).data('id');
        var colaboracionFil = $('#colaboracionFilter' + i).val();
        var colaboracionAnswer = $('.colaboracion');
        $.each(colaboracionAnswer, function (i, item) {
            var data = $(item).data('id');
            var exist = $(item).val();
            if (exist !== colaboracionFil) {
                $('#row' + data).hide();
            } else {
                $('#row' + data).show();
            }
        });
    } else {
        $('.rowTable').show();
    }
})


// Filtros busqueda postulados por por tipo de empleo en oportunidades

$('#tipo-empleo').on("change", function () {
    var select = $('#tipo-empleo').val();
    var tipo = $('.jobType');
    $.each(tipo, function (i, item) {
        var data = $(item).data('id');
        var existTipo = $(item).val();
        if (existTipo == "todos") {
            $('.filaEntera').show();
        } else if (existTipo !== select) {
            console.log('Son iguales');
            $('#fila' + data).hide();
        } else {
            $('#fila' + data).show();
        }
        if (select == '0') {
            $('.filaEntera').show();
        }
    });
});

// Filtros busqueda postulados por antiguedad

$('#antiguedad').on("change", function () {
    var select = $('#antiguedad').val();
    var tipo = $('.antiguedad');
    $.each(tipo, function (i, item) {
        var data = $(item).data('id');
        var existTipo = $(item).val();
        if (existTipo == "todos") {
            $('.filaEntera').show();
        } else if (existTipo !== select) {
            console.log('Son iguales');
            $('#fila' + data).hide();
        } else {
            $('#fila' + data).show();
        }
        if (select == '0') {
            $('.filaEntera').show();
        }
    });
});

// Filtros busqueda postulados por sector

$('#sectores').on("change", function () {
    var select = $('#sectores').val();
    var tipo = $('.sector');
    $.each(tipo, function (i, item) {
        var data = $(item).data('id');
        var existTipo = $(item).val();
        if (existTipo == "todos") {
            $('.filaEntera').show();
        } else if (existTipo !== select) {
            console.log('Son iguales');
            $('#fila' + data).hide();
        } else {
            $('#fila' + data).show();
        }
        if (select == '0') {
            $('.filaEntera').show();
        }
    });
});

// Filtros busqueda postulados por sector

$('#estatus-postulados').on("change", function () {
    var select = $('#estatus-postulados').val();
    var tipo = $('.postulado');
    $.each(tipo, function (i, item) {
        var data = $(item).data('id');
        var existTipo = $(item).val();

        if (existTipo == "todos") {
            $('.filaEntera').show();
        } else if (existTipo !== select) {
            console.log('Son iguales');
            $('#fila' + data).hide();
        } else {
            $('#fila' + data).show();
        }
        if (select == '0') {
            $('.filaEntera').show();
        }
    });
});


//Guardar negociacion empresa
$('#saveNegociation').on("click", function () {

    if (!$('#seller_profile_id').val()) {
        $('#seller_profile_id').addClass('is-invalid');
        $('#validation-seller').css('display', 'block');
        return false;
    } else {
        $('#seller_profile_id').removeClass('is-invalid');
        $('#validation-seller').css('display', 'none');
        var seller_profile_id = $('#seller_profile_id').val();
    }

    if (!$('#status_negociations_id').val()) {
        $('#status_negociations_id').addClass('is-invalid');
        $('#validation-status').css('display', 'block');
        return false;
    } else {
        $('#status_negociations_id').removeClass('is-invalid');
        $('#validation-status').css('display', 'none');
        var status_negociations_id = $('#status_negociations_id').val();
    }

    if (!$('#producto').val()) {
        $('#producto').addClass('is-invalid');
        $('#validation-producto').css('display', 'block');
    } else {
        $('#producto').removeClass('is-invalid');
        $('#validation-producto').css('display', 'none');
        var producto = $('#producto').val();

    }

    if (!$('#responsable').val()) {
        $('#responsable').addClass('is-invalid');
        $('#validation-responsable').css('display', 'block');
    } else {
        $('#responsable').removeClass('is-invalid');
        $('#validation-responsable').css('display', 'none');
        var responsable = $('#responsable').val();

    }

    if (!$('#importe').val()) {
        $('#importe').addClass('is-invalid');
        $('#validation-importe').css('display', 'block');
    } else {
        $('#importe').removeClass('is-invalid');
        $('#validation-importe').css('display', 'none');
        var estimado = parseFloat($('#importe').val());
    }

    console.log(typeof (estimado));
    $.ajax({
        url: url + '/negociacion/save/' + seller_profile_id + '/' + status_negociations_id + '/' + producto + '/' + responsable + '/' + estimado,
        type: 'GET',
        success: function (response) {
            // $('.add-new-data-sidebar').fadeOut();
            $(".alert-success").css("display", "block");
            setTimeout(function () {
                $('.alert-success').hide();
            }, 5000);
            var producto = '';
            var status_negociations_id = '';
            var seller_profile_id = '';
            var responsable = '';
            var estimado = '';
            location.reload();
        }
    });

});

/*
document.getElementById("userinput").onblur = function () {

    //number-format the user input
    this.value = parseFloat(this.value.replace(/,/g, ""))
        .toFixed(2)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    //set the numeric value to a number input
    document.getElementById("number").value = this.value.replace(/,/g, "")

}*/
