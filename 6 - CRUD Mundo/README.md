# CRUD Mundo

Sistema web para gerenciamento de dados geográficos e governamentais, com cadastro de continentes, países, cidades e seus respectivos governantes.

## Sobre o projeto

O CRUD Mundo é uma aplicação full-stack desenvolvida para organizar e consultar informações geográficas do planeta de forma relacional: continentes contêm países, países contêm cidades, e tanto países quanto cidades podem estar associados a um governante. O sistema permite cadastrar, consultar, editar e excluir registros em todas essas entidades, respeitando as regras de integridade entre elas (por exemplo, um continente não pode ser excluído enquanto possuir países vinculados).

Além do CRUD geográfico, o sistema conta com um módulo de autenticação completo: o acesso às telas é protegido por login, o usuário é obrigado a trocar a senha padrão no primeiro acesso, pode alterar sua senha a qualquer momento e tem todas as tentativas de acesso (sucesso, falha, bloqueio e logout) registradas em uma tabela de logs auditável.

## Funcionalidades

- Login de usuário com sessão protegida
- Bloqueio automático de acesso após 3 tentativas de senha incorretas consecutivas
- Troca de senha obrigatória no primeiro acesso ao sistema
- Alteração de senha sob demanda (senha atual, nova senha e confirmação)
- Registro de logs de autenticação (login, falha, bloqueio e logout)
- Cadastro, edição e exclusão de continentes
- Cadastro, edição e exclusão de países, vinculados a um continente e, opcionalmente, a um governante
- Cadastro, edição e exclusão de cidades, vinculadas a um país e, opcionalmente, a um governante
- Cadastro, edição e exclusão de governantes
- Pesquisa em tempo real nas tabelas de listagem
- Dashboard com estatísticas globais (total de países, total de cidades, cidade mais populosa e distribuição de cidades por continente)

## Tecnologias utilizadas

- PHP (PDO)
- MySQL
- HTML5
- CSS3
- JavaScript

## Estrutura do projeto

```
6 - CRUD Mundo/
├── actions/        # Scripts que processam os formulários (create, update, delete) e o login
├── config/         # Configuração de conexão com o banco de dados (PDO)
├── css/            # Folha de estilos da aplicação
├── database/       # Script SQL de criação das tabelas e dados iniciais
├── includes/       # Cabeçalho, rodapé e módulo de autenticação (auth.php)
├── js/             # Script de front-end (busca nas tabelas, confirmação de exclusão, etc.)
├── views/          # Telas de cadastro/listagem de continentes, países, cidades, governantes e logs
├── index.php       # Dashboard principal do sistema
├── login.php       # Tela de login
├── logout.php      # Encerramento de sessão
├── trocar_senha.php # Tela de troca de senha
└── README.md
```

## Como executar

1. Clone este repositório para o diretório raiz do seu servidor local (ex: `C:/xampp/htdocs/`).
2. Crie o banco de dados executando o script `database/schema.sql` no MySQL — ele cria todas as tabelas e já insere um usuário administrador inicial.
3. Se necessário, ajuste usuário e senha de acesso ao banco em `config/conexao.php`.
4. Acesse pelo navegador em: `http://localhost/crud-mundo/login.php`.
5. Faça login com as credenciais iniciais abaixo. Como é o primeiro acesso, o sistema vai pedir a troca de senha antes de liberar o restante do sistema.

## Requisitos

- PHP 7.4 ou superior (com extensão PDO MySQL habilitada)
- MySQL ou MariaDB
- Servidor local como XAMPP, WAMP ou similar

## Credenciais iniciais

- **Login:** `admin`
- **Senha:** `admin123`

## Autor

Gustavo Henrique de Oliveira Gonçalves