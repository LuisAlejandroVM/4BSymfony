const url = "http://localhost/4BSymfony/public/index.php";

const fill = list => {
    let table = "";

    if(list.length > 0){
        for(let i = 0; i < list.length; i++) {
            table += `
            <tr>
                <td>${ i + 1 }</td>
                <td>${list[i].name}</td>
                <td>${list[i].price}</td>
                <td>${list[i].status ? "Activo" : "Inactivo"}</td>
                <td>
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#details">Detalles</button>
                    <button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Modificar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
            `;
        }
    }else{
        table = `
        <tr class="text-center">
            <td colspan="5">No hay registros para mostrar</td>
        </tr>
        `;
    }
    $(`#table > tbody`).html(table);
};

const getProducts = async () => {
    await $.ajax({
        type: 'GET',
        url: url + '/products'
    }).done(res => {
        console.log(res);
        fill(res.listProducts);
    });
};

const getProductById = async id => {
    await $.ajax({
        type: 'GET',
        url: url + '/product/' + id
    }).done(res => {
        console.log(res);
    });
};

getProducts();
getProductById(1);