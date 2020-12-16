<li class="<?php if ($category['id'] === $categories[0]['id']) echo 'active' ?>">
    <a href="#tab_category_<?php echo $category['id'] ?>"
       aria-controls="tab_category_<?php echo $category['id'] ?>"
       role="tab" data-toggle="tab"><?php echo $category['title'] ?></a>
</li>