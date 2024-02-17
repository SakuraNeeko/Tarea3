// Función para cargar las sucursales desde el servidor
var CargarSucursales = () => {
  var html = "";
  $.get("../../REPOSITORIO-GIT/Tarea2-Sucursales/sucursales.controllers.php?op=todos", (ListaSucursales) => {
    ListaSucursales = JSON.parse(ListaSucursales);
    $.each(ListaSucursales, (index, sucursal) => {
      html += `<tr>
          <td>${sucursal.SucursalId}</td>
          <td>${sucursal.Nombre}</td>
          <td>${sucursal.Direccion}</td>
          <td>${sucursal.Telefono}</td>
          <td>${sucursal.Correo}</td>
          <td>${sucursal.Parroquia}</td>
          <td>${sucursal.Canton}</td>
          <td>${sucursal.Provincia}</td>
          <td>
            <button class='btn btn-primary' onclick='editar(${sucursal.SucursalId})'>Editar</button>
            <button class='btn btn-warning' onclick='eliminar(${sucursal.SucursalId})'>Eliminar</button>
          </td>
        </tr>`;
    });
    $("#tablaSucursales").html(html);
  });
};

// Función para guardar una nueva sucursal
var GuardarSucursal = (e) => {
  e.preventDefault();
  var datosFormulario = new FormData($("#formularioSucursal")[0]);
  var accion = "../../REPOSITORIO-GIT/Tarea2-Sucursales/sucursales.controllers.php?op=insertar";

  $.ajax({
    url: accion,
    type: "post",
    data: datosFormulario,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        alert("Sucursal guardada con éxito");
        CargarSucursales();
        LimpiarFormulario();
      } else {
        alert("Error al guardar la sucursal");
      }
    },
  });
};

// Función para limpiar el formulario de sucursal
var LimpiarFormulario = () => {
  $("#formularioSucursal")[0].reset();
};
