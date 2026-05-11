<!-- Arquivo: views/usuarios.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuários - Vistoria Veicular</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .voltar {
      display: inline-block;
      margin-bottom: 20px;
      background: #6c757d;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
    }

    .form-row {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    input, select {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      flex: 1;
      min-width: 150px;
    }

    button {
      padding: 10px 20px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #0056b3;
      color: white;
    }
  </style>
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
</body>

</html>
