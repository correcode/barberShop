<?php 
session_start();
require_once 'database.php';

// Verifica se o usuario esta logado
if (!isset($_SESSION['usuario_id'])) {
  header('Location: login.php');
  exit();
}

$pdo = conectarBanco();

// Adiciona novo servico
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $duracao = $_POST['duracao'];

  $stmt = $pdo->prepare('INSERT INTO servicos (nome, descricao, preco, duracao) VALUES (?, ?, ?, ?)');
  $stmt->execute([$nome, $descricao, $preco, $duracao]);
  header('Location: servicos.php');
  exit();
}

//Excluir um servico
if (isset($_GET['exlcuir'])) {
  $id= $_GET['exlcuir'];
  $stmt = $pdo->prepare('DELETE FROM servicos WHERE id = ?');
  $stmt->execute([$id]);
  header('Location: servicos.php');
  exit();
}

//Buscar todos os servicos
$stmt = $pdo->query('SELECT * FROM servicos ORDER BY criado_em DESC');
$servicos = $stmt-> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Gerenciar Servicos</title>
  </head>
  <body>
    <h2>Gerenciar Servicos</h2>
    <a href="painel.php">Voltar ao Painel</a>

    <h3>Adicionar Servico</h3>
    <form method="POST" action="">
      <label>Nome:</label>
      <input type="text" name="nome" required>
      <br>
      <label>Descricao:</label>
      <textarea name="descricao" required></textarea>
      <br>
      <label>Preco (R$):</label>
      <input type="number" name="preco" step="0.01" required>
      <br>
      <label>Duracao (minutos):</label>
      <input type="number" name="duracao" required>
      <br>
      <button type="submit">Adicionar</button>
    </form>

    <h3>Lista de Servicos</h3>
    <table border="1">
      <tr>
        <th>Nome</th>
        <th>Descricao</th>
        <th>Preco</th>
        <th>Duracao</th>
        <th>Acoes</th>
      </tr>
      <?php foreach ($servicos as $servico) : ?>
      <tr>
        <td><?php echo $servico['nome']; ?></td>
        <td><?php echo $servico['descricao']; ?></td>
        <td>R$ <?php echo number_format($servico['preco'], 2, '.', '.'); ?></td>
        <td><?php echo $servico['duracao']; ?> min</td>
        <td><a href="?excluir=<?php echo $servico['id']; ?>" onclick="return confirm('Tem certeza?');">Excluir</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>