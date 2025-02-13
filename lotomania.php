<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lotomania</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="container">
        <h1>Lotomania</h1>
        <form method="POST">
            <label for="numeroDezenas">Número de Dezenas:</label>
            <input type="number" id="numeroDezenas" name="numeroDezenas" min="50" max="50" required>
            <button type="submit">Sortear</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dezenas_minimo = 50;        // lotomania
            $dezenas_maximo = 50;
            $numero_minimo = 0;
            $numero_maximo = 99;
            $preco_base = 3;

            $numeroDezenas = intval($_POST['numeroDezenas']);

            function sorteador($numeroDezenas, $minimo, $maximo) {
                $numerosSorteados = [];
                for ($i = 0; $i < $numeroDezenas; $i++) {
                    $numeroSorteado = random_int($minimo, $maximo);
                    if (in_array($numeroSorteado, $numerosSorteados)) {
                        $i--;
                        continue;
                    }
                    $numerosSorteados[] = $numeroSorteado;
                }
                sort($numerosSorteados);
                return $numerosSorteados;
            }

            function fatorial($n) {
                if ($n <= 1) return 1;
                return $n * fatorial($n - 1);
            }

            function combinacao($n, $r) {
                return fatorial($n) / (fatorial($r) * fatorial($n - $r));
            }

            function calcular_preco($numeroDezenas, $preco_base, $numero_minimo, $numero_maximo, $dezenas_minimo) {
                if ($numeroDezenas < $numero_minimo || $numeroDezenas > $numero_maximo) {
                    return [
                        'erro' => true,
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

            $numerosSorteados = sorteador($numeroDezenas, $numero_minimo, $numero_maximo);
            $resultado = calcular_preco($numeroDezenas, $preco_base, $numero_minimo, $numero_maximo, $dezenas_minimo);

            if ($resultado['erro']) {
                echo "<p>{$resultado['mensagem']}</p>";
            } else {
                echo "<p>Números sorteados: " . implode(", ", $numerosSorteados) . "</p>";
                echo "<p>O valor das apostas é R$" . number_format($resultado['preco'], 2, ',', '.') . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>