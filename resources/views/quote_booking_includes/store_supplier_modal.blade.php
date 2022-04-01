<div class="modal fade add-new-supplier-modal" id="store_supplier_modal" tabindex="-1" role="dialog"
    aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('response.suppliers.store') }}" method="POST" id="store_supplier_modal_form">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row-cols-lg-7 g-0 g-lg-2">
                        <input type="hidden" name="supplier_country_id" class="supplier-country-id" id="supplier_country_id" value="0">

                        <div class="form-group">
                            <label for="inputEmail3" class="">Supplier Name <span style="color:red">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Supplier Name" value="{{ old('username') }}">
                            <span class="text-danger" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="">Email <span style="color:red">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            <span class="text-danger" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="">Categories <span style="color:red">*</span></label>
                            <select name="categories[]" id="categories" class="form-control select2-multiple" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories') ?? []) ? 'selected' : '' }}> {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label>Country <span style="color:red">*</span></label>
                            <select name="country_id[]" id="country_id"
                                class="form-control select2-multiple getCountryToLocation" multiple="multiple">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ in_array($country->id, old('country_id') ?? []) ? 'selected' : '' }}> {{ $country->name }} </option>
                                @endforeach
                            </select>
                            <span class="text-danger" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label>Location <span style="color:red">*</span></label>
                            <select name="location_id[]" id="location_id" class="form-control select2-multiple location-id appendCountryLocation" multiple="multiple"></select>
                            <span class="text-danger" role="alert"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><span class=""></span> Submit </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
