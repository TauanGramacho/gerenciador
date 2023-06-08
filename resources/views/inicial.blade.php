<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<div>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <img src="../imgs/icon.png" alt="">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link ml-3 disabled">Itens disponíveis<span class="sr-only">(página atual)</span></a>

                    <li class="nav-item">
                        <a class="nav-link" href="/cadastro">Cadastro e edição de produtos</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                    <button class="logout-button">Logout</button>
                </form>
            </div>
        </nav>

        <div class="container">
            <div class="botaovoltar">
                <!-- <a href="{{ route('inicial') }}">
        <img src="/imgs/voltar.png" alt="">
        </a> -->
            </div>
            <div class="header">
                <span class="tituloTabela">Disponibilidade de Produtos</span>
            </div>

            <div class="divTable">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>


        </div>

    </body>

</html>

<!-- CSS do Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script>
    const tbody = document.querySelector('tbody')

    function openModal(edit = false, index = 0) {
        modal.classList.add('active')
    }

    function insertItem(item, index) {
        let tr = document.createElement('tr')

        tr.innerHTML = `
    <td>${item.nome}</td>
    <td>${item.funcao}</td>
    <td>R$ ${item.salario}</td> 
  `
        tbody.appendChild(tr)
    }

    function loadItens() {
        itens = getItensBD()
        tbody.innerHTML = ''
        itens.forEach((item, index) => {
            insertItem(item, index)
        })
    }

    const getItensBD = () => JSON.parse(localStorage.getItem('dbfunc')) ?? []
    const setItensBD = () => localStorage.setItem('dbfunc', JSON.stringify(itens))

    loadItens()
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = tbody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const rowData = rows[i].textContent.toLowerCase();

            if (rowData.includes(searchTerm)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;700&family=Roboto:wght@100;300;400;500;700;900&family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap');

    .logout-button {
        background-color: #ff0000;
        color: #fff;
        border: none;
        padding: 7px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 1vh;
    }

    .logout-button:hover {
        background-color: #cccccc;
        color: #fff;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .tituloTabela {
        margin-top: 3vh;
    }

    .incluir {
        margin-top: 2.5vh;
    }

    body {
        background-image: url('imgs/background.jpg');
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.1);
    }

    button {
        cursor: pointer;
    }

    .container {
        width: 90%;
        height: 80%;
        border-radius: 10px;
        background: white;
    }

    .header {
        min-height: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: auto 12px;
    }

    .header span {
        font-weight: 900;
        font-size: 20px;
        word-break: break-all;
    }

    #new {
        font-size: 16px;
        padding: 8px;
        border-radius: 5px;
        border: none;
        color: white;
        background-color: rgb(57, 57, 226);
    }

    .divTable {
        padding: 10px;
        width: auto;
        height: inherit;
        overflow: auto;
    }

    .divTable::-webkit-scrollbar {
        width: 12px;
        background-color: whitesmoke;
    }

    .divTable::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: darkgray;
    }

    table {
        width: 100%;
        border-spacing: 10px;
        word-break: break-all;
        border-collapse: collapse;
    }

    thead {
        background-color: whitesmoke;
    }

    tr {
        border-bottom: 1px solid rgb(238, 235, 235) !important;
    }

    tbody tr td {
        vertical-align: text-top;
        padding: 6px;
        max-width: 50px;
    }

    thead tr th {
        padding: 5px;
        text-align: start;
        margin-bottom: 50px;
    }

    tbody tr {
        margin-bottom: 50px;
    }

    thead tr th.acao {
        width: 100px !important;
        text-align: center;
    }

    tbody tr td.acao {
        text-align: center;
    }

    @media (max-width: 700px) {
        body {
            font-size: 10px;
        }

        .header span {
            font-size: 15px;
        }

        #new {
            padding: 5px;
            font-size: 10px;
        }

        thead tr th.acao {
            width: auto !important;
        }

        td button i {
            font-size: 20px !important;
        }

        td button i:first-child {
            margin-right: 0;
        }

        .modal {
            width: 90% !important;
        }

        .modal label {
            font-size: 12px !important;
        }
    }

    .modal-container {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 999;
        align-items: center;
        justify-content: center;
    }

    .modal {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        width: 50%;
    }

    .modal label {
        font-size: 14px;
        width: 100%;
    }

    .modal input {
        width: 100%;
        outline: none;
        padding: 5px 10px;
        width: 100%;
        margin-bottom: 20px;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .modal button {
        width: 100%;
        margin: 10px auto;
        outline: none;
        border-radius: 20px;
        padding: 5px 10px;
        width: 100%;
        border: none;
        background-color: rgb(57, 57, 226);
        color: white;
    }

    .botaovoltar {
        margin-top: 10px;
        margin-left: 30px;
    }

    .active {
        display: flex;
    }

    .active .modal {
        animation: modal .4s;
    }

    @keyframes modal {
        from {
            opacity: 0;
            transform: translate3d(0, -60px, 0);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    td button {
        border: none;
        outline: none;
        background: transparent;
    }

    td button i {
        font-size: 25px;
    }

    td button i:first-child {
        margin-right: 10px;
    }
</style>