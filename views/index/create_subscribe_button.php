<?php if (isset($categories) && $categories) { ?>
    <button class="btn btn-primary" data-toggle="modal" data-target="#createSubscribeModal">
        <i class="fa fa-plus"></i> Создать абонемент
    </button>

    <!-- Modal -->
    <div class="modal fade" id="createSubscribeModal" tabindex="-1" aria-labelledby="createSubscribeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title"> <?php echo "Создать абонемент" ?> </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="procrm_subscribes_category_id">Выберите категорию</label>
                        <select class="form-control" id="procrm_subscribes_category_id">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="procrm_subscribes_title">Выберите название</label>
                        <input class="form-control" id="procrm_subscribes_title" type="text"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="procrm_subscribes_time">Введите время</label>
                        <div class="row align-items-center">
                            <div class="col-xs-2">Начало</div>
                            <div class="col-xs-2">
                                <input class="form-control" id="procrm_subscribes_time" type="number" value="00" min="00" max="12"/>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" id="procrm_subscribes_time" type="number" value="00" min="00" max="60"/>
                            </div>
                            <div class="col-xs-2">Конец</div>
                            <div class="col-xs-2">
                                <input class="form-control" id="procrm_subscribes_time" type="number" value="00" min="00" max="12"/>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" id="procrm_subscribes_time" type="number" value="00" min="00" max="60"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="procrm_subscribes_duration">Выберите длительность</label>
                        <select class="form-control" id="procrm_subscribes_duration">
                            <option value="1">1 месяц</option>
                            <option value="2">2 месяца</option>
                            <option value="3">3 месяца</option>
                            <option value="4">4 месяца</option>
                            <option value="5">5 месяцев</option>
                            <option value="6">6 месяцев</option>
                            <option value="9">9 месяцев</option>
                            <option value="12">12 месяцев</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="procrm_subscribes_price">Введите стоимость</label>
                        <input class="form-control" id="procrm_subscribes_price" type="number"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="procrm_subscribes_frost_day">Введите кол-во заморозок</label>
                        <input class="form-control" id="procrm_subscribes_frost_day" type="number"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="procrm-subscribes-create-category-button">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
