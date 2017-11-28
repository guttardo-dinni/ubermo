<?php
    //crie uma variável para receber o código da tabela
    $tabela = '<table border="1">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    $tabela .= '<th>Alvara</th>'; // colunas do cabeçalho
    $tabela .= '<th>Numero</th>';
    $tabela .= '<th>Validade</th>';
    $tabela .= '<th>Anexo</th>';
    $tabela .= '<th>Valor numero</th>';
    $tabela .= '<th>Data</th>';
    $tabela .= '<th>Ver PDF</th>';
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td></td>'; // coluna Alvara
    $tabela .= '<td>'.$exibe['AlvaraNumero'].'</td>'; //coluna numero
    $tabela .= '<td>'.$exibe['AlvaraValidade'].'</td>'; // coluna validade
    $tabela .= '<td></td>'; //coluna anexo
    $tabela .= '<td></td>';//coluna valor numero
    $tabela .= '<td></td>'; // coluna data
    $tabela .= '<td><a href="MostrarAlvara.php?id='.$exibe['id'].'">Ver PDF </a></td>';
    $tabela .= '</tr>'; // fecha linha
    /*loop deve terminar aqui*/
    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela

    echo $tabela; // imprime
?>