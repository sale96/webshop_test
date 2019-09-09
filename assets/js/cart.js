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
                let total = 0;
                for(let i = 0; i < data.product.length; i++){
                    total = total + data.product[i].price * data.product[i].quantity;
                    output += '<tr>'
                    output += '<td data-th="Product">';
                    output += '<div class="row">'
                    output += '<div class="col-sm-12 pl-4">';
                    output += '<h4 class="">'+data.product[i].name+'</h4>';
                    output += '</div></div></td>';
                    output += '<td data-th="Price">'+data.product[i].price+'</td>';
                    output += '<td data-th="Quantity"><input type="hidden" name="quantity-js" id="quantity-js" value="'+data.product[i].quantity+'"/><p>'+data.product[i].quantity+'</p></td>';
                    output += '<td data-th="Subtotal" class="text-center">' + data.product[i].quantity * data.product[i].price + '</td>';
                    output += '<td class="actions" data-th=""><button onclick="deleteCartItem('+data.product[i].id+');" class="btn btn-danger btn-sm cart-item-delete">Delete</button></td>';
                    output += '</tr>';
                }
                if(data.quantity == 0){
                    $('#cart-button').hide();
                    document.querySelector('#single-product-info').innerHTML += '<p class="lead">Currently we don\'t have this product at our disposal.</p>';
                }
                $("#quantity-value").html(data.quantity);
                $('#cart-total-sum').html(total);
                $('#cart-body').html(output);
            },
            error: function(xhr, status, text){
                console.log(xhr);
            }
        });
    });
});