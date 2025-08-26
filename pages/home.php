<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="../style/style.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <style>
    .conteudo {
        display: flex;
        flex-direction: column;
        align-items: center; /* centraliza horizontalmente */
        margin-top: 30px;
    }

    table {
        border-collapse: collapse;
        width: 80%; /* ajuste o tamanho da tabela */
        text-align: center; /* centraliza o texto dentro das células */
    }

    table th, table td {
        padding: 10px;
        border: 1px solid #000;
    }

    table th {
        background-color: #f2f2f2;
    }
</style>

</head>

<body>
    <div class="menu">
        <nav>
            <div class="logo">
                <img src="../images/logoBR3.png" alt="Logo">
                <a id="nameuser">Olá user</a>
            </div>

            <ul>
                <li><a href="home.php" class="active">Home</a></li>
            </ul>
        </nav>
    </div>

    <div class="conteudo">

        <?php
        include_once "../conexao.php";

        try {
            if (isset($_GET['id'])) {
                $id_aluno = $_GET['id'];
                $deletar = $conectar->query("DELETE FROM aluno WHERE ID_aluno = $id_aluno");

                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }

            $consultar = $conectar->query("SELECT * FROM aluno");

            echo "<h2>Listagem de Usuários</h2>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>";
            echo "<tr><th>Nome</th><th>CPF</th><th>Nascimento</th><th>Endereço</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>";

            while ($linha = $consultar->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$linha['nome']}</td>
                        <td>{$linha['cpf']}</td>
                        <td>{$linha['data_nascimento']}</td>
                        <td>{$linha['endereco']}</td>
                        <td>{$linha['email']}</td>
                        <td>{$linha['telefone']}</td>
                        <td>
                            <a href='formEditar.php?id={$linha['ID_aluno']}'>Editar</a> - 
                            <a href='?id={$linha['ID_aluno']}' onclick=\"return confirm('Tem certeza que deseja excluir este aluno?')\">Excluir</a>
                        </td>
                      </tr>";
            }

            echo "</table>";
            echo "<p>" . $consultar->rowCount() . " registros encontrados</p>";

        } catch (PDOException $e) {
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>
