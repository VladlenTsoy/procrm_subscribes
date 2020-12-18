<div class="horizontal-tabs">
    <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal nav-tabs-categories">
        <?php if (isset($categories) && $categories) { ?>
            <?php foreach ($categories as $category) { ?>
                <?php include('tab_title.php') ?>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<div class="tab-content tab-tabs-categories">
    <?php if (isset($categories) && $categories) { ?>
        <?php foreach ($categories as $category) { ?>
            <?php include('tab_content.php') ?>
        <?php } ?>
    <?php } ?>
</div>
