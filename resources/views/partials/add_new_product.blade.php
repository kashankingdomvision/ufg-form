<div class="modal fade add-new-product-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('add.product.with.supplier.sync') }}"  method="POST"  id="form_add_product">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Add New Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row-cols-lg-7 g-0 g-lg-2">
                        <input type="hidden" name="product_supplier_id" class="product-supplier-id">

                        <div class="form-group">
                            <label>Product Code <span style="color:red">*</span></label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Product Code">
                            <span class="text-danger" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label>Product Name <span style="color:red">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Product Name" >
                            <span class="text-danger" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control summernote"></textarea>
                            <span class="text-danger" role="alert"></span>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"  id="submit_add_product">
                        <span class="mr-2 " role="status" aria-hidden="true"></span>
                        Submit
                      </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
