<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" type="image/x-icon">
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
          <li class="nav-item">
            <a href="/inicial" class="nav-link ml-3">Itens disponíveis<span class="sr-only">(página atual)</span></a>

          </li>
          <li class="nav-item active">
            <a class="nav-link">Cadastro e edição de produtos</a>

          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Pesquisar produto" aria-label="Pesquisar">
          <button class="logout-button">
            <a class="button-link" href="{{ route('logout') }}">Logout</a>
          </button>

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
        <span class="tituloTabela">Cadastro de Produtos</span>
        <button class="incluir" onclick="openModal()" id="new">Incluir</i></button>
      </div>

      <div class="divTable">
        <table>
          <thead>
            <tr>
              <th>Produto</th>
              <th>Quantidade</th>
              <th>Preço</th>
              <th class="acao">Editar</th>
              <th class="acao">Excluir</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

      <div class="modal-container">
        <div class="modal">
          <form>
            <label for="m-nome">Nome</label>
            <input id="m-nome" type="text" required />

            <label for="m-funcao">Quantidade</label>
            <input id="m-funcao" type="text" required />

            <label for="m-salario">Preço</label>
            <input id="m-salario" type="number" required />
            <button id="btnSalvar">Salvar</button>
          </form>
        </div>
      </div>
    </div>

  </body>

</html>

<!-- CSS do Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- JS do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js integrity=" sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
  const modal = document.querySelector('.modal-container')
  const tbody = document.querySelector('tbody')
  const sNome = document.querySelector('#m-nome')
  const sFuncao = document.querySelector('#m-funcao')
  const sSalario = document.querySelector('#m-salario')
  const btnSalvar = document.querySelector('#btnSalvar')

  let itens
  let id

  function openModal(edit = false, index = 0) {
    modal.classList.add('active')

    modal.onclick = e => {
      if (e.target.className.indexOf('modal-container') !== -1) {
        modal.classList.remove('active')
      }
    }

    if (edit) {
      sNome.value = itens[index].nome
      sFuncao.value = itens[index].funcao
      sSalario.value = itens[index].salario
      id = index
    } else {
      sNome.value = ''
      sFuncao.value = ''
      sSalario.value = ''
    }

  }

  function editItem(index) {

    openModal(true, index)
  }

  function deleteItem(index) {
    itens.splice(index, 1)
    setItensBD()
    loadItens()
  }

  function insertItem(item, index) {
    let tr = document.createElement('tr')

    tr.innerHTML = `
    <td>${item.nome}</td>
    <td>${item.funcao}</td>
    <td>R$ ${item.salario}</td>
    <td class="acao">
      <button onclick="editItem(${index})"><i class='bx bx-edit' ></i></button>
    </td>
    <td class="acao">
      <button onclick="deleteItem(${index})"><i class='bx bx-trash'></i></button>
    </td>
  `
    tbody.appendChild(tr)
  }

  btnSalvar.onclick = e => {

    if (sNome.value == '' || sFuncao.value == '' || sSalario.value == '') {
      return
    }

    e.preventDefault();

    if (id !== undefined) {
      itens[id].nome = sNome.value
      itens[id].funcao = sFuncao.value
      itens[id].salario = sSalario.value
    } else {
      itens.push({
        'nome': sNome.value,
        'funcao': sFuncao.value,
        'salario': sSalario.value
      })
    }

    setItensBD()

    modal.classList.remove('active')
    loadItens()
    id = undefined
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
    background-image: url('imgs/backlogin.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
    font-family: 'Numans', sans-serif;
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
    position: fixed;
    top: 30%;
    left: 30%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px;
    background-color: white;
    border-radius: 30px;
    width: 40vw;
    height: 40vh;
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

  .button-link {
    color: inherit;

  }

  .button-link {
    color: inherit;
    text-decoration: none;
  }

  .button-link:hover,
  .button-link:focus {
    color: white;
    text-decoration: none;
  }
</style>