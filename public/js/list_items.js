
let listItem  = {    
    create:function(url){
        let self = this
        $.get(url).then(function(data){     
            self.showModal()
        }).catch(({error}) => console.log(error))
    },

    store:function(url){
        let data = this.getData()      
        let self = this
        $.post(url ,data).then(function(data){
            self.hideModal();
        }).catch(({responseJSON}) => {
            Object.values( responseJSON.errors).map(error => {
                toastr.error(error)
            })         
        })
    },

    edit:function(url){
        let self = this
        $.get(url).then(function(data){
            self.showModal();
        }).catch(({error}) => console.log(error))
    },
    
    update:function(url){
        let data = this.getData()
        let self = this

        $.ajax({
            type: 'PATCH',
            url: url ,
            data: data,
            success: function(data){        
                self.hideModal();
            },
            error: function({responseJSON}){
                Object.values( responseJSON.errors).map(error => {
                    toastr.error(error)
                })        
            }
        });
    },  
    
    getData: function(){
        return {
            name: $("[name='name']").val(),
            text: $("[name='text']").val(),
            hashtags: $("[name='hashtags[]']").val(),
        }
    },

    showModal: function(){
        $('.modal-form').find('.modal-dialog').append(data.html);
        $('.ajax-select2').select2();
        $('.modal-form').show();   
    },
    
    hideModal: function(){
        $('.modal-form').hide();
        $('.modal-form').find('.modal-dialog').children().remove();
        $('#list_items-table').DataTable().ajax.reload();    
    }
}