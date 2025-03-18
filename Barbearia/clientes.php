<?php 
session_start();
require_once 'database.php';

//Verifica se o usuario esta logado
if (!isset($_SESSION['usuario_id'])) {
  header('Location: login.php');
  exit();
}

$pdo = conectarBanco();

// Adiciona novo cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {
  $nome = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];

  $stmt = $pdo->prepare('INSERT INTO clientes (nome, telefone, email) VALUES (?, ?, ?)');
  $stmt->execute([$nome, $telefone, $email]);
  header('Location: clientes.php');
  exit();
}

// Exclui um cliente
if (isset($_GET['excluir'])) {
  $id = $_GET['excluir'];
  $stmt = $pdo->prepare('DELETE FROM clientes WHERE id = ?');
  $stmt->execute([$id]);
  header('Location: clientes.php');
  exit();
}

//Buscar todos os clientes
$stmt = $pdo->query('SELECT * FROM clientes ORDER BY criado_em DESC');
$clientes = $stmt-> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Gerenciar Clientes</title>
  </head>
  <body>
    <h2>Gerenciar Clientes</h2>
    <a href="painel.php">Voltar ao Painel</a>

    <h3>Adicionar Clientes</h3>
    <form method="POST" action="">
      <label>Nome:</label>
      <input type="text" name="nome" required>
      <br>
      <label>Telefone:</label>
      <input type="text" name="telefone" required>
      <br>
      <label>Email:</label>
      <input type="email" name="email">
      <br>
      <button type="submit">Adicionar</button>
    </form>

    <h3>Lista de Clientes</h3>
    <table border="1">
      <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Acoes</th>
      </tr>
      <?php foreach ($clientes as $cliente) : ?>
        <tr>
          <td><?php echo $cliente['nome']; ?></td>
          <td><?php echo $cliente['telefone']; ?></td>
          <td><?php echo $cliente['email']; ?></td>
          <td><a href="?excluir=<?php echo $cliente['id']; ?>" onclick="return confirm('Tem certeza?');">Exlcuir</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
  </body>
</html>