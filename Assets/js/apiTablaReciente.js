const listReciente = async () => {
    try {
        const response = await fetch("https://jsonplaceholder.typicode.com/users");
        const data = await response.json();  
        let contenido= ``;
        data.forEach((element, index) => {  
            contenido+=
            `<tr>
                <td>${index+1}</td>
                <td>${element.name}</td>
                <td>${element.name}</td>
                <td>${element.name}</td>
                <td>Detalles</td>
            </tr>`;
        });
        tableBodyData.innerHTML = contenido;
    } catch (error) {
        alert(error);
    }
}

window.addEventListener("load", async()=> {
    await listReciente();
})