<button class="btn btn-primary" data-toggle="modal" data-target="#createActiveSubscribeModal">
    <i class="fa fa-plus"></i> <?php echo _l('add_to_lead') ?>
</button>

<!-- Modal -->
<div class="modal fade" id="createActiveSubscribeModal" tabindex="-1" aria-labelledby="createActiveSubscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"> <?php echo _l('add_to_lead') ?> </h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(null, ['id' => 'form-active-subscribe']) ?>
                <?php echo render_select(
                    'lead_id',
                    $leads,
                    ['id', 'name'],
                    'lead',
                    '',
                    [],
                    [], '', '', false
                ); ?>
                <?php echo render_select(
                    'subscribe_id',
                    $subscribes,
                    ['id', ['title']],
                    'procrm_subscribe',
                    '',
                    [],
                    [], '', '', false
                ); ?>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
                <button type="submit" class="btn btn-primary" form="form-active-subscribe"><?php echo _l('save') ?></button>
            </div>
        </div>
    </div>
</div>