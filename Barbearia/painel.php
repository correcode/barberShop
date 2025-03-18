<?php 
session_start();

// Verifica se o usuario esta logado
if (!isset($_SESSION['usuario_id'])) {
  header('Location: login.php');
  exit();
}

require_once 'database.php';
$pdo = conectarBanco();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Painel Administrativo</title>
  </head>
  <body>
    <h2>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h2>
    <nav>
      <ul>
        <li><a href="cliente.php">Gerenciar Clientes</a></li>
        <li><a href="servicos.php">Gerenciar Servicos</a></li>
        <li><a href="agendamentos.php">Gerenciar Agendamentos</a></li>
        <li><a href="logout.php">Sair</a></li>
      </ul>
    </nav>
    <h3>Resumo do Sistema</h3>
    <?php
    // Contagem de clientes
    $stmt = $pdo->query('SELECT COUNT(*) as total FROM clientes');
    $totalClientes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Contagem de servicos
    $stmt = $pdo->query('SELECT COUNT(*) as total FROM servicos');
    $totalServicos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    //Contagem de agendamentos
    $stmt = $pdo->query('SELECT COUNT(*) as total FROM agendamentos');
    $totalAgendamento = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    ?>
    <p>Total de Clientes: <?php echo $totalClientes; ?></p>
    <p>Total de Serviicos: <?php echo $totalServicos; ?></p>
    <p>Total de Agendamento: <?php echo $totalAgendamento; ?></p>
  </body>
</html>