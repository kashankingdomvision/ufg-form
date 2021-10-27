<div class="modal fade add-new-product-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('bookings.credit-note') }}"  method="POST"  id="create_credit_note">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title">Add New Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <section class="credit-note-section">
                        <div class="credit-note-row else-here row-cols-lg-7 g-0 g-lg-2">
                            <input type="text" name="product_supplier_id" class="product-supplier-id" value="">

                            <div class="form-group">
                                <label>Product Code <span style="color:red">*</span></label>
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="Product Code" required>
                                <span class="text-danger" role="alert"></span>
                            </div>

                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" >
                                <span class="text-danger" role="alert"></span>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"  class="form-control summernote">{{ old('description') }}</textarea>
                                <span class="text-danger" role="alert"></span>
                            </div>

                        </div>
                    </section>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary loader_icon" type="submit">
                      <span class="mr-2" role="status" aria-hidden="true"></span>
                      Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
