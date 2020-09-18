<template>
    <div class="container">
        <div v-if="$can('update products')">
            
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" :data-target="'#edit-product-'+currentProduct.id">
                <i class="fas fa-pencil-alt">
                </i>
            </button>

            <div class="modal fade" :id="'edit-product-'+currentProduct.id" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit {{currentProduct.name }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="updateProduct" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="your product name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Shop</label>
                                    <select class="form-control" name="shop" v-model="form.shop" :class="{ 'is-invalid': form.errors.has('shop') }" required>
                                        <option :value="currentShop.id" :key="currentShop.id">
                                            {{ currentShop.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="shop"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Sections</label>
                                    <select class="form-control" name="section" v-model="form.section" :class="{ 'is-invalid': form.errors.has('section') }" required>
                                        <option v-for="section in currentShopSections" :key="section.id" :value="section.id">
                                            {{ section.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="section"></has-error>
                                </div>

                                    <label :for="'image-'+currentProduct.id">Image File</label><br>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" :id="'image-'+currentProduct.id"
                                            :class="{ 'is-invalid': form.errors.has('image') }" @change="selectFile">
                                        <label class="custom-file-label" :for="'image-'+currentProduct.id">{{ image_notice }}</label>

                                        <div v-if="form.errors.has('image')" class="invalid-feedback mb-4">{{ form.errors.get('image') }}</div>
                                    </div>

                                <div class="form-group"><br/>
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about your product"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required>
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Base price</label>
                                    <input v-model="form.base_price" type="text" name="base_price" placeholder="your products base price"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('base_price') }" required>
                                    <has-error :form="form" field="base_price"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Availability</label>
                                    <select class="form-control" name="availability" v-model="form.availability" :class="{ 'is-invalid': form.errors.has('availability') }" required>
                                        <option :value="0">
                                            Unavailable
                                        </option>
                                        <option :value="1">
                                            available
                                        </option>
                                    </select>
                                    <has-error :form="form" field="availability"></has-error>
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
        props: ['shop', 'sections', 'product'],

        mounted() {
            console.log('Retailer edit shop Component mounted.')
        },
        data() {
            return {
                currentShop: this.shop,
                currentShopSections: this.sections,
                currentProduct: this.product,
                form: new Form({
                    name : this.product.name,
                    shop:  this.shop.id,
                    section:  this.product.section.id,
                    image:  '',
                    description:  this.product.description,
                    base_price:  this.product.price,
                    availability:  this.product.is_available,
                    
                }),
                image_notice: this.product.image,
                image_errors: '',
            }
        },
        methods: {
            selectFile(e) {
                const file = e.target.files[0];
                // Assign the image name to notice
                this.image_notice = file.name;
                // Assign the file to the image
                this.form.image = file;
            },
            updateProduct(){
                console.log(this.form);
                this.form.submit('post', '/dashboard/retailer/shops/'+this.currentShop.slug+'/products/'+this.currentProduct.id, {
                    // Transform form data to FormData
                    transformRequest: [function (data, headers) {
                        data['_method'] = 'PUT';
                        return objectToFormData(data)
                    }]
                })
                .then(()=>{

                    $('#edit-product-'+this.currentProduct.id).modal('hide');

                    Toast.fire({
                        icon: 'success',
                        title: 'Product Updated Successfully'
                    })

                    setTimeout(()=>{ 
                        window.location.reload();
                    },1000);

                })
                .catch(()=>{

                })
            }
        }
    }
</script>
