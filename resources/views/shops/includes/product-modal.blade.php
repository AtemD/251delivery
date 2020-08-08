<div class="modal fade" id="product-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$product->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$product->description}}
            </div>
            <div class="modal-footer">
                <div class="container pl-1 pr-1">
                    <div class="row no-gutters">
                        <div class="col-5 justify-content-start">
                            <td class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-danger btn-sm">-</button>
                                    <strong class="mx-1"> 1 </strong> 
                                <button type="button" class="btn btn-outline-success btn-sm">+</button>
                            </td>
                        </div>
                        <div class="col-7">
                            <button type="button" class="btn btn-primary btn-block">Add for ETB {{$product->price}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>