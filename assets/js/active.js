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

    $(document).on('click', '.btn-edit-active-subscribe', function (e) {
        e.preventDefault()
        $('#editActiveSubscribeModal').modal('show')
    })

});