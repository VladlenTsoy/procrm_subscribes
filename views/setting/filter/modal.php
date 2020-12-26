<div class="_filters _hidden_inputs hidden">
    <?php echo form_hidden('filter_category_id', 'all'); ?>
</div>

<button
        id="btn-filter-by"
        class="table-btn hide"
        data-table=".table-subscribes"
>
    <?php echo _l('filter_by'); ?>
</button>
<div class="modal fade" id="categories_modal_action" tabindex="-1"
     role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _l('filter_by'); ?></h4>
            </div>
            <div class="modal-body modal-body-filter-by">
                <div class="loading-block">
                    <i class="fa fa-spin fa-refresh"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo _l('close'); ?>
                </button>
                <button type="submit" class="btn btn-info" form="form-filter-for-subscribes">
                    <?php echo _l('confirm'); ?>
                </button>
            </div>
        </div>
    </div>
</div>