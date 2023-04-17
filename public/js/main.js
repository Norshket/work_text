let Main = {
    showDeleteModal: function (url, table) {
        $(".delete-modal").show();
        $("#delete_action").attr("data-url", url);
        $("#delete_action").attr("data-table_id", table);
    },

    hideDeleteModal: function () {
        $(".delete-modal").hide();
        $("#delete_action").attr("data-url", "");
        $("#delete_action").attr("data-table_id", "");
    },

    delete: function () {
        let url = $("#delete_action").attr("data-url");
        let table = $("#delete_action").attr("data-table_id");

        $.ajax({
            type: "DELETE",
            url: url,
            success: function (data) {
                if (!data.is_delete) {
                    toastr.error(data.message);
                }

                $(".delete-modal").hide();
                $("#delete_action").attr("data-url", "");
                $("#delete_action").attr("data-table_id", "");
                $(`#${table}`).DataTable().ajax.reload();
            },
            error: function (error) {
                console.log(error);
            },
        });
    },

    hideModal: function (modal) {
        modal.hide();
        modal.find(".modal-dialog").children().remove();
    },

    searchDataTable: function (input, tableId) {
        if (tableId && input) {
            const table = window.LaravelDataTables[tableId];
            table.search($(input).val()).draw();
        }
        return true;
    },

    updateDataTable: function (event, tableId = "dtListElements") {
        const table = window.LaravelDataTables[tableId];
        table.draw();
        event.preventDefault();
    },
};
