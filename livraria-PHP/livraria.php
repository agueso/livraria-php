<?php

$livros = [];

function cadastrar_livro(&$livros) {
    echo "\nDigite o código do livro: ";
    $codigo = trim(fgets(STDIN));

    if (livro_existe($livros, $codigo)) {
        echo "Erro: O código do livro já existe.\n";
        return;
    }

    echo "Digite o nome do livro: ";
    $nome = trim(fgets(STDIN));

    echo "Digite o autor do livro: ";
    $autor = trim(fgets(STDIN));

    echo "Digite a quantidade em estoque: ";
    $quantidade = trim(fgets(STDIN));

    if (!is_numeric($quantidade) || $quantidade < 0) {
        echo "Erro: Quantidade inválida.\n";
        return;
    }

    $livros[] = [
        'codigo' => $codigo,
        'nome' => $nome,
        'autor' => $autor,
        'quantidade' => $quantidade
    ];

    echo "Livro cadastrado com sucesso!\n";
}

function livro_existe($livros, $codigo) {
    foreach ($livros as $livro) {
        if ($livro['codigo'] == $codigo) {
            return true;
        }
    }
    return false;
}

function consultar_livro($livros, $codigo) {
    foreach ($livros as $livro) {
        if ($livro['codigo'] == $codigo) {
            echo "\nDetalhes do Livro:\n";
            echo "Código: " . $livro['codigo'] . "\n";
            echo "Nome: " . $livro['nome'] . "\n";
            echo "Autor: " . $livro['autor'] . "\n";
            echo "Quantidade em estoque: " . $livro['quantidade'] . "\n";
            return;
        }
    }

    echo "Livro não encontrado.\n";
}

function atualizar_estoque(&$livros, $codigo, $quantidade) {
    foreach ($livros as &$livro) {
        if ($livro['codigo'] == $codigo) {
            if (!is_numeric($quantidade) || $quantidade < 0) {
                echo "Erro: Quantidade inválida.\n";
                return;
            }

            $livro['quantidade'] = $quantidade;
            echo "Estoque atualizado com sucesso!\n";
            return;
        }
    }

    echo "Livro não encontrado.\n";
}

function exibir_livros($livros) {
    if (empty($livros)) {
        echo "Nenhum livro cadastrado.\n";
        return;
    }

    echo "\nLista de Livros Cadastrados:\n";
    foreach ($livros as $livro) {
        echo "Código: " . $livro['codigo'] . " | Nome: " . $livro['nome'] . " | Autor: " . $livro['autor'] . " | Estoque: " . $livro['quantidade'] . "\n";
    }
}

function exibir_menu() {
    echo "\nMenu de opções:\n";
    echo "1. Cadastrar livro\n";
    echo "2. Consultar livro\n";
    echo "3. Atualizar estoque\n";
    echo "4. Exibir todos os livros\n";
    echo "5. Sair\n";
    echo "Escolha uma opção: ";
    return trim(fgets(STDIN));
}

function sistema() {
    global $livros;

    do {
        $opcao = exibir_menu();
        
        switch ($opcao) {
            case 1:
                cadastrar_livro($livros);
                break;
            case 2:
                echo "Digite o código do livro para consulta: ";
                $codigo = trim(fgets(STDIN));
                consultar_livro($livros, $codigo);
                break;
            case 3:
                echo "Digite o código do livro para atualizar o estoque: ";
                $codigo = trim(fgets(STDIN));
                echo "Digite a nova quantidade em estoque: ";
                $quantidade = trim(fgets(STDIN));
                atualizar_estoque($livros, $codigo, $quantidade);
                break;
            case 4:
                exibir_livros($livros);
                break;
            case 5:
                echo "Saindo do sistema...\n";
                break;
            default:
                echo "Opção inválida. Tente novamente.\n";
        }
        
    } while ($opcao != 5);
}

sistema();

?>
