<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-plus"></i> <?php echo _l('create_category') ?>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content data">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"> <?php echo _l('create_category') ?> </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label" for="procrm_subscribes_category_title">Введите название категории</label>
                    <input class="form-control" id="procrm_subscribes_category_title" type="text"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="procrm-subscribes-create-category-button">Сохранить</button>
            </div>
        </div>
    </div>
</div>