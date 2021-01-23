<?php
$alternatif = array();
$kriteria = array();

$kriteria[] = 'C1';
$kriteria[] = 'C2';
$kriteria[] = 'C3';
$kriteria[] = 'C4';
                    // 0           1  2  3   4  
$alternatif[] = array('A1 Lazada', 4, 3, 2.8, 4);       //0
$alternatif[] = array('A2 Tokopedia', 5, 4, 6.6, 4);    //1
$alternatif[] = array('A3 Blibli.com', 3, 5, 2.14, 3); //2
$alternatif[] = array('A4 Shopee', 5, 5, 5.6, 3);       //3
$alternatif[] = array('A5 Bukalapak', 4, 4, 4.29, 4);  //4

$index_alternatif = 0;
foreach ($alternatif as $alt){
    $index_kriteria = 1;
    foreach ($kriteria as $kr){
        if ($kr == 'C1' || 'C2') {
            $r[$index_alternatif][$index_kriteria] = round($alternatif[$index_alternatif][$index_kriteria] / max(array_column($alternatif, $index_kriteria)), 4);
        } elseif ($kr == 'C3' || $kr =='C4'){
            $r[$index_alternatif][$index_kriteria] = round($alternatif[$index_alternatif][$index_kriteria] / max(array_column($alternatif, $index_kriteria)), 4);
        } 
        $index_kriteria++;
    }
    $index_alternatif++;
}

echo '<pre>';
print_r($r);
echo '</pre>';

$w = array (0.35, 0.25, 0.20, 0.20);

$index_alternatif = 0;
foreach ($alternatif as $alt){
    $index_w = 0;
    $index_r = 1;
    $v = 0;
    foreach ($kriteria as $kr ){
        $v += $w[$index_w] * $r[$index_alternatif][$index_r];
        $index_r++;
        $index_w++;
    }
    $nilai[$index_alternatif]['alternatif'] = $alt[0];
    $nilai[$index_alternatif]['nilaiAkhir'] =$v;
    $index_alternatif++;
}

echo '<pre>';
print_r($nilai);
echo '</pre>';

usort($nilai, function($a, $b) {
    return $a['nilaiAkhir'] <=> $b['nilaiAkhir'];
});

echo '<h2>Rekomendasi</h2>';
$rank = 1;

foreach (array_reverse($nilai) as $v) {
    echo $rank . ' . ' . $v['alternatif'] . ' dengan nilai ' . $v['nilaiAkhir'] . '<br>';
    $rank++;
}