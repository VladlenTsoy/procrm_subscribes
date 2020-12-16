<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link href="<?php echo module_dir_url('procrm_subscribes', 'assets/css/setting.css?v=' . PROCRM_SUBSCRIBES_VERSIONING); ?>"
      rel="stylesheet">
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="no-margin"><?php echo _l('procrm_subscribes') ?></h3>
                        <hr class="hr-panel-heading"/>
                        <div style="margin-bottom: 3.5rem">
                            <?php include('category_button.php') ?>
                            <?php include('create_subscribe_button.php') ?>
                        </div>
                        <div class="tabs-container-categories"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    const block = `
        <div class="form-group form-group-button">
            <input
                class="form-control"
                type="text" name="create_categories[]"
                placeholder="<?php echo _l('title_category') ?>"
                required
            />
            <button type="button" class="btn btn-danger btn-category-add"><i class="fa fa-trash"></i></button>
        </div>
    `
</script>
<script src="<?php echo module_dir_url('procrm_subscribes', 'assets/js/setting.js?v=' . PROCRM_SUBSCRIBES_VERSIONING); ?>"></script>
</body>
</html>