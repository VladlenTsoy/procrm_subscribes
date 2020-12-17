class ProcrmSubscribesTab {
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
}

class ProcrmSubscribesCategories {
    isEditCategories = false
    $renderHtml = null
    btnCategoryAdd = null
    btnCategoryDelete = null
    formCategories = null

    /**
     *
     * @param deleteTabs - Удаление табов
     * @param addTabTitleAndContentInner - Добавление таба
     */
    constructor({deleteTabs, addTabTitleAndContentInner}) {
        this.deleteTabs = deleteTabs
        this.addTabTitleAndContentInner = addTabTitleAndContentInner
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
        let response = await $.get(admin_url + 'procrm_subscribes/subscribe/delete/' + subscribeId)
        response = JSON.parse(response)

        if (response.status === 'success') {
            this.updateDataTable(categoryId)
            alert_float('success', response.message)
        } else
            alert_float('error', response.message)
    }

    /**
     * Создать абонемент
     * @param e
     * @returns {Promise<void>}
     */
    createSubscribe = async (e) => {
        e.preventDefault()
        const data = $('#create-subscribe-form').serialize()
        let response = await $.post(admin_url + 'procrm_subscribes/subscribe/create', data)
        response = JSON.parse(response)
        if (response.status === 'success') {
            this.updateDataTable(response.category_id)
            $('#editorSubscribeModal').modal('hide')
        }
    }

    fetchTabsContent = () => {
        $.get(admin_url + 'procrm_subscribes/setting/content')
            .done((response) => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.$el.html(response.html)
                        .find('.table-category')
                        .map((key, e) => this.createDataTable(e.dataset.categoryId))
                }
            })
    }

    fetchOpenModalContent = async () => {
        $('#editorSubscribeModal').modal('show')
        let response = await $.get(admin_url + 'procrm_subscribes/subscribe/formModalView')
        response = JSON.parse(response)
        if (response.status === 'success') {
            //
            $(document).find('.modal-body-subscribe').html(response.html)
            //
            $(document).find('#create-subscribe-form').submit(this.createSubscribe)
        }
    }

    openEditModal = (e) => {
        const subscribeId = e.currentTarget.dataset.subscribeId
        $('#editorSubscribeModal').modal('show')
        $.get(admin_url + 'procrm_subscribes/subscribe/formModalView/' + subscribeId)
            .done(response => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.$el.find('.modal-body-subscribe').html(response.html)
                    this.$el.find('#create-subscribe-form').submit(this.createSubscribe)
                }
            })
    }

    /**
     * События
     */
    events() {
        $(document).on('click', '#btn-subscribe-modal', this.fetchOpenModalContent);
        this.$el.on('click', '.edit-column', this.openEditModal);
        this.$el.on('click', '.delete-column', this.deleteSubscribe);
    }

    render() {
        this.fetchTabsContent()
        this.events()
    }
}

$(function () {
    const tabClass = new ProcrmSubscribesTab()
    const tableClass = new ProcrmSubscribeTable()
    const categoriesClass = new ProcrmSubscribesCategories({
        addTabTitleAndContentInner: tabClass.addTabTitleAndContentInner,
        deleteTabs: tabClass.deleteTabs
    })

    tableClass.render()
    categoriesClass.render()
});