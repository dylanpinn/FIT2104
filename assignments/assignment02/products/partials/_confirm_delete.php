<div class="container">
    <div class="table-heading-row">
        <h1>Delete Product (ID: <?php echo $product->product_id; ?>)</h1>
    </div>

    <form method="post" data-behaviour="disable-submit">
        <div class="form-group">
            Are you sure you want to delete this product - <?php echo $product->name; ?>?
        </div>

        <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>"/>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Delete</button>
            <a href="products/index.php" class="btn brn-secondary">Cancel</a>
        </div>
    </form>
</div>
