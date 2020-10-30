<template>
    <div class="card card-primary card-outline mt-5">
        <div class="card-header">
            <h5 class="card-title">Your Cart Summary</h5>
            <a href="#" class="card-link">Edit</a>
        </div>
        <div class="card-body" v-for="cartItem in cart" :key="cartItem.id">
            <div class="row">
                <div class="col-md-6">
                    {{cartItem.name}}
                </div>
                <div class="col-md-3">
                    x{{cartItem.qty}}
                </div>
                <div class="col-md-3">
                    {{cartItem.base_price*cartItem.qty}} ETB
                </div>
            </div>
            <hr>
            <div class="cart-summary d-flex justify-content-center">
                <h5>Grand Total: {{carttotal}} ETB</h5>
                <small>({{ totalitems}} Items)</small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['cart','carttotal','totalitems'],

        mounted() {
            console.log('Cart Summary Component mounted.');
        },
        data() {
            return {
                form: new Form({
                    myCart : '',
                }),
            }
        },
        methods:{
            goToProductLocation(cartItem) {
                $('#cartDetail').card('hide');
                window.location.href = cartItem.shop_path +"?#"+ cartItem.name ;
            }
        }
    }
</script>
