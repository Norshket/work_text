
let Main = {

    showDeleteModal:function(url){
        $('.delete-modal').show();  
        $('#delete_action').attr("data-url", url);
        $('#delete_action').attr("data-table_id", 'list_items-table');
    },

    hideDeleteModal:function(){       
        $('.delete-modal').hide();  
        $('#delete_action').attr("data-url", '');
        $('#delete_action').attr("data-table_id", '');
    },


    delete:function(){
        let url = $('#delete_action').attr("data-url");
        let table = $('#delete_action').attr("data-table_id");

        $.ajax({
            type: 'DELETE',
            url: url ,
            success: function(data){        
                $('.delete-modal').hide();
                $(`#${table}`).DataTable().ajax.reload();  
                $('#delete_action').attr("data-url",'');
                $('#delete_action').attr("data-table_id",'');
            },
            error: function(error){
                console.log(error)
            }
        });
    },


    hideModal:function(modal){       
        modal.hide()
        modal.find('.modal-dialog').children().remove();
    },

}