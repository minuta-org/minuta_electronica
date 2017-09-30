var doAjax = function(url, data){
	data['ajx-rqst'] = true;
    return $.ajax({
        'type' : 'POST',
        'url'  : url,
        'data' : data,
    });
};

var esFechaMenor = function(fechaA, fechaB, primerDia){
    var partes = fechaA.split('-');
    var anio = parseInt(partes[0]);
    var mes = parseInt(partes[1]) - 1;
    if(mes < 0 ) {
        mes = 12;
        anio --;
    }
    var tmpFechaA = null;
    if(primerDia){
        tmpFechaA = new Date(anio, mes, 1);
    } else {
        tmpFechaA = new Date(anio, mes, partes[2]);
    }

    mes = parseInt(tmpFechaA.getMonth()) + 1;
    var FechaA = Date.parse(tmpFechaA.getFullYear() + "-" + (mes < 10? '0' + mes : mes) + "-" + tmpFechaA.getDate());
    var FechaB = Date.parse(fechaB);
    return FechaA <= FechaB;
};


(function($){
    $.fn.clickDerecho = function(parametros){
        var opciones = parametros.opciones || {};
        var elementos = $(this);

        var dibujarMenu = function(elemento, valor){
            var posicion = elemento.offset();
            var ancho = elemento.width();
            var anchoPantalla = $(window).width();

            var contenedor = $("<div/>", {class: "dropdown-opciones"});
            var contenedorOpciones = $("<ul/>");
            var xcontenedor = posicion.left + ancho;
            var ycontenedor = posicion.top;

            $.each(opciones, function(k,v) {
                var opcion = $("<li/>").text(v.texto);
                var accion = v.accion || function(){};
                opcion.click(function(){accion(valor);});
                contenedorOpciones.append(opcion);
            });

            var ajustarPosicion = function(menu){
                var anchoMenu = menu.width();
                if(xcontenedor + anchoMenu >= anchoPantalla){
                    menu.css({left: posicion.left - (anchoMenu + 20)});
                }
            };


            contenedor.append(contenedorOpciones);
            contenedor.css({
                left: xcontenedor,
                top: ycontenedor,
            });
            $("body").append(contenedor);
            contenedor.contextmenu(function(e){
                e.preventDefault();
            });

            ajustarPosicion(contenedor);

        };

        var removerMenu = function(){
            $(".dropdown-opciones").remove();
        };

        $("body").click(function(){
            removerMenu();
        });

        /**
         * Iniciamos los eventos
         */
        $.each(elementos, function(k,v){
            var elemento = $(v);
            elemento.on("contextmenu", function(e){
                removerMenu();
                var valor = elemento.attr("data-valor");
                celdaSeleccionada = elemento;
                dibujarMenu(elemento, valor);
                e.preventDefault();
            });
        });
    };
})(jQuery);