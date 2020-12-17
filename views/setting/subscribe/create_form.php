<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title"> <?php echo _l('create_subscribe') ?> </h4>
</div>
<div class="modal-body modal-body-subscribe">
<?php echo form_open(null, ['id' => 'create-subscribe-form']); ?>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_category_id"><?php echo _l('select_category') ?></label>
        <select class="form-control" id="procrm_subscribes_category_id" name="category_id" required>
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_title"><?php echo _l('enter_title') ?></label>
        <input class="form-control" id="procrm_subscribes_title" type="text" name="title" required/>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_time"><?php echo _l('enter_time') ?></label>
        <div class="time-container">
            <div class="time-from">
                <div class="time-label text-muted"><?php echo _l('start') ?></div>
                <div class="time-control">
                    <input class="form-control" id="procrm_subscribes_time" type="number" value="00"
                           min="00" max="24" name="time[from][hour]" required maxlength="2"/>
                </div>
                <div class="time-control">
                    <input class="form-control" type="number" value="00"
                           min="00" max="60" name="time[from][minute]" required maxlength="2"/>
                </div>
            </div>
            <div class="time-to">
                <div class="time-label text-muted"><?php echo _l('end') ?></div>
                <div class="time-control">
                    <input class="form-control" type="number" value="00"
                           min="00" max="24" name="time[to][hour]" required maxlength="2"/>
                </div>
                <div class="time-control">
                    <input class="form-control" type="number" value="00"
                           min="00" max="60" name="time[to][minute]" required maxlength="2"/>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_duration"><?php echo _l('select_duration') ?></label>
        <select class="form-control" id="procrm_subscribes_duration" name="duration" required>
            <option value="1">1 <?php echo _l('month') ?></option>
            <option value="2">2 <?php echo _l('months') ?></option>
            <option value="3">3 <?php echo _l('months') ?></option>
            <option value="4">4 <?php echo _l('months') ?></option>
            <option value="5">5 <?php echo _l('_months') ?></option>
            <option value="6">6 <?php echo _l('_months') ?></option>
            <option value="9">9 <?php echo _l('_months') ?></option>
            <option value="12">12 <?php echo _l('_months') ?></option>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_price"><?php echo _l('enter_cost') ?></label>
        <input class="form-control" id="procrm_subscribes_price" type="number" name="price" required/>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_frost_days"><?php echo _l('enter_number_frosts') ?></label>
        <input class="form-control" id="procrm_subscribes_frost_days" type="number" name="frost_days"/>
    </div>
<?php echo form_close(); ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
    <button type="submit" class="btn btn-primary" form="create-subscribe-form">
        <?php echo _l('save') ?>
    </button>
</div>

