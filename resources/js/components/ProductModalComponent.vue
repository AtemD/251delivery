<template>
    <div class="modal fade" :id="'product-'+product.id" tabindex="-1" role="dialog" aria-labelledby="productLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{product.name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{product.description}}
                </div>
                <div class="modal-footer">
                    <div class="container pl-1 pr-1">
                        <div class="row no-gutters">
                            <div class="col-5 justify-content-start">
                                <td class="d-flex justify-content-start">
                                    <button @click="decreaseProductQuantity" type="button" class="btn btn-outline-danger btn-sm">-</button>
                                        <strong class="mx-1"><h5>{{productQuantity}}</h5></strong> 
                                    <button @click="increaseProductQuantity" type="button" class="btn btn-outline-success btn-sm">+</button>
                                </td>
                            </div>
                            <div class="col-7">
                                <button @click="addToCart" v-modal="productPrice" type="button" class="btn btn-primary btn-block">Add for ETB {{productPrice}}</button>
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
            
            // this.initializeProduct();
        },
        data(){
            return {
                productQuantity: 1,
                productPrice: this.product.price,
                isButtonDisabled:true,
            }
        },
        methods:{
            addToCart(){
                bus.$emit('add-to-cart',this.product, this.productQuantity);
                $('#product-'+this.product.id).modal('hide');
            },
            // removeFromCart(){
            //     bus.$emit('remove-from-cart',this.product.id, this.productQuantity);
            // },
            increaseProductQuantity(){
                this.productQuantity++;
                this.productPrice = this.productQuantity*this.product.price;

                if(this.isButtonDisabled == true && this.productQuantity>1){
                    this.isButtonDisabled = false;
                }
            },
            decreaseProductQuantity(){
                if(this.productQuantity > 1){
                    this.productQuantity--;
                    this.productPrice = this.productQuantity*this.product.price;
                } else {
                    if(this.productQuantity==1 && this.isButtonDisabled==false){
                        this.isButtonDisabled = true;
                    }
                }
            },
            initializeProduct(){
                const matchingProductIndex = this.cart.findIndex((item) => {
                    return item.id === product.id;
                });

                if (matchingProductIndex > -1) {
                    this.productQuantity = this.cart[matchingProductIndex].quantity;
                    this.productPrice = this.productQuantity*this.product.price;
                } else {
                    this.productQuantity = this.product.quantity;
                    this.productPrice = this.product.price;
                }
            }
        }
    }
</script>
