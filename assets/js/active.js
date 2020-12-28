$(function () {
    const table = initDataTable(`.table-active_subscribes`, admin_url + `procrm_subscribes/active/table`, undefined, undefined, undefined, [0, 'desc']);


    $('#form-active-subscribe').submit(function (e) {
        e.preventDefault()

        const data = $(e.currentTarget).serialize()
        $.post(admin_url + 'procrm_subscribes/active/create', data)
            .done(function (response) {
                response = JSON.parse(response)
                table.ajax.reload()
                $('#createActiveSubscribeModal').modal('hide')
                if (response.status === 'success')
                    alert_float('success', response.message)
            })
    })

    let id = null;

    $(document).on('click', '.btn-edit-active-subscribe', function (e) {
        e.preventDefault()
        $('#editActiveSubscribeModal').modal('show')

        const {activeId, activeStatus} = e.currentTarget.dataset
        id = activeId

        $('#editActiveSubscribeModal select[name="status"]').find('option[value="' + activeStatus + '"]').attr('selected', 'selected')
    })

    $(document).on('submit', '#edit-form-active-subscribe', function (e) {
        e.preventDefault()

        const data = $(e.currentTarget).serialize()
        if (id)
            $.post(admin_url + 'procrm_subscribes/active/update/' + id, data)
                .done(function (response) {
                    response = JSON.parse(response)
                    table.ajax.reload()
                    $('#editActiveSubscribeModal').modal('hide')
                    if (response.status === 'success')
                        alert_float('success', response.message)
                })
    })

});