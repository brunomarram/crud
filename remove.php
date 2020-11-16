<?php 
    require_once 'connection.php';
    
    isLogged();

    $conn = OpenCon();

    if($_GET)  {
        $user = getUser($conn, $_GET['user']);
    }

    if($_POST) {        
        removeUser($conn, $_POST['username']);
        header("Location: listar.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Excluir usuário</title>
        <style>
            form {
                display: flex;
                flex-direction: column;
                width: 20%
            }

            form div {
                margin: 1vh 0;
            }

            h1 {
                font-size: 2.5vh;
            }

            h2 {
                font-size: 2vh;
            }
        </style>
    </head>
    <?php  
        if(!$user){
            echo "Usuário não encontrado!";
        } else {
    ?>
        <body>
            <a href="listar.php">Voltar</a>
            <form action="remove.php" method="POST">
                <div>
                    <label for="username">Usuário: </label>
                    <input type="text" name="username" readonly value="<?php echo $user->username?>" placeholder="Usuário"/>
                </div>
                <div>
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" readonly value="<?php echo $user->email?>" placeholder="E-mail"/>
                </div>
                <div>
                    <input type="radio" id="female" disabled name="gender" <?php if($user->gender == "F") echo 'checked'; ?> value="F">
                    <label for="female">Feminino</label>
                </div>
                <div>
                    <input type="radio" id="male" disabled name="gender" <?php if($user->gender == "M") echo 'checked'; ?> value="M">
                    <label for="male">Masculino</label>
                </div>
                <h1>Deseja realmente remover esse usuário?</h1>
                <h2>Atenção: essa ação não pode ser desfeita</h2>
                <button type="submit">Excluir</button>
            </form>
        </body>
    <?php } ?>
</html>