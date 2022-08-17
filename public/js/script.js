$("#sedes").change(function() {
    $.get('carreras/'+$(this).val(),function(data){
        console.log(data.length);
        $("#carreras").empty();
        var carreras = '<option value="">Seleccione una carrera</option>'
        for(i=0;i<data.length;i++){
            carreras+= '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
        }
        $("#carreras").html(carreras);
    });
});
//Para user
$("#sedes").change(function() {
    $.get('carreras/'+$(this).val(),function(data){
        console.log(data.length);
        $("#carreras_seleccion").empty();
        var carreras = '<option value="">Seleccione una carrera</option>'
        for(i=0;i<data.length;i++){
            carreras+= '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
        }
        $("#carreras_seleccion").html(carreras);
    });
});

$("#carreras").change(function() {
    $.get('planes/'+$(this).val(),function(data){
        console.log(data.length);
        $("#planes").empty();
        var planes = '<option value="">Seleccione un plan para la carrera</option>'
        for(i=0;i<data.length;i++){
            planes+= '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
        }
        $("#planes").html(planes);
    });
});
//user
$("#carreras_seleccion").change(function() {
    $.get('planes/'+$(this).val(),function(data){
        console.log(data.length);
        $("#catedras").empty();
        var planes = '<option value="">Seleccione un plan para la carrera</option>'
        for(i=0;i<data.length;i++){
            planes+= '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
        }
        $("#catedras").html(planes);
    });
});

$("#planes").change(function() {
    $.get('catedras/'+$(this).val(),function(data){
        console.log(data.length);
        $("#catedras").empty();
        var catedra = '<option value="">Seleccione un plan para la carrera</option>'
        for(i=0;i<data.length;i++){
            catedra+= '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
        }
        $("#catedras").html(catedra);
    });
});
