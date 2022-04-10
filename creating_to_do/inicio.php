<?php


$first_template = function(string $contend_body, string $title = 'Document') :? string
{
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php print($title);?></title>
</head>
<body>
<?php print($contend_body);?>
</body>
</html>
<?php
    $return = ob_get_contents();
    ob_end_clean();
    return $return;
};

$first_form = function() :? string 
{

    ob_start();
?>
    <h1>Primero, segundo</h1>
    <form id="form_insert_data">
        <input type="hidden" name="type_form" value="submit_item">
        <label for="">Primero</label>
        <input autofocus type="text" name="primero" value="" placeholder="uno" required>

        <label for="">Segundo</label>
        <input type="text" name="segundo" value="" placeholder="dos" required>
        <input type="submit" value="Enviar">
    </form>
        <br><br><br>
        <template id="template_table">
            <tr>
                <td class='primero'></td>
                <td class='segundo'></td>
                <td>
                    <form class="form_delete_to_data">
                        <input type="hidden" name="type_form" value="delete">
                        <input type="hidden" name="index_to_delete" class="index_to_delete">
                        <input type="submit" value="Eliminar">
                        <!-- <input type="submit" value="Eliminar" onclick="return confirm('¿Desea eliminar ... ?')"> -->
                    </form>
                </td>
            </tr>
        </template>
        <template id="template_table_category">
            <table class="table_category">
                <tr>
                    <th>Primero</th>
                    <th>Segundo</th>
                    <th>eliminar</th>
                </tr>
            </table>
        </template>
        
        <div id="container_table_category"></div>

        <script src="inicio.js"></script>
<?php
    $return = ob_get_contents();
    ob_end_clean();
    
    return $return;
};

print($first_template($first_form(), 'Inicio'));


