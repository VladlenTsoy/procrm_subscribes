<button class="btn btn-primary" id="btn-subscribe-modal" data-toggle="modal" data-target="#editorSubscribeModal">
    <i class="fa fa-plus"></i> <?php echo _l('create_subscribe') ?>
</button>

<!-- Modal -->
<div class="modal fade" id="editorSubscribeModal" tabindex="-1" aria-labelledby="editorSubscribeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"> <?php echo _l('create_subscribe') ?> </h4>
            </div>
            <div class="modal-body modal-body-subscribe">
                <div class="loading-block">
                    <i class="fa fa-spin fa-refresh"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
                <button type="submit" class="btn btn-primary" form="create-subscribe-form">
                    <?php echo _l('save') ?>
                </button>
            </div>
        </div>
    </div>
</div>

