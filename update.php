<?php 
    require_once 'connection.php';
    
    isLogged();
    
    $conn = OpenCon();

    if($_GET)  {
        $user = getUser($conn, $_GET['user']);
    }

    if($_POST) {        
        updateUser($conn, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['gender']);
        $user = getUser($conn, $_POST['username']);
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar usuário</title>
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
    <?php  
        if(!$user){
            echo "Usuário não encontrado!";
        } else {
    ?>
        <body>
            <a href="listar.php">Voltar</a>
            <form action="update.php" onsubmit="return validar()" method="POST">
                <div>
                    <label for="username">Usuário: </label>
                    <input type="text" required name="username" readonly value="<?php echo $user->username?>" placeholder="Usuário"/>
                </div>
                <div>
                    <label for="email">E-mail: </label>
                    <input type="email" required name="email" value="<?php echo $user->email?>" placeholder="E-mail"/>
                </div>
                <div>
                    <label for="password">Senha: </label>
                    <input type="password" required name="password" placeholder="Senha"/>
                </div>
                <div>
                    <label for="confirm">Confirmar Senha: </label>
                    <input type="password" required name="confirm" placeholder="Confirmar Senha"/>
                </div>
                <div>
                    <input type="radio" id="female" required name="gender" <?php if($user->gender == "F") echo 'checked'; ?> value="F">
                    <label for="female">Feminino</label>
                </div>
                <div>
                    <input type="radio" id="male" required name="gender" <?php if($user->gender == "M") echo 'checked'; ?> value="M">
                    <label for="male">Masculino</label>
                </div>
                <?php if($_POST) { if($conn->error) echo $conn->error; else echo "Usuário editado com sucesso"; } ?>
                <br>
                <button type="submit">Editar Usuário</button>
            </form>
        </body>
    <?php } ?>
</html>