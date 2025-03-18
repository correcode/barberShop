<?php
require_once 'database.php';
$pdo = conectarBanco();

// Obtém os serviços disponíveis
$servicos = $pdo->query("SELECT * FROM servicos")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Barbearia - Página Inicial</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Bem-vindo à Barbearia</h1>
    <h2>Serviços Disponíveis</h2>
    <ul>
        <?php foreach ($servicos as $servico): ?>
            <li><?php echo $servico['nome'] . " - R$ " . number_format($servico['preco'], 2, ',', '.'); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="login.php">Área Administrativa</a>
</body>
</html>