<?php
require_once 'database.php';
$pdo = conectarBanco();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o usuário já existe
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    if ($stmt->fetchColumn() > 0) {
        $erro = "Usuário já existe!";
    } else {
        // Insere novo usuário
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, usuario, senha) VALUES (?, ?, ?)");
        if ($stmt->execute([$nome, $usuario, $senha])) {
            header("Location: login.php");
            exit();
        } else {
            $erro = "Erro ao cadastrar usuário.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <?php if (isset($erro)) : ?>
        <p style="color: red;"> <?php echo $erro; ?> </p>
    <?php endif; ?>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="login.php">Já tem uma conta? Faça login</a>
</body>
</html>
