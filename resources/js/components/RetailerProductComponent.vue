<template>
            <tr>
                <td>{{product.name}}</td>
                <td>
                    <img class="img-fluid mb-3" style="height: 50px; width:80px;" :src="product.image_path" alt="Photo">    
                </td>
                <td>{{product.price}} ETB</td>
                <td>{{product.short_description }}...</td>
                <td>{{product.section.name}}</td>

                <td class="project-actions">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="'#edit-product">
                        <i class="fas fa-pencil-alt">
                        </i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash">
                        </i>
                    </button>
                </td>
            </tr>
</template>

<script>
    export default {
        props: ['product'],

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
