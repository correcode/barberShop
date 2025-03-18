<?php 
session_start();
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha']; 

    try {
        $pdo = conectarBanco();
        $stmt = $pdo->prepare('SELECT id, nome, tipo, senha FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        var_dump($usuario); // Debug para ver se encontrou o usuário

        if ($usuario) {
            var_dump($senha); // Senha digitada
            var_dump($usuario['senha']); // Senha no banco

            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_tipo'] = $usuario['tipo'];

                header('Location: painel.php');
                exit();
            } else {
                echo "<p style='color: red;'>Senha incorreta!</p>";
            }
        } else {
            echo "<p style='color: red;'>Usuário não encontrado!</p>";
        }
    } catch (PDOException $e) {
        die("Erro no login: " . $e->getMessage());
    }
}
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Login - Barbearia</title>
  </head>
  <body>
    <h2>Login</h2>
    <form method="POST" action="">
      <label>Email:</label>
      <input type="email" name="email" required>
      <br>
      <label>Senha:</label>
      <input type="password" name="senha" required>
      <br>
      <button type="submit">Entrar</button>
    </form>
  </body>
</html>