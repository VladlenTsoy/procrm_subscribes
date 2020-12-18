$(function () {
    initDataTable(`.table-subscribes`, admin_url + `procrm_subscribes/active/table`, ['undefined'], ['undefined'], undefined, [0, 'desc']);
});