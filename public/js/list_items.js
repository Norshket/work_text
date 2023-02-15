
let listItem  = {

    create:function(url){
        $.get(url).then(function(data){            
            $('.default-modal').find('.modal-dialog').append(data.html);
            $('.default-modal').show();            
        }).catch(({error}) => console.log(error))
    },

    store:function(url){
        let data = {
            name: $("[name='name']").val()
        }
        $.post(url ,data).then(function(data){
            $('.default-modal').hide();
            $('.default-modal').find('.modal-dialog').children().remove();
            $('#list_items-table').DataTable().ajax.reload();  
        }).catch(({error}) => console.log(error))
    },

    edit:function(url){
        $.get(url).then(function(data){
            console.log(data);
        }).catch(({error}) => console.log(error))
    },
    
    update:function(url){
        let data = {
            name: $("[name = 'name']").val()
        }

        $.put(url ,data).then(function(data){
            console.log(data);
        }).catch(({error}) => console.log(error))
    },   
}