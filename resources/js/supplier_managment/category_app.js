$(document).ready(function() {
   
    /*
    |--------------------------------------------------------------------------------
    | Common Functions
    |--------------------------------------------------------------------------------
    */

    function setFieldData(fieldData){
        currentFieldData = fieldData;
    }
    
    function hideOptionsAndRemoveChildLI(fieldID){
        $(`#${fieldID} .field-options`).addClass("d-none");
        $(`#${fieldID} .sortable-options li`).remove();
    }

    function showOptions(fieldID){
        $(`#${fieldID} .field-options`).removeClass("d-none");
    }

    /* hide & show label of time */
    $(document).on('change', '.show-tf', function(){

        let value          = $(this).val();
        let relavantColumn = $(this).closest('.parent').find('.label-of-time-col');

        if(value == 1){
            relavantColumn.removeClass('d-none');
        }else{
            relavantColumn.addClass('d-none');
        }
    });

    /*
    |--------------------------------------------------------------------------------
    | Store Category
    |--------------------------------------------------------------------------------
    */

    var storeOptions = {
        disabledActionButtons: ['clear','data','save'],
        disableFields: ['file','hidden','button'],
        disabledAttrs: [
            'className',
            'description',
            'maxlength',
            'name',
            'other',
            'required',
            'rows',
            'step',
            'style',
            'access',
            'accept',
            'toggle',
            // 'value',
        ],
        typeUserAttrs: {
            autocomplete: {
            data: {
                label: 'Type',
                /* options keys should be related table name */ 
                options: {
                'airport_codes' : 'Airport Codes',
                'harbours'      : 'Harbours, Train and Points of Interest',
                'hotels'        : 'Hotels',
                'all'           : 'All',
                'group_owners'  : 'Group Owner',
                'none'          : 'None',
                },
            }
            },
        },
        onAddField: function(fieldId, fieldData) {
            setFieldData(fieldData);
        },
        onOpenFieldEdit: function(field) {
            if(currentFieldData.type == "autocomplete"){
    
            /* By default hide options & remove child li */ 
            hideOptionsAndRemoveChildLI(field.id);
    
            let selector = `#${field.id} .form-elements .data-wrap .input-wrap select`;
            $(selector).on('change', function(){
    
                if($(this).val() === "none"){
    
                /* display options li */ 
                showOptions(field.id);
                } else {
                hideOptionsAndRemoveChildLI(field.id);
                }
            });
    
            } /* end if condition*/
            
        },
    };
    
    var storeFormBuilderDiv = $('#store_form_builder_div');
    // var storeFormBuilder    = $(storeFormBuilderDiv).formBuilder(storeOptions);
    var storeFormBuilder    = [];
    $(storeFormBuilderDiv).formBuilder(storeOptions).promise.then(function(response){
        storeFormBuilder.push(response);
    });

    $(document).on('click', '#store_category_submit', function(){

        let storeFormData = storeFormBuilder[0].actions.getData('json')
        let url           = $('#store_category').attr('action');
        let storeCategory = new FormData($('#store_category')[0]);
        storeFormData     = (storeFormData == '[]') ? '' : storeFormData;
        storeCategory.append('feilds', storeFormData);

        $.ajax({
            type: 'POST',
            url: url,
            data: storeCategory,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('input, select').removeClass('is-invalid');
                $('.text-danger').html('');
                $("#overlay").addClass('overlay');
                $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
            },
            success: function(data) {
                $("#overlay").removeClass('overlay').html('');
                
                setTimeout(function() {

                    if(data && data.status == true){
                        alert(data.success_message);
                        window.location.href = `${REDIRECT_BASEURL}categories/index`;
                    }
                }, 200);
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);
                    var flag = true;

                    setTimeout(function() {

                        $("#overlay").removeClass('overlay').html('');

                        jQuery.each(errors.errors, function(index, value) {

                            index = index.replace(/\./g, '_');

                            $(`#${index}`).addClass('is-invalid');
                            $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                            if(flag){
                                $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                flag = false;
                            }

                        });
                    }, 400);
                }
                
            },
        }); /* end ajax*/

    });


    /*
    |--------------------------------------------------------------------------------
    | Update Category
    |--------------------------------------------------------------------------------
    */

    var presetFormData = $('#preset_form_data').val();
    var updateOptions  = {
        disabledActionButtons: ['clear','data','save'],
        disableFields: ['file','hidden','button'],
        disabledAttrs: [
        'className',
        'description',
        'maxlength',
        'name',
        'other',
        'required',
        'rows',
        'step',
        'style',
        'access',
        'accept',
        'toggle',
        // 'value',
        ],
        formData: presetFormData,
        typeUserAttrs: {
        autocomplete: {
            data: {
            label: 'Type',
            /* options keys should be related table name */ 
            options: {
                'airport_codes' : 'Airport Codes',
                'harbours'      : 'Harbours, Train and Points of Interest',
                'hotels'        : 'Hotels',
                'all'           : 'All',
                'group_owners'  : 'Group Owner',
                'none'          : 'None',
            },
            }
        },
        },
        onAddField: function(fieldId, fieldData) {
            setFieldData(fieldData);
        },
        onOpenFieldEdit: function(field) {
            if(currentFieldData.type == "autocomplete"){

                /* By default hide options & remove child li */ 
                hideOptionsAndRemoveChildLI(field.id);

                let selector = `#${field.id} .form-elements .data-wrap .input-wrap select`;
                $(selector).on('change', function(){

                if($(this).val() === "none"){

                    /* display options li */ 
                    showOptions(field.id);
                } else {
                    hideOptionsAndRemoveChildLI(field.id);
                }
                });

            } /* end if condition*/
        
        },
    };
  
    var updateFormBuilderDiv = $('#update_form_builder_div');
    var updateFormBuilder    = $(updateFormBuilderDiv).formBuilder(updateOptions);

    $(document).on('click', '#update_category_submit', function(){

        let updateFormData = updateFormBuilder.actions.getData('json')
        let url            = $('#update_category').attr('action');
        let updateCategory = new FormData($('#update_category')[0]);
        updateFormData     = (updateFormData == '[]') ? '' : updateFormData;
        updateCategory.append('feilds', updateFormData);

        $.ajax({
            type: 'POST',
            url: url,
            data: updateCategory,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('input, select').removeClass('is-invalid');
                $('.text-danger').html('');
                $("#overlay").addClass('overlay');
                $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
            },
            success: function(data) {
                $("#overlay").removeClass('overlay').html('');
                
                setTimeout(function() {

                    if(data && data.status == true){
                        alert(data.success_message);
                        window.location.href = `${REDIRECT_BASEURL}categories/index`;
                    }
                }, 200);
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);
                    var flag = true;

                    setTimeout(function() {

                        $("#overlay").removeClass('overlay').html('');

                        jQuery.each(errors.errors, function(index, value) {

                            index = index.replace(/\./g, '_');

                            $(`#${index}`).addClass('is-invalid');
                            $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                            if(flag){
                                $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                flag = false;
                            }

                        });
                    }, 400);
                }
            
            },
        }); /* end ajax*/

    });
    
});