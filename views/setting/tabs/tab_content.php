<div role="tabpanel"
     class="tab-pane <?php if ($category['id'] === $categories[0]['id']) echo 'active' ?>"
     id="tab_category_<?php echo $category['id'] ?>">

    <div role="tabpanel" class="tab-pane" id="tab_two_test">
        <?php echo render_datatable([
            '#',
            _l('title'),
            _l('time'),
            _l('duration'),
            _l('price'),
            _l('frost_days')
        ], 'category-' . $category['id'] . ' table-category') ?>
    </div>
</div>