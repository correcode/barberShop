<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $tipo = 'user'; // Define o tipo de usuário (pode ser "admin" manualmente)

    try {
        $pdo = conectarBanco();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $senha, $tipo]);

        echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
    } catch (PDOException $e) {
        die("Erro no cadastro: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro - Barbearia</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form method="POST" action="">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
