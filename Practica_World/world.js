const select_paises = document.getElementById("paises");
const select_estados = document.getElementById("estados");
const select_ciudades = document.getElementById("ciudades");
const cargando_estados = document.getElementById("cargando_estados");
const cargando_ciudades = document.getElementById("cargando_ciudades");
const cargando_paises = document.getElementById("cargando_paises");

cargando_ciudades.style.display = "none";
cargando_estados.style.display = "none";
cargando_paises.style.display = "none";
function cargarPaises() {
  cargando_paises.style.display = "block";
  fetch(
    "http://localhost/tienda_buena/public/api/paises/getPaises.php?page=0&limit=250"
  )
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((resultado) => {
      select_paises.innerHTML = "";
      let opcion = document.createElement("option");
      opcion.textContent = "Seleciona un pais";
      opcion.value = 0;
      select_paises.appendChild(opcion);

      resultado.data.forEach((pais) => {
        let opcion = document.createElement("option");
        opcion.textContent = pais.name;
        opcion.setAttribute("value", pais.id);
        //o tambien asi -> opcion.value = pais.id;
        select_paises.appendChild(opcion);
      });
      cargando_paises.style.display = "none";
    });
}

cargarPaises();

function cargarEstados(id) {
  cargando_estados.style.display = "block";

  fetch(
    "http://localhost/tienda_buena/public/api/states/getStates.php?id_country=" +
      id
  )
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((resultado) => {
      if (resultado.success == true) {
        select_estados.innerHTML = "";
        let opcion = document.createElement("option");
        opcion.textContent = "Seleciona un estado";
        opcion.value = 0;
        select_estados.appendChild(opcion);

        resultado.data.forEach((estado) => {
          let opcion = document.createElement("option");
          opcion.textContent = estado.name;
          opcion.value = estado.id;
          select_estados.appendChild(opcion);
        });
        cargando_estados.style.display = "none";
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "No existen estados",
          footer: '<a href="#">Why do I have this issue?</a>',
        });
        cargando_estados.style.display = "none";
      }
    });
}

select_paises.addEventListener("change", () => {
  cargarEstados(select_paises.value);
});

function cargarCiudades(id) {
  cargando_ciudades.style.display = "block";
  fetch(
    "http://localhost/tienda_buena/public/api/ciudades/getCiudades.php?id_state=" +
      id
  )
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((resultado) => {
      if (resultado.success == true) {
        select_ciudades.innerHTML = "";
        let opcion = document.createElement("option");
        opcion.textContent = "Seleciona una ciudad";
        opcion.value = 0;
        select_ciudades.appendChild(opcion);

        resultado.data.forEach((ciudad) => {
          let opcion = document.createElement("option");
          opcion.textContent = ciudad.name;
          opcion.value = ciudad.id;
          select_ciudades.appendChild(opcion);
        });
        cargando_ciudades.style.display = "none";
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "No existen paises",
          footer: '<a href="#">Why do I have this issue?</a>',
        });
        cargando_ciudades.style.display = "none";
      }
    });
}

select_estados.addEventListener("change", () => {
  cargarCiudades(select_estados.value);
});

document.getElementById("btn_limpiar").addEventListener("click", () => {
  select_paises.value = 0;
  select_estados.innerHTML = "";
  select_ciudades.innerHTML = "";
});
