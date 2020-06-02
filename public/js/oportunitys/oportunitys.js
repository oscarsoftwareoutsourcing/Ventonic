// Varibales globales
var url=$(location).attr('origin');

// Buscador tabla de oportunidades guardadas
$(document).ready(function(){
    $("#textSearch").on('keyup', function(){
        _this = this;
        // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
        $.each($("#oportunityTable tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
            $(this).hide();
            else
            $(this).show();                
        });
    }); 

    // Ordenar columnas
    $('th').click(function() {
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
        return function(a, b) {
          var valA = getCellValue(a, index),
            valB = getCellValue(b, index)
          return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
        }
      }
    
      function getCellValue(row, index) {
        return $(row).children('td').eq(index).html()
      }
    
      function setIcon(element, asc) {
        $("th").each(function(index) {
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
$("#sectors").on('change', function(e) {
  if (Object.keys($(this).val()).length > 2) {
      $('option[value="' + $(this).val().toString().split(',')[3] + '"]').prop('selected', false);
  }
});

// Filas de tablas como enlaces a pagina
$('tr').on("click", function() { 
  if($(this).attr('href') !== undefined){ 
    document.location = $(this).attr('href'); 
  } 
});

// Cambios de estatus postulados
$('.status_postulation').on("change", function(){
  var status_id=$('#status_postulation').val();
  $.ajax({
    url:url+'/estatus/'+$(this).data('id')+'/'+status_id,
    type:'GET',
    success:function(response){
      $(".alert-success").css("display", "block");
      setTimeout(function(){ $('.alert-success').hide(); }, 5000);

    }
  });
});

// Message flash despues del cambio de estado
$('#dismiss').on("click", function(){
  $('.alert-success').css('color', 'transparent');
  $('.alert-success').hide();
});

// Filtros de postulados

$('#customCheck1').on("change", function(){
  if($(this).prop('checked')){
    var moviles=$('.movil');
    $.each(moviles,function(i, item) {
      var data=$(item).data('id');
      var existMovil = $(item).val();
      
      if(!existMovil){
        $('#row'+data).hide();
      }
    });
  }else{
    $('.rowTable').show();
  }
})

$('#customCheck2').on("change", function(){
  if($(this).prop('checked')){
    var photos=$('.photo');
    $.each(photos,function(i, item) {
      var data=$(item).data('id');
      var existphoto = $(item).val();
      if(!existphoto){
        $('#row'+data).hide();
      }
      else{
        $('#row'+data).show();
      }
    });
  }else{
    $('.rowTable').show();
  }
})

$('#customCheck3').on("change", function(){
  if($(this).prop('checked')){
    var videos=$('.video');
    $.each(videos,function(i, item) {
      var data=$(item).data('id');
      var existvideo = $(item).val();
      if(!existvideo){
        $('#row'+data).hide();
      }
      else{
        $('#row'+data).show();
      }
    });
  }else{
    $('.rowTable').show();
  }
})

$('#customCheck4').on("change", function(){
  if($(this).prop('checked')){
    var likeinds=$('.likeind');
    $.each(likeinds,function(i, item) {
      var data=$(item).data('id');
      var existlike = $(item).val();
      if(!existlike){
        $('#row'+data).hide();
      }
      else{
        $('#row'+data).show();
      }
    });
  }else{
    $('.rowTable').show();
  }
})

//Guardar negociacion empresa
$('#saveNegociation').on("click", function(){
  
  if(!$('#seller_profile_id').val()){
    $('#seller_profile_id').addClass('is-invalid');
    $('#validation-seller').css('display', 'block');
    return false;
  }else{
    $('#seller_profile_id').removeClass('is-invalid');
    $('#validation-seller').css('display', 'none');
    var seller_profile_id=$('#seller_profile_id').val();
  }

  if(!$('#status_negociations_id').val()){
    $('#status_negociations_id').addClass('is-invalid');
    $('#validation-status').css('display', 'block');
    return false;
  }else{
    $('#status_negociations_id').removeClass('is-invalid');
    $('#validation-status').css('display', 'none');
    var status_negociations_id=$('#status_negociations_id').val();
  }

  if(!$('#producto').val()){
    $('#producto').addClass('is-invalid');
    $('#validation-producto').css('display', 'block');
  }else{
    $('#producto').removeClass('is-invalid');
    $('#validation-producto').css('display', 'none');
    var producto=$('#producto').val();

  }

  if(!$('#responsable').val()){
    $('#responsable').addClass('is-invalid');
    $('#validation-responsable').css('display', 'block');
  }else{
    $('#responsable').removeClass('is-invalid');
    $('#validation-responsable').css('display', 'none');
    var responsable=$('#responsable').val();

  }

  if(!$('#importe').val()){
    $('#importe').addClass('is-invalid');
    $('#validation-importe').css('display', 'block');
  }else{
    $('#importe').removeClass('is-invalid');
    $('#validation-importe').css('display', 'none');
    var estimado=parseFloat($('#importe').val());
  }

  console.log(typeof(estimado));
  $.ajax({
    url:url+'/negociacion/save/'+seller_profile_id+'/'+status_negociations_id+'/'+producto+'/'+responsable+'/'+estimado,
    type:'GET',
    success:function(response){
      // $('.add-new-data-sidebar').fadeOut();
      $(".alert-success").css("display", "block");
      setTimeout(function(){ $('.alert-success').hide(); }, 5000);
      var producto='';
      var status_negociations_id='';
      var seller_profile_id='';
      var responsable='';
      var estimado='';
      location.reload();
    }
  });

});

//Guardar negociacion empresa
// $('#saveNegociation').on("click", function(){
//   var seller_profile_id=$('#seller_profile_id').val();
//   var status_negociations_id=$('#status_negociations_id').val();
//   var producto=$('#producto').val();

//   $.ajax({
//     url:url+'/negociacionempresa/'+seller_profile_id+status_negociations_id+producto,
//     type:'GET',
//     success:function(response){
//       $(".alert-success").css("display", "block");
//       setTimeout(function(){ $('.alert-success').hide(); }, 5000);
//     }
//   });

  // var negociacion={
  //   'seller_profile_id': seller_profile_id,
  //   'status_negociations_id' : status_negociations_id,
  //   'producto' : producto
  // }

  // $.ajax({
  //   type:'POST',
  //   url:url+'/negociaciones/empresa/guardar',
  //   data:negociacion,
  //   beforeSend:function(){

  //   },
  //   success:function(response){
  //     console.log('Guardado correctamente');
  //   },
  //   error:function(){
  //     console.log('A ocurrido un error')
  //   }
  // });
// });

// Notificaciones RealTime
// // Echo.channel('channel-postulation').listen('PostulationOportunity', (e) => {
// // 	console.log(e);
// // });

// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

// Initiate the Pusher JS library
// var pusher = new Pusher(f18ead0fa8750c93afd7, {
//   encrypted: true
// });

// // Subscribe to the channel we specified in our Laravel Event
// var channel = pusher.subscribe('channel-postulation');

// // Bind a function to a Event (the full Laravel class)
// channel.bind('App\\Events\\PostulationOportunity', function(data) {
//   console.log(data);
// });
