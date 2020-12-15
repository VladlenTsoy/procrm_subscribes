<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="no-margin"><?php echo _l('procrm_subscribes') ?></h3>
                        <hr class="hr-panel-heading"/>
                        <div style="margin-bottom: 3.5rem">
                            <?php include('create_category_button.php') ?>
                            <?php include('create_subscribe_button.php') ?>
                        </div>
                        <?php if (isset($categories) && $categories) { ?>
                            <div class="horizontal-tabs">
                                <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal">
                                    <?php foreach ($categories as $category) { ?>
                                        <li class="<?php if($category['id'] === '1') echo 'active' ?>">
                                            <a href="#tab_category_<?php echo $category['id'] ?>"
                                               aria-controls="tab_category_<?php echo $category['id'] ?>"
                                               role="tab" data-toggle="tab"><?php echo $category['title'] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <?php foreach ($categories as $category) { ?>
                                    <div role="tabpanel" class="tab-pane <?php if($category['id'] === '1') echo 'active' ?>"
                                         id="tab_category_<?php echo $category['id'] ?>">
                                        <table class="table table-clients dataTable no-footer dtr-inline">
                                            <thead>
                                            <th>#</th>
                                            <th>Название</th>
                                            <th>Время</th>
                                            <th>Длительность</th>
                                            <th>Стоимость</th>
                                            <th>Заморозок</th>
                                            <th></th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Morning card</td>
                                                <td>7:00 - 12:00</td>
                                                <td>1 месяц</td>
                                                <td>1 520 000</td>
                                                <td>Нет</td>
                                                <td>
                                                    <button class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Morning card</td>
                                                <td>7:00 - 12:00</td>
                                                <td>3 месяца</td>
                                                <td>2 900 000</td>
                                                <td>Нет</td>
                                                <td>
                                                    <button class="btn btn-primary">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script src="<?php echo module_dir_url('procrm_subscribes', 'assets/js/setting.js'); ?>"></script>
</body>
</html>