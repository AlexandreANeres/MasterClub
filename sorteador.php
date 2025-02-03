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
        $valor_minimo = 1;
        $valor_maximo = 60;
        break;
    
    case 2:
        $dezenas_minimo = 5;        //quina
        $dezenas_maximo = 15;
        $valor_minimo = 1;
        $valor_maximo = 80;
        break;

    case 3:
        $dezenas_minimo = 50;        //lotomania
        $dezenas_maximo = 50;
        $valor_minimo = 00;
        $valor_maximo = 99;
        break;
    
    case 4:
        $dezenas_minimo = 15;        //lotofacil
        $dezenas_maximo = 20;
        $valor_minimo = 1;
        $valor_maximo = 25;
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

/*function calculaPreco ($totalNumeros, $totalNumEscolhidos, $preco_base): float{

    $preco = fatorial($totalNumeros)/(fatorial($totalNumEscolhidos) * fatorial($totalNumeros - $totalNumEscolhidos));
    
    return $preco * $preco_base;
};

function fatorial($numero){

    $resultado =$numero;
    if($numero <= 0){
        return 1;
    }
    for ($i = $numero; $i > 1; $i--){

        $resultado = $resultado * ($i - 1);
    }

    return $resultado;
};*/



sorteador($numeroDezenas, $valor_minimo, $valor_maximo);
