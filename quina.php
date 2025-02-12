<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

$dezenas_minimo = 5;        //quina
$dezenas_maximo = 15;
$numero_minimo = 1;
$numero_maximo = 80;
$preco_base = 2.5;

$numeroDezenas = readline("Quantas dezenas você quer jogar? ");

while($numeroDezenas < $dezenas_minimo or $numeroDezenas > $dezenas_maximo){

    $numeroDezenas = readline("Número inválido. São aceitas apenas entre $dezenas_minimo e $dezenas_maximo dezenas. ");
}

function sorteador ($numeroDezenas, $minimo, $maximo){
    
    $numerosSorteados = [];

    for ($i = 0; $i < $numeroDezenas; $i++){

        $numeroSorteado = random_int($minimo, $maximo);
        
        if (in_array($numeroSorteado, $numerosSorteados)) {
            $i--;
            continue;
        }
        
        $numerosSorteados[] = $numeroSorteado;
        
    
    
    };
    
    sort($numerosSorteados);
    print_r($numerosSorteados);
}
/**
 * Calcula o fatorial de um número
 */
function fatorial($n) {
    if ($n <= 1) return 1;
    return $n * fatorial($n - 1);
}

/**
 * Calcula a combinação C(n,r)
 */
function combinacao($n, $r) {
    return fatorial($n) / (fatorial($r) * fatorial($n - $r));
}

/**
 * Calcula o preço da aposta da Mega-Sena
 */
function calcular_preco($numeroDezenas, $preco_base, $numero_minimo, $numero_maximo, $dezenas_minimo) {        //numeroDezenas = quantidade de apostas do usuário
                                                                                                               //preco_base = valor mínimo da aposta
    if ($numeroDezenas < $numero_minimo || $numeroDezenas > $numero_maximo) {                                  //numero_minimo = numero minimo que pode ser sorteado
        return [                                                                                               //numero_maximo = numero maximo que pode ser sorteado
            'erro' => true,                                                                                    //dezenas_minimo = minimo de apostas que o usuário pode realizar
            'mensagem' => "Número de dezenas deve ser entre {$numero_minimo} e {$numero_maximo}",
            'preco' => 0,
            'combinacoes' => 0
        ];
    }
    
    $combinacoes = combinacao($numeroDezenas, $dezenas_minimo);
    $preco = $preco_base * $combinacoes;
    
    return [
        'erro' => false,
        'mensagem' => '',
        'preco' => $preco,
        'combinacoes' => $combinacoes
    ];
}



sorteador($numeroDezenas, $numero_minimo, $numero_maximo);
print("O valor das apostas é R$" . calcular_preco($numeroDezenas, $preco_base, $numero_minimo, $numero_maximo, $dezenas_minimo)['preco'] . "\n");


    ?>
</body>
</html>
