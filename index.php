<?php include('includes/database.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP e MySQLi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <h1>Gerenciamento de Usuários</h1>

        <!-- Formulário para adicionar novo usuário -->
        <form action="index.php" method="POST">
            <input type="text" name="name" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Telefone" required>
            <button type="submit" name="save">Adicionar Usuário</button>
        </form>

        <?php
        if (isset($_POST['save'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
            $conn->query($sql);
            header("Location: index.php");
        }
        ?>

        <!-- Tabela de usuários -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM users");
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <button onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone']; ?>')">Editar</button>
                        <a href="index.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Modal para editar usuário -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h2>Editar Usuário</h2>
                <form id="editForm" method="POST" action="index.php">
                    <input type="hidden" name="id" id="editId">
                    <input type="text" name="name" id="editName" placeholder="Nome" required>
                    <input type="email" name="email" id="editEmail" placeholder="Email" required>
                    <input type="text" name="phone" id="editPhone" placeholder="Telefone" required>
                    <button type="submit" name="update">Atualizar Usuário</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id";
            $conn->query($sql);
            header("Location: index.php");
        }

        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $sql = "DELETE FROM users WHERE id=$id";
            $conn->query($sql);
            header("Location: index.php");
        }
        ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
