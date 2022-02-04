$(document).ready(function() {

  /*
    Note: 
    Remove form builder feild method define in supplier_managment/category_app.js
  */
  
  /*
  |--------------------------------------------------------------------------------
  | Common Functions for Store & Update Product
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


  /*
  |--------------------------------------------------------------------------------
  | Store Product
  |--------------------------------------------------------------------------------
  */

  var storeProductOptions = {
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
  
  var storeProductFormBuilderDiv = $('#store_product_form_builder_div');
  var storeProductFormBuilder    = [];
  $(storeProductFormBuilderDiv).formBuilder(storeProductOptions).promise.then(function(response){
    storeProductFormBuilder.push(response);
  });

  $(document).on('click', '#store_product_submit', function(){

    let storeProductFormData = storeProductFormBuilder[0].actions.getData('json');
    let url                  = $('#store_product').attr('action');
    let storeProduct         = new FormData($('#store_product')[0]);
    storeProductFormData     = (storeProductFormData == '[]') ? '' : storeProductFormData;
    storeProduct.append('feilds', storeProductFormData);

    $.ajax({
      type: 'POST',
      url: url,
      data: storeProduct,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function() {
        removeFormValidationStyles();
        addFormLoadingStyles();
      },
      success: function(response) {

        removeFormLoadingStyles();
        printServerSuccessMessage(response, `${REDIRECT_BASEURL}products/index`);
      },
      error: function(response) {
          
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    });

  });



  /*
  |--------------------------------------------------------------------------------
  | Update Product
  |--------------------------------------------------------------------------------
  */

  var presetProductFormData = $('#preset_product_form_data').val();

  var updateProductOptions = {
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
    formData: presetProductFormData,
    dataType: 'json',
    typeUserAttrs: {
      autocomplete: {
        data: {
          label: 'Type',
          options: {
            'airport_codes': 'Airport Codes',
            'harbours': 'Harbours, Train and Points of Interest',
            'hotels': 'Hotels',
            'all': 'All',
            'none': 'None',
          },
        },
      }
    },
  };

  var updateProductFormBuilderDiv = $('#update_product_form_builder_div');
  var updateProductFormBuilder    = [];
  $(updateProductFormBuilderDiv).formBuilder(updateProductOptions).promise.then(function(response){
    updateProductFormBuilder.push(response);
  });


  $(document).on('click', '#update_product_submit', function(){

    let updateProductFormData = updateProductFormBuilder[0].actions.getData('json');
    let url                    = $('#update_product').attr('action');
    let updateProduct         = new FormData($('#update_product')[0]);
    updateProductFormData     = (updateProductFormData == '[]') ? '' : updateProductFormData;
    updateProduct.append('feilds', updateProductFormData);

    $.ajax({
      type: 'POST',
      url: url,
      data: updateProduct,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function() {
        removeFormValidationStyles();
        addFormLoadingStyles();
      },
      success: function(response) {

        removeFormLoadingStyles();
        printServerSuccessMessage(response, `${REDIRECT_BASEURL}products/index`);
      },
      error: function(response) {
          
        removeFormLoadingStyles();
        printServerValidationErrors(response);
      }
    }); /* end ajax*/

  });

  /* Category feild templates */
  let categoryTemplates = {
    tours: [
      {
        "type":"text",
        "label":"Meeting Point",
        "className":"form-control",
        "subtype":"text"
      },
      {
        "type":"text",
        "label":"Contact",
        "className":"form-control",
        "subtype":"text"
      },
      {
        "type":"number",
        "label":"Telephone",
        "className":"form-control",
      },
      {
        "type":"textarea",
        "label":"Address",
        "className":"form-control",
        "subtype":"textarea"
      }
    ]
  };

  /* 
    Note:
    This function work for both create & update product form builder
  */

  /* Set selected category feild templates on catgeory change */
  $(document).on('change', '#store_product #category_id, #update_product #category_id', function(){
    let category_slug     = $(this).find(':selected').attr('data-slug');

    if(category_slug in categoryTemplates){
      storeProductFormBuilder[0].actions.setData(categoryTemplates[category_slug]);
    }else{
      storeProductFormBuilder[0].actions.setData('[]');
    }
  });

});