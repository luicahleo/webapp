"use strict";

function showContent(dia, id_label) {

    var names = document.getElementsByName(dia);
    var check = document.getElementById(dia);
    var resultado;
    if (check.checked) {
        for (let index = 1; index < names.length; index++) {
            names[index].style.display = 'block';
        }
    } else {
        for (let index = 1; index < names.length; index++) {
            names[index].style.display = 'none';
        }
    }
}

function validacion() {

    var no_error = true;
    var mensaje_turno = '';
    var dia = document.getElementsByTagName("select");
    var names;
    for (let index = 1; index < dia.length; index = index + 4) {
        names = dia[index].name;

        var select_dia = document.getElementsByName(names);
        var select_dia_manana_primero = parseInt(select_dia[2].value);
        var select_dia_manana_segundo = parseInt(select_dia[3].value);
        var select_dia_tarde_primero = parseInt(select_dia[4].value);
        var select_dia_tarde_segundo = parseInt(select_dia[5].value);

        if (!isNaN(select_dia_manana_primero) && !isNaN(select_dia_manana_segundo)) {
            if (select_dia_manana_primero > select_dia_manana_segundo || select_dia_manana_primero == select_dia_manana_segundo) {
                no_error = false;
            }
        } else if (!isNaN(select_dia_manana_primero) && isNaN(select_dia_manana_segundo)) {
            no_error = false;
        } else if (isNaN(select_dia_manana_primero) && !isNaN(select_dia_manana_segundo)) {
            no_error = false;
        } else if (isNaN(select_dia_manana_primero) && isNaN(select_dia_manana_segundo)) {
            mensaje_turno = "manana vacio";
        }

        if (!isNaN(select_dia_tarde_primero) && !isNaN(select_dia_tarde_segundo)) {
            if (select_dia_tarde_primero > select_dia_tarde_segundo || select_dia_tarde_primero == select_dia_tarde_segundo) {
                no_error = false;
            }
        } else if (!isNaN(select_dia_tarde_primero) && isNaN(select_dia_tarde_segundo)) {
            no_error = false;
        } else if (isNaN(select_dia_tarde_primero) && !isNaN(select_dia_tarde_segundo)) {
            no_error = false;
        } else if (isNaN(select_dia_tarde_primero) && isNaN(select_dia_tarde_segundo)) {
            mensaje_turno = "tarde vacio";
        }
    }
    if (no_error) {
        return no_error;
    } else {
        alert("Error: corrija los horarios");
        return no_error;
    }

}

// function toJson() {
//     var formulario = $('#form_validation');
//     formulario.click(function(e) {
//         e.preventDefault();
//         var jsonData=$(this).serializeArray()
//             .reduce(function(a, z) { a[z.name] = z.value; return a; }, {});
//         console.log(jsonData);
//     });
// }


// function toJson() {
//     var myForm = document.getElementById('form_validation');
//     myForm.addEventListener('submit', function (event) {
//         event.preventDefault();
//         var formData = new FormData(myForm),
//             result = {};
//
//         for (var entry of formData.entries()) {
//             result[entry[0]] = entry[1];
//         }
//         result = JSON.stringify(result)
//         console.log(result);
//
//     });
// }

/* codigo para crear elemento
var nuevo_parrafo = document.createElement("p");
var selec_horario_txt = document.createTextNode("Seleccione horario");
nuevo_parrafo.appendChild(selec_horario_txt);
nuevo_parrafo.setAttribute("color","red");

padre.appendChild(nuevo_parrafo);

*/

/*este codigo no lo estoy utilizando, pero es muy util a la hora de crear un array solo con los id de los checkbox
function showContent1(dia) {

    var inputs = document.getElementsByTagName('input');
    var tipo;
    var id = [];
    var array_checkbox_id = [];
    var contador = 0;
    var buscar_id = "";
    for(var i=0; i<inputs.length; i++){
        id[i] = inputs[i].getAttribute('id');
        if(inputs[i].getAttribute('type')=='checkbox' && id[i] != null){
           array_checkbox_id[contador] = id[i];
           contador++;
        }
    }


    array_checkbox_id.forEach(element => {
        buscar_id = document.getElementById(element);

        
    });
        if(buscar_id.checked){
        
            var names = document.getElementsByName(buscar_id);

            for (let index = 1; index < names.length; index++) {
                names[index].style.display = 'block';
            }
            
    
        }else{
            for (let index = 1; index < names.length; index++) {
                names[index].style.display = 'none';
            }
        }
}*/

function isset(variable) {
    if (typeof variable != "undefined") {
        console.log("Variable no existe");
    }
}


window.addEventListener("load", function () {

    //ocultamos los select de los horarios
    var ocultar = true;
    var select = document.getElementsByTagName('select');
    for (let index = 1; index < select.length; index++) {

        select[index].style.display = 'none';

        // if(index == 1 || index == 2 || index == 3){
        //     select[index].style.display = 'none';
        //
        // }
    }

    //console.log(document.getElementById("form_validation").innerHTML);


});