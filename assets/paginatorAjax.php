<?php

$lelang = new lelang();
//Untuk dihitung semua lelangnya
$semuaLelang = $lelang->tampilLelangSemua();

if (count($semuaLelang) > 0) {
    $paginationCount = getPagination(count($semuaLelang),config::$LELANGPERPAGE);
}

$content ='<div id="pageData"></div>
    <div id="tesCetak"></div>';

if (count($semuaLelang) > 0) {
    $content .='
        <div align="center">
        <ul class="pagination">
        <li class="active" id="link">
            <a id="link" href="javascript:void(0)" onclick="changePagination(\'0\',\'first\')">&laquo;</a>
        </li>';
    for ($i = 0; $i < $paginationCount; $i++) {
        $content .='<li id="' . $i . '_no">'; //id="' . $i . '_no" >
        $content .='
          <a href="javascript:void(0)" onclick="changePagination(\'' . $i . '\',\'' . $i . '_no\')">' . ($i + 1) . '</a>
        </li>';
    }
    $content .='
        <li id="link">
             <a href="javascript:void(0)" onclick="changePagination(\'' . ($paginationCount - 1) . '\',\'last\')">&raquo;
        </a></li>
        <li class="loading"></li>
        </ul>
        </div>';
    print_r($content);
}
?>