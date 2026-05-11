# Sistema de Vistoria Veicular

Este é um sistema web completo desenvolvido para facilitar o gerenciamento e a execução de vistorias automotivas. Ele permite o cadastro de veículos, gerenciamento de usuários com controle de acesso, criação de checklists dinâmicos, captura de fotos e geração de relatórios em PDF.

## 🚀 Tecnologias Utilizadas

- **Backend:** PHP (Vanilla) com arquitetura MVC.
- **Banco de Dados:** MySQL com acesso via PDO (Prepared Statements).
- **Frontend:** HTML5, CSS3 (Design moderno, flexbox/grid, 100% responsivo) e JavaScript (Vanilla).
- **Geração de PDF:** Biblioteca [Dompdf](https://github.com/dompdf/dompdf).

---

## 🔒 Segurança Aplicada

A segurança foi um dos pilares no desenvolvimento deste projeto:

1. **Prevenção contra SQL Injection:** Todas as interações com o banco de dados utilizam `PDO` e prepared statements.
2. **Criptografia de Senhas:** As senhas dos usuários não são salvas em texto puro. O sistema utiliza a função nativa `password_hash()` do PHP.
3. **Controle de Sessão Estrito:** Todas as páginas protegidas (`views/`, `public/`) possuem checagem de sessão no início do arquivo. Se um usuário não estiver autenticado, ele é redirecionado para o login.
4. **Controle de Acesso por Perfil (RBAC):** Os usuários possuem níveis de permissão (`admin`, `supervisor` e `vistoriador`). Apenas administradores e supervisores podem acessar as rotas de criação/edição/exclusão de Veículos, Categorias, Itens e Usuários. O vistoriador tem acesso restrito a realizar vistorias e ver o histórico.

---

## 🛠️ Como Acessar e Configurar o Projeto

### Pré-requisitos
- Um servidor web (Apache, Nginx).
- PHP 7.4 ou superior.
- MySQL ou MariaDB.
- [Composer](https://getcomposer.org/) (para instalar dependências).

### Passos de Instalação

1. **Clonar/Copiar o Projeto:** Coloque a pasta do projeto no diretório público do seu servidor web (ex: `/var/www/html/app_vistoria_veicular` no Apache/Linux ou `htdocs/` no XAMPP).
2. **Instalar Dependências:** No terminal, dentro da pasta do projeto, execute o comando para instalar o Dompdf:
   ```bash
   composer install
   ```
3. **Configuração do Banco de Dados:**
   - Crie um banco de dados no MySQL (ex: `vistoria_veicular`).
   - Importe o script de criação das tabelas (tabelas de `usuarios`, `veiculos`, `categorias_checklist`, `itens_checklist`, `vistorias`, `vistoria_itens`, `vistoria_fotos`).
   - Edite o arquivo `app/Database.php` e insira as credenciais corretas do seu banco de dados (host, usuário, senha e nome do banco).
4. **Criação do Primeiro Usuário Administrador:**
   - Para o primeiro acesso, você precisará inserir manualmente um usuário no banco de dados com a senha criptografada, ou criar um script de instalação inicial.

---

## 📋 Como Fazer os Cadastros (Fluxo de Uso)

O sistema foi desenhado para ser intuitivo. Acesse o sistema e faça login. A partir do **Painel de Controle (Dashboard)**, siga o fluxo de configurações:

### 1. Cadastro de Usuários
- **Acesso:** Somente `admin`.
- **Como fazer:** Clique no menu "Usuários". Preencha Nome, E-mail, defina uma Senha e escolha o Perfil (Administrador, Supervisor ou Vistoriador). 

### 2. Criação do Checklist (Categorias e Itens)
- **Acesso:** `admin` e `supervisor`.
- **Como fazer:** 
  1. Primeiro vá em **Categorias** e crie os grupos (Ex: "Lataria", "Documentação", "Mecânica"). Defina uma ordem de exibição.
  2. Em seguida, vá em **Itens**. Cadastre os itens que pertencem a cada categoria criada (Ex: "Para-choque dianteiro" na categoria "Lataria").

### 3. Cadastro de Veículos
- **Acesso:** `admin` e `supervisor`.
- **Como fazer:** Vá no menu **Veículos**. Informe a Placa, Ano, Tipo. Os campos "Marca" e "Modelo" possuem preenchimento inteligente (auto-complete). Adicione também o nome e o telefone do cliente.

### 4. Realizando uma Vistoria
- **Acesso:** Todos os perfis.
- **Como fazer:** 
  1. Clique em **Nova Vistoria**.
  2. Selecione um veículo previamente cadastrado na lista.
  3. A tela do Checklist se abrirá, exibindo no cabeçalho os dados do veículo e do cliente.
  4. Para cada item, selecione o status (**✔ OK**, **✖ Avaria**, **N/A**).
  5. Você pode usar o botão **📷 Foto** para anexar imagens da câmera do celular/tablet para evidenciar avarias.
  6. Ao finalizar todos os itens, clique em **Finalizar Vistoria**.

### 5. Histórico e Relatórios (PDF)
- **Como fazer:** No painel, clique em **Histórico**. Lá estarão todas as vistorias concluídas. Ao clicar no botão **📄 PDF**, o sistema utiliza a biblioteca Dompdf para gerar um laudo estruturado contendo o cabeçalho, as observações registradas e o status de cada item.

---

## 📱 Responsividade e UI/UX

O projeto foi refatorado utilizando um arquivo CSS global (`public/assets/css/style.css`), que garante que o sistema seja **100% responsivo**. 

- No **celular**, os formulários se empilham em formato de bloco para facilitar o toque, e tabelas extensas ganham uma barra de rolagem lateral (Scroll) sem quebrar o visual da página.
- A tela de **Checklist** foi especialmente pensada para tablets e celulares, utilizando botões grandes para seleção rápida ("touch-friendly").
