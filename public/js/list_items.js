
let listItem  = {    
    create:function(url){
        $.get(url).then(function(data){     
            listItem.showModal(data)
        }).catch(({error}) => console.log(error))
    },

    store:function(url){    

        let data = new FormData($('#create')[0]);
        data.append('delete_image', Number($('#delete-image').prop('checked'))) 

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

        let data = new FormData($('#create')[0]);
        data.append('delete_image', Number($('#delete-image').prop('checked'))) 


        $.ajax({
            type: 'POST',
            data: data,
            url: url ,
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
    },

    deleteImage:function()
    { 
        $("#image").val('');
        $('#delete-image').attr('checked', true);

        if( $('#image-previewer').prop("tagName") === 'CANVAS'){
            var canvas = document.getElementById('image-previewer');
            var context = canvas.getContext('2d');
            context.clearRect(0, 0, canvas.width, canvas.height); 
        }     
        if( $('#image-previewer').prop("tagName") === 'IMG'){
            $('#image-previewer').attr('src', '#')
            $('#image-previewer').attr('alt', '')
        }          
    }
}