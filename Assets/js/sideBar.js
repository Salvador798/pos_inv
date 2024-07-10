// funciones que reaccional al sideBar //

let btn = document.querySelector("#btn");
let sideBar = document.querySelector(".sideBar");
let container = document.querySelector(".contenidoMain");
btn.onclick = () => {
    sideBar.classList.toggle("activo");
    container.classList.toggle("desaparezco");
};
