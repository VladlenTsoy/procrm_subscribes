<!-- Modal -->
<div class="modal fade" id="editActiveSubscribeModal" tabindex="-1" aria-labelledby="editActiveSubscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"> <?php echo _l('edit') ?> </h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(null, ['id' => 'edit-form-active-subscribe']) ?>
                    <div class="form-group">
                        <label for="status"><?php echo _l('status') ?></label>
                        <select name="status" id="status" class="form-control">
                            <option value="active"><?php echo _l('Активный') ?></option>
                            <option value="frozen"><?php echo _l('Замороженный') ?></option>
                        </select>
                    </div>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
                <button type="submit" class="btn btn-primary" form="edit-form-active-subscribe"><?php echo _l('save') ?></button>
            </div>
        </div>
    </div>
</div>