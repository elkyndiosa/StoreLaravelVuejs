var app = new Vue({
    el: "#adminProduct",
    created: function () {
        this.getProducts(this.pagination.current_page),
        this.getCategory()
    },
    data: {
        products: [],
        category: null,
        image_path: null,
        thumbImage: null,
        newProduct: {
            'category': null,
            'name': null,
            'description': null,
            'image': null,
            'price': null,
            'stock': null
        },
        fillProduct: {
            'id': '',
            'category': '',
            'name': '',
            'description': '',
            'image': '',
            'price': ''
            
        },
        pagination: {
            'total':0,
            'current_page':1,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0
        },
        'offset' : 3,
        'errors' : ''
    },
    computed:{
        image: function(){
            return this.thumbImage;
        },
        isActive: function(){
            return this.pagination.current_page;
        },
        pagesNumber:function(){
        if(!this.pagination.to){
            return [];
	}

            var from = this.pagination.current_page - this.offset; 
            if(from < 1){
                    from = 1;
            }

            var to = from + (this.offset * 2); 
            if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                    pagesArray.push(from);
                    from++;
            }
            return pagesArray;
        }
    },
    methods: {
        restartThumb: function(){
            this.thumbImage = '';
        },
        createProduct: function(){
            this.errors = '';
            var url = "../product/create";
            var formData = new FormData();
            formData.append('category', this.newProduct.category);
            formData.append('name', this.newProduct.name);
            formData.append('description', this.newProduct.description);
            formData.append('price', this.newProduct.price);
            formData.append('stock', this.newProduct.stock);
            formData.append('image', this.newProduct.image);
            axios.post(url, formData).then(response => {
                console.log(response);
                this.getProducts(this.current_page);
                this.newProduct = {};
                formData.delete('category');
                formData.delete('name');
                formData.delete('description');
                formData.delete('price');
                formData.delete('image');
                formData.delete('stock');
                $('#created').modal('hide');
                $('#created').removeClass('show');
                toastr.success('Product created successfull'); //mensaje

            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        },
        getImage: function(e){
            $('#img-show').hide();

            var file = e.target.files[0];
            this.newProduct.image = file;
            this.uploadImage(file);
        },
        uploadImage: function(file){
            var reader = new FileReader();
            
            reader.readAsDataURL(file);
            
            reader.onload = (e) =>{
                this.thumbImage = e.target.result;
            }
//            console.log(this.thumbImage);
        },
        deleteProduct: function(id){
            var confirmed = confirm("Are you sure to eliminate this product?");
            if (confirmed == true) {
                var urlDelete = '../product/delete/'+id;
                axios.get(urlDelete).then(response => {
                    this.getProducts(this.pagination.current_page);
                    toastr.success('Product delete successfull'); //mensaje
                }); 
            }


        },
        getCategory: function(){
            var url = '../category/all';
            axios.get(url).then(response => {
                this.category = response.data;
            });
        },
        editProduct: function(product){
            this.newProduct.image = '';
            $('#img-show').show();
            $('#file').val('');
            this.thumbImage = '';
            this.fillProduct.id = product.id;
            this.fillProduct.category = product.category;
            this.fillProduct.name = product.name;
            this.fillProduct.description = product.description;
            this.fillProduct.price = product.price;
            this.fillProduct.image = product.image;
            this.getImageUpdate(product.id);
            $('#update').modal('show');
        },
        
        updateProduct: function(){
            this.restartThumb();
            var url = "../product/edit";
            var formData = new FormData();
            formData.append('id', this.fillProduct.id);
            formData.append('name', this.fillProduct.name);
            formData.append('description', this.fillProduct.description);
            formData.append('price', this.fillProduct.price);
            if(this.newProduct.image){
                formData.append('image', this.newProduct.image);
            };
            
            axios.post(url, formData).then(response => {
                this.getProducts(this.pagination.current_page);
                this.fillProduct = {};
                formData.delete('id');
                formData.delete('category');
                formData.delete('name');
                formData.delete('description');
                formData.delete('price');
                formData.delete('image');
                $('#update').modal('hide');
                $('#update').removeClass('show');
                toastr.success('Product edit successfull'); //mensaje
            }).catch(error => {
                this.errors.p = 'Incorrect data, please modify.',
                this.errors.s = 'note: you must enter all the data to be able to create the product'
            });
        },
        
        getProducts: function (page) {
            var url = '../products?page=' + page;
            axios.get(url).then(response => {
//                console.log(response);
                this.products = response.data.product.data,
                this.pagination = response.data.pagination
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getProducts(page);
            
        },
        getImageUpdate: function(id){
            var url = '../product/getImage/'+id;
            axios.get(url).then(response => {
                this.image_path= 'http://localhost/Delivery/storage/app/'+response.data;
            });
        }

    }

});

