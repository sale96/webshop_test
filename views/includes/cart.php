<div class="cart mt-5">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody id="cart-body">
        <?php $total = 0; ?>
        <?php if(Sessions::isCart()) : ?>
        <?php foreach(Sessions::getCart() as $item) : ?>

        <?php $total = $total + ($item['quantity'] * $item['price']); ?>
        <tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-12 pl-4">
                        <h4 class=""><?= $item['name']; ?></h4>
                    </div>
                </div>
            </td>
            <td data-th="Price"><?= $item['price']; ?></td>
            <td data-th="Quantity">
                <input type="hidden" name="quantity-js" id="quantity-js" value="<?= $item['quantity']; ?>">
                <p><?= $item['quantity']; ?></p>
            </td>
            <td data-th="Subtotal" class="text-center"><?= $item['quantity'] * $item['price']; ?></td>
            <td class="actions" data-th="">
                <button onclick="deleteCartItem(<?= $item['id'] ?>);" class="btn btn-danger btn-sm cart-item-delete">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
        <tfoot>
        <tr>
            <td><button onclick="cartdelete();" id="cart-delete"" class="btn btn-danger btn-sm">Delete all</button></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total:  <span id="cart-total-sum"><?= $total; ?></span></strong></td>
            <td>
                <a href="#" id="button-check-out" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>
            </td>
        </tr>
        </tfoot>
    </table>
</div>