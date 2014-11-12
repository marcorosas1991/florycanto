function validate(form) {

	fail = validateClave(form.claveCurso.value);
	fail += validateNombre(form.nombreCurso.value);
//	fail += validateApellido(form.apellido.value);
//	fail += validateUsername(form.username.value);
//	fail += validateEmail(form.email.value);
	if (fail == "")
		return true;
	else {

		alert(fail);
		return false;

	}
		
}

function validateClave(valor) {

	var codigo = valor.substring(0,2);
	var numero = valor.substring(2,6);

	if (valor == "") 
		return "No se introdujo clave ";
	else if (valor.length != 6)
		return "La clave del curso debe ser de 6 caracteres";
	else if ((/[^A-Z]/.test(codigo)) || (/[^0-9]/.test(numero)))
		return "el formato es dos letras y cuatro digitos";
	else
		return "";

}


function validateNombre(valor) {

	if (valor == "") 
		return "No se introdujo nombre ";
	else
		return "";

}

function validateApellido(valor) {

	if (valor == "") 
		return "No se introdujo apellido ";
	else
		return "";

}


function validateUsername(valor) {

	if (valor == "") 
		return "No se introdujo username ";
	else if (valor.length < 5)
		return "El username debe tener al menos 5 caracteres";
	else if (/[^a-zA-Z0-9_-]/.test(valor))
		return "El username requiere cada una de a-z, A-Z y 0-9";
	else
		return "";

}

function validateEmail(valor) {

	if (valor == "") 
		return "No se introdujo username";
	else if (valor.length < 6)
		return "El password debe tener al menos 5 caracteres";
	else if (!/[a-z]/.test(valor) || !/[A-Z]/.test(valor) || !/[0-9]/.test(valor))
		return "El password requiere cada una de a-z, A-Z y 0-9";
	else
		return "";

}
