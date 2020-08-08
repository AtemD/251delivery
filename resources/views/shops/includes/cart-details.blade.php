<div class="modal fade" id="cartDetail" tabindex="-1" role="dialog" aria-labelledby="cartDetailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartDetailLabel">Cart Contents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Dinish</th>
                                <td>30 ETB</td>
                                <td class="d-flex justify-content-end">
                                    <button @click="removeFromCart(cartItem)" type="button" class="btn btn-danger btn-sm">-</button>
                                        <strong class="mx-1"> 6 </strong> 
                                    <button @click="addToCart(cartItem)" type="button" class="btn btn-success btn-sm">+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Proceed to CheckOut</button>
            </div>
        </div>
    </div>
</div>