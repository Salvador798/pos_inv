let tblUsuarios, tblProveedores, tblCategorias, tblMarcas, tblProductos;
document.addEventListener("DOMContentLoaded", function () {
  tblUsuarios = $("#tblUsuarios").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [
      [3, "asc"],
      [2, "asc"],
    ],
    ajax: {
      url: APP_URL + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "usuario",
      },
      {
        data: "nombre",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  // Tabla Proveedores
  tblProveedores = $("#tblProveedores").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [
      [5, "asc"],
      [2, "asc"],
    ],
    ajax: {
      url: APP_URL + "Proveedores/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "rif",
      },
      {
        data: "nombre",
      },
      {
        data: "telefono",
      },
      {
        data: "direccion",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  // Tabla Categorias
  tblCategorias = $("#tblCategorias").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [
      [2, "asc"],
      [1, "asc"],
    ],
    ajax: {
      url: APP_URL + "Categorias/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  // Tabla Marcas
  tblMarcas = $("#tblMarcas").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [
      [2, "asc"],
      [1, "asc"],
    ],
    ajax: {
      url: APP_URL + "Marcas/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  // Tabla Productos
  tblProductos = $("#tblProductos").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [
      [5, "asc"],
      [2, "asc"],
    ],
    ajax: {
      url: APP_URL + "Productos/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "codigo",
      },
      {
        data: "nombre",
      },
      {
        data: "precio_venta",
      },
      {
        data: "cantidad",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
  });
  // Historial de compras
  $("#t_historial_c").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [[2, "desc"]],
    ajax: {
      url: APP_URL + "Compras/listar_historial",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "total",
      },
      {
        data: "fecha",
      },
      {
        data: "acciones",
      },
    ],
  });
  $("#t_historial_v").DataTable({
    language: {
      info: "Mostrando la página _PAGE_ de _PAGES_",
      infoEmpty: "No records available",
      infoFiltered: "(filtrado de _MAX_ registros totales)",
      lengthMenu: "Mostrar _MENU_ Registros por página",
      zeroRecords: "Nada encontrado - Disculpe",
      search: "Buscar",
    },
    order: [[2, "desc"]],
    ajax: {
      url: APP_URL + "Compras/listar_historial_venta",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "total",
      },
      {
        data: "fecha",
      },
      {
        data: "acciones",
      },
    ],
  });
});

// Usuarios
// Mostrar la ventana de Usuario
function frmUsuario() {
  document.getElementById("title").innerHTML = "Registrar Usuario";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("claves").classList.remove("d-none");
  document.getElementById("frmUsuario").reset();
  $("#nuevo_usuario").modal("show");
  document.getElementById("id").value = "";
}
// Registar Usuario
function registrarUser(e) {
  e.preventDefault();
  const usuario = document.getElementById("usuario");
  const nombre = document.getElementById("nombre");
  if (usuario.value == "" || nombre.value == "") {
    alertas("Todos los campos son obligatorios", "warning");
  } else {
    const url = APP_URL + "Usuarios/registrar";
    const frm = document.getElementById("frmUsuario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        $("#nuevo_usuario").modal("hide");
        alertas(res.msg, res.icono);
        tblUsuarios.ajax.reload();
      }
    };
  }
}
// Editar Usuario
function btnEditarUser(id) {
  document.getElementById("title").innerHTML = "Actualizar Usuario";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = APP_URL + "Usuarios/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("usuario").value = res.usuario;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("claves").classList.add("d-none");
      $("#nuevo_usuario").modal("show");
    }
  };
}
// Eliminar Usuario
function btnEliminarUser(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Usuarios/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblUsuarios.ajax.reload();
        }
      };
    }
  });
}
// Ingresar Usuario
function btnIngresarUser(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Usuarios/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblUsuarios.ajax.reload();
        }
      };
    }
  });
}
// Fin Usuario

// Proveedores
// Mostrar la ventana de Proveedor
function frmProveedor() {
  document.getElementById("title").innerHTML = "Registrar Proveedor";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmProveedor").reset();
  $("#nuevo_proveedor").modal("show");
  document.getElementById("id").value = "";
}
// Registar Proveedor
function registrarProve(e) {
  e.preventDefault();
  const rif = document.getElementById("rif");
  const nombre = document.getElementById("nombre");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");
  if (
    rif.value == "" ||
    nombre.value == "" ||
    telefono == "" ||
    direccion.value == ""
  ) {
    alertas("Todos los campos son obligatorios", "warning");
  } else {
    const url = APP_URL + "Proveedores/registrar";
    const frm = document.getElementById("frmProveedor");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        $("#nuevo_proveedor").modal("hide");
        alertas(res.msg, res.icono);
        tblProveedores.ajax.reload();
      }
    };
  }
}
// Editar Proveedor
function btnEditarProve(id) {
  document.getElementById("title").innerHTML = "Actualizar Proveedor";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = APP_URL + "Proveedores/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("rif").value = res.rif;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("telefono").value = res.telefono;
      document.getElementById("direccion").value = res.direccion;
      $("#nuevo_proveedor").modal("show");
    }
  };
}
// Eliminar Proveedor
function btnEliminarProve(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Proveedores/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProveedores.ajax.reload();
        }
      };
    }
  });
}
// Ingresar Proveedord
function btnIngresarProve(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Proveedores/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProveedores.ajax.reload();
        }
      };
    }
  });
}
// Fin Proveedor

// Categoria
// Mostrar la ventana de Categoria
function frmCategoria() {
  document.getElementById("title").innerHTML = "Registrar Categoria";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmCategoria").reset();
  $("#nuevo_categoria").modal("show");
  document.getElementById("id").value = "";
}
// Registar Categoria
function registrarCat(e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre");
  if (nombre.value == "") {
    alertas("El campo Nombre es obligatorio", "warning");
  } else {
    const url = APP_URL + "Categorias/registrar";
    const frm = document.getElementById("frmCategoria");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        $("#nuevo_categoria").modal("hide");
        alertas(res.msg, res.icono);
        tblCategorias.ajax.reload();
      }
    };
  }
}
// Editar Categoria
function btnEditarCat(id) {
  document.getElementById("title").innerHTML = "Actualizar Categoria";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = APP_URL + "Categorias/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.nombre;
      $("#nuevo_categoria").modal("show");
    }
  };
}
// Eliminar Categoria
function btnEliminarCat(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Categorias/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblCategorias.ajax.reload();
        }
      };
    }
  });
}
// Ingresar Categoria
function btnIngresarCat(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Categorias/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblCategorias.ajax.reload();
        }
      };
    }
  });
}
// Fin Categoria

// Marcas
// Mostrar la ventana de Marcas
function frmMarca() {
  document.getElementById("title").innerHTML = "Registrar Marca";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmMarca").reset();
  $("#nuevo_marca").modal("show");
  document.getElementById("id").value = "";
}
// Registar Marca
function registrarMar(e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre");
  if (nombre.value == "") {
    alertas("El campo Nombre es obligatorio", "warning");
  } else {
    const url = APP_URL + "Marcas/registrar";
    const frm = document.getElementById("frmMarca");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        $("#nuevo_marca").modal("hide");
        alertas(res.msg, res.icono);
        tblMarcas.ajax.reload();
      }
    };
  }
}
// Editar Marca
function btnEditarMar(id) {
  document.getElementById("title").innerHTML = "Actualizar Marca";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = APP_URL + "Marcas/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("nombre").value = res.nombre;
      $("#nuevo_marca").modal("show");
    }
  };
}
// Eliminar Proveedor
function btnEliminarMar(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Marcas/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblMarcas.ajax.reload();
        }
      };
    }
  });
}
// Ingresar Proveedord
function btnIngresarMar(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Marcas/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblMarcas.ajax.reload();
        }
      };
    }
  });
}
// Fin Proveedor

// Productos
// Mostrar la ventana de Producto
function frmProducto() {
  document.getElementById("title").innerHTML = "Registrar Producto";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmProducto").reset();
  document.getElementById("id").value = "";
  $("#nuevo_producto").modal("show");
}
// Registar Producto
function registrarPro(e) {
  e.preventDefault();
  const codigo = document.getElementById("codigo");
  const nombre = document.getElementById("nombre");
  const precio_compra = document.getElementById("precio_compra");
  const precio_venta = document.getElementById("precio_venta");
  const id_marca = document.getElementById("marca");
  const id_cat = document.getElementById("categoria");
  if (
    codigo.value == "" ||
    nombre.value == "" ||
    precio_compra == "" ||
    precio_venta == ""
  ) {
    alertas("Todos los campos son obligatorios", "warning");
  } else {
    const url = APP_URL + "Productos/registrar";
    const frm = document.getElementById("frmProducto");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        $("#nuevo_producto").modal("hide");
        alertas(res.msg, res.icono);
        tblProductos.ajax.reload();
      }
    };
  }
}
// Editar Producto
function btnEditarPro(id) {
  document.getElementById("title").innerHTML = "Actualizar Producto";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = APP_URL + "Productos/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("codigo").value = res.codigo;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("precio_compra").value = res.precio_compra;
      document.getElementById("precio_venta").value = res.precio_venta;
      document.getElementById("marca").value = res.id_marca;
      document.getElementById("categoria").value = res.id_categoria;
      $("#nuevo_producto").modal("show");
    }
  };
}
// Eliminar Producto
function btnEliminarPro(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Productos/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProductos.ajax.reload();
        }
      };
    }
  });
}
// Ingresar Producto
function btnIngresarPro(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Productos/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblProductos.ajax.reload();
        }
      };
    }
  });
}
// Fin Productos

// Entrada
// Buscar Producto por código de barra
function buscarCodigo(e) {
  e.preventDefault();
  const cod = document.getElementById("codigo").value;
  if (cod != "") {
    if (e.which == 13) {
      const url = APP_URL + "Compras/buscarCodigo/" + cod;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res) {
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("precio").value = res.precio_compra;
            document.getElementById("id").value = res.id;
            document.getElementById("cantidad").removeAttribute("disabled");
            document.getElementById("cantidad").focus();
          } else {
            alertas("El Producto no existe", "warning");
            document.getElementById("codigo").value = "";
            document.getElementById("codigo").focus();
          }
        }
      };
    }
  } else {
    alertas("Ingrese el código", "warning");
  }
}

// Salida
// Buscar Producto por código de barra
function buscarCodigoVenta(e) {
  e.preventDefault();
  const cod = document.getElementById("codigo").value;
  if (cod != "") {
    if (e.which == 13) {
      const url = APP_URL + "Compras/buscarCodigo/" + cod;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res) {
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("precio").value = res.precio_venta;
            document.getElementById("id").value = res.id;
            document.getElementById("cantidad").removeAttribute("disabled");
            document.getElementById("cantidad").focus();
          } else {
            alertas("El Producto no existe", "warning");
            document.getElementById("codigo").value = "";
            document.getElementById("codigo").focus();
          }
        }
      };
    }
  } else {
    alertas("Ingrese el código", "warning");
  }
}

// Calcular el precio de la entrada
function calcularPrecio(e) {
  e.preventDefault();
  const cant = document.getElementById("cantidad").value;
  const precio = document.getElementById("precio").value;
  document.getElementById("sub_total").value = precio * cant;
  if (e.which == 13) {
    if (cant > 0) {
      const url = APP_URL + "Compras/ingresar";
      const frm = document.getElementById("frmCompra");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          frm.reset();
          cargarDetalle();
          document
            .getElementById("cantidad")
            .setAttribute("disabled", "disabled");
          document.getElementById("codigo").focus();
        }
      };
    }
  }
}

// Calcular el precio de la salida
function calcularPrecioVenta(e) {
  e.preventDefault();
  const cant = document.getElementById("cantidad").value;
  const precio = document.getElementById("precio").value;
  document.getElementById("sub_total").value = precio * cant;
  if (e.which == 13) {
    if (cant > 0) {
      const url = APP_URL + "Compras/ingresarVenta";
      const frm = document.getElementById("frmVenta");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          frm.reset();
          cargarDetalleVenta();
          document
            .getElementById("cantidad")
            .setAttribute("disabled", "disabled");
          document.getElementById("codigo").focus();
        }
      };
    }
  }
}

if (document.getElementById("tblDetalle")) {
  cargarDetalle();
}
if (document.getElementById("tblDetalleVenta")) {
  cargarDetalleVenta();
}
function cargarDetalle() {
  const url = APP_URL + "Compras/listar/detalle";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.detalle.forEach((row) => {
        html += `<tr>
        <td>${row["id"]}</td>
        <td>${row["nombre"]}</td>
        <td>${row["cantidad"]}</td>
        <td>${`Bs. ` + row["precio"]}</td>
        <td>${"Bs. " + row["sub_total"]}</td>
        <td>
        <button class="btn btn-danger" type="button" onclick="deleteDetalle(${
          row["id"]
        }, 1)">Eliminar</button>
        </td>
        </tr>`;
      });
      document.getElementById("tblDetalle").innerHTML = html;
      document.getElementById("total").value = `Bs. ${res.total_pagar.total}`;
    }
  };
}

function cargarDetalleVenta() {
  const url = APP_URL + "Compras/listar/detalle_temp";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.detalle.forEach((row) => {
        html += `<tr>
        <td>${row["id"]}</td>
        <td>${row["nombre"]}</td>
        <td>${row["cantidad"]}</td>
        <td>${`Bs. ` + row["precio"]}</td>
        <td>${"Bs. " + row["sub_total"]}</td>
        <td>
        <button class="btn btn-danger" type="button" onclick="deleteDetalle(${
          row["id"]
        }, 2)">Eliminar</button>
        </td>
        </tr>`;
      });
      document.getElementById("tblDetalleVenta").innerHTML = html;
      document.getElementById("total").value = `Bs. ${res.total_pagar.total}`;
    }
  };
}

function deleteDetalle(id, accion) {
  let url;
  if (accion == 1) {
    url = APP_URL + "Compras/delete/" + id;
  } else {
    url = APP_URL + "Compras/deleteVenta/" + id;
  }
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      alertas(res.msg, res.icono);
      if (accion == 1) {
        cargarDetalle();
      } else {
        cargarDetalleVenta();
      }
    }
  };
}

function procesar(accion) {
  Swal.fire({
    title: "Está seguro de realizar la compra?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      let url;
      if (accion == 1) {
        url = APP_URL + "Compras/registrarCompra";
      } else {
        url = APP_URL + "Compras/registrarVenta";
      }
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.msg == "ok") {
            alertas(res.msg, res.icono);
            let ruta;
            if (accion == 1) {
              ruta = APP_URL + "Compras/generarPdf/" + res.id_compra;
            } else {
              ruta = APP_URL + "Compras/generarPdfVenta/" + res.id_venta;
            }
            window.open(ruta);
            setTimeout(() => {
              window.location.reload();
            }, 3000);
          } else {
            alertas(res.msg, res.icono);
          }
        }
      };
    }
  });
}

// Modificar Empresa
function modificarEmpresa() {
  const frm = document.getElementById("frmEmpresa");
  const url = APP_URL + "Administracion/modificar";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        alert("modificado");
      }
    }
  };
}

function alertas(mensaje, icono) {
  Swal.fire({
    position: "top-end",
    icon: icono,
    title: mensaje,
    showConfirmButton: false,
    timer: 3000,
  });
}
