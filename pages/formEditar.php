<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cadastro</title>
    <style>
        /* --------------------------------- HR --------------------------------- */
        hr {
            border: none;
            height: 2px;          
            background-color: #046874;
            margin: 20px 0;
        }

        /* --------------------------------- Geral --------------------------------- */
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* --------------------------------- Menu --------------------------------- */
        .menu {
            width: 100%;
            min-height: 100px;
            padding: 0;
            margin: 0 auto;
        }

        .menu nav {
            width: 100%;
            background-color: #046874;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100px;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .logo img {
            max-width: 150px;
            max-height: 50px;
            width: auto;
            height: auto;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 19px;
            color: white;
            border-radius: 30px;
            transition: 0.6s;
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        #nameuser {
            position: relative;
            top: -15px;
            padding: 5px 15px;
            text-decoration: none;
            font-size: 19px;
            color: white;
            border-radius: 30px;
            transition: 0.3s;
            display: inline-block;
        }

        #nameuser:hover {
            transform: translateY(-5px);
        }

        nav ul li a.active {
            background-color: #034f56;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* --------------------------------- Formulário de Edição --------------------------------- */
        .FormEditar {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px);
            padding: 40px 20px;
            box-sizing: border-box;
        }

        .quadradoEditar {
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border: 2px solid #d4d4d4;
            border-radius: 10px;
            background: #f9f9f9;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        #TituloEditar {
            text-align: center;
            margin-bottom: 25px;
            font-family: Arial, sans-serif;
            color: #046874;
            font-size: 28px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .input-group label {
            font-weight: bold;
            margin-bottom: 8px;
            color: #046874;
            font-size: 16px;
        }

        .input-group input {
            width: 95%;
            height: 40px;
            padding: 5px 10px;
            border: 2px solid #d4d4d4;
            border-radius: 5px;
            background: white;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            border-color: #046874;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #046874;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #034f56;
        }

        /* Mensagens de alerta */
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .menu nav {
                flex-direction: column;
                height: auto;
                padding: 15px;
            }
            
            .logo {
                margin-bottom: 15px;
            }
            
            .quadradoEditar {
                padding: 25px;
            }
            
            #TituloEditar {
                font-size: 24px;
            }
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
                <li><a href="home.php">Home</a></li>
                <li><a href="cadastro.php" class="active">Cadastro</a></li>
            </ul>
        </nav>
    </div>

    <?php
    include_once "../conexao.php";
    
    $linha = array();
    $mensagem = '';
    $tipoMensagem = '';
    
    try {
        if (isset($_GET['id'])) {
            $id_aluno = $_GET['id'];
            
            $consultar = $conectar->query("SELECT * FROM aluno WHERE ID_aluno = $id_aluno");
            
            if($consultar && $consultar->rowCount() > 0) {
                $linha = $consultar->fetch(PDO::FETCH_ASSOC);
            } else {
                $mensagem = 'Aluno não encontrado!';
                $tipoMensagem = 'error';
            }
        } else {
            $mensagem = 'ID do aluno não especificado!';
            $tipoMensagem = 'error';
        }
        
        if(isset($_POST['salvar'])) {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $data_nascimento = $_POST['data_nascimento'];
            $endereco = $_POST['endereco'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            
            $stmt = $conectar->prepare("UPDATE aluno SET 
                nome = :nome,
                cpf = :cpf,
                data_nascimento = :data_nascimento,
                endereco = :endereco,
                email = :email,
                telefone = :telefone
                WHERE ID_aluno = :id_aluno");
            
            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':data_nascimento' => $data_nascimento,
                ':endereco' => $endereco,
                ':email' => $email,
                ':telefone' => $telefone,
                ':id_aluno' => $id_aluno
            ]);
            
            if($stmt->rowCount() > 0) {
                $mensagem = 'Dados atualizados com sucesso!';
                $tipoMensagem = 'success';
                
                $consultar = $conectar->query("SELECT * FROM aluno WHERE ID_aluno = $id_aluno");
                if($consultar && $consultar->rowCount() > 0) {
                    $linha = $consultar->fetch(PDO::FETCH_ASSOC);
                }
            } else {
                $mensagem = 'Nenhum dado foi alterado.';
                $tipoMensagem = 'error';
            }
        }
    } catch (PDOException $e) {
        $mensagem = 'Erro: ' . $e->getMessage();
        $tipoMensagem = 'error';
    }
    ?>

    <div class="FormEditar">
        <div class="quadradoEditar">
            <!-- Exibe mensagens de alerta -->
            <?php if (!empty($mensagem)): ?>
                <div class="alert alert-<?php echo $tipoMensagem; ?>">
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <h1 id="TituloEditar">Editar</h1>
                <hr />

                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="FOFINHO" value="<?php echo isset($linha['nome']) ? htmlspecialchars($linha['nome']) : ''; ?>"/>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="123.456.789-10" value="<?php echo isset($linha['cpf']) ? htmlspecialchars($linha['cpf']) : ''; ?>"/>
                </div>

                <div class="input-group">
                    <label for="nascimento">Nascimento</label>
                    <input type="text" id="nascimento" name="data_nascimento" placeholder="01/01/2000" value="<?php echo isset($linha['data_nascimento']) ? htmlspecialchars($linha['data_nascimento']) : ''; ?>"/>
                </div>

                <div class="input-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Seu endereço" value="<?php echo isset($linha['endereco']) ? htmlspecialchars($linha['endereco']) : ''; ?>"/>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="FOFINHO@gmail.com" value="<?php echo isset($linha['email']) ? htmlspecialchars($linha['email']) : ''; ?>"/>
                </div>
                
                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" placeholder="(92) 99999-9999" value="<?php echo isset($linha['telefone']) ? htmlspecialchars($linha['telefone']) : ''; ?>"/>
                </div>
               
                <button type="submit" name="salvar">
                    Salvar Alterações
                </button>
            </form>
        </div>
    </div>
</body>
</html>