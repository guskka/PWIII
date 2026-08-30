<?php
/**
 * Módulo de Autenticação
 * Centraliza o controle de sessão, verificação de acesso,
 * regra de primeiro acesso e registro de logs do sistema.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const MAX_TENTATIVAS = 3;

/**
 * Verifica se existe um usuário autenticado na sessão atual.
 */
function estaLogado(): bool {
    return isset($_SESSION['usuario_id']);
}

/**
 * Protege uma página: exige login e, se for o primeiro acesso do
 * usuário, força o redirecionamento para a troca de senha antes de
 * liberar qualquer outra tela do sistema.
 *
 * @param string $prefixo Caminho relativo até a raiz do projeto
 *                        (use '' para páginas na raiz e '../' para
 *                        páginas dentro de views/ ou actions/).
 */
function exigirLogin(string $prefixo = ''): void {
    if (!estaLogado()) {
        header("Location: {$prefixo}login.php");
        exit;
    }

    $paginaAtual = basename($_SERVER['PHP_SELF']);
    if (!empty($_SESSION['primeiro_acesso']) && $paginaAtual !== 'trocar_senha.php') {
        header("Location: {$prefixo}trocar_senha.php");
        exit;
    }
}

/**
 * Registra uma linha de auditoria na tabela LOGS.
 *
 * @param PDO         $pdo          Conexão ativa com o banco.
 * @param int|null    $usuarioId    ID do usuário (quando conhecido).
 * @param string|null $loginTentado Login informado na tentativa.
 * @param string      $acao         Identificador da ação (ex: LOGIN_SUCESSO).
 */
function registrarLog(PDO $pdo, ?int $usuarioId, ?string $loginTentado, string $acao): void {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'desconhecido';
    $stmt = $pdo->prepare("INSERT INTO logs (usuario_id, login_tentado, acao, ip_address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuarioId, $loginTentado, $acao, $ip]);
}
