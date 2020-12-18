<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link href="<?php echo module_dir_url('procrm_subscribes', 'assets/css/active.css?v=' . PROCRM_SUBSCRIBES_VERSIONING); ?>"
      rel="stylesheet">
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="no-margin"><?php echo _l('active_subscribes') ?></h3>
                        <hr class="hr-panel-heading"/>
                        <button class="btn btn-primary"><i class="fa fa-plus"></i> Добавить к лиду</button>
                        <hr class="hr-panel-heading"/>
                        <?php echo render_datatable([
                            '#',
                            _l('title'),
                            _l('time'),
                            _l('duration'),
                            _l('price'),
                            _l('frost_days')
                        ],
                            'subscribes'
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script src="<?php echo module_dir_url('procrm_subscribes', 'assets/js/active.js?v=' . PROCRM_SUBSCRIBES_VERSIONING); ?>"></script>
</body>
</html>