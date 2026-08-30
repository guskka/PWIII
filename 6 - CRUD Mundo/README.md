# CRUD Mundo - Sistema de Gerenciamento Geográfico

- **Aluno:** Gustavo Henrique de Oliveira Gonçalves

## Descrição do Projeto
Uma aplicação web completa (Full-Stack) voltada para o gerenciamento de dados de distribuições geográficas e esferas governamentais (Continentes, Países, Cidades e Governantes). O sistema implementa validações em tempo real e opera respeitando regras restritas de integridade relacional.

## Tecnologias Utilizadas
- **Front-End:** HTML5, CSS3 e Vanilla JavaScript.
- **Back-End:** PHP.
- **Banco de Dados:** MySQL.

## Como Executar o Projeto
1. Clone este repositório para o diretório raiz do seu servidor local (ex: `C:/xampp/htdocs/`).
2. Abra o painel do MySQL e execute todo o script contido em `database/schema.sql` para gerar o ecossistema de tabelas.
3. Se necessário, ajuste os parâmetros de usuário e senha dentro de `config/conexao.php`.
4. Acesse pelo navegador em: `http://localhost/crud-mundo/login.php`.

## Módulo de Autenticação

O acesso ao sistema agora é protegido por login. Todas as telas do CRUD (Dashboard, Continentes, Países, Cidades e Governantes) exigem uma sessão ativa.

**Credenciais iniciais (criadas pelo `schema.sql`):**
- **Login:** `admin`
- **Senha:** `admin123`

Como esse é o primeiro acesso desse usuário, o sistema obrigará a troca de senha antes de liberar qualquer outra tela.

### Regras implementadas
- **Tabela `usuarios`**: armazena login, senha (hash `bcrypt` via `password_hash`), flag de primeiro acesso, contador de tentativas de senha incorreta e flag de bloqueio.
- **Tabela `logs`**: registra cada evento de autenticação (login com sucesso, falha, bloqueio automático, troca de senha e logout), com data/hora e IP de origem.
- **Bloqueio por tentativas**: ao errar a senha 3 vezes consecutivas, o usuário é automaticamente bloqueado (`bloqueado = 1`) e impedido de tentar novamente, mesmo com a senha correta, até que um administrador o desbloqueie diretamente no banco de dados. Um acerto na senha antes da 3ª tentativa zera o contador.
- **Troca de senha obrigatória**: enquanto `primeiro_acesso = 1`, o usuário é redirecionado para `trocar_senha.php` em qualquer tentativa de acessar outra página, até definir uma nova senha (mínimo de 6 caracteres).
- **Tela de Logs** (`views/logs.php`): permite consultar o histórico de acessos registrado na tabela `logs`.

### Novos arquivos
- `login.php`, `logout.php`, `trocar_senha.php` — telas do fluxo de autenticação.
- `actions/auth_action.php` — processa o login, o contador de tentativas e o bloqueio.
- `actions/senha_action.php` — processa a troca de senha.
- `includes/auth.php` — funções centrais de sessão (`estaLogado`, `exigirLogin`, `registrarLog`).
- `views/logs.php` — consulta da tabela `logs`.