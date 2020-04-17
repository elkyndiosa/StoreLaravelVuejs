var app = new Vue({
    el: "#adminCategories",
    created: function () {
        this.getCategory();
    },
    data: {
        categories: {},
        nameCategory: '',
        fillCategory: {
            'id': '',
            'name' : '',
        },
        newImage:'',
        thumbImage: '',
        showImg: false,
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
        getCategory: function(){
            var url = '../category/all';
            axios.get(url).then(response => {
                this.categories = response.data;
            });
        },
        getImage: function(image_path){
            return 'http://localhost/ProyectsFinish/Delivery/storage/app/'+image_path;
        },
        deleteCategory: function(id){
            var confirmed = confirm("Are you sure to eliminate this category?");
            if(confirmed){
                var url= '../category/delete/'+id;
                axios.get(url).then(response =>{
                this.getCategory();
                toastr.success('Category delete successfull'); //mensaje
            });
            }
            
        },
        editCategory: function(category){
            this.showImg = true;
            this.thumbImage = '';
            $('#img-show').show();
            $('#file').val('');
            this.newImage='';
            this.fillCategory.id= category.id;
            this.fillCategory.name= category.name;
            this.fillCategory.image_path= category.image_path;            
            $('#updateCategory').modal('show');
        },
        getImageForShow: function(e){
            $('#img-show').hide();
            var file= e.target.files[0];
            this.newImage = file;
            this.showImage(file);
            
        },
        showImage: function(file){
            var reader = new FileReader();
            reader.readAsDataURL(file);            
            reader.onload = (e) =>{
                this.thumbImage = e.target.result;
            }
        },
        update: function(){
            var url = '../category/update';
            var formData = new FormData();
            formData.append('id', this.fillCategory.id);
            formData.append('name', this.fillCategory.name);
            if(this.newImage){
                formData.append('image', this.newImage);
            }
            
            axios.post(url, formData).then(response =>{
                console.log(response);
                this.newImage='';
                this.thumbImage= '';
                formData.delete('id');
                formData.delete('name');
                $('#updateCategory').modal('hide');
                $('#updateCategory').removeClass('show');
                toastr.success('Category update successfull'); //mensaje
                this.getCategory();
            }).catch(error => {
                console.log(error.response);
            });
        },
        createCategory: function(){
            var url = '../category/create';
            var formData = new FormData();
            formData.append('name', this.nameCategory);
            if(this.newImage){
                formData.append('image', this.newImage);
            }
            axios.post(url, formData).then(response => {
                this.getCategory();
                this.thumbImage = '';
                formData.delete('name');
                formData.delete('image');
                $('#created').modal('hide');
                toastr.success('Category create successfull'); //mensaje
            });
        },

    }



});

