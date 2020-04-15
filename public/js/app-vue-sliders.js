var app = new Vue({
    el: "#adminSliders",
    created: function () {
        this.getSliders()
    },
    data: {
        thumbImage: '',
        sliders: [],
        var_image: false,
        newSlider: {
            'title': '',
            'text': '',
            'color': '',
        },
        fillSlider: {
            'id' : '',
            'title': '',
            'text': '',
            'color': '',
            'image_path': ''

        },
        newImage: '',
        
        errors: {
            'p': '',
            's': ''
        }
    },
    computed:{
        image: function(){
            return this.thumbImage;
        }       
    },
    methods: {
        getImage: function(image_path){
            return 'http://localhost/Delivery/storage/app/'+image_path;
        },
        getImageForShow:function(e){
            var file= e.target.files[0];
            this.newImage = file;
            this.showImage(file);
            $('#img-show').hide();
        },
        showImage: function(file){
            var reader = new FileReader();
            
            reader.readAsDataURL(file);
            
            reader.onload = (e) =>{
                this.thumbImage = e.target.result;
            }
        },
        deleteSlider: function(id){
            var confirmed = confirm("Are you sure to eliminate this image?");
            if (confirmed == true) {
                var urlDelete = '../slider/delete/'+id;
                axios.get(urlDelete).then(response => {
                    this.getSliders();
                    toastr.success('Sliders delete successfull'); //mensaje
                }).catch(error => {
                this.errors.p = 'Error delete.',
                this.errors.s = 'please contact web administrator'
            }); 
            }
        },
        getSliders: function(){
            var url = '../sliders';
            axios.get(url).then(response => {
                this.sliders = response.data;
            });
        },
        createSlider: function(){
            var url = '../slider/create';
            var formData = new FormData();
            formData.append('title', this.newSlider.title);
            formData.append('text', this.newSlider.text);
            formData.append('color', this.newSlider.color);
            if(this.newImage){
                formData.append('image', this.newImage);
            }
            axios.post(url, formData).then(response => {
                this.getSliders();
                $('#created').modal('hide');
                toastr.success('Sliders created successfull'); //mensaje
                this.newSlider= {'title': '', 'text': '', 'color': ''};
                
            }).catch(error => {
                this.errors.p = 'Error create slider.',
                this.errors.s = 'please modify data for add';
                });
        },
        uploadSlider: function(){
            var url = '../slider/update';
            var formData = new FormData();
            formData.append('id', this.fillSlider.id);
            formData.append('title', this.fillSlider.title);
            formData.append('text', this.fillSlider.text);
            formData.append('color', this.fillSlider.color);
            if(this.newImage){
                formData.append('image', this.newImage);  
            };
            axios.post(url, formData).then(response => {
                this.getSliders();
                $('#update').modal('hide');
                toastr.success('Sliders update successfull'); //mensaje
            }).catch(error => {
                this.errors.p = 'Error update.',
                this.errors.s = 'please modify data for add';
            });
        },

        editSlider: function(slider){
            this.fillSlider.id = slider.id;
            this.fillSlider.title = slider.title;
            this.fillSlider.text = slider.text;
            this.fillSlider.color = slider.color;
            this.fillSlider.image_path = slider.image_path;
            this.restarThumb();
            
            $('#img-show').show();
            $('#update').modal('show');
        },
        restarThumb: function(){
            this.thumbImage = '';
            this.newImage = '';
            $('#inputImageUpdate').val('');
            $('#inputImageCreate').val('');
            
        }
    }

});