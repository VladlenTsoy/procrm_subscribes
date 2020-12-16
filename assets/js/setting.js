class ProcrmSubscribesCategories {
    isEditCategories = false
    $renderHtml = null
    btnCategoryAdd = null
    btnCategoryDelete = null
    formCategories = null

    constructor() {

    }

    /**
     *
     * @param e
     */
    async submitCategories(e) {
        e.preventDefault()
        const categories = $(e.currentTarget).serialize()

        let response = await $.post(admin_url + 'procrm_subscribes/setting/category', categories)
        response = JSON.parse(response)

        if (response.status === 'success') {
            alert_float('success', response.message)
            $('#procrmSubscribesCategoriesModal').modal('hide')

            deleteTabs(response.deleteCategoryIds)
            await addTabTitleAndContentInner(response.categoryIds)
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
    addCategoryBlock(e) {
        $('.add-category-block').append(block)
            .find('.btn-category-add')
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

/**
 *
 * @returns {Promise<void>}
 */
const tabsContentInner = async () => {
    let response = await $.get(admin_url + 'procrm_subscribes/setting/content')
    response = JSON.parse(response)
    if (response.status === 'success')
        $('.tabs-container-categories').html(response.html)

    $('.table-category').map(function () {
        const categoryId = this.dataset.categoryId
        createDataTable(categoryId)
    })
}

const addTabTitleAndContentInner = async (categoryIds) => {
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
 *
 * @param categoryId
 */
const createDataTable = (categoryId) => {
    initDataTable(`.table-category-${categoryId}`, window.location.href + `/subscribes/${categoryId}`);
}

const deleteTabs = (ids) => {
    if (ids && ids.length > 0) {
        ids.map(id => {
            $(`.li_tab_title_${id}`).remove()
            $(`#tab_category_${id}`).remove()
        })
    }
}

// const openCategoriesModal = async () => {
//     $('#procrmSubscribesCategoriesModal').modal('show')
//
//     $.get(admin_url + 'procrm_subscribes/setting/categoriescontent')
//         .done(function (response) {
//             response = JSON.parse(response)
//             if (response.status === 'success')
//                 $('.modal-body-categories').html(response.html)
//
//
//
//             // Удалить категорию
//             $('.btn-category-delete').click(deleteCategoryBlock)
//
//             // Добавить категорию
//             $('.btn-category-add').click(addCategoryBlock)
//
//             // Сохранить
//             $('#procrm-subscribes-categories-form').submit(submitCategories)
//
//         });
// }

$(function () {
    // initDataTable('.table-category', window.location.href + '/subscribes/1', [2], [2]);
    // initDataTable('.table-category', window.location.href + '/subscribes/1');
    // initDataTable('.table-category', admin_url + 'projects/discussions/' + 1, undefined, undefined, 'undefined', [1, 'desc'])
    // initDataTable('.table-category', admin_url + 'subscribes/1', undefined, undefined, 'undefined', [1, 'desc'])

    tabsContentInner().then()


    const categoriesClass = new ProcrmSubscribesCategories()
    $('#btn-categories-modal').click(categoriesClass.render)


    //
    $('#create-subscribe-form').submit(function (e) {
        e.preventDefault()

        const data = $('#create-subscribe-form').serialize()

        $.post(admin_url + 'procrm_subscribes/setting/subscribe', data)
            .done(function (response) {
                response = JSON.parse(response)
                if (response.status === 'success')
                    window.location = admin_url + 'procrm_subscribes/setting';
            });
    })
});