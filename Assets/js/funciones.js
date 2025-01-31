let tblUsuarios,
  tblProveedores,
  tblCategorias,
  tblMarcas,
  tblRepuestos,
  tblHEntradas,
  tblHSalidas,
  tblBitacora;

document.addEventListener("DOMContentLoaded", function () {
  tblReposicion = $("#tblReposicion").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [1, "asc"],
      [0, "asc"],
    ],
    ajax: {
      url: APP_URL + "Repuestos/reposicion",
      dataSrc: "",
    },
    columns: [
      {
        data: "codigo",
      },
      {
        data: "nombre",
      },
      {
        data: "cantidad",
      },
      {
        data: "c_minimo",
      },
      {
        data: "marca",
      },
      {
        data: "categoria",
      },
    ],
  });

  tblUsuarios = $("#tblUsuarios").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [4, "asc"],
      [0, "asc"],
    ],
    ajax: {
      url: APP_URL + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "ci",
      },
      {
        data: "usuario",
      },
      {
        data: "nombre",
      },
      {
        data: "apellido",
      },
      {
        data: "rol",
      },
      {
        data: "estado",
      },
      {
        data: "acciones",
      },
    ],
    initComplete: function () {
      // Aplica el filtro inicial para la columna "Estado" (índice 8)
      initialFilter(this.api(), 5, "^Activo$");
    },
  });

  // Tabla Proveedores
  tblProveedores = $("#tblProveedores").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [4, "asc"],
      [1, "asc"],
    ],
    ajax: {
      url: APP_URL + "Proveedores/listar",
      dataSrc: "",
    },
    columns: [
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
    initComplete: function () {
      // Aplica el filtro inicial para la columna "Estado" (índice 8)
      initialFilter(this.api(), 4, "^Activo$");
    },
  });

  // Tabla Categorias
  tblCategorias = $("#tblCategorias").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [1, "asc"],
      [0, "asc"],
    ],
    ajax: {
      url: APP_URL + "Categorias/listar",
      dataSrc: "",
    },
    columns: [
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
    initComplete: function () {
      // Aplica el filtro inicial para la columna "Estado" (índice 8)
      initialFilter(this.api(), 1, "^Activo$");
    },
  });

  // Tabla Marcas
  tblMarcas = $("#tblMarcas").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [2, "asc"],
      [0, "asc"],
    ],
    ajax: {
      url: APP_URL + "Marcas/listar",
      dataSrc: "",
    },
    columns: [
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
    initComplete: function () {
      // Aplica el filtro inicial para la columna "Estado" (índice 8)
      initialFilter(this.api(), 1, "^Activo$");
    },
  });
  applyFilter(tblMarcas, 1, "#estFilter");

  // Tabla Repuestos
  tblRepuestos = $("#tblRepuestos").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [6, "asc"],
      [1, "asc"],
    ],
    ajax: {
      url: APP_URL + "Repuestos/listar",
      dataSrc: "",
    },
    columns: [
      {
        data: "codigo",
      },
      {
        data: "nombre",
      },
      {
        data: "marca",
      },
      {
        data: "categoria",
      },
      {
        data: "precio_venta",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `$ ${formattedPrice}`;
          }
          return data;
        },
      },
      {
        data: "precio_venta_dolar",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `Bs ${formattedPrice}`;
          }
          return data;
        },
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
    initComplete: function () {
      // Aplica el filtro inicial para la columna "Estado" (índice 8)
      initialFilter(this.api(), 7, "^Activo$");
    },
  });

  // Historial de compras
  $("#t_historial_c").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [[3, "desc"]],
    ajax: {
      url: APP_URL + "Entradas/listar_historial",
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
        data: "total",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `${formattedPrice} Bs`;
          }
          return data;
        },
      },
      {
        data: "fecha",
      },
      {
        data: "acciones",
      },
    ],
  });

  // Tabla Historial General Entradas
  tblHEntradas = $("#tblHEntradas").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [[7, "desc"]],
    ajax: {
      url: APP_URL + "Entradas/listar_historial_g",
      dataSrc: "",
    },
    columns: [
      {
        data: "repuesto",
      },
      {
        data: "proveedor",
      },
      {
        data: "marca",
      },
      {
        data: "categoria",
      },
      {
        data: "precio",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `${formattedPrice} Bs`;
          }
          return data;
        },
      },
      {
        data: "cantidad",
      },
      {
        data: "sub_total",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `${formattedPrice} Bs`;
          }
          return data;
        },
      },
      {
        data: "fecha_entrada",
      },
    ],
  });

  $("#t_historial_v").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [[2, "desc"]],
    ajax: {
      url: APP_URL + "Entradas/listar_historial_salida",
      dataSrc: "",
    },
    columns: [
      {
        data: "id",
      },
      {
        data: "total",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `${formattedPrice} Bs`;
          }
          return data;
        },
      },
      {
        data: "fecha",
      },
      {
        data: "acciones",
      },
    ],
  });

  // Tabla Historial General Salidas
  tblHSalidas = $("#tblHSalidas").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [
      [7, "desc"],
      [0, "desc"],
    ],
    ajax: {
      url: APP_URL + "Entradas/listar_historial_salidas_g",
      dataSrc: "",
    },
    columns: [
      {
        data: "ref",
      },
      {
        data: "repuesto",
      },
      {
        data: "marca",
      },
      {
        data: "categoria",
      },
      {
        data: "precio_venta_dolar",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `${formattedPrice} Bs`;
          }
          return data;
        },
      },
      {
        data: "cantidad",
      },
      {
        data: "sub_total_dolar",
        render: function (data, type, row) {
          if (type === "display") {
            const formattedPrice = numberFormat(data, 2, ",", ".");
            return `${formattedPrice} Bs`;
          }
          return data;
        },
      },
      {
        data: "fecha",
      },
    ],
  });

  tblBitacora = $("#tblBitacora").DataTable({
    language: {
      url: APP_URL + "Assets/js/es-ES.json",
    },
    order: [[4, "desc"]],
    ajax: {
      url: APP_URL + "Usuarios/listar_bitacora",
      dataSrc: "",
    },
    columns: [
      {
        data: "usuario",
      },
      {
        data: "modulo",
      },
      {
        data: "accion",
      },
      {
        data: "detalle",
      },
      {
        data: "fecha",
      },
    ],
  });

  // Aplicar filtros simples
  applyFilter(tblUsuarios, tableFiltersConfig.tblUsuarios.estado, "#estFilter");
  applyFilter(tblUsuarios, tableFiltersConfig.tblUsuarios.rol, "#rolFilter");
  applyFilter(
    tblProveedores,
    tableFiltersConfig.tblProveedores.estado,
    "#estFilter"
  );
  applyFilter(
    tblCategorias,
    tableFiltersConfig.tblCategorias.estado,
    "#estFilter"
  );
  applyFilter(tblMarcas, tableFiltersConfig.tblMarcas.estado, "#estFilter");
  applyFilter(
    tblRepuestos,
    tableFiltersConfig.tblRepuestos.estado,
    "#estFilter"
  );

  // Aplicar filtros múltiples
  applyMultipleFilters(
    tblRepuestos,
    "marca",
    tableFiltersConfig.tblRepuestos.marca,
    "#filter-marca"
  );
  applyMultipleFilters(
    tblRepuestos,
    "categoria",
    tableFiltersConfig.tblRepuestos.categoria,
    "#filter-categoria"
  );
});

const tableFiltersConfig = {
  tblUsuarios: { estado: 5, rol: 4 },
  tblProveedores: { estado: 4 },
  tblCategorias: { estado: 1 },
  tblMarcas: { estado: 5 },

  tblRepuestos: {
    estado: 6,
    marca: 2,
    categoria: 3,
  },
};

// Filtro inicial por defecto
function initialFilter(api, columnIndex, filterValue) {
  if (api && api.column) {
    api.column(columnIndex).search(filterValue, true, false).draw();
  } else {
    console.error("La API de DataTable no está inicializada correctamente.");
  }
}

// Objeto para almacenar los filtros activos
const activeFilters = {
  marca: [],
  categoria: [],
};

// Botón para limpiar todos los filtros
$("#clear-filters").on("click", function () {
  clearAllFilters(tblRepuestos, [
    "#estFilter",
    "#filter-marca",
    "#filter-categoria",
  ]);
});

// Función para aplicar un filtro simple
function applyFilter(table, columnIndex, filterSelector) {
  $(filterSelector).on("change", function () {
    const value = $(this).val();
    table
      .column(columnIndex)
      .search(value ? `^${value}$` : "", true, false)
      .draw();
  });
}

// Función para manejar múltiples filtros (marca y categoría)
function applyMultipleFilters(table, filterType, columnIndex, filterSelector) {
  $(filterSelector).on("change", function () {
    const value = $(this).val();
    if (value) {
      // Agregar filtro al array si no está ya presente
      if (!activeFilters[filterType].includes(value)) {
        activeFilters[filterType].push(value);
        renderActiveFilters(); // Renderizar filtros activos
        updateTableFilters(table, filterType, columnIndex); // Actualizar la tabla
        console.log(activeFilters);
      }
      $(this).val(""); // Resetea el select
    }
  });

  // Manejar la eliminación de filtros activos
  $("#active-filters").on("click", ".remove-filter", function () {
    const filterType = $(this).parent().data("filter-type");
    const filterValue = $(this).parent().data("filter-value");

    // Depuración: Verificar qué tipo y valor de filtro estamos intentando eliminar
    console.log("Eliminando filtro:", filterType, filterValue);

    // Verificamos si la clave existe en activeFilters
    if (filterType && activeFilters[filterType]) {
      console.log(
        `Filtro ${filterType} existe en activeFilters:`,
        activeFilters[filterType]
      );

      activeFilters[filterType] = activeFilters[filterType].filter(
        (v) => v !== filterValue
      );

      // Después de eliminar, renderizamos los filtros activos
      renderActiveFilters();

      // Actualizamos los filtros en la tabla
      updateTableFilters(
        tblRepuestos,
        filterType,
        tableFiltersConfig.tblRepuestos[filterType]
      );
    } else {
      console.error(
        `El tipo de filtro "${filterType}" no existe en activeFilters.`
      );
    }
  });
}

// Función para actualizar la tabla con los filtros activos
function updateTableFilters(table, filterType, columnIndex) {
  const filterValues = activeFilters[filterType];
  let regex = "";

  // Si hay filtros activos, crea un regex para buscar esos valores
  if (filterValues.length > 0) {
    regex = filterValues.map((v) => `^${v}$`).join("|");
  }

  table.column(columnIndex).search(regex, true, false).draw();
}

// Renderizar filtros activos en el HTML
function renderActiveFilters() {
  $("#active-filters").empty();
  console.log("Filtros activos:", activeFilters);

  Object.entries(activeFilters).forEach(([filterType, values]) => {
    values.forEach((value) => {
      console.log("Generando filtro:", filterType, value);
      $("#active-filters").append(`
        <div class="filter-badge" data-filter-type="${filterType}" data-filter-value="${value}">
          <span>${
            filterType === "marca" ? "Marca" : "Categoría"
          }: ${value}</span>
          <span class="remove-filter" style="cursor: pointer; color: red;" >x</span>
        </div>
      `);
    });
  });
}

// Función para limpiar todos los filtros
function clearAllFilters(table, filterSelectors) {
  filterSelectors.forEach((selector) => {
    $(selector).val(""); // Resetea los selectores
  });

  // Limpiar los filtros activos
  Object.keys(activeFilters).forEach((key) => {
    activeFilters[key] = [];
  });

  // Volver a renderizar los filtros activos
  renderActiveFilters();

  // Limpiar todos los filtros en la tabla
  table.columns().search("").draw();
}

function dateFilter(tableIds, dateColumnIndex) {
  const startDateInput = document.getElementById("startDate");
  const endDateInput = document.getElementById("endDate");

  // Obtener la fecha actual (sin hora, al final del día)
  const today = new Date();
  today.setHours(23, 59, 59, 999); // Ajustar al final del día
  const todayStr = today.toISOString().split("T")[0]; // Formato YYYY-MM-DD

  // Calcular la fecha de hace 3 meses (al inicio del día)
  const threeMonthsAgo = new Date(today);
  threeMonthsAgo.setMonth(today.getMonth() - 3);
  threeMonthsAgo.setHours(0, 0, 0, 0); // Ajustar al inicio del día
  const threeMonthsAgoStr = threeMonthsAgo.toISOString().split("T")[0];

  // Establecer las fechas por defecto
  startDateInput.value = threeMonthsAgoStr;
  endDateInput.value = todayStr;

  // Establecer restricciones (máximo y mínimo)
  startDateInput.setAttribute("max", todayStr);
  endDateInput.setAttribute("max", todayStr);
  endDateInput.setAttribute("min", threeMonthsAgoStr);

  // Validaciones dinámicas de los campos
  startDateInput.addEventListener("change", function () {
    const startDate = startDateInput.value;
    if (startDate) {
      endDateInput.setAttribute("min", startDate);
    } else {
      endDateInput.setAttribute("min", threeMonthsAgoStr);
    }
    if (
      endDateInput.value &&
      new Date(endDateInput.value) < new Date(startDate)
    ) {
      endDateInput.value = ""; // Resetea si la fecha final es inválida
    }
  });

  endDateInput.addEventListener("change", function () {
    const endDate = endDateInput.value;
    if (endDate) {
      startDateInput.setAttribute("max", endDate);
    } else {
      startDateInput.setAttribute("max", todayStr);
    }
    if (
      startDateInput.value &&
      new Date(startDateInput.value) > new Date(endDate)
    ) {
      startDateInput.value = ""; // Resetea si la fecha inicial es inválida
    }
  });

  // Filtro personalizado para DataTables
  $.fn.dataTable.ext.search.push(function (settings, data) {
    // Verificar si el filtro se aplica a las tablas indicadas
    if (!tableIds.includes(settings.nTable.id)) {
      return true;
    }

    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
    const rowDate = new Date(data[dateColumnIndex]); // Índice de la columna de fecha

    // Asegurarnos de que las fechas solo se comparen por el día (sin hora)
    startDate.setHours(0, 0, 0, 0); // Inicio del día
    endDate.setHours(23, 59, 59, 999); // Final del día
    rowDate.setHours(0, 0, 0, 0); // Comparar solo la fecha

    // Validar el rango de fechas
    if ((startDate && rowDate < startDate) || (endDate && rowDate > endDate)) {
      return false;
    }
    return true;
  });

  // Evento para redibujar las tablas cuando cambian las fechas
  $("#startDate, #endDate").on("change", function () {
    tableIds.forEach(function (tableId) {
      const table = $("#" + tableId).DataTable(); // Obtener la instancia de DataTable
      table.draw(); // Redibujar la tabla
    });
  });
}

// Formatear el precio a Bs
function numberFormat(number, decimals, decPoint, thousandsSep) {
  if (number == null || !isFinite(number)) {
    throw new TypeError("El número no es válido");
  }

  if (!decimals) {
    const len = number.toString().split(".").length;
    decimals = len > 1 ? len : 0;
  }

  if (!decPoint) {
    decPoint = ".";
  }

  if (!thousandsSep) {
    thousandsSep = ",";
  }

  number = parseFloat(number).toFixed(decimals);
  number = number.replace(".", decPoint);

  const splitNum = number.split(decPoint);
  splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);

  return splitNum.join(decPoint);
}

// Usuarios
// Mostrar la ventana de Usuario
function frmUsuario() {
  document.getElementById("title").innerHTML = "Registrar Usuario";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("claves").classList.remove("d-none");
  document.getElementById("frmUsuario").reset();
  $("#nuevo_usuario").modal("show");
  document.getElementById("id").value = "";

  const inputs = [
    { id: "ci", limite: 8, tipo: "n" },
    { id: "usuario", limite: 20, tipo: "ln" },
    { id: "nombre", limite: 20, tipo: "l" },
    { id: "apellido", limite: 20, tipo: "l" },
  ];
  inputs.forEach((input) => {
    const element = document.getElementById(input.id);
    element.onkeydown = function (event) {
      validate(event, this, input.limite, input.tipo);
    };
  });
}
// Registar Usuario
function registrarUser(e) {
  e.preventDefault();
  const ci = document.getElementById("ci");
  const usuario = document.getElementById("usuario");
  const nombre = document.getElementById("nombre");
  const apellido = document.getElementById("apellido");
  const rol = document.getElementById("rol");
  if (
    ci.value == "" ||
    usuario.value == "" ||
    nombre.value == "" ||
    apellido.value == ""
  ) {
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
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = APP_URL + "Usuarios/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("ci").value = res.ci;
      document.getElementById("usuario").value = res.usuario;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("apellido").value = res.apellido;
      document.getElementById("claves").classList.add("d-none");
      document.getElementById("rol").value = res.rol;
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
    confirmButtonText: "Si",
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
    confirmButtonText: "Si",
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
  const inputs = [
    { id: "rif", limite: 9, tipo: "n" },
    { id: "nombre", limite: 50, tipo: "ln" },
    { id: "telefono", limite: 11, tipo: "n" },
  ];

  inputs.forEach((input) => {
    const element = document.getElementById(input.id);
    element.onkeydown = function (event) {
      validate(event, this, input.limite, input.tipo);
    };
  });
}
// Registar Proveedor
function registrarProve(e) {
  e.preventDefault();
  const tRif = document.getElementById("tRif");
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
    const frm = new FormData(document.getElementById("frmProveedor"));
    frm.set("rif", tRif.value + rif.value);
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(frm);
    http.onreadystatechange = function () {
      if (this.readyState === 4) {
        try {
          if (this.status === 200) {
            const res = JSON.parse(this.responseText);
            $("#nuevo_proveedor").modal("hide");
            alertas(res.msg, res.icono);
            tblProveedores.ajax.reload();
          } else {
            console.error("Error en la respuesta HTTP:", this.responseText);
            alertas("Error en la solicitud: " + this.status, "error");
          }
        } catch (error) {
          console.error("Respuesta no válida del servidor:", this.responseText);
          alertas("El servidor devolvió una respuesta no válida.", "error");
        }
      }
    };
  }
}

// Editar Proveedor
function btnEditarProve(id) {
  document.getElementById("title").innerHTML = "Actualizar Proveedor";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = APP_URL + "Proveedores/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);

      const rifCompleto = res.rif;
      const prefijo = rifCompleto.substring(0, 2);
      const numeroRif = rifCompleto.substring(2);

      // Llenar los campos del formulario
      document.getElementById("id").value = res.id;
      document.getElementById("tRif").value = prefijo;
      document.getElementById("rif").value = numeroRif;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("telefono").value = res.telefono;
      document.getElementById("direccion").value = res.direccion;

      // Mostrar modal
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
    confirmButtonText: "Si",
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
    confirmButtonText: "Si",
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
  const inputs = [{ id: "nombre", limite: 20, tipo: "l" }];

  inputs.forEach((input) => {
    const element = document.getElementById(input.id);
    element.onkeydown = function (event) {
      validate(event, this, input.limite, input.tipo);
    };
  });
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
  document.getElementById("btnAccion").innerHTML = "Actualizar";
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
    confirmButtonText: "Si",
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
    confirmButtonText: "Si",
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
  const inputs = [{ id: "nombre", limite: 20, tipo: "l" }];

  inputs.forEach((input) => {
    const element = document.getElementById(input.id);
    element.onkeydown = function (event) {
      validate(event, this, input.limite, input.tipo);
    };
  });
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
  document.getElementById("btnAccion").innerHTML = "Actualizar";
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
// Eliminar Marca
function btnEliminarMar(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
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
// Ingresar Marca
function btnIngresarMar(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
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
// Fin Marca

// Repuestos
// Mostrar la ventana de Repuesto
function frmRepuesto() {
  // Actualización de los elementos de la interfaz
  const title = document.getElementById("title");
  const btnAccion = document.getElementById("btnAccion");
  const form = document.getElementById("frmRepuesto");
  const codigo = document.getElementById("codigo");
  codigo.parentElement.style.display = "block";
  codigo.disabled = true;
  document.getElementById("precio_compra").parentElement.style.display = "none";
  document.getElementById("precio_venta").parentElement.style.display = "none";

  const inputs = [
    { id: "codigo", limite: 8, tipo: "ln" },
    { id: "nombre", limite: 30, tipo: "ln" },
    { id: "stock_minimo", limite: 10, tipo: "n" },
  ];

  title.innerHTML = "Registrar Repuesto";
  btnAccion.innerHTML = "Registrar";
  form.reset();
  form.id.value = "";
  $("#nuevo_repuesto").modal("show");

  inputs.forEach(({ id, limite, tipo }) => {
    document.getElementById(id).onkeydown = (event) =>
      validate(event, event.target, limite, tipo);
  });

  ["nombre", "marca", "categoria"].forEach((id) => {
    document.getElementById(id).oninput = generarCodigo;
  });
}

// Registar Repuesto
function registrarRep(e) {
  e.preventDefault();
  const codigo = document.getElementById("codigo");
  const nombre = document.getElementById("nombre");
  const precio_compra = document.getElementById("precio_compra");
  const precio_venta = document.getElementById("precio_venta");
  const c_minimo = document.getElementById("stock_minimo");
  const id_marca = document.getElementById("marca");
  const id_cat = document.getElementById("categoria");
  if (codigo.value == "" || c_minimo.value == "" || nombre.value == "") {
    alertas("Todos los campos son obligatorios", "warning");
  } else {
    codigo.disabled = false;
    const url = APP_URL + "Repuestos/registrar";
    const frm = document.getElementById("frmRepuesto");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4) {
        if (this.status == 200) {
          try {
            const res = JSON.parse(this.responseText);
            $("#nuevo_repuesto").modal("hide");
            alertas(res.msg, res.icono);
            tblRepuestos.ajax.reload();
          } catch (error) {
            console.error("Error al parsear JSON:", error);
            console.error("Respuesta recibida:", this.responseText);
          }
        } else {
          console.error("Error en la petición:", this.status, this.statusText);
          console.log("Respuesta recibida:", this.responseText);
        }
      }
    };
  }
}

function generarCodigo() {
  const nombre = document.getElementById("nombre").value.toUpperCase();
  const marca = document.getElementById("marca").selectedOptions[0].text;
  const categoria =
    document.getElementById("categoria").selectedOptions[0].text;
  const idRep = document.getElementById("id").value;
  const button = document.getElementById("btnAccion");
  button.disabled = true;
  button.classList.add("disabled");
  if (nombre && marca && categoria) {
    const codigoBase = `AE-${nombre.charAt(0)}${marca.charAt(
      0
    )}${categoria.charAt(0)}`;

    fetch(APP_URL + "Repuestos/buscarCod", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ codigoBase: codigoBase, idRep: idRep }),
    })
      .then((response) => response.json())
      .then((data) => {
        const numero = data.numero;
        const codigo = `${codigoBase}${numero}`;
        document.getElementById("codigo").value = codigo;
        button.disabled = false;
        button.classList.remove("disabled");
      })
      .catch((error) => console.error("Error:", error));
  }
}

// Editar Repuesto
function btnEditarRep(id) {
  document.getElementById("title").innerHTML = "Actualizar Repuesto";
  document.getElementById("btnAccion").innerHTML = "Actualizar";
  const url = APP_URL + "Repuestos/editar/" + id;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id;
      document.getElementById("codigo").value = res.codigo;
      codigo.parentElement.style.display = "block";
      codigo.disabled = true;
      document.getElementById("nombre").value = res.nombre;
      document.getElementById("precio_compra").value = res.precio_compra;
      document.getElementById("precio_venta").value = res.precio_venta;
      document.getElementById("stock_minimo").value = res.c_minimo;
      document.getElementById("marca").value = res.id_marca;
      document.getElementById("categoria").value = res.id_categoria;
      const precioCompra = document.getElementById("precio_compra");
      const precioVenta = document.getElementById("precio_venta");
      precioCompra.parentElement.style.display = "block";
      precioVenta.parentElement.style.display = "block";
      precioCompra.disabled = true;
      $("#nuevo_repuesto").modal("show");
      ["nombre", "marca", "categoria"].forEach((id) => {
        document.getElementById(id).oninput = generarCodigo;
      });
    }
  };
}
// Eliminar Repuesto
function btnEliminarRep(id) {
  Swal.fire({
    title: "Está seguro de desactivar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Repuestos/eliminar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblRepuestos.ajax.reload();
        }
      };
    }
  });
}
// Ingresar Repuesto
function btnIngresarRep(id) {
  Swal.fire({
    title: "Está seguro de activar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = APP_URL + "Repuestos/reingresar/" + id;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          tblRepuestos.ajax.reload();
        }
      };
    }
  });
}
// Fin Repuestos

// Entrada
// Buscar Repuesto por código de barra
function buscarCodigo(e) {
  e.preventDefault();
  const cod = document.getElementById("codigo").value;
  if (cod != "") {
    if (e.which == 13) {
      const url = APP_URL + "Entradas/buscarCodigo/" + cod;
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
            alertas("El Repuesto no Existe o no Está Disponible", "warning");
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
function buscarCodigoSalida(e) {
  e.preventDefault();
  const cod = document.getElementById("codigo").value;
  if (cod != "") {
    if (e.which == 13) {
      const url = APP_URL + "Entradas/buscarCodigo/" + cod;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res) {
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("precio").value = res.precio_venta_dolar;
            document.getElementById("id").value = res.id;
            document.getElementById("cantidad").removeAttribute("disabled");
            document.getElementById("cantidad").focus();
          } else {
            alertas("El Repuesto no Existe o no Está Disponible", "warning");
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

function moverFocoAPrecio(e) {
  const cant = document.getElementById("cantidad").value;
  const precio = document.getElementById("precio").value;
  document.getElementById("sub_total").value = precio * cant;

  if (e.which == 13) {
    e.preventDefault();
    document.getElementById("precio").focus();
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
      const url = APP_URL + "Entradas/ingresar";
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
function calcularPrecioSalida(e) {
  e.preventDefault();
  const cant = document.getElementById("cantidad").value;
  const precio = document.getElementById("precio").value;
  document.getElementById("sub_total").value = precio * cant;
  if (e.which == 13) {
    if (cant > 0) {
      const url = APP_URL + "Entradas/ingresarSalida";
      const frm = document.getElementById("frmVenta");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          frm.reset();
          cargarDetalleSalida();
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
if (document.getElementById("tblDetalleSalida")) {
  cargarDetalleSalida();
}
function cargarDetalle() {
  const url = APP_URL + "Entradas/listar/detalle";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      let html = "";
      res.detalle.forEach((row) => {
        html += `<tr>
        <td>${row["codigo"]}</td>
        <td>${row["nombre"]}</td>
        <td>${row["cantidad"]}</td>
        <td>${`Bs ` + row["precio"]}</td>
        <td>${"Bs " + row["sub_total"]}</td>
        <td>
        <button class="btn btn-danger" type="button" onclick="deleteDetalle(${
          row["id"]
        }, 1)">Eliminar</button>
        </td>
        </tr>`;
      });
      document.getElementById("tblDetalle").innerHTML = html;
      // Perform the division
      const totalPagar = res.total_pagar.total;
      const precioDolar = res.detalle[0]?.precio_dolar || 1; // Default to 1 to avoid division by zero
      const totalDividido = totalPagar / precioDolar;

      document.getElementById("total").value = `Bs ${totalDividido.toFixed(2)}`;
    }
  };
}

function cargarDetalleSalida() {
  const url = APP_URL + "Entradas/listar/detalle_temp";
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.detalle.forEach((row) => {
        html += `<tr>
        <td>${row["codigo"]}</td>
        <td>${row["nombre"]}</td>
        <td>${row["cantidad"]}</td>
        <td>${`Bs ` + (row["precio"] * row["precio_dolar"]).toFixed(2)}</td>
        <td>${"Bs " + (row["sub_total"] * row["precio_dolar"]).toFixed(2)}</td>
        <td>
        <button class="btn btn-danger" type="button" onclick="deleteDetalle(${
          row["id"]
        }, 2)">Eliminar</button>
        </td>
        </tr>`;
      });
      document.getElementById("tblDetalleSalida").innerHTML = html;
      document.getElementById("total").value = `Bs ${res.total_pagar.total}`;
    }
  };
}

function deleteDetalle(id, accion) {
  let url;
  if (accion == 1) {
    url = APP_URL + "Entradas/delete/" + id;
  } else {
    url = APP_URL + "Entradas/deleteSalida/" + id;
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
        cargarDetalleSalida();
      }
    }
  };
}

function procesar(accion) {
  const item = accion === 1 ? "Entrada" : "Salida";
  Swal.fire({
    title: `Está seguro de realizar la ${item}?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      let url;
      if (accion == 1) {
        const id_proveedor = document.getElementById("proveedor").value;
        url = APP_URL + "Entradas/registrarEntrada/" + id_proveedor;
      } else {
        url = APP_URL + "Entradas/registrarSalida";
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
              ruta = APP_URL + "Entradas/generarPdf/" + res.id_entrada;
            } else {
              ruta = APP_URL + "Entradas/generarPdfSalida/" + res.id_salida;
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
  let color;

  // Define el color según el tipo de icono
  switch (icono) {
    case "success":
      color = "#28a745"; // Verde para éxito
      break;
    case "error":
      color = "#dc3545"; // Rojo para error
      break;
    case "warning":
      color = "#ffc107"; // Amarillo para advertencia
      break;
    case "info":
      color = "#17a2b8"; // Azul para información
      break;
    default:
      color = "#6c757d"; // Gris para otros casos
  }

  Swal.fire({
    position: "top-end",
    icon: icono,
    title: mensaje,
    toast: true,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    background: color, // Establece el color de fondo
    customClass: {
      title: "alert-title", // Clase personalizada para el título
    },
    showClass: {
      popup: "animate__animated animate__fadeInDown", // Animación al aparecer
    },
    hideClass: {
      popup: "animate__animated animate__fadeOutUp", // Animación al desaparecer
    },
  });

  // Aplica el estilo CSS para el texto
  const style = document.createElement("style");
  style.innerHTML = `
    .alert-title {
      color: white !important; // Asegura que el texto sea blanco
    }
  `;
  document.head.appendChild(style);
}

//PDF's
//Repuestos
function btnPDFRepuestos() {
  generatePDF(tblRepuestos, APP_URL + "Repuestos/generarPDF", "Repuestos.pdf");
}

//Entradas
function btnPDFEntradas() {
  generatePDF(tblHEntradas, APP_URL + "Entradas/pdf_entradas");
}

//Salidas
function btnPDFSalidas() {
  generatePDF(tblHSalidas, APP_URL + "Entradas/pdf_salidas");
}

//Proveedores
function btnPDFProve() {
  generatePDF(tblProveedores, APP_URL + "Proveedores/generarPDF");
}

//Marcas
function btnPDFMarcas() {
  generatePDF(tblMarcas, APP_URL + "Marcas/generarPDF");
}

//Categorias
function btnPDFCategorias() {
  generatePDF(tblCategorias, APP_URL + "Categorias/generarPDF");
}

function btnPDFUsuarios() {
  generatePDF(tblUsuarios, APP_URL + "Usuarios/generarPDF");
}

function btnPDFBitacora() {
  generatePDF(tblBitacora, APP_URL + "Usuarios/generarPDFBitacora");
}

function generatePDF(table, apiEndpoint) {
  // Obtener los datos filtrados de la tabla
  const tableData = table.rows({ search: "applied" }).data().toArray();

  // Crear el formulario dinámico
  const form = document.createElement("form");
  form.method = "POST";
  form.action = apiEndpoint; // Endpoint en PHP
  form.target = "_blank";

  // Agregar los datos filtrados como campos ocultos
  const hiddenField = document.createElement("input");
  hiddenField.type = "hidden";
  hiddenField.name = "tableData";
  hiddenField.value = JSON.stringify(tableData);
  form.appendChild(hiddenField);

  // Agregar el formulario al DOM, enviarlo y luego eliminarlo
  document.body.appendChild(form);
  form.submit();
  document.body.removeChild(form);
}

function validate(event, input, limite, tipo) {
  const keyCode = event.keyCode || event.which;
  const tecla = String.fromCharCode(keyCode);
  let regex;

  // Permitir siempre las teclas "Backspace" y de navegación (flechas)
  if (
    keyCode === 8 ||
    keyCode === 37 ||
    keyCode === 38 ||
    keyCode === 39 ||
    keyCode === 40
  ) {
    return;
  }

  switch (tipo) {
    case "l": // Solo letras y espacio
      regex = /^[a-zA-Z\s]+$/;
      if (!regex.test(tecla)) {
        event.preventDefault();
      }
      break;

    case "n": // Solo números (sin decimales ni signo negativo)
      regex = /^[0-9]+$/;
      if (!regex.test(tecla)) {
        event.preventDefault();
      }
      break;

    case "c": // Números y comas
      regex = /^[0-9,]+$/;
      if (!regex.test(tecla)) {
        event.preventDefault();
      }
      const commaCount = input.value.split(",").length - 1;
      if (commaCount > 0 && tecla === ",") {
        event.preventDefault();
      }
      break;

    case "ln": // Letras, números y espacio
      regex = /^[a-zA-Z0-9\s]+$/;
      if (!regex.test(tecla)) {
        event.preventDefault();
      }
      break;
  }

  // Limitar la longitud del campo (excepto si limite es "n/a")
  if (limite !== "n/a" && input.value.length >= limite) {
    if (keyCode !== 8) {
      event.preventDefault();
    }
  }
}

function mayus(e) {
  e.value = e.value.toUpperCase();
}

function manual() {
  const pdfUrl = APP_URL + "Assets/img/Manual de Usuario.pdf";
  window.open(pdfUrl);
}

function modificarDolar() {
  Swal.fire({
    title: "Está seguro de cambiar el precio del Dolar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const frm = document.getElementById("frmDolar");
      const url = APP_URL + "Administracion/getDolar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            alertas("Precio del Dolar actualizado", "success");
          }
        }
      };
    }
  });
}
