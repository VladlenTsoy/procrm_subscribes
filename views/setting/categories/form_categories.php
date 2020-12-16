<?php echo form_open(null, ['id' => 'procrm-subscribes-categories-form']) ?>
<?php if (isset($categories) && $categories) { ?>
    <?php foreach ($categories as $category) { ?>
        <div class="form-group form-group-button">
            <input
                class="form-control" type="text"
                name="categories[<?php echo $category['id'] ?>]"
                value="<?php echo $category['title'] ?>"
                placeholder="<?php echo _l('title_category') ?>"
                required
            />
            <button type="button" class="btn btn-danger btn-category-delete"><i class="fa fa-trash"></i></button>
        </div>
    <?php } ?>
<?php } ?>
<!---->
<div class="add-category-block"></div>
<!---->
<div class="text-center">
    <button type="button" class="btn btn-primary btn-category-add"><i class="fa fa-plus"></i> <?php echo _l('add_category') ?></button>
</div>
<?php echo form_close() ?>