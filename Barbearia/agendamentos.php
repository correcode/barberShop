<?php 
session_start();
require_once 'database.php';

//Verifica se o usuario esta logado
if (!isset($_SESSION['usuario_id'])) {
  header('Location; login.php');
  exit();
}

$pdo = conectarBanco();

//Adiciona novo agendamento
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cliente_id'])) {
  $cliente_id = $_POST['cliente_id'];
  $servico_id = $_POST['servico_id'];
  $data_hora = $_POST['data_hora'];

  $stmt = $pdo-> prepare('INSERT INTO agendamentos (cliente_id, servico_id, data_hora) VALUE (?, ?, ?)');
  $stmt->execute([$cliente_id, $servico_id, $data_hora]);
  header('Location: agendamentos.php');
  exit();
}

//Exclui um agendamento
if (isset($_GET['excluir'])) {
  $id = $_GET['excluir'];
  $stmt = $pdo->prepare('DELETE FROM agendamentos WHERE id = ?');
  $stmt->execute([$id]);
  header('Location: agendamentos.php');
  exit();
}

//Buscar todos os agendamentos
$stmt = $pdo->query('SELECT a.id, c.nome AS cliente, s.nome AS servico, a.data_hora FROM agendamentos a JOIN clientes c ON a.cliente_id = c.id JOIN servico_id = s.id ORDER BY a.data_hora DESC');
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Busca clientes e servicos para o formulario
$clientes = $pdo->query('SELECT * FROM clientes ORDER BY nome ASC')->fetchAll(PDO::FETCH_ASSOC);
$servicos = $pdo->query('SELECT * FROM servicos ORDER BY nome ASC')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Gerenciar Agendamentos</title>
  </head>
  <body>
    <h2>Gerenciar Agendamentos</h2>
    <a href="painel.php">Voltar ao Painel</a>

    <h3>Adicionar Agendamentos</h3>
    <form method="POST" action="">
      <label>Cliente:</label>
      <select name="cliente_id" required>
        <?php foreach ($clientes as $cliente) : ?>
          <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome']; ?></option>
        <?php endforeach; ?>
      </select>
      <br>
      <label>Data e Hora:</label>
      <input type="datetime-local" name="data_hora" required>
      <br>
      <button type="submit">Adicionar</button>
    </form>

    <h3>Lista de Agendamentos</h3>
    <table border="1">
    <tr>
      <th>Clientes</th>
      <th>Servico</th>
      <th>Data e Hora</th>
      <th>Acoes</th>
    </tr>
    <?php foreach ($agendamentos as $agendamento) : ?>
      <tr>
        <td><?php echo $agendamento['cliente']; ?></td>
        <td><?php echo $agendamento['servico']; ?></td>
        <td><?php echo date('d/m/Y H:ii', strtotime($agendamento['data_hora'])); ?></td>
        <td><a href="?excluir=<?php echo $agendamento['id']; ?>" onclick="return confirm('Tem certeza?');">Excluir</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>