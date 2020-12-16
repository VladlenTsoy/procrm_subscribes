<?php if (isset($categories) && $categories) { ?>
    <div class="horizontal-tabs">
        <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal">
            <?php foreach ($categories as $category) { ?>
                <?php include('tab_title.php') ?>
            <?php } ?>
        </ul>
    </div>
    <div class="tab-content">
        <?php foreach ($categories as $category) { ?>
            <?php include('tab_content.php') ?>
        <?php } ?>
    </div>
<?php } ?>