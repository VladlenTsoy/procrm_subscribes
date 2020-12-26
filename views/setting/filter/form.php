<form id="form-filter-for-subscribes">
    <div class="form-group">
        <label for="filter_category"><?php echo _l('categories') ?></label>
        <select name="filter_category" id="filter_category" class="form-control">
            <option value="all"><?php echo _l('all') ?></option>
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
            <?php } ?>
        </select>
    </div>
</form>
