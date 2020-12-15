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
                                        <li class="<?php if ($category['id'] === '1') echo 'active' ?>">
                                            <a href="#tab_category_<?php echo $category['id'] ?>"
                                               aria-controls="tab_category_<?php echo $category['id'] ?>"
                                               role="tab" data-toggle="tab"><?php echo $category['title'] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <?php foreach ($categories as $category) { ?>
                                    <div role="tabpanel"
                                         class="tab-pane <?php if ($category['id'] === '1') echo 'active' ?>"
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

                                            <?php if (isset($subscribes) && $subscribes) { ?>
                                                <?php foreach ($subscribes as $subscribe) { ?>
                                                    <?php if ($subscribe['category_id'] === $category['id']) { ?>
                                                        <tr>
                                                            <td><?php echo $subscribe['id'] ?></td>
                                                            <td><?php echo $subscribe['title'] ?></td>
                                                            <td>
                                                                <?php
                                                                $time = json_decode($subscribe['time'], true);
                                                                echo $time['from']['hour'] . ':' . $time['from']['minute'] . ' - ' . $time['to']['hour'] . ':' . $time['to']['minute'];
                                                                ?>
                                                            </td>
                                                            <td><?php echo $subscribe['duration'] ?> месяц</td>
                                                            <td><?php echo $subscribe['price'] ?></td>
                                                            <td><?php echo $subscribe['frost_days'] ?></td>
                                                            <td>
                                                                <button class="btn btn-primary">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>

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