<template>
    <div class="container">
        <div v-if="$can('update products')">
                    
            <form role="form" @click="updateShopAvailability">
                
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">

                    <small class="text-white">{{this.shop.name}}</small>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input v-model="form.availability" name="availability" type="checkbox" class="custom-control-input" :class="{ 'is-invalid': form.errors.has('availability') }" 
                            :id="'availability-'+this.currentShop.slug">
                            <label class="custom-control-label text-success" :for="'availability-'+this.currentShop.slug">Shop is {{this.shopStatus ? 'Available' : 'unavailable'}}</label>
                        </div>
                    </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['shop'],

        mounted() {
            console.log('Retailer Shoop Availability Component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    availability: this.shop.is_available,
                }),
                // currentShopState: this.shop.is_available,
                currentShop: this.shop,
                shopStatus: this.shop.is_available,
            }
        },
        computed: {
            // updateShopState(){
            //     this.currentShopState = !this.currentShopState;
            // },
            // updateForm(){
            //     this.form.availability = this.currentShopState;
            // }
            updateShopStatus(){
                this.shopStatus = !this.shopStatus;
            }
        },
        methods: {
            updateShopAvailability(){

                // this.updateShopstate;
                // this.updateForm;
                
                // make sure the product belongs to the shop, and the user has permission to update the shop
                this.form.put('/dashboard/retailer/shops/'+this.currentShop.slug+'/settings/availability')
                .then(()=>{
                    this.updateShopStatus();

                    Toast.fire({
                        icon: 'success',
                        title: 'Availability Successfully'
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
