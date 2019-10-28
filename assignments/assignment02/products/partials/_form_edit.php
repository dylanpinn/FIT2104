<div class="container">
    <div class="table-heading-row">
        <h1>Edit Product (ID: <?php echo $product->product_id; ?>)</h1>
    </div>

    <form method="post" enctype="multipart/form-data" data-behaviour="disable-submit">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required class="form-control" placeholder="T-Shirt, Mug, etc."
                   value="<?php echo $product->name; ?>">
        </div>
        <div class="form-group">
            <label for="country">Country of Origin</label>
            <input type="text" name="country" id="country" required class="form-control"
                   placeholder="India, Sudan, etc." value="<?php echo $product->country_of_origin; ?>">
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="purchase_price">Purchase Price ($)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="purchase_price" id="purchase_price" min="0" step="0.01"
                               class="form-control" value="<?php echo $product->purchase_price; ?>">
                    </div>
                </div>
                <div class="col">
                    <label for="sale_price">Sale Price ($)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="sale_price" id="sale_price" min="0" step="0.01" class="form-control"
                               value="<?php echo $product->sale_price; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"
                      placeholder="Description of the product."><?php echo $product->description; ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>

            <div class="form-row">
                <div class="col">
                    <div class="custom-file">
                        <input type="file" name="image" id="image" class="custom-file-input" accept="image/*"/>
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
                <div class="col">
                    <?php if ($product->image_name &&
                        file_exists(__DIR__ . '/../../product_images/' . $product->image_name)
                    ) : ?>
                        <div class="product-image-preview-wrapper">
                            <div class="product-image-preview">
                                <img src="product_images/<?php echo $product->image_name; ?>"
                                     alt="<?php echo $product->name; ?>"/>
                                <small style="text-align: center; display: block;">
                                    <?php echo $product->image_name; ?>
                                </small>
                            </div>
                            <input type="submit" class="btn btn-secondary float-right" value="Remove Image"
                                   name="remove_image"/>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Add to Product</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $prod_cat_stmt = $dbh->prepare("SELECT * FROM product_category WHERE product_id = ?");
                $prod_cat_stmt->execute([$_GET['product_id']]);
                $prod_cat_rows = $prod_cat_stmt->fetchAll();

                $prod_cat_ids = [];
                foreach ($prod_cat_rows as $prod_cat_row) {
                    $prod_cat_ids[] = intval($prod_cat_row["category_id"]);
                }
                $prod_cat_stmt->closeCursor();

                $stmt = $dbh->prepare("SELECT * FROM category");
                $stmt->execute();
                while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td>
                            <input type="checkbox" name="category[]" value="<?php echo $row["id"]; ?>"
                                   title="add-to-category"
                                <?php echo in_array(intval($row["id"]), $prod_cat_ids) ? "checked" : ''; ?> >
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Update</button>
        </div>
    </form>
</div>
