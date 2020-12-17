<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title"> <?php echo _l('edit_subscribe') ?> </h4>
</div>
<div class="modal-body modal-body-subscribe">
<?php echo form_open(null, ['id' => 'edit-subscribe-form']); ?>
<?php echo form_hidden('id', $subscribe['id']) ?>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_category_id"><?php echo _l('select_category') ?></label>
        <select class="form-control" id="procrm_subscribes_category_id" name="category_id" required>
            <?php foreach ($categories as $category) { ?>
                <option
                        value="<?php echo $category['id'] ?>"
                    <?php if ($category['id'] === $subscribe['category_id']) echo 'selected' ?>
                >
                    <?php echo $category['title'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_title"><?php echo _l('enter_title') ?></label>
        <input
                class="form-control"
                id="procrm_subscribes_title"
                type="text"
                name="title"
                required
                value="<?php echo $subscribe['title'] ?>"
        />
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_time"><?php echo _l('enter_time') ?></label>
        <div class="time-container">
            <div class="time-from">
                <div class="time-label text-muted"><?php echo _l('start') ?></div>
                <div class="time-control">
                    <input class="form-control" id="procrm_subscribes_time" type="number"
                           min="00" max="24" name="time[from][hour]" required maxlength="2"
                           value="<?php echo $subscribe['time']['from']['hour'] ?>"
                    />
                </div>
                <div class="time-control">
                    <input class="form-control" type="number"
                           value="<?php echo $subscribe['time']['from']['minute'] ?>"
                           min="00" max="60" name="time[from][minute]" required maxlength="2"/>
                </div>
            </div>
            <div class="time-to">
                <div class="time-label text-muted"><?php echo _l('end') ?></div>
                <div class="time-control">
                    <input class="form-control" type="number"
                           value="<?php echo $subscribe['time']['to']['hour'] ?>"
                           min="00" max="24" name="time[to][hour]" required maxlength="2"/>
                </div>
                <div class="time-control">
                    <input class="form-control" type="number"
                           value="<?php echo $subscribe['time']['to']['minute'] ?>"
                           min="00" max="60" name="time[to][minute]" required maxlength="2"/>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_duration"><?php echo _l('select_duration') ?></label>
        <select class="form-control" id="procrm_subscribes_duration" name="duration" required>
            <option <?php if ($subscribe['duration'] === 1) echo 'selected' ?> value="1">
                1 <?php echo _l('month') ?>
            </option>
            <option <?php if ($subscribe['duration'] === 2) echo 'selected' ?> value="2">
                2 <?php echo _l('months') ?>

            </option>
            <option <?php if ($subscribe['duration'] === 3) echo 'selected' ?> value="3">
                3 <?php echo _l('months') ?>
            </option>
            <option <?php if ($subscribe['duration'] === 4) echo 'selected' ?> value="4">
                4 <?php echo _l('months') ?>

            </option>
            <option <?php if ($subscribe['duration'] === 5) echo 'selected' ?> value="5">
                5 <?php echo _l('_months') ?>
            </option>
            <option <?php if ($subscribe['duration'] === 6) echo 'selected' ?> value="6">
                6 <?php echo _l('_months') ?>

            </option>
            <option <?php if ($subscribe['duration'] === 9) echo 'selected' ?> value="9">
                9 <?php echo _l('_months') ?>
            </option>
            <option <?php if ($subscribe['duration'] === 12) echo 'selected' ?> value="12">
                12 <?php echo _l('_months') ?>

            </option>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_price"><?php echo _l('enter_cost') ?></label>
        <input
                class="form-control" id="procrm_subscribes_price" type="number" name="price"
                value="<?php echo $subscribe['price'] ?>"
                required/>
    </div>
    <div class="form-group">
        <label class="control-label" for="procrm_subscribes_frost_days"><?php echo _l('enter_number_frosts') ?></label>
        <input class="form-control" id="procrm_subscribes_frost_days" type="number" name="frost_days"
               value="<?php echo $subscribe['frost_days'] ?>"
        />
    </div>
<?php echo form_close(); ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _l('close') ?></button>
    <button type="submit" class="btn btn-primary" form="edit-subscribe-form">
        <?php echo _l('save') ?>
    </button>
</div>
