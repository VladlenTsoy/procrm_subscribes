<li class="<?php if (isset($categories) && $category['id'] === $categories[0]['id']) echo 'active' ?> li_tab_title_<?php echo $category['id'] ?>">
    <a href="#tab_category_<?php echo $category['id'] ?>"
       aria-controls="tab_category_<?php echo $category['id'] ?>"
       role="tab" data-toggle="tab"><?php echo $category['title'] ?></a>
</li>