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
            window.location.href = `${REDIRECT_BASEURL}products/index`;
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
            window.location.href = `${REDIRECT_BASEURL}products/index`;
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