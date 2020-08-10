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
                    <div class="table-responsive">
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
                                    <th scope="row">{{cartItem.name}}</th>
                                    <td>{{cartItem.price}} ETB</td>
                                    <td>{{cartItem.price*cartItem.qty}} ETB</td>
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
                                    <th>No Item In card, Please order an item in the shop</th>
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
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Back</button>
                    <button v-if="totalitems > 0" type="submit" class="btn btn-primary">Proceed to CheckOut</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['cart','carttotal','totalitems'],

        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            removeFromCart(cartItem){
                bus.$emit('remove-from-cart',cartItem);

            },
            addToCart(cartItem){
                bus.$emit('add-to-cart',cartItem);

            }
        }
    }
</script>
