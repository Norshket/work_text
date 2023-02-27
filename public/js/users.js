
let user  = {    
    create:function(url){
        $.get(url).then(function(data){     
            user.showModal(data)
        }).catch(({error}) => console.log(error))
    },

    store:function(url){     
        let data = new FormData($('#create')[0])   
        $.ajax({
            type:'POST',
            url: url ,
            data: data,
            processData: false,
            contentType: false,
            success: function(data){        
                user.hideModal();
            },
            error: function({responseJSON}){
                Object.values( responseJSON.errors).map(error => {
                    toastr.error(error)
                })        
            }
        });
    },

    edit:function(url){    
        $.get(url).then(function(data){
            user.showModal(data);
        }).catch(({error}) => console.log(error))
    },


    permissions:function(url){
        $.get(url).then(function(data){
            user.showModal(data);
        }).catch(({error}) => console.log(error))
    },
    
    update:function(url){
        let data = new FormData($('#create')[0])   
        $.ajax({
            type:'POST',
            data: data,
            url: url ,
            contentType: false,
            processData: false,
            success: function(data){        
                user.hideModal();
            },
            error: function({responseJSON}){
                Object.values( responseJSON.errors).map(error => {
                    toastr.error(error)
                })        
            }
        });
    },  
    
    showModal: function(data){
        $('.modal-form').find('.modal-dialog').append(data.html);
        $('.modal-form').show();   
    },
    
    hideModal: function(){
        $('.modal-form').hide();
        $('.modal-form').find('.modal-dialog').children().remove();
        $('#users-table').DataTable().ajax.reload();    
    }


    
}