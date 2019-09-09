<div class="cart">
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
        <?php if(Sessions::isCart()) : ?>
        <?php $total = 0; ?>
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
                <p><?= $item['quantity']; ?></p>
            </td>
            <td data-th="Subtotal" class="text-center"><?= $item['quantity'] * $item['price']; ?></td>
            <td class="actions" data-th="">
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total:  <span id="cart-total-sum"><?= $total; ?></span></strong></td>
            <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
        </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</div>