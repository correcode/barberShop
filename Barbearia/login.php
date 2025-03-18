<?php 
session_start();
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $senha = md5($_POST['senha']); // Senha criptografada com MD5

  try {
    $pdo = conectarBanco();
    $stmt = $pdo->prepare('SELECT id, nome, tipo FROM usuarios WHERE email = ? AND senha = ?');
    $stmt->execute([$email, $senha]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_nome'] = $usuario['nome'];
      $_SESSION['usuario_tipo'] = $usuario['tipo'];

      // Redirecionar para o painel
      header('Location: painel.php');
      exit();
    } else {
      echo "<p style='color: red;'>Email ou senha invalidos!</p>";
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