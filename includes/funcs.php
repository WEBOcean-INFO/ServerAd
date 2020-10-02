<?php
function mysqli_result($result, $row, $field = 0) {
    if ($result === false) return false;
    if ($row >= mysqli_num_rows($result)) return false;
    if (is_string($field) && !(strpos($field, ".") === false)) {
        $t_field = explode(".", $field);
        $field = - 1;
        $t_fields = mysqli_fetch_fields($result);
        for ($id = 0;$id < mysqli_num_fields($result);$id++) {
            if ($t_fields[$id]->table == $t_field[0] && $t_fields[$id]->name == $t_field[1]) {
                $field = $id;
                break;
            }
        }
        if ($field == - 1) return false;
    }
    mysqli_data_seek($result, $row);
    $line = mysqli_fetch_array($result);
    return isset($line[$field]) ? $line[$field] : false;
}
function truncate_chars($str, $limit = 15, $bekind = false, $maxkind = NULL, $end = NULL) {
    if (empty($str) || gettype($str) != 'string') {
        return false;
    }
    $end = empty($end) || gettype($end) != 'string' ? '...' : $end;
    $limit = intval($limit) <= 0 ? 15 : intval($limit);
    if (mb_strlen($str, 'UTF-8') > $limit) {
        if ($bekind == true) {
            $maxkind = $maxkind == NULL || intval($maxkind) <= 0 ? 5 : intval($maxkind);
            $chars = preg_split('/(?<!^)(?!$)/u', $str);
            $cut = mb_substr($str, 0, $limit, 'UTF-8');
            $buffer = '';
            $total = $limit;
            for ($i = $limit;$i < count($chars);$i++) {
                if (!($chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i]))) {
                    if ($maxkind > 0) {
                        $maxkind--;
                        $buffer = $buffer . $chars[$i];
                    } else {
                        $buffer = !($chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i])) ? '' : $buffer;
                        $total = !($chars[$i] == "\n" || $chars[$i] == "\r" || $chars[$i] == " " || $chars[$i] == NULL || preg_match('/[\p{P}\p{N}]$/u', $chars[$i])) ? 0 : ($total + 1);
                        break;
                    }
                    $total++;
                } else {
                    break;
                }
            }
            return $total == mb_strlen($str, 'UTF-8') ? $str : ($cut . $buffer . $end);
        }
        return mb_substr($str, 0, $limit, 'UTF-8') . $end;
    } else {
        return $str;
    }
}
function mobio_checkcode2($servID4, $code, $debug = 0) {
    $res_lines = file("http://www.mobio.bg/code/checkcode.php?servID=$servID4&code=$code");
    $ret = 0;
    if ($res_lines) {
        if (strstr("PAYBG=OK", $res_lines[0])) {
            $ret = 1;
        } else {
            if ($debug) echo $line . "\n";
        }
    } else {
        if ($debug) echo "Unable to connect to mobio.bg server.\n";
        $ret = 0;
    }
    return $ret;
}

function percent($num_amount, $num_total) {
    if ($num_amount != 0) {
     $count1 = $num_amount / $num_total;
     $count2 = $count1 * 100;
     $count = number_format($count2, 0);
     return ''.$count.'%';
    } else return '0%';
   }