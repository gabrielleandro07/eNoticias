<?php
    include('conexao.php');
    $query = 'SELECT * FROM usuario';
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        foreach ($row as $data) {
            echo '<td>';
            echo $data;
            echo '</td>';
        }

        echo "<td>
        <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModalLong".$row['id_usuario']."\">
          Ver
        </button>  ";

		if($_SESSION['perfil'] == 1){
		echo "
        <form class=\"d-inline\" method=\"GET\" action=\"usuarioAtualizar.php\">
        <input type=\"hidden\" name=\"id\" value=\"" . $row['id_usuario'] . "\">
        <button type=\"submit\" class=\"btn btn-success\">Editar</button></form>";
		
		}
		if($_SESSION['perfil'] == 1){
        echo "<form method=\"POST\" class=\"d-inline\" onsubmit=\"excluir(event)\" action=\"controle/usuarioDeletar.php\">
        <input type=\"hidden\" name=\"id\" va value=\"" . $row['id_usuario'] . "\">
        <button type=\"submit\" class=\"btn btn-danger\">Excluír</button></form> </td> ";
		}
        echo "
        <!-- Modal -->
        <div class=\"modal fade\" id=\"exampleModalLong".$row['id_usuario']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLongTitle\" aria-hidden=\"true\">
          <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
              <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"exampleModalLongTitle\">Informações do Usuário</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                  <span aria-hidden=\"true\">&times;</span>
                </button>
              </div>
              <div class=\"modal-body\">";

               foreach ($row as $name=> $data) {
          
                echo "<h4> $name </h4>";
                echo "<p> $data </p>";
    
                }
                echo "
              </div>
              <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Fechar</button>
              </div>
            </div>
          </div>
        </div>";

        echo '</tr>';
    }
?>