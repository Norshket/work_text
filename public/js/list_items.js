
let listItem  = {    
    create:function(url){
        $.get(url).then(function(data){     
            listItem.showModal(data)
        }).catch(({error}) => console.log(error))
    },

    store:function(url){     
        let data = new FormData($('#create')[0])   
        console.log(data);


        $.ajax({
            type:'POST',
            url: url ,
            data: data,
            processData: false,
            contentType: false,
            success: function(data){        
                listItem.hideModal();
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
            listItem.showModal(data);
        }).catch(({error}) => console.log(error))
    },
    
    update:function(url){
        let data = new FormData($('#create')[0])   
        data.append('_method', "PUT");

        $.ajax({
            type:'POST',
            data: data,
            url: url ,
            dataType: 'text',
            contentType: false,
            processData: false,
            success: function(data){        
                listItem.hideModal();
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
        $('.ajax-select2').select2();
        $("#image").cropzee({
            aspectRatio: 1,
            onCropEnd: function (params) {
                $('#image-x').val(params.x)
                $('#image-y').val(params.y)
                $('#image-width').val(params.width)
                $('#image-height').val(params.height)
            },
            startSize:function(params){
                $('#image-x').val(params.x)
                $('#image-y').val(params.y)
                $('#image-width').val(params.width)
                $('#image-height').val(params.height)
            }
        })

        $('.modal-form').show();   
    },
    
    hideModal: function(){
        $('.modal-form').hide();
        $('.modal-form').find('.modal-dialog').children().remove();
        $('#list_items-table').DataTable().ajax.reload();    
    }
}