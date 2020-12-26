class ProcrmSubscribesCategories {
    isEditCategories = false
    $renderHtml = null
    btnCategoryAdd = null
    btnCategoryDelete = null
    formCategories = null

    /**
     * Изменить категории
     * @param e
     */
    submitCategories = async (e) => {
        e.preventDefault()
        const categories = $(e.currentTarget).serialize()

        this.isEditCategories = false

        let response = await $.post(admin_url + 'procrm_subscribes/category/update', categories)
        response = JSON.parse(response)

        if (response.status === 'success') {
            alert_float('success', response.message)
            $('#procrmSubscribesCategoriesModal').modal('hide')
        }
    }

    /**
     * Удалить категорию
     * @param e
     */
    deleteCategoryBlock(e) {
        $(e.currentTarget).parent('.form-group').remove()
    }

    /**
     * Добавить категорию
     * @param e
     */
    addCategoryBlock = (e) => {
        $('.add-category-block').append(block)
            .find('.btn-category-delete')
            .click(this.deleteCategoryBlock)
    }

    /**
     * Запрос и вывод формы
     * @returns {Promise<void>}
     */
    async fetchFormView() {
        this.isEditCategories = true
        let response = await $.get(admin_url + 'procrm_subscribes/category/formModalView')
        response = JSON.parse(response)

        if (response.status === 'success') {
            this.$renderHtml = $('.modal-body-categories').html(response.html)

            this.btnCategoryDelete = this.$renderHtml.find('.btn-category-delete')
            this.btnCategoryAdd = this.$renderHtml.find('.btn-category-add')
            this.formCategories = this.$renderHtml.find('#procrm-subscribes-categories-form')

            this.events()
        }
    }

    /**
     * Открыть категории модал
     */
    openModal = () => {
        $('#procrmSubscribesCategoriesModal').modal('show')
        if (!this.isEditCategories)
            this.fetchFormView().then()
    }

    /**
     * События
     */
    events() {
        this.btnCategoryDelete.click(this.deleteCategoryBlock)
        this.btnCategoryAdd.click(this.addCategoryBlock)
        this.formCategories.submit(this.submitCategories)
    }

    render() {
        $('#btn-categories-modal').click(this.openModal)
    }
}


class ProcrmSubscribeTable {
    filterParams = {
        filter_category_id: '[name="filter_category_id"]'
    }

    /**
     * Инитиализация таблицы
     */
    initDataTable = () => {
        this.table = initDataTable(`.table-subscribes`, admin_url + `procrm_subscribes/setting/table`, undefined, undefined, this.filterParams, [0, 'desc']);
    }

    /**
     * Обновление таблицы (DataTables)
     */
    updateDataTable = () => {
        this.table.ajax.reload();
    }


    /**
     * Удаление абонемента
     * @param e
     */
    deleteSubscribe = async (e) => {
        const result = confirm_delete()
        if (!result) return
        //
        const subscribeId = e.currentTarget.dataset.subscribeId
        $.get(admin_url + 'procrm_subscribes/subscribe/delete/' + subscribeId)
            .done(response => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.updateDataTable()
                    alert_float('success', response.message)
                } else
                    alert_float('error', response.message)
            })
    }

    /**
     * Редактирование
     * @param e
     */
    editSubscribe = (e) => {
        e.preventDefault()
        const data = $('#edit-subscribe-form').serialize()
        $.post(admin_url + 'procrm_subscribes/subscribe/update', data)
            .done((response) => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.updateDataTable()
                    alert_float('success', response.message)
                    $('#editorSubscribeModal').modal('hide')
                } else
                    alert_float('error', response.message)
            })
    }

    /**
     * Создать абонемент
     * @param e
     * @returns {Promise<void>}
     */
    createSubscribe = async (e) => {
        e.preventDefault()
        const data = $('#create-subscribe-form').serialize()
        $.post(admin_url + 'procrm_subscribes/subscribe/create', data)
            .done((response) => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.updateDataTable()
                    alert_float('success', response.message)
                    $('#editorSubscribeModal').modal('hide')
                } else
                    alert_float('error', response.message)
            })
    }

    /**
     * Открыть создание
     */
    openCreateModal = () => {
        $('#editorSubscribeModal').modal('show')
        $.get(admin_url + 'procrm_subscribes/subscribe/formModalView')
            .done(response => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    $(document).find('.modal-subscribe-data').html(response.html)
                }
            })
    }

    /**
     * Открыть редактирование
     * @param e
     */
    openEditModal = (e) => {
        const subscribeId = e.currentTarget.dataset.subscribeId
        $('#editorSubscribeModal').modal('show')
        $.get(admin_url + 'procrm_subscribes/subscribe/formModalView/' + subscribeId)
            .done(response => {
                response = JSON.parse(response)
                if (response.status === 'success')
                    $(document).find('.modal-subscribe-data').html(response.html)
            })
    }

    // Открыть фильтрацию (MODAL)
    openFilterHandler = (e) => {
        e.preventDefault()
        $('#categories_modal_action').modal('show')
        $.get(admin_url + 'procrm_subscribes/setting/formFilterBy')
            .done(response => {
                response = JSON.parse(response)
                if (response.status === 'success')
                    $('.modal-body-filter-by').html(response.html)
            })
    }

    // Фильтрация таблицы
    submitFilterHandler = (e) => {
        e.preventDefault()
        const formData = $(e.currentTarget).serializeArray()
        formData.map(val => {
            if (val.name === 'filter_category')
                $('._filters [name="filter_category_id"]').val(val.value)
        })
        this.updateDataTable()
        $('#categories_modal_action').modal('hide')
    }

    /**
     * События
     */
    events() {
        $(document).on('submit', '#create-subscribe-form', this.createSubscribe)
        $(document).on('submit', '#edit-subscribe-form', this.editSubscribe)
        $(document).on('click', '#btn-subscribe-modal', this.openCreateModal);
        $(document).on('click', '.edit-column', this.openEditModal);
        $(document).on('click', '.delete-column', this.deleteSubscribe);
        $(document).on('click', '#btn-filter-by', this.openFilterHandler);
        $(document).on('submit', '#form-filter-for-subscribes', this.submitFilterHandler)
    }

    render() {
        this.initDataTable()
        this.events()
    }
}

$(function () {
    const tableClass = new ProcrmSubscribeTable()
    const categoriesClass = new ProcrmSubscribesCategories()

    tableClass.render()
    categoriesClass.render()
});