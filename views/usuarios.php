<!-- Arquivo: views/usuarios.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuários - Vistoria Veicular</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="container">
    <a href="dashboard.php" class="voltar">⬅ Voltar ao Painel</a>
    <h2>Gerenciar Usuários</h2>

    <!-- Formulário de Cadastro -->
    <form action="salvar_usuario.php" method="POST" class="form-row">
      <input type="text" name="nome" placeholder="Nome Completo" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <select name="perfil" required>
        <option value="">Selecione o Perfil</option>
        <option value="admin">Administrador</option>
        <option value="supervisor">Supervisor</option>
        <option value="vistoriador">Vistoriador</option>
      </select>
      <button type="submit">➕ Adicionar</button>
    </form>

    <!-- Tabela de Listagem -->
    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Perfil</th>
            <th>Criado Em</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $user): ?>
              <tr>
                <td>
                  <?php echo htmlspecialchars($user['nome']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($user['email']); ?>
                </td>
                <td>
                  <?php echo ucfirst(htmlspecialchars($user['perfil'])); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($user['criado_em']))); ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" style="text-align: center;">Nenhum usuário cadastrado.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
