<template>
    <div class="col-md-6 col-sm-12 col-12">
        <div class="shop-item-product">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-4 p-1">
                        <img class="card-img img-fluid" :src="product.image_path" alt="product image">
                    </div>
                    <div class="col-8">
                        <div class="card-body shop-item-product-details">
                            <h5 class="card-title shop-item-product-title">{{product.name}}</h5>
                            <h5 class="card-title shop-item-product-title text-muted">{{product.price}} <small>ETB</small></h5>
                            <small><p class="card-text text-muted text-break">{{product.description}}</p></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-4">
                            
                        </div>
                        
                        <div class="col-8 ml-auto pl-0">
                            <div class="shop-item-product-add-to-cart">
                                <button v-if="productStatus==='unavailable'" type="button" class="btn btn-outline-secondary btn-sm btn-block product-cart" disabled>
                                    {{product.status}}<small>(out of stock)</small>
                                </button>

                                <div v-else class="adding-to-cart">
                                    <button v-if="!addingToCart" @click="addToCart" type="button" class="btn btn-outline-secondary btn-sm btn-block product-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>

                                    <div v-else>
                                            
                                        <div class="d-flex justify-content-end">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-secondary mr-2" disabled>Add for {{productTotalPrice}}</button>
                                                <button type="button" @click="removeFromCart" class="btn btn-outline-danger mr-2">-</button>
                                                <button type="button" class="btn" disabled>{{productQuantity}}</button>
                                                <button type="button" @click="addToCart" class="btn btn-outline-primary ml-2">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product', 'cart'],

        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                productQuantity: 1,
                productTotalPrice: this.product.price,
                productStatus: this.product.status,
                addingToCart:false,
            }
        },
        methods:{
            removeFromCart(){
                if(this.productQuantity==1){
                    this.addingToCart = false;
                    bus.$emit('remove-from-cart',this.product);
                } else {
                    bus.$emit('remove-from-cart',this.product);
                    this.findProductQuantity();
                }
            },
            addToCart(){
                bus.$emit('add-to-cart',this.product);
                this.findProductQuantity();
                this.addingToCart = true;
            },

            findProductQuantity(){
                const matchingProductIndex = this.cart.findIndex((item) => {
                    return item.id === this.product.id;
                });

                if (matchingProductIndex > -1) {
                    this.productQuantity = this.cart[matchingProductIndex].qty;
                    this.productTotalPrice = this.product.price * this.productQuantity;
                } else {
                    this.productQuantity = 1;
                    this.productTotalPrice = this.product.price;
                }
            }
        }
    }
</script>


