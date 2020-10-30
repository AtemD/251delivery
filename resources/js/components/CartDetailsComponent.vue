<template>
    <div class="modal fade" id="cartDetail" tabindex="-1" role="dialog" aria-labelledby="cartDetailLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartDetailLabel">Your Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive table-bordered">
                        <table v-if="totalitems > 0" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cartItem in cart" :key="cartItem.id">
                                    <th scope="row" @click="goToProductLocation(cartItem)" class="text-primary">{{cartItem.name}}</th>
                                    <td>{{cartItem.base_price}} ETB</td>
                                    <td>{{cartItem.base_price*cartItem.qty}} ETB</td>
                                    <td class="d-flex justify-content-end">
                                        <button @click="removeFromCart(cartItem)" type="button" class="btn btn-danger btn-sm">-</button>
                                            <strong class="mx-1"> {{cartItem.qty}} </strong> 
                                        <button @click="addToCart(cartItem)" type="button" class="btn btn-success btn-sm">+</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table v-else>
                            <thead>
                                <tr>
                                    <th>No Item In cart, Please order an item in the shop</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <hr>
                    <div class="cart-summary d-flex justify-content-center">
                        <h5>Grand Total: {{carttotal}} ETB</h5>
                        <small>({{ totalitems}} Items)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Back to Shopping</button>
                    <button v-if="totalitems > 0" type="button" class="btn btn-primary" @click="proceedToCheckout">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['cart','carttotal','totalitems'],

        mounted() {
            console.log('Component mounted.');
        },
        data() {
            return {
                form: new Form({
                    user_cart : '',
                    // cart_total: '',
                    // total_items: ''
                }),
            }
        },
        methods:{
            removeFromCart(cartItem){
                bus.$emit('remove-from-cart',cartItem);

            },
            addToCart(cartItem){
                bus.$emit('add-to-cart',cartItem);

            },
            goToProductLocation(cartItem) {
                $('#cartDetail').modal('hide');
                window.location.href = cartItem.shop_path +"?#"+ cartItem.name ;
            },
            proceedToCheckout(){
                if(!this.totalitems>0) return bus.$emit('show-error-alert');

                this.form.user_cart = this.cart;

                this.form.post('/checkout')
                .then(()=>{

                    $('#cartDetail').modal('hide');
                    window.location.href = "/checkout";

                })
                .catch(
                    (error)=>{

                        // If the error is due to user not logged in 
                        if(error.response && error.response.status === 401) {
                            // Redirect the user to the checkout page so that they are automatically redirected to login page
                            // Redirecting directly to login, will not redirect user to intended url, but to homepage, which is not what we want.
                            window.location.href = "/checkout";
                        } else {
                            // if there is another error
                            bus.$emit('show-error-alert');
                        }
                        
                    }
                )
                
            }
        }
    }
</script>
