<?php

declare(strict_types=1);

/**
 * Lógica do Jogo da Velha.
 * O tabuleiro é um array de 9 posições (0 a 8), cada uma com '', 'X' ou 'O'.
 */
class Jogo
{
    private const LINHAS_VENCEDORAS = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // linhas
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // colunas
        [0, 4, 8], [2, 4, 6],            // diagonais
    ];

    public array $tabuleiro;
    public string $jogadorAtual;
    public ?string $vencedor = null;
    public array $linhaVencedora = [];
    public bool $empate = false;
    public array $placar;

    public function __construct()
    {
        $this->placar = ['X' => 0, 'O' => 0, 'empates' => 0];
        $this->reiniciar();
    }

    public function reiniciar(): void
    {
        $this->tabuleiro = array_fill(0, 9, '');
        $this->jogadorAtual = 'X';
        $this->vencedor = null;
        $this->linhaVencedora = [];
        $this->empate = false;
    }

    public function terminou(): bool
    {
        return $this->vencedor !== null || $this->empate;
    }

    public function jogar(int $posicao): bool
    {
        if ($this->terminou() || $posicao < 0 || $posicao > 8 || $this->tabuleiro[$posicao] !== '') {
            return false;
        }

        $this->tabuleiro[$posicao] = $this->jogadorAtual;
        $this->verificarFim();

        if (!$this->terminou()) {
            $this->jogadorAtual = $this->jogadorAtual === 'X' ? 'O' : 'X';
        }

        return true;
    }

    private function verificarFim(): void
    {
        foreach (self::LINHAS_VENCEDORAS as [$a, $b, $c]) {
            $valor = $this->tabuleiro[$a];
            if ($valor !== '' && $valor === $this->tabuleiro[$b] && $valor === $this->tabuleiro[$c]) {
                $this->vencedor = $valor;
                $this->linhaVencedora = [$a, $b, $c];
                $this->placar[$valor]++;
                return;
            }
        }

        if (!in_array('', $this->tabuleiro, true)) {
            $this->empate = true;
            $this->placar['empates']++;
        }
    }
}
