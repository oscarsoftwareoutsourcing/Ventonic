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

      // Fonts colors
});

// Validacion de select2 para que no admita mas de 3 opciones

$("#sectors").on('change', function(e) {
  if (Object.keys($(this).val()).length > 2) {
      $('option[value="' + $(this).val().toString().split(',')[3] + '"]').prop('selected', false);
  }
});

$('tr').on("click", function() { 
  if($(this).attr('href') !== undefined){ 
    document.location = $(this).attr('href'); 
  } 
});


