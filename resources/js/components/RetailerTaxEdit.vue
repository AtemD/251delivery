<template>
    <div class="container">
        <div v-if="$can('update taxes')">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" :data-target="'#edit-tax-'+currentTax.id">
                <i class="fas fa-pencil-alt">
                </i>
            </button>

            <div class="modal fade" :id="'edit-tax-'+currentTax.id" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit {{currentTax.name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="updateTax">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of tax e.g 'Sales Tax' "
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Rate</label>
                                        <input v-model="form.rate" type="text" name="rate" placeholder="your tax rate e.g 15.00"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('rate') }" required>
                                        <has-error :form="form" field="rate"></has-error>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Rate Type</label>
                                        <select class="form-control" name="rate_type" v-model="form.rate_type" :class="{ 'is-invalid': form.errors.has('rate_type') }" required>
                                            <option value="percentage">
                                                Percentage (%)
                                            </option>
                                        </select>
                                        <has-error :form="form" field="rate_type"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Shop</label>
                                    <select class="form-control" name="shop" v-model="form.shop" :class="{ 'is-invalid': form.errors.has('shop') }" required>
                                        <option :value="currentShop.id">
                                            {{ currentShop.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="shop"></has-error>
                                </div>
                            
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }" required>
                                        <option :value="0">
                                            Disabled
                                        </option>
                                        <option :value="1">
                                            Enabled
                                        </option>
                                    </select>
                                    <has-error :form="form" field="status"></has-error>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['shop', 'tax'],

        mounted() {
            console.log('Edit tax component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : this.tax.name,
                    rate: this.tax.tax_rate,
                    rate_type: this.tax.rate_type,
                    shop:  this.shop.id,
                    status: this.tax.is_enabled,
                }),
                currentShop: this.shop,
                currentTax: this.tax,
            }
        },
        methods: {
            updateTax(){
                this.form.put('/dashboard/retailer/shops/'+this.currentShop.slug+'/settings/taxes/'+ this.currentTax.id)
                .then(()=>{

                    $('#edit-tax-'+this.currentTax.id).modal('hide');

                    Toast.fire({
                        icon: 'success',
                        title: 'Tax Updated Successfully'
                    })

                    setTimeout(()=>{ 
                        window.location.reload();
                    },1000);

                })
                .catch(()=>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Check your inputs values and try again'
                    })
                })
            }
        }
    }
</script>
