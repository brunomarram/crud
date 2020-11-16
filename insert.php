<?php 
    require_once 'connection.php';
    
    isLogged();
    
    $conn = OpenCon();

    if($_POST) {
        insertUser($conn, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['gender']);
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar usuário</title>
        <style>
            form {
                display: flex;
                flex-direction: column;
                width: 30%
            }

            form div {
                margin: 1vh 0;
            }
        </style>
        <script>
            function validar() {
                const password = document.getElementById("password"),
                    confirm = document.getElementById("confirm");

                if(password.value !== confirm.value) {
                    alert("As senhas não coincidem");
                    return false;
                }

                return true;
            }
        </script>
    </head>
    <body>
        <a href="listar.php">Voltar</a>
        <form action="insert.php" onsubmit="return validar()" method="POST">
            <div>
                <label for="username">Usuário: </label>
                <input type="text" required name="username" placeholder="Usuário"/>
            </div>
            <div>
                <label for="email">E-mail: </label>
                <input type="email" required name="email" placeholder="E-mail"/>
            </div>
            <div>
                <label for="password">Senha: </label>
                <input type="password" id="password" required name="password" placeholder="Senha"/>
            </div>
            <div>
                <label for="confirm">Confirmar Senha: </label>
                <input type="password" id="confirm" required name="confirm" placeholder="Confirmar Senha"/>
            </div>
            <div>
                <input type="radio" required id="female" name="gender" value="F">
                <label for="female">Feminino</label>
            </div>
            <div>
                <input type="radio" required id="male" name="gender" value="M">
                <label for="male">Masculino</label>
            </div>
            <?php if($_POST) { if($conn->error) echo $conn->error; else echo "Usuário inserido com sucesso"; } ?>
            <br>
            <button type="submit">Cadastrar Usuário</button>
        </form>
    </body>
</html>