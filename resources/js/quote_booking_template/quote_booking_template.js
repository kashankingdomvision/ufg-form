$(document).ready(function() {

    $(document).on('change', '.booking-type-id', function() {

        var quote        = $(this).closest('.quote');
        var booking_type = $(this).val();
        var booking_slug = $(this).find(':selected').data('slug');

        if(booking_type == 2 || booking_slug == 'partially-refundable'){

            quote.find('.refundable-percentage-feild').removeClass('d-none');
        }else{

            quote.find('.refundable-percentage-feild').addClass('d-none');
        }

    });

      
    $(".quote").each(function(){
                
        var quote            = $(this);
        var quoteKey         = quote.attr('data-key');
        var categoryFormData = $(`#quote_${quoteKey}_category_details`).val();
        var productFormData  = $(`#quote_${quoteKey}_product_details`).val();

        if(categoryFormData != '' && typeof categoryFormData != 'undefined'){
            createAllElm( quote, '.category-details-render', 'category_details', JSON.parse(categoryFormData));
        }

        if(productFormData != '' && typeof productFormData != 'undefined'){
            createAllElm( quote, '.product-details-render', 'product_details', JSON.parse(productFormData));
        }

    });

    $(document).on('keyup', '.cat-details-feild', function(e) {

        var quote            = $(this).closest('.quote');
        var quoteKey         = quote.data('key');
        var formData         = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex       = $(this).parents('.cat-feild-col').index();

        formData[feildIndex].userData = [$(this).val()];
        formData[feildIndex].value    = $(this).val();

        quote.find(`#quote_${quoteKey}_category_details`).val( JSON.stringify(formData) );

        console.log(JSON.stringify(formData));
    });

    $(document).on('change', '.cat-details-select', function(e) {

        var quote       = $(this).closest('.quote');
        var quoteKey    = quote.data('key');
        var formData    = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex  = $(this).parents('.cat-feild-col').index();
        var optionIndex = $(this).find(":selected").index();
        // formData[feildIndex].values[optionIndex].selected = true;

        var formData = formData.map(function(obj) {
            if(obj.type == 'select' || obj.type == 'autocomplete'){
                obj.values.map(function(obj) {
                    obj.selected = false;
                    return obj;
                });
            }
            return obj;
        });

        formData[feildIndex].values[optionIndex].selected = true;

        quote.find(`#quote_${quoteKey}_category_details`).val( JSON.stringify(formData) );
    });

    $(document).on('change', '.cat-details-checkbox', function(e) {

        var quote       = $(this).closest('.quote');
        var quoteKey    = quote.data('key');

        var formData    = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex  = $(this).parents('.cat-feild-col').index();
        var optionIndex = $(this).parents('.cat-details-checkbox-parent').index();
        formData[feildIndex].values[optionIndex].selected = true;

        quote.find(`#quote_${quoteKey}_category_details`).val( JSON.stringify(formData) );
    });

    $(document).on('change', '.cat-details-radio-btn', function(e) {

        var quote       = $(this).closest('.quote');
        var quoteKey    = quote.data('key');

        var formData    = JSON.parse($(`#quote_${quoteKey}_category_details`).val());
        var feildIndex  = $(this).parents('.cat-feild-col').index();
        var optionIndex = $(this).parents('.cat-details-radio-btn-parent').index();

        var formData = formData.map(function(obj) {
            if(obj.type == 'radio-group'){
                obj.values.map(function(obj) {
                    obj.selected = false;
                    return obj;
                });
            }

            return obj;
        });

        formData[feildIndex].values[optionIndex].selected = true;


        quote.find(`#quote_${quoteKey}_category_details`).val( JSON.stringify(formData) );
    });

    $(document).on('keyup', '.prod-details-feild', function(e) {

        var quote            = $(this).closest('.quote');
        var quoteKey         = quote.data('key');
        var formData         = JSON.parse($(`#quote_${quoteKey}_product_details`).val());
        var feildIndex       = $(this).parents('.prod-feild-col').index();

        formData[feildIndex].userData = [$(this).val()];
        formData[feildIndex].value    = $(this).val();

        quote.find(`#quote_${quoteKey}_product_details`).val( JSON.stringify(formData) );

        console.log(JSON.stringify(formData));
    });

    $(document).on('change', '.prod-details-select', function(e) {

        var quote       = $(this).closest('.quote');
        var quoteKey    = quote.data('key');
        var formData    = JSON.parse($(`#quote_${quoteKey}_product_details`).val());
        var feildIndex  = $(this).parents('.prod-feild-col').index();
        var optionIndex = $(this).find(":selected").index();
        // formData[feildIndex].values[optionIndex].selected = true;

        var formData = formData.map(function(obj) {
            if(obj.type == 'select' || obj.type == 'autocomplete'){
                obj.values.map(function(obj) {
                    obj.selected = false;
                    return obj;
                });
            }
            return obj;
        });

        formData[feildIndex].values[optionIndex].selected = true;

        quote.find(`#quote_${quoteKey}_product_details`).val( JSON.stringify(formData) );
    });


    $(document).on('change', '.product-id', function() {
        var quote        = $(this).closest('.quote');
        var quoteKey     = quote.data('key');
        var product_name = $(this).find(':selected').attr('data-name');
        var product_id   = $(this).val();

        var detail_id         = $(`#quote_${quoteKey}_detail_id`).val();
        var model_name        = $(`#model_name`).val();

        quote.find('.prod-feild-col').remove();

        var formData = '';

        if(typeof product_name === 'undefined' || product_name == '') {
            quote.find('.badge-product-id').html('');
            $(`#quote_${quoteKey}_booking_type_id`).val("").change();
            return;
        }

        $.ajax({
            type: 'get',
            url: `${BASEURL}get-product-booking-type`,
            data: { 
                'product_id': product_id,
                'detail_id': detail_id,
                'model_name': model_name 
            },
            success: function(response) {

                // set category details feilds 
                if(response.product != null && response.product.booking_type_id != null) {
                    $(`#quote_${quoteKey}_booking_type_id`).val(response.product.booking_type_id).change();
                }

                if(response.product_details != '' && response.product_details != 'undefined'){

                    $(`#quote_${quoteKey}_product_details`).val(response.product_details);
                    createAllElm(quote, '.product-details-render', 'product_details', JSON.parse(response.product_details));
                }

            }
        });

        quote.find('.badge-product-id').html(product_name);
        quote.find('.badge-product-id').removeClass('d-none');
    });

    $(document).on('change', '.supplier-country-id', function(){

        var supplier_country_ids   = $(this).val();
        var url           = BASEURL + 'country/to/supplier';
        var options       = '';
        var selectOption  = "<option value=''>Select Supplier</option>";

        if(supplier_country_ids && supplier_country_ids.length > 0){
      
            $.ajax({
                type: 'get',
                url: url,
                data: { 'supplier_country_ids': supplier_country_ids },
                beforeSend: function() {
                    $('.supplier-id').html(options);
                },
                success: function(response) {

                    if(response && response.suppliers.length > 0){

                        options += selectOption;

                        $.each(response.suppliers, function(key, value) {
                            options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
                        });
                        
                    }else{
                        options = selectOption;
                    }
    

                    $('.supplier-id').html(options);
                }
            });
        }else{
            options = selectOption;
            $('.supplier-id').html(options);
        }

        
    });









    
    $(document).on('change', '.date-of-service', function() {
        var quote = $(this).closest('.quote');
        quote.find('.badge-date-of-service').html($(this).val());
        quote.find('.badge-date-of-service').removeClass('d-none');
    });

    $(document).on('change', '.time-of-service', function() {
        var quote = $(this).closest('.quote');
        quote.find('.badge-time-of-service').html($(this).val());
        quote.find('.badge-time-of-service').removeClass('d-none');
    });



    var quoteKeyForComment = '';
    $(document).on('click', '.insert-quick-text', function() {

        var quote           = $(this).closest('.quote');
        quoteKeyForComment  = quote.data('key');
        var modal           = jQuery('.insert-quick-text-modal');
        modal.modal('show');
    });

    $(document).on('click', '#insert_quick_text_confirm_btn', function() {

        var quickText = $(".quick-comment:checked").val();
        $(".quick-comment").prop('checked', false);
        jQuery('.insert-quick-text-modal').modal('hide');
        $(`#quote_${quoteKeyForComment}_comments`).val(quickText);
    });

    var quoteKeyForProduct = '';
    $(document).on('click', '.add-new-product', function() {

        var quote           = $(this).closest('.quote');
        quoteKeyForProduct  = quote.data('key');
        var supplier_id     = quote.find('.supplier-id').val();
        var modal           = jQuery('.add-new-product-modal');

        if((supplier_id != "") && (typeof supplier_id !== 'undefined')){

            modal.modal('show');

            // reset modal feilds
            $('#form_add_product').trigger("reset");
            modal.find('#form_add_product #description').summernote("reset");
            modal.find('#form_add_product #inclusions').summernote("reset");
            modal.find('#form_add_product #packing_list').summernote("reset");

            // set supplier id
            modal.find('.product-supplier-id').val(supplier_id);

        }else{
            alert("Please select Supplier first");
            return;
        }

    });

    $("#form_add_product").submit(function(event) {

        event.preventDefault();

        var url      = $(this).attr('action');
        var formData = $(this).serialize();
        var options  = '';

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            beforeSend: function() {
                $('input').removeClass('is-invalid');
                $('.text-danger').html('');
                $("#submit_add_product").find('span').addClass('spinner-border spinner-border-sm');
            },
            success: function(data) {
                $("#submit_add_product").find('span').removeClass('spinner-border spinner-border-sm');

                jQuery('.add-new-product-modal').modal('hide');

                setTimeout(function() {

                    if(data && data.status == true){
                        alert(data.success_message);

                        if(data.products.length != 0){
                        
                            options += "<option value=''>Select Product</option>";
                            $.each(data.products, function(key, value) {
                                options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
                            });

                            $(`#quote_${quoteKeyForProduct}_product_id`).html(options);
                        }
                    }


                }, 200);
            },
            error: function(reject) {
                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);

                    setTimeout(function() {

                        $("#submit_add_product").find('span').removeClass('spinner-border spinner-border-sm');

                        if (errors.hasOwnProperty("product_error")) {
                            alert(errors.product_error);

                        } else {

                            jQuery.each(errors.errors, function(index, value) {
                                index = index.replace(/\./g, '_');

                                $(`#${index}`).addClass('is-invalid');
                                $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                            });

                        }

                    }, 200);

                }
            },
        });

    });

    function createElm(quote, selector, type, obj ) {

        let inputTypes = [ 'text', 'textarea', 'number', 'select', 'autocomplete' ];
        var appendHTML = '';

        if(obj.type == 'radio-group'){

            var radioBtnElementParent = document.createElement("div");
            if(obj.inline){
                radioBtnElementParent.setAttribute('class', 'd-flex row');
            }
        
            //Create and append the options
            for (let i = 0; i < obj.values.length; i++) {
        
                let radioBtnDiv = document.createElement("div");
                radioBtnDiv.setAttribute('class', 'mr-1 cat-details-radio-btn-parent');
        
                let radioBtn   = document.createElement("input")
                radioBtn.setAttribute("type", "radio");
                radioBtn.setAttribute("name", obj.name);
                radioBtn.setAttribute("id", removeSpace(obj.values[i].value));
                radioBtn.setAttribute("class", "cat-details-radio-btn");
                radioBtn.setAttribute("value", obj.values[i].value);
                if(obj.values[i].selected){
                    radioBtn.setAttribute('checked','checked');
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

        if(obj.type == 'checkbox-group'){
            
            var checkboxElementParent = document.createElement("div");
            if(obj.inline){
                checkboxElementParent.setAttribute('class', 'd-flex');
            }

            //Create and append the options
            for (let i = 0; i < obj.values.length; i++) {

                let checkboxDiv = document.createElement("div");
                checkboxDiv.setAttribute('class', 'mr-1 cat-details-checkbox-parent');

                let checkbox   = document.createElement("input")
                checkbox.setAttribute("type", "checkbox");
                checkbox.setAttribute("name", obj.values[i].value);
                checkbox.setAttribute("id", removeSpace(obj.values[i].value));
                checkbox.setAttribute("class", "cat-details-checkbox");
                checkbox.setAttribute("value", obj.values[i].value);
                if(obj.values[i].selected){
                    checkbox.setAttribute('checked','checked');
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

        if(inputTypes.includes(obj.type)){

            let element     = '';

            if( [ 'text', 'number' ].includes(obj.type) )
                element = 'input';

            else if( [ 'autocomplete', 'select' ].includes(obj.type) )
                element = 'select';

            else
                element = obj.type;

            let elm = document.createElement(element);
        
            // Set attributes
            if(obj.type == 'text')
                elm.setAttribute('type', 'text');

            if(obj.type == 'number')
                elm.setAttribute('type', 'number');
            
            elm.setAttribute('name', obj.name);
        
            if( obj.placeholder != undefined ){
                elm.setAttribute('placeholder', obj.placeholder);
            }
        
            if( obj.className != undefined && type == 'category_details' ){
                elm.setAttribute('class', obj.className + ' cat-details-feild');
            }

            if( obj.className != undefined && type == 'product_details' ){
                elm.setAttribute('class', obj.className + ' prod-details-feild');
            }

            if(obj.className != undefined && obj.type == 'select' || obj.type == 'autocomplete' && type == 'category_details'){
                elm.setAttribute('class', obj.className + ' select2single cat-details-select');
            }

            if(obj.className != undefined && obj.type == 'select' || obj.type == 'autocomplete' && type == 'product_details'){
                elm.setAttribute('class', obj.className + ' select2single prod-details-select');
            }
        
            if( obj.required != undefined && obj.required ){
                elm.setAttribute('required', true);
            }
        
            // set value for text and textarea
            if( obj.value != undefined && ['text', 'textarea', 'number'].includes(obj.type) ) {
                elm.setAttribute('value', obj.value);
            }

            // set value for textarea
            if( obj.value != undefined && ['textarea'].includes(obj.type) ) {
                elm.innerHTML =  obj.value;
            }
        
            // add options to selectbox
            else if( obj.type == 'select' || obj.type == 'autocomplete' ) {
                //Create and append the options
                for (let i = 0; i < obj.values.length; i++) {
                    let option   = document.createElement("option");
                    option.value = obj.values[i].label;
                    option.text  = obj.values[i].value;

                    if(obj.values[i].selected){
                        option.setAttribute('selected','selected');
                    }

                    elm.appendChild(option);
                }
            }

            appendHTML = createParentDivOfElm(elm, type, obj);
        }

        quote.find(selector).append(appendHTML);

        reinitializedDynamicFeilds();
        // insElment.appendChild(div);
        // $(div).insertAfter(quote.find('.product-id-col'));
    }

    function createParentDivOfElm(elem, type, obj) {

        var div = document.createElement('div');

        if(type == 'category_details')
            div.setAttribute('class', 'col-md-3 cat-feild-col');

        if(type == 'product_details')
            div.setAttribute('class', 'col-md-3 prod-feild-col');

        let formGroup = document.createElement('div');
        formGroup.setAttribute('class', 'form-group');

        let label = document.createElement('label');
        label.innerHTML = `&nbsp; ${obj.label}`;

        formGroup.appendChild(label);
        formGroup.appendChild(elem);
        div.appendChild(formGroup);

        return div;
    }

    function createAllElm(location, selector, type, obj) {

        obj.forEach(function(item) {
            createElm(location, selector, type, item );
        });
    }

    $(document).on('change', '.category-id', function() {

        var quote             = $(this).closest('.quote');
        var quoteKey          = quote.data('key');

        var detail_id         = $(`#quote_${quoteKey}_detail_id`).val();
        var model_name        = $(`#model_name`).val();

        var category_id       = $(this).val();
        var category_name     = $(this).find(':selected').attr('data-name');
        var category_slug     = $(this).find(':selected').attr('data-slug');
        var options           = ''; 
        var formData          = '';
        
        // remove already appended feild
        quote.find('.cat-feild-col').remove();

        /* remove & reset supplier location attribute when category selected */
        if(typeof category_id === 'undefined' || category_id == ""){

            quote.find('.badge-category-id').html("");

            // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');
            // $(`#quote_${quoteKey}_supplier_location_id`).attr('disabled', 'disabled');

            $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
            $(`#quote_${quoteKey}_supplier_id`).attr('disabled', 'disabled');

            $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');
            
            $('.show-tf').addClass('d-none');

            return;
        }else{

            // $(`#quote_${quoteKey}_supplier_location_id`).removeAttr('disabled');
            // $(`#quote_${quoteKey}_supplier_location_id`).val("").trigger('change');

            $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');
            quote.find('.badge-category-id').html(category_name);
        }

        // set Payment type (Booking Type) refundable when category is fligt
        if(category_slug == 'flights'){
            let refundable = $(`#quote_${quoteKey}_booking_type_id`).find("option[data-slug='refundable']").val();
            $(`#quote_${quoteKey}_booking_type_id`).val(refundable).trigger('change');
        }else{
            $(`#quote_${quoteKey}_booking_type_id`).val('').change();
        }

        $.ajax({
            type: 'get',
            url: `${BASEURL}category/to/supplier`,
            data: { 'category_id': category_id, 'detail_id': detail_id, 'model_name': model_name },
            success: function(response) {


                if(response.category_details != '' && response.category_details != 'undefined'){

                    $(`#quote_${quoteKey}_category_details`).val(response.category_details);

                    console.log(JSON.parse(response.category_details));

                    createAllElm(quote, '.category-details-render', 'category_details', JSON.parse(response.category_details));
                }

                // Hide & Show Category details btn according to status
                if((response.category != "") && (typeof response.category !== 'undefined')){

                    if(response.category.show_tf == 1){

                        $('.show-tf').removeClass('d-none');
                        quote.find('.show-tf .form-group .label-of-time-label').html(response.category.label_of_time);
                    }
                    else{
                        $('.show-tf').addClass('d-none');
                    }

                    if(response.category.second_tf == 1){

                        $('.second-tf').removeClass('d-none');
                        quote.find('.second-tf .form-group .second-label-of-time').html(response.category.second_label_of_time);
                    }
                    else{
                        $('.second-tf').addClass('d-none');
                    }

                    if(response.category.quote == 1){
                        quote.find('.build-wrap-parent').removeClass('d-none').addClass('d-flex');
                    }else{
                        quote.find('.build-wrap-parent').removeClass('d-flex').addClass('d-none');
                    }

                    if(response.category.booking == 1){
                        quote.find('.booking-category-detail-btn-parent').removeClass('d-none');
                        quote.find('.booking-category-detail-btn-parent').addClass('d-flex');
                    }else{
                        quote.find('.booking-category-detail-btn-parent').removeClass('d-flex');
                        quote.find('.booking-category-detail-btn-parent').addClass('d-none');
                    }

                    if(response.category.set_end_date_of_service == 1){
                        var DateOFService = $(`#quote_${quoteKey}_date_of_service`).val();
                        $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", DateOFService);
                    }

                    /* set product dropdown */
                    if(response && response.products.length > 0){

                        options += "<option value=''>Select Product</option>";
                        $.each(response.products, function(key, value) {
                            options += `<option value='${value.id}' data-name='${value.name}'>${value.name} - ${value.code}</option>`;
                        });

                        $(`#quote_${quoteKey}_product_id`).html(options);
                    }else{
                        $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
                    }
                    
                    
                }


        
            }
        });

    });

    $(document).on('change', '.supplier-location-id', function(){
        
        var quote                 = $(this).closest('.quote');
        var quoteKey              = quote.data('key');
        var suppplier_location_id = $(`#quote_${quoteKey}_supplier_location_id`).val();
        var category_id           = $(`#quote_${quoteKey}_category_id`).val();
        var options               = '';

        $(`#quote_${quoteKey}_supplier_id`).removeAttr('disabled');

        /* set supplier dropdown null when supplier location become null */
        if(typeof suppplier_location_id === 'undefined' || suppplier_location_id == ""){
            
            $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
            $(`#quote_${quoteKey}_supplier_id`).attr('disabled', 'disabled');

            $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');

            return;
        }



        /* get suppliers according to location */
        $.ajax({
            type: 'get',
            url: `${BASEURL}location/to/supplier`,
            data: { 'suppplier_location_id': suppplier_location_id, 'category_id': category_id},
            beforeSend : function(){
                $(`#quote_${quoteKey}_supplier_id`).val("").trigger('change');
            },
            success: function(response) {

                /* set supplier dropdown*/
                options += `<option value="">Select Supplier</option>`;
                $.each(response.suppliers, function(key, value) {
                    options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
                });
                $(`#quote_${quoteKey}_supplier_id`).html(options);
              
            }
        })

    });



    
    $(document).on('change', '.end-date-of-service', function() {

        var quote    = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var DateOFService    = $(`#quote_${quoteKey}_date_of_service`).val();
        var EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        var nowDate          = todayDate();

        var category_enddateofservice = $(`#quote_${quoteKey}_category_id`).find(':selected').attr('data-enddateofservice');

        if(convertDate(EndDateOFService) < convertDate(nowDate)){
            alert('Please select valid Date, The date you select is already Passed.');
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        }
        if((convertDate(EndDateOFService) < convertDate(DateOFService)) && category_enddateofservice != 1){
    
            alert('Please select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.');
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        } else {

            var number = convertDate(EndDateOFService) - convertDate(DateOFService);
            var days   = Math.ceil(number / (1000 * 3600 * 24));

            $(`#quote_${quoteKey}_number_of_nights`).val(checkForInt(days));
        }

    });

    $(document).on('change', '.date-of-service', function() {

        var quote    = $(this).closest('.quote');
        var quoteKey = quote.data('key');

        var DateOFService    = $(`#quote_${quoteKey}_date_of_service`).val();
        var EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        var nowDate          = todayDate();

        var category_enddateofservice = $(`#quote_${quoteKey}_category_id`).find(':selected').attr('data-enddateofservice');

        if(convertDate(DateOFService) < convertDate(nowDate)){
            alert('Please select valid Date, The date you select is already Passed.');
            $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('');
        }

        if(category_enddateofservice == 1){
            $(`#quote_${quoteKey}_end_date_of_service`).datepicker("setDate", DateOFService);
            EndDateOFService = $(`#quote_${quoteKey}_end_date_of_service`).val();
        }

        if((convertDate(EndDateOFService) < convertDate(DateOFService)) && category_enddateofservice != 1){
            alert('Please select Valid Date\nEnd Date of Service should be equal or greater than Start Date of Service.');
            $(`#quote_${quoteKey}_date_of_service`).datepicker("setDate", '');
            $(`#quote_${quoteKey}_number_of_nights`).val('')
        } else {

            var number = convertDate(EndDateOFService) - convertDate(DateOFService);
            var days   = Math.ceil(number / (1000 * 3600 * 24));

            $(`#quote_${quoteKey}_number_of_nights`).val(checkForInt(days));
        }

    });


   

    function convertDate(date) {
        var dateParts = date.split("/");
        return dateParts = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
    }







});