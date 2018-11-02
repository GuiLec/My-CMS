var nombre_de_nvmodule = 0;
function add_field(){
	nombre_de_nvmodule ++;
    var new_element = document.createElement("textarea");
   	new_element.name = "nvmodule" + nombre_de_nvmodule;
    var br = document.createElement("br");
    var add_button = document.getElementById("add_button");
    var parent = add_button.parentNode;
    parent.insertBefore(new_element, add_button);
    parent.insertBefore(br, add_button);
}

function passer_nb_de_modules(){
	var form = document.getElementById('modifier_form');
	form.action += "&nombre_de_nvmodule=" + nombre_de_nvmodule;
}
