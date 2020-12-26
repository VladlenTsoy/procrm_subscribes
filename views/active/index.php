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
                        <?php include('create_active/button.php') ?>
                        <?php include('edit_active/button.php') ?>
                        <hr class="hr-panel-heading"/>
                        <?php echo render_datatable([
                            '#',
                            _l('Абонемент'),
                            _l('Лид'),
                            _l('Статус'),
                            _l('Осталось'),
                            _l('Замороженных'),
                            _l('Создан'),
                            '',
                        ],
                            'active_subscribes'
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