function deleteCartItem(id){
    let quantity = $('#quantity-js').val();
    $.ajax({
        url: 'index.php?page=Cart/remove/'+id,
        data: {
            'quantity': quantity
        },
        dataType: 'json',
        method: 'post',
        success: function(data){
            let output = '';
            let total = 0;

            for(let i = 0; i < data.length; i++){
                total = total + data[i].price * data[i].quantity;
                output += '<tr>'
                output += '<td data-th="Product">';
                output += '<div class="row">'
                output += '<div class="col-sm-12 pl-4">';
                output += '<h4 class="">'+data[i].name+'</h4>';
                output += '</div></div></td>';
                output += '<td data-th="Price">'+data[i].price+'</td>';
                output += '<td data-th="Quantity"><input type="hidden" name="quantity-js" id="quantity-js" value="'+data[i].quantity+'"><p>'+data[i].quantity+'</p></td>';
                output += '<td data-th="Subtotal" class="text-center">' + data[i].quantity * data[i].price + '</td>';
                output += '<td class="actions" data-th=""><button data-id="'+data[i].id+'" class="btn btn-danger btn-sm cart-item-delete">Delete</button></td>';
                output += '</tr>';
            }

            $('#cart-total-sum').html(total);
            $('#cart-body').html(output);
        },
        error: function(xhr, status, text){
            console.log(xhr);
        }
    });
}

function cartdelete(){
    $.ajax({
        url: 'index.php?page=Cart/destroy',
        dataType: 'json',
        method: 'post',
        success: function(data){
            console.log(123);
            let output = '';
            let total = 0;
            $('#cart-total-sum').html(total);
            $('#cart-body').html(output);
        },
        error: function(xhr, status, text){
            console.log(xhr);
        }
    });
}

