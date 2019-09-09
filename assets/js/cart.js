$(document).ready(function(){
    $('#cart-button').click(function(){
        const name = $('#hidden_name');
        const price = $('#hidden_price');
        const quantity = $('#hidden_quantity');
        const id = $(this).data('value');

        let dataToSent = {
            'id' : id,
            'name' : name.val(),
            'price' : price.val(),
            'quantity' : quantity.val()
        };

        $.ajax({
            url: 'index.php?page=Cart/add/'+id,
            data: dataToSent,
            dataType: 'json',
            method: 'post',
            success: function(data){
                let output = '';
                console.log(data);

                for(let i = 0; i < data.length; i++){
                    output += '<tr>'
                    output += '<td data-th="Product">';
                    output += '<div class="row">'
                    output += '<div class="col-sm-12 pl-4">';
                    output += '<h4 class="">'+data[i].name+'</h4>';
                    output += '</div></div></td>';
                    output += '<td data-th="Price">'+data[i].price+'</td>';
                    output += '<td data-th="Quantity"><p>'+data[i].quantity+'</p></td>';
                    output += '<td data-th="Subtotal" class="text-center">' + data[i].quantity * data[i].price + '</td>';
                    output += '<td class="actions" data-th=""><button class="btn btn-danger btn-sm">Delete</button></td>';
                    output += '</tr>';
                }


                $('#cart-body').html(output);
            },
            error: function(xhr, status, text){
                console.log(xhr);
            }
        });
    });
});