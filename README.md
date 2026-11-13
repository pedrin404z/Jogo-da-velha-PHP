# 🎮 Jogo da Velha em PHP

Jogo da velha para dois jogadores feito com **PHP puro**, HTML e CSS. O estado da partida e o placar ficam guardados na sessão do PHP, então não precisa de banco de dados nem de JavaScript.

## ✨ Funcionalidades

* Dois jogadores (X e O) no mesmo navegador
* Detecção de vitória (com destaque na linha vencedora) e de empate
* Placar que se mantém entre as partidas
* Botões para iniciar nova partida e zerar o placar
* Layout responsivo com suporte a modo escuro

## 📁 Estrutura do projeto

```
jogo-da-velha-php/
├── assets/
│   └── style.css      # Estilos da página
├── src/
│   └── Jogo.php       # Classe com as regras do jogo
├── .gitignore
├── index.php          # Página principal (interface e controle)
└── README.md
```

## 🚀 Como executar

**Requisito:** PHP 7.4 ou superior.

```bash
# 1. Clone o repositório
git clone https://github.com/pedrin404z/Jogo-da-velha-PHP.git
cd Jogo-da-velha-PHP

# 2. Inicie o servidor embutido do PHP
php -S localhost:8000

# 3. Abra no navegador
# http://localhost:8000
```

## 🧠 Como funciona

* `src/Jogo.php` contém a classe `Jogo`, responsável pelo tabuleiro, pela alternância de jogadores, pela verificação das 8 combinações vencedoras e pelo placar.
* `index.php` guarda o objeto `Jogo` em `$\_SESSION`, recebe as jogadas via `POST` e redireciona de volta (padrão *Post/Redirect/Get*, que evita reenvio ao atualizar a página).

## 🔧 Ideias para evoluir

* Modo contra o computador
* Jogar com JavaScript, sem recarregar a página
* Salvar o histórico de partidas em banco de dados

## 👤 Autor

Feito por **Pedro Santana da Silva** — [GitHub](https://github.com/SEU-USUARIO)

