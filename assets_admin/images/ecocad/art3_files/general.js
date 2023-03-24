var code400 = function () {
	ErrorCustom("No tiene permisos de acceder!", "");
};
var code404 = function () {
	ErrorCustom(
		"La petición realizada no se encuentra, favor de intentarlo de nuevo mas tarde.",
		""
	);
};
var code500 = function () {
	ErrorCustom("El servidor no se encuentra disponible, intenta de nuevo", "");
};
var code409 = function () {
	ErrorCustom("Sesión ha expirado por inactividad en el sistema", function () {
		window.location.href = "/Account/LogOff";
	});
};

//mensaje y tipo: success, danger, etc
var exito = function (mensaje, tipo) {
	bootbox.dialog({
		message: mensaje,
		closeButton: false,
		buttons: {
			danger: {
				label: "<i class='icon-remove'></i> Cerrar",
				className: "btn-sm btn-" + tipo + "",
			},
		},
	});
};

var exito_redirect = function (mensaje, tipo, redirect) {
	bootbox.dialog({
		message: mensaje,
		closeButton: false,
		buttons: {
			danger: {
				label: "<i class='icon-remove'></i> Cerrar",
				className: "btn-sm btn-" + tipo + "",
				callback: function () {
					window.location.href = redirect;
				},
			},
		},
	});
};

var ajaxJson = function (
	url,
	data,
	metodo,
	asincrono,
	callback,
	mostrar_loading = true,
	mensaje_isloading = ""
) {
	if (mostrar_loading) {
		if (mensaje_isloading == "") {
			//$.isLoading({ text: "Cargando..." });
		} else {
			//$.isLoading({ text: mensaje_isloading });
		}
	}
	if (metodo == "") metodo = "POST";
	$.ajax({
		type: metodo,
		url: url,
		enctype: "multipart/form-data",
		datatype: "JSON",
		async: asincrono,
		cache: false,
		data: data,
		statusCode: {
			200: function (result) {
				if (mostrar_loading) {
					//$.isLoading( "hide" );
				}
				if (callback != "") {
					var call = $.Callbacks();
					call.add(callback);
					call.fire(result);
				}
			},
			401: code400,
			404: code404,
			500: code500,
			409: code409,
		},
	});
};

var ErrorCustom = function (mensaje, callback) {
	if (mensaje == "" || mensaje == undefined)
		mensaje = "<span>Ocurrió un error al procesar la petición</span>";
	else mensaje = "<span>" + mensaje + "</span>";
	bootbox.dialog({
		message: mensaje,
		closeButton: false,
		buttons: {
			danger: {
				label: "<i class='icon-remove'></i> Cerrar",
				className: "btn-sm btn-danger",
				callback: function () {
					if (callback != "") {
						var call = $.Callbacks();
						call.add(callback);
						call.fire();
					}
				},
			},
		},
	});
};
var ExitoCustom = function (mensaje, callback, nombre_boton = "") {
	if (nombre_boton == "") {
		var cerrar = "Cerrar";
	} else {
		cerrar = nombre_boton;
	}
	if (mensaje == "" || mensaje == undefined)
		mensaje = "<span>Los datos han sido guardados con éxito</span>";
	else mensaje = "<span>" + mensaje + "</span>";
	bootbox.dialog({
		message: mensaje,
		closeButton: false,
		buttons: {
			success: {
				label: "<i class='icon-remove'></i> " + cerrar,
				className: "btn-sm btn-success",
				callback: function () {
					if (callback != "") {
						var call = $.Callbacks();
						call.add(callback);
						call.fire();
					}
				},
			},
		},
	});
};
totalModal = 0;
var ajaxLoad = function (url, data, div, metod, callback) {
	//$.isLoading({ text: "Cargando..." });
	if (typeof metod === "undefined") metod = "POST";
	$.ajax({
		type: metod,
		datatype: "html",
		url: url,
		data: data,
		cache: false,
		statusCode: {
			200: function (result) {
				//$.isLoading( "hide" );
				$("#" + div).empty();
				$("#" + div).html(result);
				if (callback != "") {
					var call = $.Callbacks("memory once");
					call.add(callback);
					call.fire(result, div);
				}
				//$("#" + div).isLoading("hide");
			},
			401: code400,
			404: code404,
			500: code500,
			409: code409,
		},
	});
};
var customModal = function (
	url,
	data,
	metodo,
	size,
	callbackOk,
	callbackCancel,
	txtBtnOk,
	txtBtnCancel,
	txtTitulo,
	idModal
) {
	totalModal++;
	var btns = {};
	if (txtBtnOk != "") {
		btns.success = {
			label: txtBtnOk,
			className: "btn btn-primary",
			callback: function () {
				if (callbackOk != "") {
					var call = $.Callbacks();
					call.add(callbackOk);
					call.fire();
					return false;
				}
			},
		};
	}
	if (txtBtnCancel != "") {
		btns.danger = {
			label: txtBtnCancel,
			className: "btn btn-secundario",
			callback: function () {
				totalModal--;
				if (callbackCancel != "") {
					var call = $.Callbacks();
					call.add(callbackCancel);
					call.fire();
				}
				if (totalModal > 0) {
					setTimeout(function () {
						$("body").addClass("modal-open");
					}, 500);
				}
			},
		};
	}
	$.ajax({
		url: url,
		type: metodo,
		data: data,
		datatype: "html",
		cache: false,
		statusCode: {
			200: function (response) {
				if (typeof response == "string") {
					bootbox.dialog({
						message: response,
						closeButton: true,
						title: txtTitulo,
						className: idModal,
						buttons: btns,
					});
					if (size != "")
						$("." + idModal)
							.children()
							.addClass("modal-" + size);
				} else {
					if (response.Exito == false) {
						ErrorCustom(response.Mensaje, "");
					} else {
						llamarMaestro(response.Url, response.Parametros);
					}
				}
			},
			401: code400,
			404: code404,
			500: code500,
			409: code409,
		},
	});
};
var ConfirmCustom = function (
	mensaje,
	callbackOk,
	callbackCancel,
	TxtBtnOk,
	TxtBtnFail
) {
	if (TxtBtnOk == "" || TxtBtnOk == undefined) TxtBtnOk = "Aceptar";
	if (TxtBtnFail == "" || TxtBtnFail == undefined) TxtBtnFail = "Cancelar";
	bootbox.dialog({
		message: mensaje,
		closeButton: false,
		buttons: {
			success: {
				label: TxtBtnOk,
				className: "btn-sm btn-success",
				callback: function () {
					if (callbackOk != "") {
						var call = $.Callbacks();
						call.add(callbackOk);
						call.fire();
					}
				},
			},
			danger: {
				label: TxtBtnFail,
				className: "btn-sm btn-danger",
				callback: function () {
					if (callbackCancel != "") {
						var call = $.Callbacks();
						call.add(callbackCancel);
						call.fire();
					}
				},
			},
		},
	});
};

var customHTMLModal = function (
	html,
	size,
	callbackOk,
	callbackCancel,
	txtBtnOk,
	txtBtnCancel,
	txtTitulo,
	idModal
) {
	var btns = {};
	if (txtBtnOk != "") {
		btns.success = {
			label: txtBtnOk,
			className: "btn-sm btn-success",
			callback: function () {
				if (callbackOk != "") {
					var call = $.Callbacks();
					call.add(callbackOk);
					call.fire();
					return false;
				}
			},
		};
	}
	if (txtBtnCancel != "") {
		btns.danger = {
			label: txtBtnCancel,
			className: "btn-sm btn-danger",
			callback: function () {
				if (callbackCancel != "") {
					var call = $.Callbacks();
					call.add(callbackCancel);
					call.fire();
				}
			},
		};
	}
	bootbox.dialog({
		message: html,
		closeButton: true,
		title: txtTitulo,
		className: idModal,
		buttons: btns,
	});
	if (size != "")
		$("." + idModal)
			.children()
			.addClass("modal-" + size);
};
