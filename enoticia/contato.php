<?php
include_once('./includes/header.php');
include_once('./includes/menu.php');
include_once('./controle/conexao.php');

?>

<main role="main bg-light">
    <div class="container mt-3">
        <h2 class="text-center mb-3">Contato</h2>
        <form class="contact-form" action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="inputState">Estado</label>
                    <select id="inputState" class="form-control estados" data-item="Estado" name="estado" required>
                        <option selected>Selecione seu estado...</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Cidade</label>
                    <select id="inputCity" class="form-control cidades" data-item="Cidade" name="cidade" required>
                        <option selected>Selecione sua cidade...</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="assunto">Assunto</label>
                    <input type="text" class="form-control" id="assunto" name="assunto" required>
                </div>
            </div>
            <div class="form-group">
                <label for="conside">Considerações</label>
                <textarea name="consideracao" id="conside" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
            <button type="reset" class="btn btn-secondary">Resetar</button>
        </form>
    </div>
</main>
<script src="js/contato.js"></script>
<?php
include_once('includes/footer.php');

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $assunto = $_POST['assunto'];
    $consideracao = $_POST['consideracao'];

    $query = "INSERT INTO contato (nome,cpf,email,telefone,estado,cidade,assunto,consideracoes) VALUES ('$nome','$cpf','$email','$telefone','$estado','$cidade','$assunto','$consideracao')";

    $result = mysqli_query($conn, $query);

    if (!(mysqli_affected_rows($conn) > 0)) {

        echo '<div class="alert alert-danger mt-3" role="alert">Ocorreu um erro!</div>';
    }
}

?>