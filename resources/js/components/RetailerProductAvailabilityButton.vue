<template>
    <div class="container">
        <div v-if="$can('update products')">
                    
            <form role="form" @click="updateProductAvailability">
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input v-model="form.availability" name="availability" type="checkbox" class="custom-control-input" :class="{ 'is-invalid': form.errors.has('availability') }" 
                            :id="'availability-'+this.currentProduct.id">
                        <label class="custom-control-label" :for="'availability-'+this.currentProduct.id"></label>
                    </div>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['shop', 'product'],

        mounted() {
            console.log('Retailer Product Availability Component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    availability: this.product.is_available,
                }),
                currentShop: this.shop,
                currentProduct: this.product
            }
        },
        methods: {
            updateProductAvailability(){
                
                // make sure the product belongs to the shop, and the user has permission to update the shop
                this.form.put('/dashboard/retailer/shops/'+this.currentShop.slug+'/products/'+this.currentProduct.id+'/availability')
                .then(()=>{

                    Toast.fire({
                        icon: 'success',
                        title: 'Availability Updated Successfully'
                    })

                    // setTimeout(()=>{ 
                    //     window.location.reload();
                    // },1000);

                })
                .catch(()=>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong, Try again.!'
                    })
                })
            }
        }
    }
</script>
