<?php 
//  скрипт меняет Заголовок с ID = "change_block"
// Проверяем наличие меток в url и сохраняем в переменную
$url = $_SERVER['REQUEST_URI'];
$utm_content = '';
if (strpos($url, 'utm_') !== false) {
    $params = parse_url($url);
    parse_str($params['query'], $query);
    if (isset($query['utm_content'])) {
        $utm_content = $query['utm_content'];
    }
}

// Открываем файл с словарем значений id компании и заголовка
$file = fopen( $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/clear_theme/txt/adv_list.txt', 'r' );


$dictionary = array();
while(!feof($file)) {
    $line = fgets($file);
    $parts = explode('-', $line);
    $key_item = trim($parts[0]);

    $dictionary[$key_item] = $parts[1];
}
fclose($file);



if (array_key_exists($utm_content, $dictionary)) {
    $insert_h1 = $dictionary[$utm_content];
    $match_id = 1;
} else {
    $insert_h1 = ' ';
    $match_id = 0;
}


 ?>

<script>
    
    var match_id_js = <?php echo trim($match_id); ?>;
    if (match_id_js === 1) {
        var insert_h1 = '<?php echo trim($insert_h1); ?>';
        document.getElementById('change_block').innerHTML = insert_h1;
    } else{
        // document.getElementById('change_block').innerHTML = 'insert_h1';
    }

    
</script>
