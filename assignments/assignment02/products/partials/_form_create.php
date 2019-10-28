<div class="container">
    <div class="table-heading-row">
        <h1>Create Product</h1>
    </div>

    <form method="post" enctype="multipart/form-data" data-behaviour="disable-submit">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required class="form-control" placeholder="T-Shirt, Mug, etc.">
        </div>
        <div class="form-group">
            <label for="country">Country of Origin</label>
            <input type="text" name="country" id="country" required class="form-control"
                   placeholder="India, Sudan, etc.">
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
                               class="form-control">
                    </div>
                </div>
                <div class="col">
                    <label for="sale_price">Sale Price ($)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="sale_price" id="sale_price" min="0" step="0.01" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"
                      placeholder="Description of the product."></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>

            <div class="custom-file">
                <input type="file" name="image" id="image" class="custom-file-input" accept="image/*"/>
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
        </div>
        <div>
            <h3>Please choose category</h3>
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
                $stmt = $dbh->prepare("SELECT * FROM category");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td>
                            <input type="checkbox" name="category[]" value="<?php echo $row["id"]; ?>"
                                   title="add-to-category">
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-behaviour="disable-on-submit">Create</button>
        </div>
    </form>
</div>
