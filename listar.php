<?php 
    require_once 'connection.php';
    $conn = OpenCon();
    $users = getUsers($conn);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>CRUD Usuários</title>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            caption {
                margin-bottom: 3vh;
                font-weight: bold;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 2vh 1vw;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

            a {
                padding: 1vh;
                border: 1px solid #002699;
                color: #002699;
                border-radius: 3vh;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <a href="insert.php">Adicionar novo usuário</a>
        <table>
            <thead>
                <caption>Lista de usuários</caption>
                <tr>
                    <th>Usuário</th>
                    <th>E-mail</th>
                    <th>Sexo</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['gender'] ?></td>
                    <td><a href="update.php?user=<?php echo $user['username']; ?>">Editar</a></td>
                    <td><a href="remove.php?user=<?php echo $user['username']; ?>">Excluir</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>