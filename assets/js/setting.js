/**
 * Удалить категорию
 * @param e
 */
const deleteCategoryBlock = (e) => {
    $(e.currentTarget).parent('.form-group').remove()
}

/**
 * Добавить категорию
 * @param e
 */
const addCategoryBlock = (e) => {
    $('.add-category-block').append(block)
        .find('.btn-category-add')
        .click(deleteCategoryBlock)
}

/**
 *
 * @param e
 */
const submitCategories = (e) => {
    e.preventDefault()
    const categories = $(e.currentTarget).serialize()

    $.post(admin_url + 'procrm_subscribes/setting/category', categories)
        .done(function (response) {
            response = JSON.parse(response)

            if(response.status === 'success') {
                alert_float('success', response.message)
                $('.tabs-container-categories').html(response.html)
                $('#procrmSubscribesCategoriesModal').modal('hide')
            }
        });
}

$(function () {
    // initDataTable('.table-category', window.location.href + '/subscribes/1', [2], [2]);
    // initDataTable('.table-category', window.location.href + '/subscribes/1');
    // initDataTable('.table-category', admin_url + 'projects/discussions/' + 1, undefined, undefined, 'undefined', [1, 'desc'])
    // initDataTable('.table-category', admin_url + 'subscribes/1', undefined, undefined, 'undefined', [1, 'desc'])

    // Удалить категорию
    $('.btn-category-delete').click(deleteCategoryBlock)

    // Добавить категорию
    $('.btn-category-add').click(addCategoryBlock)

    // Сохранить
    $('#procrm-subscribes-categories-form').submit(submitCategories)

    $('#create-subscribe-form').submit(function (e) {
        e.preventDefault()

        // console.log($('#create-subscribe-form').serialize())
        // console.log(e)

        const data = $('#create-subscribe-form').serialize()

        // $.ajax({
        //     url: admin_url + 'procrm_subscribes/setting/subscribe',
        //     type: 'post',
        //     dataType: 'json',
        //     data: data
        // }).done((response) => {
        //     response = JSON.parse(response)
        // console.log(response)
        // })
        $.post(admin_url + 'procrm_subscribes/setting/subscribe', data)
            .done(function (response) {
                response = JSON.parse(response)
                if (response.status === 'success')
                    window.location = admin_url + 'procrm_subscribes/setting';
            });
    })
});