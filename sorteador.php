<?php

$numeroDezenas = readline("Quantas dezenas você quer jogar? ");

while($numeroDezenas < 6 or $numeroDezenas > 20){

    $numeroDezenas = readline("Número inválido. São aceitas apenas entre 6 e 20 dezenas. ");
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

sorteador($numeroDezenas, 1, 60);
//sorteador(70, 1, 80);