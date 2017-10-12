var opcionesSelct2 = {
    width : '100%'
};
$(function(){
    $("select.select-2").select2(opcionesSelct2);
    $("select.select-2").on("select2:close", function (e) {
        e.target.focus();
    });
});

/**
 * Alias para la función ajax de jquery.
 * @param {string} url
 * @param {json} data
 * @returns {jqXHR}
 */
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

/**
 * Función para calcular digíto de verificación.
 */
function  calcularDv(myNit) {
    var vpri,x,y,z;
    myNit = myNit.replace(/\s/g, ""); // Espacios
    myNit = myNit.replace(/,/g, ""); // Comas
    myNit = myNit.replace(/\./g, ""); // Puntos
    myNit = myNit.replace(/-/g, ""); // Guiones

    if (isNaN(myNit)) {
        console.log("El nit/cédula '" + myNit + "' no es válido(a).");
        return "";
    };
    vpri = new Array(16);
    z = myNit.length;
    vpri[1] = 3;
    vpri[2] = 7;
    vpri[3] = 13;
    vpri[4] = 17;
    vpri[5] = 19;
    vpri[6] = 23;
    vpri[7] = 29;
    vpri[8] = 37;
    vpri[9] = 41;
    vpri[10] = 43;
    vpri[11] = 47;
    vpri[12] = 53;
    vpri[13] = 59;
    vpri[14] = 67;
    vpri[15] = 71;
    x = 0;
    y = 0;
    for (var i = 0; i < z; i++) {
        y = (myNit.substr(i, 1));
        x += (y * vpri [z - i]);
    }
    y = x % 11;
    return (y > 1) ? 11 - y : y;
}

var limpiarSelect2 = function(select2){
    select2.select2("destroy");
    select2.select2(opcionesSelct2);
    select2.on("select2:close", function (e) {
        e.target.focus();
    });
};

var select2Enable = function(select2, activo){
    var contenedorSelect2 = select2.parent().find(".select2-container");
    contenedorSelect2.find(".select-2-inactivo").remove();
    if(!activo && contenedorSelect2.find(".select-2-inactivo").length === 0){
        contenedorSelect2.append($("<div/>", {class: "select-2-inactivo"}));
    }
};