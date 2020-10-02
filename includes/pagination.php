<?php
/*
	Библиотека за странициране
*/
function pagination($results, $properties = array(), $gameget) {
    error_reporting(0);
    $defaultProperties = array('get_vars' => array(), 'per_page' => 15, 'per_side' => 4, 'get_name' => 'page');
    foreach ($defaultProperties as $name => $default) {
        $properties[$name] = (isset($properties[$name])) ? $properties[$name] : $default;
    }
    foreach ($properties['get_vars'] as $name => $value) {
        if (isset($_GET[$name])) {
            $GETItems[] = $name . '=' . $value;
        }
    }
    $l = (empty($GETItems)) ? '?' . $properties['get_name'] . '=' : '?' . implode('&', $GETItems) . '&' . $properties['get_name'] . '=';
    $totalPages = ceil($results / $properties['per_page']);
    $currentPage = (isset($_GET[$properties['get_name']]) && $_GET[$properties['get_name']] > 1) ? $_GET[$properties['get_name']] : 1;
    $currentPage = ($currentPage > $totalPages) ? $totalPages : $currentPage;
    $previousPage = $currentPage - 1;
    $nextPage = $currentPage + 1;
    if ($totalPages <= ($properties['per_side'] * 2) + 1) {
        $loopStart = 1;
        $loopRange = $totalPages;
    } else {
        $loopStart = $currentPage - $properties['per_side'];
        $loopRange = $currentPage + $properties['per_side'];
        $loopStart = ($loopStart < 1) ? 1 : $loopStart;
        while ($loopRange - $loopStart < $properties['per_side'] * 2) {
            $loopRange++;
        }
        $loopRange = ($loopRange > $totalPages) ? $totalPages : $loopRange;
        while ($loopRange - $loopStart < $properties['per_side'] * 2) {
            $loopStart--;
        }
    }
    $output = '';
    $output.= '<ul class="pagination pagination-responsive justify-content-center">';
    if ($currentPage != 1) {
        if (!empty($gameget)) {
            $output.= '<li class="page-item"><a href=\'' . $l . '1&game=' . $gameget . '\' class="page-link">&#171;</a></li>';
            $output.= '<li class="page-item active"><a href=\'' . $l . $previousPage . '&game=' . $gameget . '\' class="page-link">‹</a></li>';
        } else {
            $output.= '<li class="page-item active"><a href=\'' . $l . '1\' class="page-link">&#171;</a></li>';
            $output.= '<li class="page-item active"><a href=\'' . $l . $previousPage . '\' class="page-link">‹</a></li>';
        }
    } else {
        $output.= '<li class="page-item disabled"><a class=\'page-link\'>&#171;</a></li>';
        $output.= '<li class="page-item disabled"><a class=\'page-link\'>‹</a></li>';
    }
    for ($p = $loopStart;$p <= $loopRange;$p++) {
        if ($p != $currentPage) {
            if (!empty($gameget)) {
                $output.= '<li class="page-item active"><a href=\'' . $l . $p . '&game=' . $gameget . '\' class=\'page-link\'>' . $p . '</a></li>';
            } else {
                $output.= '<li class="page-item active"><a href=\'' . $l . $p . '\' class=\'page-link\'>' . $p . '</a></li>';
            }
        } else {
            $output.= '<li class="page-item active"><a class=\'page-link\'>' . $p . '</a></li>';
        }
    }
    if ($currentPage != $totalPages) {
        if (!empty($gameget)) {
            $output.= '<li class="page-item active"><a href=\'' . $l . $nextPage . '&game=' . $gameget . '\' class=\'page-link\'>›</a></li>';
            $output.= '<li class="page-item active"><a href=\'' . $l . $totalPages . '&game=' . $gameget . '\' class=\'page-link\'>&#187;</a></li>';
        } else {
            $output.= '<li class="page-item active"><a href=\'' . $l . $nextPage . '\' class=\'page-link\'>›</a></li>';
            $output.= '<li class="page-item active"><a href=\'' . $l . $totalPages . '\' class=\'page-link\'>&#187;</a></li>';
        }
    } else {
        $output.= '<li class="page-item disabled"><a class=\'page-link\'>›</a></li>';
        $output.= '<li class="page-item disabled"><a class=\'page-link\'>&#187;</a></li>';
    }
    $output.= '</ul>';
    return array('limit' => array('first' => $previousPage * $properties['per_page'], 'second' => $properties['per_page']), 'output' => $output);
}
