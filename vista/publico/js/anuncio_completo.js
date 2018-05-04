function verTodo(id) {
      $.ajax({
            type: "POST",
            url: "anuncios/anuncio_completo.php",
            data: {anuncio_id:id},

            success:function(res){  
                $("#zona0").html(res);
            },

            error:function(){
                alert("Error ocurrido con el ajax leer mas");
            }
      });


}

function paginar(pagina, maxXpag) {
    $.ajax({
            type: "POST",
            url: "anuncios/pagina_anuncio.php",
            data: {pagina:pagina, max:maxXpag},

            success:function(res){
                $("#zona1").html(res);
            },

            error:function(){
                alert("Error ocurrido con el ajax paginador");
            }
      });
}
