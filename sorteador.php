<?php

print("Qual jogo você quer jogar? \n1) Mega-Sena \n2)Quina \n3)Lotomania \n4)Lotofácil: ");

$tipo_jogo = readline("");

while($tipo_jogo > 4 or $tipo_jogo <= 0){

    print("Opção Inválida: ");
    $tipo_jogo = readline("");
}

switch ($tipo_jogo) {
    case 1:
        $dezenas_minimo = 6;        //mega-sena
        $dezenas_maximo = 20;
        $numero_minimo = 1;
        $numero_maximo = 60;
        $preco_base = 5;

        //$valores[] = [5, 35, 140, 420, 1050, 2310, 4620, 8580, 15015, 25025, 40040, 61880, 92820, 135660, 193800];
        break;
    
    case 2:
        $dezenas_minimo = 5;        //quina
        $dezenas_maximo = 15;
        $numero_minimo = 1;
        $numero_maximo = 80;
        $preco_base = 2.5;

        //$valores[] = [2.50, 15, 52.50, 140, 315, 630, 1155, 1980, 3217.50, 5005, 7507.50];
        break;

    case 3:
        $dezenas_minimo = 50;        //lotomania
        $dezenas_maximo = 50;
        $numero_minimo = 00;
        $numero_maximo = 99;
        $preco_base = 3;

        //$valores[] = [3];
        break;
    
    case 4:
        $dezenas_minimo = 15;        //lotofacil
        $dezenas_maximo = 20;
        $numero_minimo = 1;
        $numero_maximo = 25;
        $preco_base = 3;

        //$valores[] = [3, 48, 408, 2448, 11628, 46512];
        break;
}

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
