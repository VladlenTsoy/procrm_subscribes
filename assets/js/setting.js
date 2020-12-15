$(function () {
    // initDataTable('.table-test', window.location.href, [2], [2]);

    $('#procrm-subscribes-create-category-button').click(function (e) {
        e.preventDefault()
        const title = $('#procrm_subscribes_category_title').val()

        if (title.length === 0)
            alert(1)

        $.post(admin_url + 'procrm_subscribes/setting/category', {
            title,
        }).done(function (response) {
            response = JSON.parse(response)
            if(response.status === 'success')
                window.location = admin_url + 'procrm_subscribes/setting';
            // console.log(response, )
            // var tab = $('#theme_styling_areas').find('li.active > a:eq(0)').attr('href');
            // tab = tab.substring(1, tab.length)
            // window.location = admin_url+'theme_style?tab='+tab;
        });
    })
});