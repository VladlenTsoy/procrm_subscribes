<button class="btn btn-primary" id="btn-categories-modal">
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
            <div class="modal-body modal-body-categories">
                <div class="loading-block">
                    <i class="fa fa-spin fa-refresh"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
                <button type="submit" class="btn btn-primary" form="procrm-subscribes-categories-form"><?php echo _l('save') ?></button>
            </div>
        </div>
    </div>
</div>