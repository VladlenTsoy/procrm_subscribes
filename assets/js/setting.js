class ProcrmSubscribesCategories {
    isEditCategories = false
    $renderHtml = null
    btnCategoryAdd = null
    btnCategoryDelete = null
    formCategories = null

    constructor({createDataTable}) {
        this.createDataTable = createDataTable
    }

    /**
     * Добавление таб
     * @param categoryIds
     * @returns {Promise<void>}
     */
    addTabTitleAndContentInner = async (categoryIds) => {
        if (categoryIds && categoryIds.length > 0) {
            await Promise.all(
                categoryIds.map(async categoryId => {
                    let response = await $.get(`${admin_url}/procrm_subscribes/setting/content/${categoryId}`)
                    response = JSON.parse(response)

                    if (response.status === 'success') {
                        $('.nav-tabs-categories').append(response.html.title)
                        $('.tab-tabs-categories').append(response.html.content)
                        this.createDataTable(categoryId)
                    }
                })
            )
        }
    }

    /**
     * Удаление табов
     * @param ids
     */
    deleteTabs = (ids) => {
        if (ids && ids.length > 0) {
            ids.map(id => {
                $(`.li_tab_title_${id}`).remove()
                $(`#tab_category_${id}`).remove()
            })
        }
    }

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

            this.deleteTabs(response.deleteCategoryIds)
            await this.addTabTitleAndContentInner(response.categoryIds)
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
    constructor() {
        this.$el = $('.tabs-container-categories')
        // this.$el = $('.btn-create-subscribe-block')
    }

    /**
     * Обновление таблицы (DataTables)
     * @param categoryId
     */
    updateDataTable = (categoryId) => {
        $(`.table-category-${categoryId}`).DataTable().ajax.reload()
    }

    /**
     * Создание таблицы (DataTables)
     * @param categoryId
     */
    createDataTable = (categoryId) => {
        initDataTable(`.table-category-${categoryId}`, admin_url + `procrm_subscribes/subscribe/table/${categoryId}`, ['undefined'], ['undefined'], undefined, [0, 'desc']);
    }

    /**
     * Удаление абонемента
     * @param e
     * @returns {Promise<void>}
     */
    deleteSubscribe = async (e) => {
        const result = confirm_delete()
        if (!result) return result;
        const subscribeId = e.currentTarget.dataset.subscribeId
        const categoryId = e.currentTarget.dataset.categoryId
        $.get(admin_url + 'procrm_subscribes/subscribe/delete/' + subscribeId)
            .done(response => {
                response = JSON.parse(response)

                if (response.status === 'success') {
                    this.updateDataTable(categoryId)
                    alert_float('success', response.message)
                } else
                    alert_float('error', response.message)
            })
    }

    editSubscribe = (e) => {
        e.preventDefault()
        const data = $('#edit-subscribe-form').serialize()
        $.post(admin_url + 'procrm_subscribes/subscribe/update', data)
            .done((response) => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.updateDataTable(response.category_id)
                    alert_float('success', response.message)
                    $('#editorSubscribeModal').modal('hide')
                }
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
                    this.updateDataTable(response.category_id)
                    alert_float('success', response.message)
                    $('#editorSubscribeModal').modal('hide')
                }
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

    /**
     * События
     */
    events() {
        $(document).on('submit', '#create-subscribe-form', this.createSubscribe)
        $(document).on('submit', '#edit-subscribe-form', this.editSubscribe)
        $(document).on('click', '#btn-subscribe-modal', this.openCreateModal);
        $(document).on('click', '.edit-column', this.openEditModal);
        $(document).on('click', '.delete-column', this.deleteSubscribe);
    }

    render() {
        this.events()
    }
}

$(function () {
    const tableClass = new ProcrmSubscribeTable()
    const categoriesClass = new ProcrmSubscribesCategories({createDataTable: tableClass.createDataTable})

    tableClass.render()
    categoriesClass.render()
});

$(function () {
    const SubscribesServerParams = {
        category_id: '[name="category_id"]'
    }

    const table = initDataTable(`.table-subscribes`, admin_url + `procrm_subscribes/setting/table`, undefined, undefined, SubscribesServerParams, [0, 'desc']);

    // Фильтрация таблицы
    $(document).on('submit', '#form-filter-for-subscribes', function (e) {
        e.preventDefault()
        const formData = $(e.currentTarget).serializeArray()
        formData.map(val => {
            if (val.name === 'filter_category')
                $('._filters [name="category_id"]').val(val.value)
        })
        table.ajax.reload();
        $('#categories_modal_action').modal('hide')
    })

    // Открыть фильтрацию (MODAL)
    $('#btn-filter-by').click(function (e) {
        e.preventDefault()
        $('#categories_modal_action').modal('show')
        $.get(admin_url + 'procrm_subscribes/setting/formFilterBy')
            .done(response => {
                response = JSON.parse(response)
                if (response.status === 'success')
                    $('.modal-body-filter-by').html(response.html)
            })
    })
});