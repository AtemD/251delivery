<template>
        <div v-if="$can('delete shops')">
            <button type="button" class="btn btn-danger btn-sm" @click="deleteShop">
                <i class="fas fa-trash">
                </i>
            </button>
        </div>
</template>

<script>
    export default {
        props: ['shop'],

        mounted() {
            console.log('Retailer delete shop Component mounted.')
        }, 
        data() {
            return {
                form: new Form({}),
                shopToDelete: this.shop,
            }
        },
        methods: {
            deleteShop(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

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

                        this.form.delete('/dashboard/retailer/shops/'+this.shopToDelete.slug).then(()=>{

                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your shop has been deleted.',
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
                            'Your shop and its contents are safe :)',
                            'error'
                        )
                    }
                })

                    
            },
        }
    }
</script>
