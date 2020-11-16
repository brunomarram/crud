<?php 
    require_once 'connection.php';
    session_start();

    if(isset($_SESSION['logged']) && $_SESSION['logged'])
        header("Location: listar.php");

    if($_POST) {
        $conn = OpenCon();
        $user = logIn($conn, $_POST['email'], $_POST['password']);
        if($user) {
            $_SESSION['username'] = $user->username;
            $_SESSION['logged'] = true;
            header("Location: listar.php");
        }
    }
?>

<html>
    <head>
        <title>CRUD Usuários</title>
        <style>
            form {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100%;
            }

            form div {
                margin: 1vh 0;
                display: flex;
                flex-direction: column;
            }

            form button {
                width: 10%
            }

            button {
                margin-top: 3vh;
                padding: 1vh;
                border: 1px solid #002699;
                color: #002699;
                border-radius: 3vh;
                text-decoration: none;
                cursor: pointer;
            }

            h1 {
                color: #002699;
            }

            h2 {
                font-size: 2vh;
                color: #002699;
            }
        </style>
    </head>
    <body>
        <form action="index.php" method="POST">
            <h1>Seja bem vindo ao CRUD Usuários</h1>
            <h2>Informe seu email e sua senha para continuar</h2>
            <div>
                <label for="email">E-mail: </label>
                <input type="email" required name="email" placeholder="E-mail"/>
            </div>
            <div>
                <label for="password">Senha: </label>
                <input type="password" id="password" required name="password" placeholder="Senha"/>
            </div>
            <?php if($_POST) echo "Usuário ou senha incorretas"; ?>
            <button type="submit">Entrar</button>
        </form>        
    </body>
</html>