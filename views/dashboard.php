<!-- Arquivo: views/dashboard.php -->
<!DOCTYPE html>
<?php
$totalVeiculos = $totalVeiculos ?? 0;
$vistoriasAndamento = $vistoriasAndamento ?? 0;
$vistoriasConcluidas = $vistoriasConcluidas ?? 0;
?>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <div>
        <h2>Painel de Vistorias</h2>
        <p>Bem-vindo(a), <strong>
            <?php echo $_SESSION['usuario_nome']; ?>
          </strong> (Perfil:
          <?php echo ucfirst($_SESSION['usuario_perfil']); ?>)
        </p>
      </div>
      <a href="logout.php" class="btn-sair">Sair</a>
    </div>
    <!-- Cards de Indicadores (KPIs) -->
    <div class="kpi-container">
      <div class="kpi-card">
        <h3>
          <?php echo $totalVeiculos; ?>
        </h3>
        <p>Veículos Cadastrados</p>
      </div>
      <div class="kpi-card border-warning">
        <h3>
          <?php echo $vistoriasAndamento; ?>
        </h3>
        <p>Vistorias em Andamento</p>
      </div>
      <div class="kpi-card border-success">
        <h3>
          <?php echo $vistoriasConcluidas; ?>
        </h3>
        <p>Vistorias Concluídas</p>
      </div>
    </div>
    <div class="menu">
      <!-- Em breve criaremos esta rota -->
      <?php if (isset($_SESSION['usuario_perfil']) && $_SESSION['usuario_perfil'] === 'admin'): ?>
      <a href="usuarios.php">👥 Gerenciar Usuários</a>
      <?php endif; ?>
      <?php if (isset($_SESSION['usuario_perfil']) && in_array($_SESSION['usuario_perfil'], ['admin', 'supervisor'])): ?>
      <a href="veiculos.php">🚗 Gerenciar Veículos</a>
      <a href="categorias.php">📋 Cadastrar Categorias</a>
      <a href="itens.php">✅ Cadastrar Itens de Vistoria</a>
      <?php endif; ?>
      <a href="nova_vistoria.php">📊 Realizar Vistoria</a>
      <a href="historico.php">🕰️ Histórico de Vistorias</a>
    </div>
</body>

</html>