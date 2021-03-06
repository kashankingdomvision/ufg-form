$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------------
    */

    function createElm(quote, selector, type, obj, key) {

        let inputTypes = ['text', 'textarea', 'number', 'select', 'autocomplete'];

        var appendHTML = '';

        if (obj.type == 'radio-group') {

            var radioBtnElementParent = document.createElement("div");
            if (obj.inline) {
                radioBtnElementParent.setAttribute('class', 'd-flex row');
            }

            //Create and append the options
            for (let i = 0; i < obj.values.length; i++) {

                let radioBtnDiv = document.createElement("div");
                radioBtnDiv.setAttribute('class', 'mr-1 cat-details-radio-btn-parent');

                let radioBtn = document.createElement("input")
                radioBtn.setAttribute("type", "radio");
                radioBtn.setAttribute("name", obj.name);
                radioBtn.setAttribute("id", removeSpace(obj.values[i].value));
                radioBtn.setAttribute("class", "cat-details-radio-btn");
                radioBtn.setAttribute("value", obj.values[i].value);
                if (obj.values[i].selected) {
                    radioBtn.setAttribute('checked', 'checked');
                }

                let label = document.createElement('label');
                label.innerHTML = `&nbsp; ${obj.values[i].label}`;
                label.setAttribute("for", removeSpace(obj.values[i].value));

                radioBtnDiv.appendChild(radioBtn);
                radioBtnDiv.appendChild(label);

                radioBtnElementParent.appendChild(radioBtnDiv);
            }

            appendHTML = createParentDivOfElm(radioBtnElementParent, type, obj);
        }

        if (obj.type == 'checkbox-group') {

            var checkboxElementParent = document.createElement("div");
            if (obj.inline) {
                checkboxElementParent.setAttribute('class', 'd-flex');
            }

            //Create and append the options
            for (let i = 0; i < obj.values.length; i++) {

                let checkboxDiv = document.createElement("div");
                checkboxDiv.setAttribute('class', 'mr-1 cat-details-checkbox-parent');

                let checkbox = document.createElement("input")
                checkbox.setAttribute("type", "checkbox");
                checkbox.setAttribute("name", obj.values[i].value);
                checkbox.setAttribute("id", removeSpace(obj.values[i].value));
                checkbox.setAttribute("class", "cat-details-checkbox");
                checkbox.setAttribute("value", obj.values[i].value);
                if (obj.values[i].selected) {
                    checkbox.setAttribute('checked', 'checked');
                }

                let label = document.createElement('label');
                label.innerHTML = `&nbsp; ${obj.values[i].label}`;
                label.setAttribute("for", removeSpace(obj.values[i].value));

                checkboxDiv.appendChild(checkbox);
                checkboxDiv.appendChild(label);

                checkboxElementParent.appendChild(checkboxDiv);
            }

            appendHTML = createParentDivOfElm(checkboxElementParent, type, obj);
        }

        if (inputTypes.includes(obj.type)) {

            let element = '';

            if (['text', 'number'].includes(obj.type))
                element = 'input';

            else if (['autocomplete', 'select'].includes(obj.type))
                element = 'select';

            else
                element = obj.type;

            let elm = document.createElement(element);

            // Set attributes
            if (obj.type == 'text'){
                elm.setAttribute('type', 'text');
                var selectedValue = obj.value;
            }

            if (obj.type == 'number')
                elm.setAttribute('type', 'number');

            if (obj.type == 'textarea')
                elm.setAttribute('rows', '1');

            elm.setAttribute('name', obj.name);
            elm.setAttribute('data-title_name', `badge-${(obj.label).trim().toLowerCase().replace(/ /g,"-")}`);

            if (obj.placeholder != undefined) {
                elm.setAttribute('placeholder', obj.placeholder);
            }

            if (obj.className != undefined && type == 'category_details') {
                elm.setAttribute('class', obj.className + ' cat-details-feild');
            }

            if (obj.className != undefined && type == 'product_details') {
                elm.setAttribute('class', obj.className + ' prod-details-feild');
            }

            if (obj.className != undefined && ['select', 'autocomplete'].includes(obj.type) && type == 'category_details') {
                elm.setAttribute('class', obj.className + ' select2single cat-details-select');
            }

            if (obj.className != undefined && ['select', 'autocomplete'].includes(obj.type) && type == 'product_details') {
                elm.setAttribute('class', obj.className + ' select2single prod-details-select');
            }

            if (obj.required != undefined && obj.required) {
                elm.setAttribute('required', true);
            }

            // set value for text and textarea
            if (obj.value != undefined && ['text', 'textarea', 'number'].includes(obj.type)) {
                elm.setAttribute('value', obj.value);
            }

            // set value for textarea
            if (obj.value != undefined && ['textarea'].includes(obj.type)) {
                elm.innerHTML = obj.value;
            }

            // add options to selectbox
            else if (['select', 'autocomplete'].includes(obj.type)) {

                let option = document.createElement("option");
                option.value = "";
                option.text = `Select ${obj.label}`;
                elm.appendChild(option);

                //Create and append the options
                for (let i = 0; i < obj.values.length; i++) {

                    let option = document.createElement("option");

                    option.value = obj.values[i].label;
                    option.text = obj.values[i].value;

                    if (obj.values[i].selected) {
                        var selectedValue = obj.values[i].label;
                        option.setAttribute('selected', 'selected');
                    }

                    elm.appendChild(option);
                }
            }

            appendHTML = createParentDivOfElm(elm, type, obj, key);
        }

        quote.find(`.badge-${(obj.label).trim().toLowerCase().replace(/ /g,"-")}`).html(selectedValue);
        
        // quote.find('.supplier-id-feild').insertAfter(appendHTML);
        $(appendHTML).insertBefore(quote.find(selector));

        reinitializedSingleSelect2();
        // insElment.appendChild(div);
        // $(appendHTML).insertAfter(quote.find('.supplier-id-feild'));
    }

    function createParentDivOfElm(elem, type, obj, key) {

        var div = document.createElement('div');

        if (type == 'category_details')
            div.setAttribute('class', 'col-md-3 cat-feild-col');

        if (['category_details', 'product_details'].includes(type))
            div.setAttribute('data-key', key);

        if (type == 'product_details')
            div.setAttribute('class', 'col-md-3 prod-feild-col');

        let formGroup = document.createElement('div');
        formGroup.setAttribute('class', 'form-group');

        let label = document.createElement('label');
        label.innerHTML = `&nbsp; ${obj.label}`;
        formGroup.appendChild(label);

        // add plus icon 
        if(['select', 'autocomplete'].includes(obj.type) && ['airport_codes', 'harbours', 'hotels', 'cabin_types', 'stations'].includes(obj.data)){
    
            const dynamicClass = { 
                airport_codes: "store-airport-code-modal",
                harbours: "store-harbour-modal",
                hotels: "store-hotel-modal",
                // group_owners: "group-owner-modal",
                cabin_types: "cabin-type-modal",
                stations: "station-modal",
            };

            const modalID = {
                airport_codes: "store_airport_code_modal",
                harbours: "store_harbour_modal",
                hotels: "store_hotel_modal",
                // group_owners: "store_group_owner_modal",
                cabin_types: "store_cabin_type_modal",
                stations: "store_station_modal",
            };

            let icon = document.createElement('i');
            icon.setAttribute('class', 'fas fa-plus');

            let button = document.createElement('button');
            button.setAttribute('type', 'button');
            button.setAttribute('class', `btn btn-xs btn-outline-dark ml-1 ${dynamicClass[obj.data]}`);
            button.setAttribute('data-modal_ID', `${modalID[obj.data]}`);

            button.appendChild(icon);
            formGroup.appendChild(button);
        }

        formGroup.appendChild(elem);
        div.appendChild(formGroup);

        return div;
    }

    function createAllElm(quote, selector, type, obj) {

        obj.forEach(function (item, index) {
            createElm(quote, selector, type, item, index);
        });
        
    }



    $(".quote").each(function () {

        var quote = $(this);
        var quoteKey = quote.attr('data-key');
        var categoryFormData = $(`#quote_${quoteKey}_category_details`).val();
        var productFormData = $(`#quote_${quoteKey}_product_details`).val();

        if (categoryFormData != '' && typeof categoryFormData != 'undefined') {
            createAllElm(quote, '.product-id-feild', 'category_details', JSON.parse(categoryFormData));
        }

        if (productFormData != '' && typeof productFormData != 'undefined') {
            createAllElm(quote, '.payment-type-feild', 'product_details', JSON.parse(productFormData));
        }

    });

    /* Expand Collapse Script */
    $(document).on('click', '.expand-collapse-quote-detail-cards', function (event) {

        let BtnText = $(this).text();
        let status = $(this).data('status');

        if (!status) {

            $(this).data('status', true);
            $('#parent .quote').removeClass('collapsed-card');
            $('#parent .card-body').css("display", "block");
            $('#parent .collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
            BtnText = `Collapse All &nbsp; <i class="fas fa-minus"></i>`;

        } else {

            $(this).data('status', false);
            $('#parent .quote').addClass('collapsed-card');
            $('#parent .card-body').css("display", "none");
            $('#parent .collapse-expand-btn').html(`<i class="fas fa-plus"></i>`);
            BtnText = `Expand All &nbsp; <i class="fas fa-plus"></i>`;
        }

        $(this).html(`${BtnText}`);
        // $(".collapse-expand-btn").trigger("click");
    });
    /* End Expand Collapse Script */

    /*
    |--------------------------------------------------------------------------------
    | Other Functions
    |--------------------------------------------------------------------------------
    */

    $(document).on('click', '.add-new-service-below', function (e) {

        var quote = $(this).closest('.quote').data('key');

        jQuery('#new_service_modal_below').modal('show');
        jQuery('#new_service_modal_below').find('.current-key').val(quote);
    });

    $(document).on('change', '.time-of-service', function () {
        var quote = $(this).closest('.quote');
        quote.find('.badge-time-of-service').html($(this).val());
        quote.find('.badge-time-of-service').removeClass('d-none');
    });

    $(document).on('change', '.date-of-service', function () {
        var DepartureDate = $('.quote:first').find('.date-of-service').val();
        $('#quote_departure_date').val(DepartureDate).datepicker('setDate');

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var DateOFService = $(`#quote_${quoteKey}_date_of_service`).val();
        var EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        var nowDate = todayDate();

        var category_enddateofservice = $(`#quote_${quoteKey}_category_id`).find(':selected').attr('data-enddateofservice');

        /* Set Badge in Card Header*/
        quote.find('.badge-date-of-service').html($(this).val());
        quote.find('.badge-date-of-service').removeClass('d-none');

        if(convertDate(DateOFService) != null)
        {
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setStartDate", DateOFService);
        }

        if (convertDate(DateOFService) < convertDate(nowDate)) {

            Toast.fire({
                icon: 'warning',
                title: 'Please Select Valid Date, Selected Date is already Passed.'
            });
        
            $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        }

        if (category_enddateofservice == 1) {
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", DateOFService);
            EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        }

        if ((convertDate(EndDateOFService) < convertDate(DateOFService)) && category_enddateofservice != 1) {
            
            Toast.fire({
                icon: 'warning',
                title: 'Please Select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.'
            });

            $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('')
        } else {

            var number = convertDate(EndDateOFService) - convertDate(DateOFService);
            var days = Math.ceil(number / (1000 * 3600 * 24));

            $(`#quote_${quoteKey}_number_of_nights`).val(checkForInt(days));
        }

    });

    $(document).on('change', '.end-date-of-service', function () {
        var ReturnDate = $('.quote:last').find('.end-date-of-service').val();
        $('#quote_return_date').val(ReturnDate).datepicker('setDate');

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var DateOFService = $(`#quote_${quoteKey}_date_of_service`).val();
        var EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        var nowDate = todayDate();

        var category_enddateofservice = $(`#quote_${quoteKey}_category_id`).find(':selected').attr('data-enddateofservice');

        quote.find('.badge-end-date-of-service').html($(this).val());

        if (convertDate(EndDateOFService) < convertDate(nowDate)) {

            Toast.fire({
                icon: 'warning',
                title: 'Please Select Valid Date, Selected Date is already Passed.'
            });

            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        }
        if ((convertDate(EndDateOFService) < convertDate(DateOFService)) && category_enddateofservice != 1) {

            Toast.fire({
                icon: 'warning',
                title: 'Please Select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.'
            });

            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        } else {

            var number = convertDate(EndDateOFService) - convertDate(DateOFService);
            var days = Math.ceil(number / (1000 * 3600 * 24));

            $(`#quote_${quoteKey}_number_of_nights`).val(checkForInt(days));
        }

    });

    $(document).on('keyup', '.cat-details-feild', function (e) {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var formData = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex = $(this).parents('.cat-feild-col').data('key');
        var labelName   = $(this).data('title_name');
        var selectedValue = $(this).val();


        formData[feildIndex].userData = [$(this).val()];
        formData[feildIndex].value = $(this).val();

        quote.find(`#quote_${quoteKey}_category_details`).val(JSON.stringify(formData));
        quote.find(`.${labelName}`).html(selectedValue);
    });


    $(document).on('change', '.cat-details-select', function (e) {

        var quote = $(this).closest('.quote');
        var quoteKey    = quote.data('key');
        var formData    = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex  = $(this).parents('.cat-feild-col').data('key');
        var optionIndex = $(this).find(":selected").index();
        var labelName   = $(this).data('title_name');
        let obj         = formData[feildIndex];

        var selectedValue = $(this).find(":selected").val();

        if (['select', 'autocomplete'].includes(obj.type)) {
            obj.values.map(function (obj) {
                obj.selected = false;
                return obj;
            });
        }

        formData[feildIndex].values[optionIndex].selected = true;
        quote.find(`#quote_${quoteKey}_category_details`).val(JSON.stringify(formData));

        quote.find(`.${labelName}`).html(selectedValue);
    });

    $(document).on('change', '.cat-details-checkbox', function (e) {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var formData = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex = $(this).parents('.cat-feild-col').index();
        var optionIndex = $(this).parents('.cat-details-checkbox-parent').index();
        formData[feildIndex].values[optionIndex].selected = true;

        quote.find(`#quote_${quoteKey}_category_details`).val(JSON.stringify(formData));
    });

    $(document).on('change', '.cat-details-radio-btn', function (e) {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var formData = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex = $(this).parents('.cat-feild-col').index();
        var optionIndex = $(this).parents('.cat-details-radio-btn-parent').index();

        var formData = formData.map(function (obj) {
            if (obj.type == 'radio-group') {
                obj.values.map(function (obj) {
                    obj.selected = false;
                    return obj;
                });
            }

            return obj;
        });

        formData[feildIndex].values[optionIndex].selected = true;


        quote.find(`#quote_${quoteKey}_category_details`).val(JSON.stringify(formData));
    });

    $(document).on('change', '.category-id', function () {

        var quote         = $(this).closest('.quote');
        var quoteKey      = quote.data('key');

        var detail_id     = $(`#quote_${quoteKey}_detail_id`).val();
        var model_name    = $(`#model_name`).val();

        var category_id          = $(this).val();
        var category_name        = $(this).find(':selected').attr('data-name');
        var category_slug        = $(this).find(':selected').attr('data-slug');
        var supplier_country_ids = $(`#quote_${quoteKey}_supplier_country_ids`).val();
        var options = '';
        var formData = '';

        // remove already appended feild
        quote.find('.cat-feild-col').remove();

        /* remove & reset supplier location attribute when category selected */
        if (typeof category_id === 'undefined' || category_id == "") {

            quote.find('.badge-category-id').html("");

            // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');
            // $(`#quote_${quoteKey}_supplier_location_id`).attr('disabled', 'disabled');

            $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
            // $(`#quote_${quoteKey}_supplier_id`).attr('disabled', 'disabled');

            $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            // $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');
            
            quote.find('.show-tf').addClass('d-none');
            quote.find('.group-owner-feild').addClass('d-none');
            
            return;
        } else {

            // $(`#quote_${quoteKey}_supplier_location_id`).removeAttr('disabled');
            // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');

            $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');
            quote.find('.badge-category-id').html(category_name);

            getCatSetLabel(quote, category_slug);
        }

        // set Payment type (Booking Type) refundable when category is fligt
        if (category_slug == 'flights') {
            let refundable = $(`#quote_${quoteKey}_booking_type_id`).find("option[data-slug='refundable']").val();
            $(`#quote_${quoteKey}_booking_type_id`).val(refundable).trigger('change');
        } else {
            $(`#quote_${quoteKey}_booking_type_id`).val('').change();
        }

        if (category_slug == 'cruise') {
            quote.find('.group-owner-feild').removeClass('d-none');
        } else {
            
            quote.find('.group-owner-feild').addClass('d-none');
        }

        if (category_slug == 'tours') {
            quote.find('.tour-feilds').removeClass('d-none');
        } else {
            
            quote.find('.tour-feilds').addClass('d-none');
        }


        $.ajax({
            type: 'get',
            url: `${BASEURL}category-on-change`,
            data: { 
                'category_id': category_id, 
                'detail_id': detail_id, 
                'model_name': model_name,
                'supplier_country_ids': supplier_country_ids
            },
            success: function (response) {


                if(response && response.suppliers.length > 0){

                    options += "<option value=''>Select Supplier</option>";

                    $.each(response.suppliers, function(key, value) {
                        options += `<option data-name="${value.name}" value="${value.id}"> ${value.name} </option>`;
                    });
                    
                    $(`#quote_${quoteKey}_supplier_id`).html(options);

                }else{
                    options = "<option value=''>Select Supplier</option>";
                }

                $(`#quote_${quoteKey}_supplier_id`).html(options);


                if (response.category_details != '' && response.category_details != 'undefined') {

                    $(`#quote_${quoteKey}_category_details`).val(response.category_details);


                    createAllElm(quote, '.product-id-feild', 'category_details', JSON.parse(response.category_details));
                }

                // Hide & Show Category details btn according to status
                if ((response.category != "") && (typeof response.category !== 'undefined')) {

                    if (response.category.show_tf == 1) {

                        quote.find('.show-tf').removeClass('d-none');
                        quote.find('.show-tf .form-group .label-of-time-label').html(response.category.label_of_time);
                    }
                    else {
                        quote.find('.show-tf').addClass('d-none');
                    }

                    if (response.category.second_tf == 1) {

                        quote.find('.second-tf').removeClass('d-none');
                        quote.find('.second-tf .form-group .second-label-of-time').html(response.category.second_label_of_time);
                    }
                    else {
                        quote.find('.second-tf').addClass('d-none');
                    }

                    if (response.category.set_end_date_of_service == 1) {
                        var DateOFService = $(`#quote_${quoteKey}_date_of_service`).val();
                        $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", DateOFService);
                    }
                    
                }
            }
        });

    });

    function getCatSetLabel(quote ,category_slug){

        if(category_slug != 'transfer'){
            quote.find('.badge-pick-up-location').html('');
            quote.find('.badge-drop-off-location').html('');
        }

        if(category_slug != 'accommodation'){
            quote.find('.badge-room-type').html('');
        }

        if(category_slug != 'cruise'){
            quote.find('.badge-group-owner-id').html('');
        }

        if(category_slug != 'flights'){
            quote.find('.badge-departure-airport').html('');
            quote.find('.badge-arrival-airport').html('');
        }

        if(category_slug != 'ferry-catamaran'){
            quote.find('.badge-departure-harbour').html('');
            quote.find('.badge-arrival-harbour').html('');
        }

        if(category_slug != 'misc'){
            quote.find('.badge-misc-details').html('');
        }

        if(category_slug != 'train'){
            quote.find('.badge-departure-station').html('');
            quote.find('.badge-arrival-station').html('');
        }

    }

    $(document).on('change', '.group-owner-id', function () {

        let quote          = $(this).closest('.quote');
        let quoteKey       = quote.data('key');
        var group_owner_name = $(this).find(':selected').data('name');
        var group_owner_id   = $(this).val();

        var supplier_country_ids = $(`#quote_${quoteKey}_supplier_country_ids`).val();
        var category_id          = $(`#quote_${quoteKey}_category_id`).val();
        
        let selectOption  = "<option value=''>Select Supplier</option>";
        let options       = "";

        quote.find('.badge-group-owner-id').html(group_owner_name);

        if(group_owner_id != ''){

            $.ajax({
                type: 'get',
                url: `${BASEURL}group-owner-on-change`,
                data: { 
                    'group_owner_id': group_owner_id,
                    'supplier_country_ids': supplier_country_ids,
                    'category_id': category_id
                },
                beforeSend: function() {
                    $(`#quote_${quoteKey}_supplier_id`).html(selectOption);
                },
                success: function(response) {
    
                    if(response && response.suppliers.length > 0){
    
                        options += selectOption;
    
                        $.each(response.suppliers, function(key, value) {
                            options += `<option data-name="${value.name}" value="${value.id}"> ${value.name} </option>`;
                        });
                        
                    }else{
                        options = selectOption;
                    }
    
                    $(`#quote_${quoteKey}_supplier_id`).html(options);
                }
            });

        }
    });

    $(document).on('change', '.supplier-country-id', function () {

        let quote    = $(this).closest('.quote');
        let quoteKey = quote.data('key');

        var supplier_country_ids = $(`#quote_${quoteKey}_supplier_country_ids`).val();
        var category_id          = $(`#quote_${quoteKey}_category_id`).val();

        if(supplier_country_ids && supplier_country_ids.length > 0){
            getSuppliers(quoteKey, supplier_country_ids, category_id);
        
        }else{
            $(`#quote_${quoteKey}_supplier_id`).html("<option value=''>Select Supplier</option>");
        }
    });

    function getSuppliers(quoteKey, supplier_country_ids, category_id){

        let options       = "";
        let selectOption  = "<option value=''>Select Supplier</option>";

        $.ajax({
            type: 'get',
            url: `${BASEURL}supplier-countries-on-change`,
            data: {
                'supplier_country_ids': supplier_country_ids,
                'category_id': category_id,
            },
            beforeSend: function() {
                $(`#quote_${quoteKey}_supplier_id`).html(selectOption);
            },
            success: function(response) {

                if(response && response.suppliers.length > 0){

                    options += selectOption;

                    $.each(response.suppliers, function(key, value) {
                        options += `<option data-name="${value.name}" value="${value.id}"> ${value.name} </option>`;
                    });
                    
                }else{
                    options = selectOption;
                }

                $(`#quote_${quoteKey}_supplier_id`).html(options);
            }
        });
    }

    // $(document).on('change', '.supplier-location-id', function(){
        
    //     var quote                 = $(this).closest('.quote');
    //     var quoteKey              = quote.data('key');
    //     var suppplier_location_id = $(`#quote_${quoteKey}_supplier_location_id`).val();
    //     var category_id = $(`#quote_${quoteKey}_category_id`).val();
    //     var options = '';

    //     $(`#quote_${quoteKey}_supplier_id`).removeAttr('disabled');

    //     /* set supplier dropdown null when supplier location become null */
    //     if (typeof suppplier_location_id === 'undefined' || suppplier_location_id == "") {

    //         $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
    //         $(`#quote_${quoteKey}_supplier_id`).attr('disabled', 'disabled');

    //         $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
    //         $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');

    //         return;
    //     }

    //     /* get suppliers according to location */
    //     $.ajax({
    //         type: 'get',
    //         url: `${BASEURL}location/to/supplier`,
    //         data: { 'suppplier_location_id': suppplier_location_id, 'category_id': category_id },
    //         beforeSend: function () {
    //             $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
    //         },
    //         success: function (response) {

    //             /* set supplier dropdown*/
    //             options += `<option value="">Select Supplier</option>`;
    //             $.each(response.suppliers, function (key, value) {
    //                 options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
    //             });
    //             $(`#quote_${quoteKey}_supplier_id`).html(options);

    //         }
    //     })

    // });

    $(document).on('change', '.supplier-id', function(){

        let quote        = $(this).closest('.quote');
        let quoteKey     = quote.data('key');
        let supplier_id  = $(this).val();
        let options      = "";
        let selectOption = "<option value=''>Select Product</option>";
        var supplier_name = $(this).find(':selected').data('name');
        
        if(supplier_id != ""){
            quote.find('.badge-supplier-id').html(supplier_name);

            $.ajax({
                type: 'get',
                url: `${BASEURL}supplier-on-change`,
                data: { 
                    'supplier_id': supplier_id
                },
                beforeSend: function() {
                    $(`#quote_${quoteKey}_product_id`).html(selectOption);
                },
                success: function(response) {
    
                    if(response && Object.keys(response.supplier).length > 0){

                        // $(`#quote_${quoteKey}_group_owner_id`).val(response.supplier.group_owner_id).change();
                        $(`#quote_${quoteKey}_supplier_currency_id`).val(response.supplier.currency_id).change();
                    }
                    
                    if(response && response.supplier_products.length > 0){
           
                        options += selectOption;
    
                        /* set product dropdown*/
                        $.each(response.supplier_products, function(key, value) {
                            options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
                        });
    
                        $(`#quote_${quoteKey}_product_id`).html(options);
                    }else{
                        $(`#quote_${quoteKey}_product_id`).html(selectOption);
                    }
                }
            });
        }else{
            
            quote.find('.badge-supplier-id').html("");
        }

    });



    
    $(document).on('submit', '#store_group_owner_modal_form', function() {

        event.preventDefault();

        let url     = $(this).attr('action');
        let formID  = $(this).attr('id');
        let modalID = $(this).closest('.modal').attr('id');
        options     = '';

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                removeFormValidationStyles();
                addModalFormLoadingStyles(`#${formID}`);
            },
            success: function (data) {

                removeModalFormLoadingStyles(`#${formID}`);

                setTimeout(function () {

                    if (data && data.status == true) {

                        $(`#${modalID}`).modal('hide');

                        if (data.group_owners.length != 0) {

                            options += "<option value=''>Select Group Owner</option>";
                            $.each(data.group_owners, function (key, value) {
                                options += `<option value='${value.id}' data-name='${value.name}'> ${value.name} </option>`;
                            });

                            $(`#quote_${quoteKeyForGroupOwner}_group_owner_id`).html(options);
                        }
                    }

                }, 200);
            },
            error: function (data) {
                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(data, `#${modalID}`);
            },
        });

    });

    $(document).on('change', '.getCountryToLocation', function () {

        var supplier_country_ids = $(this).val();
        var url = BASEURL + 'country/to/location';
        var options = '';

        $.ajax({
            type: 'get',
            url: url,
            data: { 'supplier_country_ids': supplier_country_ids },
            beforeSend: function () {
                $('.appendCountryLocation').html(options);
            },
            success: function (response) {

                $.each(response, function (key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.country_name}) </option>`;
                });

                $('.appendCountryLocation').html(options);
            }
        });

    });

    var quoteKeyForSupplier = '';
    $(document).on('click', '.add-new-supplier', function () {
        let quote = $(this).closest('.quote');
        let quoteKey = quote.data('key');
        quoteKeyForSupplier = quoteKey;

        var supplier_country_ids = $(`#quote_${quoteKey}_supplier_country_ids`).val();

        var modal  = jQuery('#store_supplier_modal');
        modal.modal('show');
        modal.find("#supplier_country_id").val(supplier_country_ids);
    });

    $(document).on('submit', '#store_supplier_modal_form', function (event) {
        event.preventDefault();

        var url     = $(this).attr('action');
        let formID  = $(this).attr('id');
        let modalID = $(this).closest('.modal').attr('id');
        var options = '';

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                removeFormValidationStyles();
                addModalFormLoadingStyles(`#${formID}`);
            },
            success: function (response) {
                removeModalFormLoadingStyles(`#${formID}`);

                $(`#${formID}`)[0].reset();
                $('#categories, #location_id, #country_id').val(null).trigger('change');
                $(`#${modalID}`).modal('hide');

                Toast.fire({
                    icon: 'success',
                    title: response.success_message
                });

                if (response.suppliers.length > 0) {

                    options += "<option value=''>Select Supplier</option>";
                    $.each(response.suppliers, function (key, value) {
                        options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
                    });

                    $(`#quote_${quoteKeyForSupplier}_supplier_id`).html(options);
                }

            },
            error: function (data) {
                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(data, `#${modalID}`);
            },
        });

    });

    var quoteKeyForProduct = '';
    $(document).on('click', '.store-product', function () {

        var quote          = $(this).closest('.quote');
        quoteKeyForProduct = quote.data('key');
        var supplier_id    = quote.find('.supplier-id').val();
        var modal          = jQuery('.store-product-modal');

        if (supplier_id != "" && typeof supplier_id !== 'undefined'){

            modal.modal('show');

            // reset modal feilds
            resetModalForm('#store_product_modal_form');

            // set supplier id
            modal.find('.product-supplier-id').val(supplier_id);

        } else {
            alert("Please select Supplier first");
            return;
        }
    });

    $(document).on('submit', '#store_product_modal_form', function(event) {

        event.preventDefault();

        var url      = $(this).attr('action');
        let formID   = $(this).attr('id');
        let modalID  = $(this).closest('.modal').attr('id');
        let options  = '';

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                removeFormValidationStyles();
                addModalFormLoadingStyles(`#${formID}`);
            },
            success: function (data) {

                removeModalFormLoadingStyles(`#${formID}`);
                jQuery('.store-product-modal').modal('hide');

                setTimeout(function () {
                    if (data && data.status) {

                        Toast.fire({
                            icon: 'success',
                            title: data.success_message
                        });

                        if (data.products.length != 0) {

                            options += "<option value=''>Select Product</option>";
                            $.each(data.products, function (key, value) {
                                options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
                            });

                            $(`#quote_${quoteKeyForProduct}_product_id`).html(options);
                        }
                    }

                }, 200);
            },
            error: function (data) {
                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(data, `#${modalID}`);
            },
        });
    });


    var quoteKeyForGroupOwner = '';
    $(document).on('click', '.group-owner-modal', function () {

        var quote             = $(this).closest('.quote');
        quoteKeyForGroupOwner = quote.data('key');
        var modal             = jQuery('#store_group_owner_modal');

        modal.modal('show');
    });
 
    var quoteKeyForCategoryFeildModal = '';
    var quoteForCategoryFeildModal = '';

    $(document).on('click', '.store-harbour-modal, .store-airport-code-modal, .store-hotel-modal, .cabin-type-modal, .station-modal', function () {


        let quote = $(this).closest('.quote');
        let quoteKey = quote.data('key');

        quoteKeyForCategoryFeildModal = quoteKey;
        quoteForCategoryFeildModal = quote;

        let modal_id = $(this).data('modal_id');
        let modal = $(`#${modal_id}`);

        console.log(modal_id);


        let detail_id = $(`#quote_${quoteKey}_detail_id`).val();
        let category_id = $(`#quote_${quoteKey}_category_id`).val();
        let model_name = $(`#model_name`).val();

        modal.modal('show');
        modal.find("input[name=category_id]").val(category_id);
        modal.find("input[name=detail_id]").val(detail_id);
        modal.find("input[name=model_name]").val(model_name);
    });

    $(document).on('submit', '#store_harbour_modal_form, #store_airport_code_modal_form, #store_hotel_modal_form, #store_cabin_type_modal_form, #store_station_modal_form', function (event) {

        event.preventDefault();

        let url = $(this).attr('action');
        let formID = $(this).attr('id');
        let modalID = $(this).closest('.modal').attr('id');

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                removeFormValidationStyles();
                addModalFormLoadingStyles(`#${formID}`);
            },
            success: function (response) {

                removeModalFormLoadingStyles(`#${formID}`);

                if (response.status) {

                    $(`#${formID}`)[0].reset();

                    $(`#${modalID}`).modal('hide');

                    Toast.fire({
                        icon: 'success',
                        title: response.success_message
                    });

                    if (response.category_details != '' && response.category_details != 'undefined') {

                        $(`.quote-${quoteKeyForCategoryFeildModal} .cat-feild-col`).remove();
                        $(`#quote_${quoteKeyForCategoryFeildModal}_category_details`).val(response.category_details);

                        createAllElm(quoteForCategoryFeildModal, '.product-id-feild', 'category_details', JSON.parse(response.category_details));
                    }
                }

                // printModalServerSuccessMessage(response, "#store_harbour_modal");
            },
            error: function (response) {
                removeModalFormLoadingStyles(`#${formID}`);
                printModalServerValidationErrors(response, `#${modalID}`);
            }
        });
    });

    $(document).on('change', '.product-id', function () {
        
        var quote        = $(this).closest('.quote');
        var quoteKey     = quote.data('key');
        var product_name = $(this).find(':selected').attr('data-name');
        var product_id   = $(this).val();
        var detail_id    = $(`#quote_${quoteKey}_detail_id`).val();
        var model_name   = $(`#model_name`).val();

        quote.find('.prod-feild-col').remove();
        quote.find('.badge-product-id').html(product_name);
        quote.find('.badge-product-id').removeClass('d-none');

        if (typeof product_name === 'undefined' || product_name == '') {
            quote.find('.badge-product-id').html('');
            $(`#quote_${quoteKey}_booking_type_id`).val("").change();
            return;
        }

        $.ajax({
            type: 'get',
            url: `${BASEURL}product-on-change`,
            data: {
                'product_id': product_id,
                'detail_id': detail_id,
                'model_name': model_name
            },
            success: function (response) {

                if (response.product != null && response.product.booking_type_id != null) {
                    $(`#quote_${quoteKey}_booking_type_id`).val(response.product.booking_type_id).change();
                }

                if (response.product_details != '' && response.product_details != 'undefined') {

                    $(`#quote_${quoteKey}_product_details`).val(response.product_details);
                    createAllElm(quote, '.payment-type-feild', 'product_details', JSON.parse(response.product_details));
                }

            }
        });
    });

    $(document).on('keyup', '.prod-details-feild', function (e) {

        var quote      = $(this).closest('.quote');
        var quoteKey   = quote.data('key');
        var formData   = JSON.parse($(`#quote_${quoteKey}_product_details`).val());
        var feildIndex = $(this).parents('.prod-feild-col').data('key');

        formData[feildIndex].userData = [$(this).val()];
        formData[feildIndex].value    = $(this).val();

        quote.find(`#quote_${quoteKey}_product_details`).val(JSON.stringify(formData));

    });

    $(document).on('change', '.prod-details-select', function (e) {

        var quote = $(this).closest('.quote');
        var quoteKey = quote.data('key');
        var formData = JSON.parse($(`#quote_${quoteKey}_product_details`).val());
        var feildIndex = $(this).parents('.prod-feild-col').index();
        var optionIndex = $(this).find(":selected").index();
        // formData[feildIndex].values[optionIndex].selected = true;

        var formData = formData.map(function (obj) {
            if (obj.type == 'select' || obj.type == 'autocomplete') {
                obj.values.map(function (obj) {
                    obj.selected = false;
                    return obj;
                });
            }
            return obj;
        });

        formData[feildIndex].values[optionIndex].selected = true;

        quote.find(`#quote_${quoteKey}_product_details`).val(JSON.stringify(formData));
    });

    $(document).on('change', '.booking-type-id', function () {

        var quote = $(this).closest('.quote');
        var booking_type = $(this).val();
        var booking_slug = $(this).find(':selected').data('slug');

        if (booking_type == 2 || booking_slug == 'partially-refundable') {

            quote.find('.refundable-percentage-feild').removeClass('d-none');
        } else {

            quote.find('.refundable-percentage-feild').addClass('d-none');
        }

    });

    var quoteKeyForComment = '';
    $(document).on('click', '.insert-quick-text', function () {

        var quote = $(this).closest('.quote');
        quoteKeyForComment = quote.data('key');
        var modal = jQuery('.insert-quick-text-modal');
        modal.modal('show');
    });

    $(document).on('click', '#insert_quick_text_confirm_btn', function () {

        var quickText = $(".quick-comment:checked").val();
        $(".quick-comment").prop('checked', false);
        jQuery('.insert-quick-text-modal').modal('hide');
        $(`#quote_${quoteKeyForComment}_comments`).val(quickText);
    });

});


/* set product dropdown */
// if(response && response.products.length > 0){

//     options += "<option value=''>Select Product</option>";
//     $.each(response.products, function(key, value) {
//         options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
//     });

//     $(`#quote_${quoteKey}_product_id`).html(options);
// }else{
//     $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
// }

// if (response.category.quote == 1) {
//     quote.find('.build-wrap-parent').removeClass('d-none').addClass('d-flex');
// } else {
//     quote.find('.build-wrap-parent').removeClass('d-flex').addClass('d-none');
// }

// if (response.category.booking == 1) {
//     quote.find('.booking-category-detail-btn-parent').removeClass('d-none');
//     quote.find('.booking-category-detail-btn-parent').addClass('d-flex');
// } else {
//     quote.find('.booking-category-detail-btn-parent').removeClass('d-flex');
//     quote.find('.booking-category-detail-btn-parent').addClass('d-none');
// }




    // $(document).on('click', '.store-harbour-modal, .store-airport-code-modal, .store-hotel-modal, .group-owner-modal, .cabin-type-modal, .station-modal', function() {

    //     let quote = $(this).closest('.quote');
    //     let quoteKey = quote.data('key');
    //     quoteKeyForSupplier = quoteKey;

    //     quoteKeyForCategoryFeildModal = quoteKey;
    //     quoteForCategoryFeildModal = quote;

    //     let modal_id    = $(this).data('modal_id');
    //     let modal       = $(`#${modal_id}`);

    //     console.log(modal);

    //     let detail_id   = $(`#quote_${quoteKey}_detail_id`).val();
    //     let category_id = $(`#quote_${quoteKey}_category_id`).val();
    //     let model_name  = $(`#model_name`).val();

    // });

    // $(document).on('submit', '#store_harbour_modal_form, #store_airport_code_modal_form, #store_hotel_modal_form, #store_group_owner_modal_form, #store_cabin_type_modal_form, #store_station_modal_form', function(event) {
        
    //     event.preventDefault();

    //     var url     = $(this).attr('action');
    //     let formID  = $(this).attr('id');
    //     let modalID = $(this).closest('.modal').attr('id');
    //     var options = '';

    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         beforeSend: function () {
    //             removeFormValidationStyles();
    //             addModalFormLoadingStyles(`#${formID}`);
    //         },
    //         success: function (response) {
    //             removeModalFormLoadingStyles(`#${formID}`);

    //             $(`#${formID}`)[0].reset();
    //             $('#categories, #location_id, #country_id').val(null).trigger('change');
    //             $(`#${modalID}`).modal('hide');

    //             Toast.fire({
    //                 icon: 'success',
    //                 title: response.success_message
    //             });

    //             if (response.suppliers.length > 0) {

    //                 options += "<option value=''>Select Supplier</option>";
    //                 $.each(response.suppliers, function (key, value) {
    //                     options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
    //                 });

    //                 $(`#quote_${quoteKeyForSupplier}_supplier_id`).html(options);
    //             }

    //         },
    //         error: function (data) {
    //             removeModalFormLoadingStyles(`#${formID}`);
    //             printModalServerValidationErrors(data, `#${modalID}`);
    //         },
    //     });

    // });


    
    // formData[feildIndex].values[optionIndex].selected = true;

    // var formData = formData[feildIndex].map(function (obj) {

    // if (obj.type == 'select' || obj.type == 'autocomplete') {

    //     obj.values.map(function (obj) {
    //         obj.selected = false;
    //         return obj;
    //     });
    // }
    // return obj;
    // });
