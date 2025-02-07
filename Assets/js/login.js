/* Formulario de Login para iniciar sesion */
function frmLogin(e) {
  e.preventDefault();
  let usuario = document.getElementById("usuario");
  let clave = document.getElementById("clave");
  if (usuario.value == "") {
    clave.classList.remove("is-invalid");
    usuario.classList.add("is-invalid");
    usuario.focus();
  } else if (clave.value == "") {
    usuario.classList.remove("is-invalid");
    clave.classList.add("is-invalid");
    clave.focus();
  } else {
    const url = APP_URL + "Usuarios/validar";
    const frm = document.getElementById("frmLogin");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        if (res == "ok") {
          window.location = APP_URL + "Administracion/home";
        } else {
          alertas(res, "warning");
        }
      }
    };
  }
}

function alertas(mensaje, icono) {
  Swal.fire({
    position: "center",
    icon: icono,
    title: mensaje,
    showConfirmButton: false,
    timer: 3000,
  });
}
