<?php

declare(strict_types=1);

require __DIR__ . '/src/Jogo.php';

session_start();

if (!isset($_SESSION['jogo']) || !$_SESSION['jogo'] instanceof Jogo) {
    $_SESSION['jogo'] = new Jogo();
}

/** @var Jogo $jogo */
$jogo = $_SESSION['jogo'];

// Processa ações enviadas pelo navegador (padrão POST/Redirect/GET)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'jogar' && isset($_POST['posicao'])) {
        $jogo->jogar((int) $_POST['posicao']);
    } elseif ($acao === 'reiniciar') {
        $jogo->reiniciar();
    } elseif ($acao === 'zerar') {
        $_SESSION['jogo'] = new Jogo();
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

if ($jogo->vencedor !== null) {
    $mensagem = "🎉 O jogador {$jogo->vencedor} venceu!";
} elseif ($jogo->empate) {
    $mensagem = '🤝 Deu velha! Empate.';
} else {
    $mensagem = "Vez do jogador {$jogo->jogadorAtual}";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jogo da Velha em PHP</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main>
    <h1>Jogo da Velha</h1>

    <p class="mensagem"><?= h($mensagem) ?></p>

    <form method="post" class="tabuleiro">
        <input type="hidden" name="acao" value="jogar">
        <?php foreach ($jogo->tabuleiro as $i => $celula): ?>
            <?php
            $classes = 'celula';
            if ($celula !== '') {
                $classes .= ' ' . strtolower($celula);
            }
            if (in_array($i, $jogo->linhaVencedora, true)) {
                $classes .= ' vitoria';
            }
            $desabilitada = $celula !== '' || $jogo->terminou();
            ?>
            <button type="submit" name="posicao" value="<?= $i ?>"
                    class="<?= $classes ?>"
                    <?= $desabilitada ? 'disabled' : '' ?>
                    aria-label="Casa <?= $i + 1 ?>">
                <?= h($celula) ?>
            </button>
        <?php endforeach; ?>
    </form>

    <section class="placar">
        <div><span>X</span><strong><?= $jogo->placar['X'] ?></strong></div>
        <div><span>Empates</span><strong><?= $jogo->placar['empates'] ?></strong></div>
        <div><span>O</span><strong><?= $jogo->placar['O'] ?></strong></div>
    </section>

    <form method="post" class="acoes">
        <button type="submit" name="acao" value="reiniciar">Nova partida</button>
        <button type="submit" name="acao" value="zerar" class="secundario">Zerar placar</button>
    </form>
</main>
</body>
</html>
