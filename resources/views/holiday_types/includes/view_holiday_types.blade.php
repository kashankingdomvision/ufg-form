<div class="row">
    <div class="table-responsive table-wrap" >
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th class="text-center" width="50%">Holiday Type</th>
                    <th class="text-center" width="50%">Brand</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($new_holiday_types as $key => $item)
                    <tr>
                        <td>
                            <input type="hidden" name="holiday_types[{{$key}}][name]" value="{{ $item }}">
                            {{$item}}
                        </td>
                        <td>
                            <div class="form-group">
                                <div>
                                    <select name="holiday_types[{{$key}}][brand_id]" id="holiday_types_{{$key}}_brand_id" class="form-control select2single">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}"> {{$brand->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger" role="alert"></span>
                            </div> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>