class ProcrmSubscribesCategories {
    isEditCategories = false
    $renderHtml = null
    btnCategoryAdd = null
    btnCategoryDelete = null
    formCategories = null

    constructor({deleteTabs, addTabTitleAndContentInner}) {
        this.deleteTabs = deleteTabs
        this.addTabTitleAndContentInner = addTabTitleAndContentInner
    }

    /**
     *
     * @param e
     */
    submitCategories = async (e) => {
        e.preventDefault()
        const categories = $(e.currentTarget).serialize()

        let response = await $.post(admin_url + 'procrm_subscribes/setting/category', categories)
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

    async fetchHtml() {
        let response = await $.get(admin_url + 'procrm_subscribes/setting/categoriescontent')

        response = JSON.parse(response)
        if (response.status === 'success') {
            this.$renderHtml = $('.modal-body-categories').html(response.html)

            this.btnCategoryDelete = this.$renderHtml.find('.btn-category-delete')
            this.btnCategoryAdd = this.$renderHtml.find('.btn-category-add')
            this.formCategories = this.$renderHtml.find('#procrm-subscribes-categories-form')

            this.events()
        }
    }

    events() {
        this.btnCategoryDelete.click(this.deleteCategoryBlock)
        this.btnCategoryAdd.click(this.addCategoryBlock)
        this.formCategories.submit(this.submitCategories)
    }

    render = () => {
        $('#procrmSubscribesCategoriesModal').modal('show')
        this.fetchHtml().then()
    }
}


class ProcrmSubscribesSubscribe {
    $el = null
    $createForm = null

    constructor({updateDataTable}) {
        this.$el = $('.btn-create-subscribe-block')
        this.updateDataTable = updateDataTable
    }

    createSubscribe = async (e) => {
        e.preventDefault()
        const data = $('#create-subscribe-form').serialize()

        $.post(admin_url + 'procrm_subscribes/setting/subscribe', data)
            .done((response) => {
                response = JSON.parse(response)
                if (response.status === 'success') {
                    this.updateDataTable(response.category_id)
                    $('#editorSubscribeModal').modal('hide')
                }
            })
    }

    fetchOpenModalContent = async () => {
        $('#editorSubscribeModal').modal('show')
        let response = await $.get(admin_url + 'procrm_subscribes/setting/subsctribeformcontent')
        response = JSON.parse(response)
        if (response.status === 'success') {
            //
            this.$el.find('.modal-body-subscribe').html(response.html)
            //
            this.$el.find('#create-subscribe-form').submit(this.createSubscribe)
        }
    }

    openEditModal = async (subscribeId) => {
        $('#editorSubscribeModal').modal('show')
        let response = await $.get(admin_url + 'procrm_subscribes/setting/subsctribeformcontent/' + subscribeId)
        response = JSON.parse(response)
        if (response.status === 'success') {
            //
            this.$el.find('.modal-body-subscribe').html(response.html)
            //
            this.$el.find('#create-subscribe-form').submit(this.createSubscribe)
        }
    }

    async fetchBtnModalContent() {
        let response = await $.get(admin_url + 'procrm_subscribes/setting/subsctribebtncontent')
        response = JSON.parse(response)
        if (response.status === 'success')
            this.$el.html(response.html)

        this.$el.find('#btn-subscribe-modal').click(this.fetchOpenModalContent)
    }

    async render() {
        await this.fetchBtnModalContent()
    }
}


class ProcrmSubscribeTable {
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

    updateDataTable = (categoryId) => {
        $(`.table-category-${categoryId}`).DataTable().ajax.reload()
    }

    openEditModal = (e) => {
        const subscribeId = e.currentTarget.dataset.subscribeId
        this.openEditSubscribeModal(subscribeId)
    }

    openDeleteModal = async (e) => {
        const subscribeId = e.currentTarget.dataset.subscribeId
        const result = confirm('Удалить?')
        if (result) {
            let response = await $.get(admin_url + 'procrm_subscribes/setting/subscribe/delete/' + subscribeId)
            console.log(response)
        }
    }

    tabsContentInner = async () => {
        let response = await $.get(admin_url + 'procrm_subscribes/setting/content')
        response = JSON.parse(response)
        if (response.status === 'success')
            $('.tabs-container-categories').html(response.html)

        $('.table-category').map(function () {
            const categoryId = this.dataset.categoryId
            initDataTable(`.table-category-${categoryId}`, admin_url + `procrm_subscribes/setting/subscribes/${categoryId}`, ['undefined'], ['undefined'], undefined, [0, 'desc']);
        })

        let i = 0
        await new Promise(resolve => {
            $(`.table-category`).DataTable().on('draw', (e) => {
                if ($(`.table-category`).length <= ++i)
                    resolve()
            })
        })
        $('.edit-column').click(this.openEditModal)
        $('.delete-column').click(this.openDeleteModal)
    }

    deleteTabs = (ids) => {
        if (ids && ids.length > 0) {
            ids.map(id => {
                $(`.li_tab_title_${id}`).remove()
                $(`#tab_category_${id}`).remove()
            })
        }
    }

    async render({openEditSubscribeModal}) {
        this.openEditSubscribeModal = openEditSubscribeModal
        await this.tabsContentInner()
    }
}

$(function () {
    const subscribeTableClass = new ProcrmSubscribeTable()

    const subscribeClass = new ProcrmSubscribesSubscribe({updateDataTable: subscribeTableClass.updateDataTable})
    subscribeClass.render().then()

    const categoriesClass = new ProcrmSubscribesCategories({
        addTabTitleAndContentInner: subscribeTableClass.addTabTitleAndContentInner,
        deleteTabs: subscribeTableClass.deleteTabs
    })

    subscribeTableClass.render({openEditSubscribeModal: subscribeClass.openEditModal}).then()

    $('#btn-categories-modal').click(categoriesClass.render)

});