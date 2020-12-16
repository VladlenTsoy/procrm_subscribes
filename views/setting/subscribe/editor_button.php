<?php if (isset($categories) && $categories) { ?>
    <button class="btn btn-primary" data-toggle="modal" data-target="#editorSubscribeModal">
        <i class="fa fa-plus"></i> <?php echo $title ?>
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
                    <h4 class="modal-title"> <?php echo $title ?> </h4>
                </div>
                <div class="modal-body">

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
<?php } ?>
