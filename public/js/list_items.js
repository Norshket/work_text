
let listItem  = {

    create:function(url){

        $.get(url).then(function(data){     
            $('.modal-form').find('.modal-dialog').append(data.html);
            $('.ajax-select2').select2();
            $('.modal-form').show();            
        }).catch(({error}) => console.log(error))
    },

    store:function(url){
        let data = {
            name: $("[name='name']").val(),
            text: $("[name='text']").val(),
            hashtags: $("[name='hashtags[]']").val(),
        }
        $.post(url ,data).then(function(data){
            $('.modal-form').hide();
            $('.modal-form').find('.modal-dialog').children().remove();
            $('#list_items-table').DataTable().ajax.reload();  
        }).catch(({responseJSON}) => {
            Object.values( responseJSON.errors).map(error => {
                toastr.error(error)
            })         
        })
    },

    edit:function(url){
        $.get(url).then(function(data){
            $('.modal-form').find('.modal-dialog').append(data.html);
            $('.modal-form').show();        
            $('.ajax-select2').select2();
        }).catch(({error}) => console.log(error))
    },
    
    update:function(url){
        let data = {
            name: $("[name='name']").val(),
            text: $("[name='text']").val(),
            hashtags: $("[name='hashtags[]']").val(),

        }
        $.ajax({
            type: 'PATCH',
            url: url ,
            data: data,
            success: function(data){        
                $('.modal-form').hide();
                $('.modal-form').find('.modal-dialog').children().remove();
                $('#list_items-table').DataTable().ajax.reload();    
            },
            error: function({responseJSON}){
                Object.values( responseJSON.errors).map(error => {
                    toastr.error(error)
                })        
            }
        });
    },   
}