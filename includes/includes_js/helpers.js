"use strict";


function showContent(dia) {

    var names = document.getElementsByName(dia);
    var check = document.getElementById(dia);

    if(check.checked){
        
        for (let index = 1; index < names.length; index++) {
            names[index].style.display = 'block';            
        }
        

    }else{
        for (let index = 1; index < names.length; index++) {
            names[index].style.display = 'none';            
        }
    }
        
}

//este codigo no lo estoy utilizando, pero es muy util a la hora de crear un array solo con los id de los checkbox
// function showContent1(dia) {

//     var inputs = document.getElementsByTagName('input');
//     var tipo;
//     var id = [];
//     var array_checkbox_id = [];
//     var contador = 0;
//     var buscar_id = "";
//     for(var i=0; i<inputs.length; i++){
//         id[i] = inputs[i].getAttribute('id');
//         if(inputs[i].getAttribute('type')=='checkbox' && id[i] != null){
//            array_checkbox_id[contador] = id[i];
//            contador++;
//         }
//     }


//     array_checkbox_id.forEach(element => {
//         buscar_id = document.getElementById(element);

        
//     });
//         if(buscar_id.checked){
        
//             var names = document.getElementsByName(buscar_id);

//             for (let index = 1; index < names.length; index++) {
//                 names[index].style.display = 'block';            
//             }
            
    
//         }else{
//             for (let index = 1; index < names.length; index++) {
//                 names[index].style.display = 'none';            
//             }
//         }
// }




window.addEventListener("load", function() {

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
	
});