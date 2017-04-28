/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "Este campo es obligatorio.",
		remote: "Por favor, rellena este campo.",
		email: "Por favor, ingrese una dirección de correo válida",
		url: "Por favor, ingrese una URL válida.",
		date: "Por favor, ingrese una fecha válida.",
		dateISO: "Por favor, ingrese una fecha (ISO) válida.",
		number: "Por favor, ingrese un número entero válido.",
		digits: "Por favor, ingrese sólo dígitos.",
		creditcard: "Por favor, ingrese un número de tarjeta válido.",
		equalTo: "Por favor, ingrese el mismo valor de nuevo.",
		accept: "Por favor, ingrese un valor con una extensión aceptada.",
		maxlength: $.validator.format("Por favor, no ingrese más de {0} caracteres."),
		minlength: $.validator.format("Por favor, no ingrese menos de {0} caracteres."),
		rangelength: $.validator.format("Por favor, ingrese un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Por favor, ingrese un valor entre {0} y {1}."),
		max: $.validator.format("Por favor, ingrese un valor menor o igual a {0}."),
		min: $.validator.format("Por favor, ingrese un valor mayor o igual a {0}.")
	});
}(jQuery));