<template>
        <div v-if="$can('delete products')">
            <button type="button" class="btn btn-danger btn-sm" @click="deleteProduct">
                <i class="fas fa-trash">
                </i>
            </button>
        </div>
</template>

<script>
    export default {
        props: ['shop', 'product'],

        mounted() {
            console.log('Retailer delete product Component mounted.')
        }, 
        data() {
            return {
                form: new Form({}),
                productToDelete: this.product,
                productToDeleteShop: this.shop,
            }
        },
        methods: {
            deleteProduct(){
                
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        
                        this.form.delete('/dashboard/retailer/shops/'+this.productToDeleteShop.slug+'/products/'+this.productToDelete.id).then(()=>{

                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your product has been deleted.',
                                'success'
                            ).then((result) => {
                                if(result.value || !result.value) {window.location.reload();}
                            })
                            

                        }).catch(()=> {
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href>Why do I have this issue?</a>'
                            })

                        });

                        
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your product has not been Deleted :)',
                            'error'
                        )
                    }
                })

                    
            },
        }
    }
</script>
