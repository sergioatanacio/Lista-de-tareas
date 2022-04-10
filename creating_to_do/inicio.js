
let table_category = document.querySelector('#table_category');
let template_table = document.querySelector('#template_table').content;
let form_insert_data = document.querySelector('#form_insert_data');
let template_table_category = document.querySelector('#template_table_category').content;

let data_table_fn = (datos)=>
{
    fetch('api.php', {
        method: 'POST',
        body: datos
    })
    .then( res => res.json())
    .then( data => {
        let fragment = document.createDocumentFragment();
        data.forEach((item, index, array) => {
            template_table.querySelector('.primero').textContent = item.primero;
            template_table.querySelector('.segundo').textContent = item.segundo;
            template_table.querySelector('form input.index_to_delete').setAttribute('value', index);

            let clone_node = document.importNode(template_table, true);
            fragment.append(clone_node);
        });

        let fragment_table_category = document.createDocumentFragment();
        clone_template_table_category = document.importNode(template_table_category, true);
        fragment_table_category.append(clone_template_table_category);
        fragment_table_category.querySelector('.table_category').append(fragment);

        container_table_category.innerHTML = ''; 
        container_table_category.append(fragment_table_category);
        form_insert_data.reset();
    })
};

form_insert_data.addEventListener('submit', (e)=>{
    e.preventDefault();
    data_table_fn(new FormData(form_insert_data));
});

data_table_fn(new FormData());

let form_delete_to_data = document.querySelectorAll('.form_delete_to_data');
form_delete_to_data.addEventListener('submit', (e) => {
    e.preventDefault();
    let element_to_delete = new FormData(form_delete_to_data);
    fetch('api.php',{
        method: 'POST',
        body: element_to_delete,
    })
    .then( result => result.json)
    .then( data => {
        data_table_fn(new FormData());
    })
});

