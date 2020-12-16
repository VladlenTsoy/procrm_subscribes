<button class="btn btn-primary" data-toggle="modal" data-target="#procrmSubscribesCategoriesModal">
    <i class="fa fa-list"></i> <?php echo _l('categories') ?>
</button>

<!-- Modal -->
<div class="modal fade" id="procrmSubscribesCategoriesModal" tabindex="-1"
     aria-labelledby="procrmSubscribesCategoriesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"> <?php echo _l('categories') ?> </h4>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
                <button type="submit" class="btn btn-primary" form="procrm-subscribes-categories-form"><?php echo _l('save') ?></button>
            </div>
        </div>
    </div>
</div>