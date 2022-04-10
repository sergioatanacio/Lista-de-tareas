<?php
/* Se crea una función de array reduce, pero que permite usar la llave y el valor de un array. */
$array_reduce_key = function(array $array, callable $callback, $initial = [])
{
    $carry = $initial;
    foreach($array as $key => $value){
        $carry = $callback($carry, $key, $value);
    }
    return $carry;
};

$name_file_relative = './data.php';
$name_file = (fn():string =>__DIR__.$name_file_relative)();

$header = fn(string $contend) : string =>
'<?php
return '.$contend.';';

$data_file = file_exists($name_file)
    ? require $name_file
    : null;

$data = (fn($arg) : array =>is_array($arg) ? $arg : [])($data_file);

$actions = function(array $arg) use ($data) : array
{
    $return = [
        'submit_item' => fn() : array => array_merge($data, 
            [[
                'primero' => $arg['primero'],
                'segundo' => $arg['segundo'],
            ]]),
        'delete'    => fn() : array => array_filter($data, fn($key)=> $key != $arg['index_to_delete'], ARRAY_FILTER_USE_KEY),
    ];

    return $return[$arg['type_form']]();
};

$data_more_post = (fn($arg_post): array =>
    ($arg_post !== [] && is_array($arg_post)) 
        /* El post es un array dentro de otro, por que debe unirse con el data, 
        el cual es un array que contiene arrays */
        ? $actions($arg_post)
        : $data)($_POST);




$write = (fn():string =>$header(var_export($data_more_post, true)))();


$file = fopen($name_file, "w");
fwrite($file, $write);
fclose($file);

print(json_encode($data_more_post));