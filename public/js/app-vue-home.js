var app = new Vue({
    el: "#home",
    created: function () {
        this.getProducts(1);
       
    },
    data: {
        categories: '',
        products: '',
        pagination: {
            'total':0,
            'current_page':0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0
        },
        fillModalProd:{
            'id'            : '',
            'name'          : '',
            'description'   : '',
            'price'         : '',
            'status'        : '',
            'image_path'    : ''
        },
        'cartProducts': null,
        'offset' : 3,
        'cantCart': '',
        'total': '',
        'iva': '',
        'shoppingHistory': '',
        'orderDetails': null,
        'optionStatus': false,
        'category': '',
        'current_category': '',
        'categoryIsset': null,
        'search': '',
        'error': ''
    },
    computed:{
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
        getImage: function(image_path){
             return 'http://localhost/ProyectsFinish/Delivery/storage/app/'+image_path;

         },
        getCart: function(){
           var url = 'product/getCart'; 
           axios.get(url).then(response => {
              this.cartProducts = response.data.cart;
              if(this.cartProducts != null){
              this.total = (response.data.total).toFixed(2);
              this.iva = (this.total * 0.19).toFixed(2);
          }

           });
         },
        deleteOfCart: function(id){
            var url = 'product/deleteProductCart/'+id;
            axios.get(url).then(response =>{
                this.getCart();
                this.cantCart = response.data;
                var textNot = this.$refs.notifications;
                textNot.innerText = this.cantCart;
                toastr.success('Product delete of cart successfull'); //mensaje
            });
        },
        getProducts: function(page){
           var url = 'products?page='+page;
           axios.get(url).then(response => {
              this.products = response.data.product.data;
              this.pagination = response.data.pagination;
              this.getCantProduct();
              this.getCategory();
              var titleHome = this.$refs.titleHome;
              titleHome.innerText = 'Products';

           }).catch(error => {
               console.log(error.response);
           });
           
       },
        getProductsByCategory: function(cat, page){
           this.current_category = cat.id;
           var url = 'products/category/'+cat.id+'?page='+page;
           axios.get(url).then(response => {
                this.categoryIsset = true;
                this.products = response.data.product.data;
                this.pagination = response.data.pagination;
                var titleHome = this.$refs.titleHome;
                titleHome.innerText = cat.name;
           }).catch(error => {
               console.log(error.response);
           });
       },
        changePage: function(page) {
            this.pagination.current_page = page;
            if(this.categoryIsset){
                this.getProductsByCategory(this.current_category ,page);
            }else{
               this.getProducts(page); 
            }
            
            
        },
        getDataProduct(product){
            this.fillModalProd.id = product.id;
            this.fillModalProd.name = product.name;
            this.fillModalProd.description = product.description;
            this.fillModalProd.price = product.price;
            this.fillModalProd.status = product.status;
            this.fillModalProd.image_path = product.image_path;
            
            $('#seeProduct').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('name') // Extract info from data-* attributes
            var price = button.data('price')
            var description = button.data('description')
            var modal = $(this)
            
            modal.find('.modal-title').text(name)
            modal.find('#price').text(price)
            modal.find('#description').text(description)

            })
            
        },
        getCantProduct: function(){
            var url = 'product/countProdS';
            axios.get(url).then(response => {
                this.cantCart = response.data;                
            });
        },
        addCart: function(fillModalProd){
            var url = 'product/addCart';
            var formData = new FormData();
            formData.append('id', fillModalProd.id);
            formData.append('name', fillModalProd.name);
            formData.append('description', fillModalProd.description);
            formData.append('price', fillModalProd.price);
            formData.append('status', fillModalProd.status);
            formData.append('image_path', fillModalProd.image_path);
            formData.append('quantity', 1);
            axios.post(url, formData).then(response => {
                if(response.data == ''){
                    toastr.warning('you must register to continue'); //mensaje
                }else{
                    $('#seeProduct').modal('hide');
                    formData.delete('id');
                    formData.delete('name');
                    formData.delete('description');
                    formData.delete('price');
                    formData.delete('status');
                    formData.delete('image_path');
                    this.cantCart = response.data;
                    var textNot = this.$refs.notifications;
                    textNot.innerText = this.cantCart;
                    toastr.success('Product add cart'); //mensaje
            }
            });
        },
        increase:function(id){
            var url = 'product/increase/'+id;
            axios.get(url).then(response => {
                this.getCart();
            });
        },
        decrease:function(id){
            var url = 'product/decrease/'+id;
            axios.get(url).then(response => {
                this.getCart();
            });
        },
        makePurchase: function(){
            var url = 'order/create/'+this.total;
            axios.get(url).then(response =>{
                this.cartProducts = '';
                this.total = 0;
                this.iva = 0;
                this.cantCart = 0;
                var textNot = this.$refs.notifications;
                textNot.innerText = this.cantCart;
                $('#shoppingCart').modal('hide');
                toastr.success('Order placed'); //mensaje
            }).catch(error => {
                console.log(error.response);
            });
        },
        getHistory: function(){
            var url = 'order/get';
            axios.get(url).then(response => {
                this.shoppingHistory = response.data;
            });
        },
        showDetailsOrder: function(shopping){
            var url = 'order/details/'+shopping.id;
            axios.get(url).then(response => {
                this.total = shopping.cost;
                $('#historyShopping').modal('hide');
                setTimeout(function(){
                    $('#orderDetails').modal('show');
                },250);
                this.orderDetails = response.data;
            });
        },
        prevModal: function(){
            setTimeout(function(){
                $('#historyShopping').modal('show');
            },250);
        },
        getOrder: function(){
            var url = 'order/getAll';
            axios.get(url).then(response =>{
                this.shoppingHistory = response.data;
                this.optionStatus = true;
            });
        },
        changeStatus: function(id){
            var select = event.target.value;
            var url = 'order/changeStatus';
            var formData = new FormData();
            formData.append('newStatus', select);
            formData.append('id', id);
            axios.post(url, formData).then(response =>{
                toastr.success('Status was modified'); //mensaje
            });
            
        },
        getCategory: function(){
             var url = 'category/admin';
             axios.get(url).then(response => {
                 console.log(response);
                 this.category = response.data;
             });
        },
        searchGet: function(){
            if(this.search.length > 3){
                var url = 'products/search/'+this.search;
                axios.get(url).then(response => {
                    this.products = response.data;
                    var titleHome = this.$refs.titleHome;
                    titleHome.innerText = 'Results for: '+this.search;
                    if(this.search.length == 4){
                        $('#pages-show').addClass("nav-show");
                    }
                });
            }else if(this.search.length <= 3){
                this.getProducts();
                if(this.search.length == 3){
                    $('#pages-show').removeClass("nav-show");
                }
            }

        }
    }
});
