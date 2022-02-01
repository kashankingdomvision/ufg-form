$(document).ready(function() {
   
    /*
    |--------------------------------------------------------------------------------
    | Common Functions for Store & Update Category
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
        Remove form builder feild method
        also used product form builder
    */
    $(document).on("click", ".del-button",function() {


        if([ "categories.create", "categories.edit" ].includes(CURRENT_ROUTE_NAME)){

            let parentLI    = $(this).closest('li');
            let elementName = parentLI.find('.frm-holder .form-elements .name-wrap .input-wrap .form-control').val();
            let categoryID  = $('input[name=id]').val();
        
            let data = {
              'id'            : categoryID,
              'element_name'  : elementName,
              "_token"        : CSRFTOKEN,
            };
    
            if(typeof categoryID !== 'undefined' && categoryID != ""){
    
                $.ajax({
                    type: 'GET',
                    url: `${BASEURL}remove-form-buidler-feild`,
                    data: data,
                    success: function(data){
                        if(data && data.status == true){
                            alert(data.success_message);
                            return;
                        }
            
                        parentLI.remove();
                    },
                    error: function(reject) {
                
                        if(reject.status === 422) {
                            var errors = $.parseJSON(reject.responseText);
                        }
                    },
                });
            }else{
    
                parentLI.remove();
            }

        }

        if([ "products.create", "products.edit" ].includes(CURRENT_ROUTE_NAME)){

            let parentLI    = $(this).closest('li');
            let elementName = parentLI.find('.frm-holder .form-elements .name-wrap .input-wrap .form-control').val();
            let categoryID  = $('input[name=id]').val();
        
            let data = {
              'id'            : categoryID,
              'element_name'  : elementName,
              "_token"        : CSRFTOKEN,
            };
    
            if(typeof categoryID !== 'undefined' && categoryID != ""){
    
                $.ajax({
                    type: 'GET',
                    url: `${BASEURL}remove-form-buidler-feild`,
                    data: data,
                    success: function(data){
                        if(data && data.status == true){
                            alert(data.success_message);
                            return;
                        }
            
                        parentLI.remove();
                    },
                    error: function(reject) {
                
                        if(reject.status === 422) {
                            var errors = $.parseJSON(reject.responseText);
                        }
                    },
                });
            }else{
    
                parentLI.remove();
            }

        }
        
    });

    /*
    |--------------------------------------------------------------------------------
    | Store Category
    |--------------------------------------------------------------------------------
    */

    var storeCatgeoryOptions = {
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
    
    var storeCategoryFormBuilderDiv = $('#store_category_form_builder_div');
    var storeCategoryFormBuilder    = [];
    $(storeCategoryFormBuilderDiv).formBuilder(storeCatgeoryOptions).promise.then(function(response){
        storeCategoryFormBuilder.push(response);
    });

    $(document).on('click', '#store_category_submit', function(){

        let storeCatgeoryFormData = storeCategoryFormBuilder[0].actions.getData('json');
        let url                   = $('#store_category').attr('action');
        let storeCategory         = new FormData($('#store_category')[0]);
        storeCatgeoryFormData     = (storeCatgeoryFormData == '[]') ? '' : storeCatgeoryFormData;
        storeCategory.append('feilds', storeCatgeoryFormData);

        $.ajax({
            type: 'POST',
            url: url,
            data: storeCategory,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}categories/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            },
        }); /* end ajax*/

    });


    /*
    |--------------------------------------------------------------------------------
    | Update Category
    |--------------------------------------------------------------------------------
    */

    var presetCategoryFormData = $('#preset_category_form_data').val();
    var updateCategoryOptions  = {
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
        formData: presetCategoryFormData,
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
  

    var updateCategoryFormBuilderDiv = $('#update_category_form_builder_div');
    var updateCategoryFormBuilder    = [];
    $(updateCategoryFormBuilderDiv).formBuilder(updateCategoryOptions).promise.then(function(response){
        updateCategoryFormBuilder.push(response);
    });

    $(document).on('click', '#update_category_submit', function(){

        let updateCategoryFormData = updateCategoryFormBuilder[0].actions.getData('json');
        let url                    = $('#update_category').attr('action');
        let updateCategory         = new FormData($('#update_category')[0]);
        updateCategoryFormData     = (updateCategoryFormData == '[]') ? '' : updateCategoryFormData;
        updateCategory.append('feilds', updateCategoryFormData);

        $.ajax({
            type: 'POST',
            url: url,
            data: updateCategory,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                removeFormValidationStyles();
                addFormLoadingStyles();
            },
            success: function(response) {

                removeFormLoadingStyles();
                printServerSuccessMessage(response, `${REDIRECT_BASEURL}categories/index`);
            },
            error: function(response) {
                
                removeFormLoadingStyles();
                printServerValidationErrors(response);
            },
        }); /* end ajax*/

    });
    
});