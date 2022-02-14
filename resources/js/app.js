import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import 'jquery-ui/ui/widgets/sortable.js';
import select2 from 'select2';
import intlTelInput from 'intl-tel-input';
import Swal from 'sweetalert2';
import datepicker from 'bootstrap-datepicker';
import daterangepicker from 'daterangepicker';
import { result } from 'lodash';

require('./global_variables');
require('./asset/laravel_filemanager/stand-alone-button');
require('./asset/summernote/summernote-bs4.min');
require('./asset/bootstrap/bootstrap.bundle.min');
require('./asset/adminlte/adminlte');
require('./asset/intl_tel_input/utils');

$(document).ready(function($) {

    $(document).on('click', '.removeChild', function() {
        var id = $(this).data('show');
        $(id).removeAttr("style");
        $($(this).data('append')).empty();
        $(this).attr("style", "display:none");
    });

    $(document).on('click', '.addChild', function() {
        $('.append').empty();
        var id = $(this).data('id');
        var refNumber = $(this).data('ref');
        var appendId = $(this).data('append');
        var url = '{{ route("get.child.reference", ":id") }}';
        url = url.replace(':id', refNumber);
        var removeBtnId = $(this).data('remove');
        var showBtnId = $(this).data('show');
        $('.addChild').removeAttr("style");
        $('.removeChild').attr("style", "display:none");

        $(this).attr("style", "display:none")
            // $(appendId).empty();

        $.ajax({
            url: BASEURL + 'quotes/child/reference',
            data: { id: id, ref_no: refNumber },
            type: 'get',
            success: function(response) {
                $(appendId).append(response);
                $(removeBtnId).removeAttr("style");
            }
        });
    });
 

    window.calltextEditorSummerNote = function(val = null) {

        $('.summernote:last').summernote('destroy');
        $('.note-editor:last').remove();
        $('.summernote').summernote({
            height: 100,   //set editable area's height
            placeholder: 'Enter Text Here..',
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        }, 'code', val);
    }

    window.setTextEditorValue = function(id, Text) {
        $(id).summernote('code', Text);
    }


    // function formatState(option) {
    window.formatState = function(option) {
        var optionImage = $(option.element).attr('data-image');
        if (!optionImage) {
            return option.text;
        }

        return $(`<span><img height="19" width="19" src="${optionImage}" class="option-flag-image" />${option.text}</span>`);
    };

    window.reinitializedSingleSelect2 = function() {
        $('.select2single').select2({
            width: '100%',
            theme: "bootstrap",
            templateResult: formatState,
            templateSelection: formatState,
        });
    }

    window.reinitializedMultiDynamicFeilds = function() {
        $('.select2-multiple').select2({
            width: '100%',
            theme: "classic",
            templateResult: formatState,
            templateSelection: formatState,
        });
    }

    window.disabledFeild = function(p) {
        $(p).attr("disabled", true);
    }

    window.removeDisabledAttribute = function(p) {
        $(p).removeAttr("disabled");
    }

    window.removeSpace = function(string) {
        return string.replace(/\s/g, '');
    }

    /*
    |--------------------------------------------------------------------------
    | Define Global Functions
    |--------------------------------------------------------------------------
    */
    
    window.removeFormValidationStyles = function() {
        $('input, select, textarea').removeClass('is-invalid');
        $('.text-danger').html('');
    }

    window.addFormLoadingStyles = function() {
        $("#overlay").addClass('overlay');
        $(".note-editor").css('border-color', '');
        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
    }

    window.removeFormLoadingStyles = function() {
        setTimeout(function() {
            $("#overlay").removeClass('overlay');
            $("#overlay").html('');
        }, 250);
    }

    window.printServerValidationErrors = function(response) {

        if (response.status === 422) {

            let errors = response.responseJSON;
            let flag   = true;

            setTimeout(function() {
                jQuery.each(errors.errors, function(index, value) {

                    index = index.replace(/\./g, '_');

                    /* Expand Quote Details Card */
                    
                    let closestQuote = $(`#${index}`).closest('.quote');

                    closestQuote.removeClass('collapsed-card');
                    closestQuote.find('.card-body').css("display", "block");
                    closestQuote.find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);

                    /* --------------------------------  */

                    $(`#${index}`).addClass('is-invalid');
                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                    $(`#${index}`).closest('.form-group').find('.note-editor').css('border-color', 'red');

                    if(flag){
                        $('html, body').animate({ scrollTop: $(`#${index}`).parent('.form-group').offset().top }, 1000);
                        // $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                        flag = false;
                    }
                });

            }, 250);

        }
    }

    window.printServerSuccessMessage = function(data, redirectURL) {

        if(data && data.status){
            Toast.fire({
                icon: 'success',
                title: data.success_message
            });

            setTimeout(function() {
                window.location.href = `${redirectURL}`;
            }, 2500);
        }
    }

    window.curday = function(sp) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //As January is 0.
        var yyyy = today.getFullYear();
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        return (yyyy + sp + mm + sp + dd);
    };

    window.todayDate = function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        return today = dd + '/' + mm + '/' + yyyy;
    }

    window.check = function(x) {

        if (isNaN(x) || !isFinite(x)) {
            return parseFloat(0).toFixed(2);
        }

        return parseFloat(x).toFixed(2);
    }

    window.checkForInt = function(x) {

        if (isNaN(x) || !isFinite(x)) {
            return '';
        }

        return parseInt(x);
    }

    window.isEmpty = function(value) {
        return (value == null || value == '' || value == 'undefined' ? 'N/A' : value);
    }

    window.datepickerReset = function(key = null, quoteClass) {

        var $season = $("#season_id");
        var season_start_date = new Date($season.find(':selected').data('start'));
        var season_end_date = new Date($season.find(':selected').data('end'));
        if (season_start_date != 'Invalid Date' && season_end_date != 'Invalid Date') {
            if (key != null) {
                $(`${quoteClass} .bookingDateOfService`).datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                // $('.bookingDate:last').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                // $('.bookingDueDate:last').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                $(`${quoteClass} .bookingEndDateOfService`).datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                $('.stored-text-date').datepicker("destroy").datepicker({ autoclose: true, format: 'dd/mm/yyyy' });
            } else {
                // $('.datepicker').datepicker('destroy').datepicker({  autoclose: true, format:'dd/mm/yyyy', startDate: season_start_date, endDate: season_end_date });
                $('.datepicker').datepicker("destroy").datepicker({ autoclose: true, format: 'dd/mm/yyyy' });
 
            }
        } else {
            $('.datepicker').datepicker('destroy').datepicker({ autoclose: true, format: 'dd/mm/yyyy' });
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Invoke Global Functions
    |--------------------------------------------------------------------------
    */
    
    datepickerReset();

       /*  ajaxSetup */
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRFTOKEN
        }
    });

    $('.select2').select2({
        width: '100%',
        theme: "classic",
    });

    $('.select2single').select2({
        width: '100%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.nationality-select2').select2({
        width: '100%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.select2-multiple').select2({
        width: '100%',
        theme: "classic",
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.select2-single').select2({
        width: '90%',
        theme: "bootstrap",
    });

    $('.selling-price-other-currency').select2({
        width: '68%',
        theme: "bootstrap",
        templateResult: formatState,
        templateSelection: formatState,
    });

    $('.summernote').summernote({
        height: 70,   //set editable area's height
        placeholder: 'Enter Text Here..',
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });

    // make quote section sortable
    $(".sortable").sortable();

    $('.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'DD/MM/YYYY',
        }
    });

    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    /*---------------------------------------------------------------------------------------*/
 
    /* Focus In/Out Function on Calculation Values */
    $(document).on('focus', '.remove-zero-values', function() {
        var value = parseFloat($(this).val()).toFixed(2);
        if(value == 0.00){
            $(this).val('');
        }
    });

    $(document).on('focusout', '.remove-zero-values', function() {
        var value = $(this).val();
        if(value == ''){
            $(this).val((parseFloat(0).toFixed(2)));
        }
    });
    /* End Focus In/Out Function on Calculation Values */

    $("#generate-pdf").submit(function(event) {
        event.preventDefault();
        var $form = $(this),
            url = $form.attr('action');
        var editor = $('#editor').html();
        var formData = $(this).serializeArray();
        formData.push({ name: 'data', value: editor });
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(data) {
                // console.log(data, 'data');
            },
            error: function(reject) {

                if (reject.status === 422) {

                    var errors = $.parseJSON(reject.responseText);

                    setTimeout(function() {
                        $("#overlay").removeClass('overlay').html('');

                        if (errors.hasOwnProperty("overrride_errors")) {
                            alert(errors.overrride_errors);
                            window.location.href = REDIRECT_BASEURL + "quotes/index";
                        } else {

                            jQuery.each(errors.errors, function(index, value) {

                                index = index.replace(/\./g, '_');
                                $('#' + index).addClass('is-invalid');
                                $('#' + index).closest('.form-group').find('.text-danger').html(value);
                            });
                        }

                    }, 400);
                }
            },
        });
    });

  

    // user managment
    $(document).on('change', '.getBrandtoHoliday', function() {
        let brand_id = $(this).val();
        var options = '';
        var url = BASEURL + 'brand/to/holidays'
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_id': brand_id },
            success: function(response) {
                options += '<option value="">Select Type Of Holiday</option>';
                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
                });
                $('.appendHolidayType').html(options);
            }
        });

        getCommissionRate();
    });

    // commission criteria
    $(document).on('change', '.getMultipleBrandtoHoliday', function() {

        let brand_ids = $(this).val();
        var options = '';
        var url = BASEURL + 'multiple/brand/to/holidays'
        
        $.ajax({
            type: 'get',
            url: url,
            data: { 'brand_ids': brand_ids },
            beforeSend: function() {
                $('.appendMultipleHolidayType').html(options);
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.brand_name}) </option>`;
                });

                $('.appendMultipleHolidayType').html(options);
            }
        });
 
    });

    // $(document).on('change', '.getCountryToTown', function() {
    //     let country_id = $(this).val();
    //     var options    = '';

    //     var url = BASEURL + 'country/to/town'
    //     $.ajax({
    //         type: 'get',
    //         url: url,
    //         data: { 'country_id': country_id },
    //         success: function(response) {
    //             options += '<option value="">Select Town</option>';
    //             $.each(response, function(key, value) {
    //                 options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} </option>`;
    //             });

    //             $('.appendCountryTown').html(options);
    //         }
    //     });
    
    // });


    // suppliers
    $(document).on('change', '.getCountryToLocation', function() {
        
        var supplier_country_ids = $(this).val();
        var url         = BASEURL + 'country/to/location';
        var options     = '';

        $.ajax({
            type: 'get',
            url: url,
            data: { 'supplier_country_ids': supplier_country_ids },
            beforeSend: function() {
                $('.appendCountryLocation').html(options);
            },
            success: function(response) {

                $.each(response, function(key, value) {
                    options += `<option data-value="${value.name}" value="${value.id}"> ${value.name} (${value.country_name}) </option>`;
                });

                $('.appendCountryLocation').html(options);
            }
        });
    
    });


  

            $(document).on('change', '.select-agency', function() {
                var agency_ = $('.agencyField');
                var passenger_ = $('.PassengerField');
                if (($(this).val() == 1)) {
                    $('#pax_no').val(1).change();
                    $("input[name=agency_commission_type][value=net-price]").prop('checked', true);
                    agency_.removeClass('d-none');
                    passenger_.addClass('d-none');
                    agency_.find('input, select').removeAttr('disabled');
                    passenger_.find('input, select').attr('disabled', 'disabled');
                    // $('#agency_contact').addClass('phone phone0');
                    // $('#lead_passenger_contact').removeClass('phone');
                    // $('#lead_passenger_contact').removeClass('phone0');
                    var iti = intlTelInput(document.querySelector('#lead_passenger_contact'), {
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                    });
                    iti.destroy();
                    // intTelinput('gc');
                } else {
                    $('#pax_no').val(1).change();
                    $('.paid-net-commission-on-departure').addClass('d-none');
                    agency_.addClass('d-none');
                    passenger_.removeClass('d-none');
                    passenger_.find('input, select').removeAttr('disabled');
                    var iti = intlTelInput(document.querySelector('#agency_contact'), {
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                    });
                    iti.destroy();
                    // $('#lead_passenger_contact').addClass('phone phone0');
                    // $('#agency_contact').removeClass('phone');
                    // $('#agency_contact').removeClass('phone0');
                    agency_.find('input, select').attr('disabled', 'disabled');
                    // intTelinput(0);
                }

                getCommissionRate();
            });

            $(document).on('click', '.expand-all-btn', function(event) {
                $('#parent .quote').removeClass('collapsed-card');
                $('#parent .card-body').css("display", "block");
                $('#parent .collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
                // $(this).addClass('d-none');
                // $('.expand-collapse-quote-detail-cards').removeClass('d-none');
            });

            /* Expand Collapse Script */
            var status = false;
            $(document).on('click', '.expand-collapse-quote-detail-cards', function(event) {

                let BtnText = $(this).text();
                status      = !(status); 

                if(!status){
                    BtnText = `Collapse All &nbsp; <i class="fas fa-minus"></i>`;
                }else{
                    BtnText = `Expand All &nbsp; <i class="fas fa-plus"></i>`;
                }

                $(this).html(`${BtnText}`);
                $(".collapse-expand-btn").trigger("click");

            });
            /* End Expand Collapse Script */

            $(document).on('click', '.compare-expand-all-btn', function(event) {
                $('#compare_parent .card').removeClass('collapsed-card');
                $('#compare_parent .card-body').css("display", "block");
                $('#compare_parent .compare-collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);
            });

            $(document).on('click', '.compare-expand-collapse-quote-detail-cards', function(event) {

                $('#compare_parent .card').addClass('collapsed-card');
                $('#compare_parent .card-body').css("display", "none");
                $('#compare_parent .compare-collapse-expand-btn').html(`<i class="fas fa-plus"></i>`);
            });


            // $(document).on('change', '.supplier-id', function() {

            //     var quote                = $(this).closest('.quote');
            //     var quoteKey             = quote.data('key');
            //     var supplier_name        = $(this).find(':selected').attr('data-name');
            //     var supplier_id          = $(this).val();
            //     var season_id            = $('.season-id').val();
            //     var supplier_location_id = $(`#quote_${quoteKey}_supplier_location_id`).val();
            //     var category_id          = $(`#quote_${quoteKey}_category_id`).val();
            //     var options              = '';

            //     /* set/unset card header, supplier currency & product */
            //     if(typeof supplier_id === 'undefined' || supplier_id == "") {
            //         quote.find('.badge-supplier-id').html("");

            //         // $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            //         // $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');

            //         $(`#quote_${quoteKey}_supplier_currency_id`).val("").trigger('change');
            //         return;
            //     }else{
            //         quote.find('.badge-supplier-id').html(supplier_name);
            //         // $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');
            //     }

            //     /* get supplier's rate sheet, supplier's product, supplier's currency */
            //     if(season_id != "" && supplier_id != ""){
            //         $.ajax({
            //             type: 'get',
            //             url: `${BASEURL}get-supplier-product-and-sheet`,
            //             data: { 
            //                 'supplier_id': supplier_id,
            //                 'season_id': season_id,
            //                 'supplier_location_id': supplier_location_id,
            //                 'category_id': category_id,
            //             },
            //             success: function(response) {

            //                 if(response && response.url != ""){
            //                     quote.find('.view-supplier-rate').attr("href", response.url).html("(View Rates)");
            //                 }else{
            //                     quote.find('.view-supplier-rate').attr("href","").html("");
            //                 }

            //                 // /* set product dropdown */
            //                 // if(response && response.products.length > 0){
                            
            //                 //     options += "<option value=''>Select Product</option>";
            //                 //     $.each(response.products, function(key, value) {
            //                 //         options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
            //                 //     });

            //                 //     $(`#quote_${quoteKey}_product_id`).html(options);
            //                 // }else{
            //                 //     $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
            //                 // }

            //                 /* set supplier currency */
            //                 if(response && response.supplier_currency != ""){
            //                     $(`#quote_${quoteKey}_supplier_currency_id`).val(response.supplier_currency).trigger('change');
            //                 }

            //             }
            //         });
            //     }else{
            //         quote.find('.view-supplier-rate').attr("href","").html("");
            //         $(`#quote_${quoteKey}_product_id`).html("");
            //     }
            // });

            // $(document).on('change', '.product-location-id', function(){
                
            //     var quote                 = $(this).closest('.quote');
            //     var quoteKey              = quote.data('key');
            //     var product_location_id   = $(`#quote_${quoteKey}_product_location_id`).val();
            //     var supplier_id           = $(`#quote_${quoteKey}_supplier_id`).val();
            //     var options               = '';

            //     $(`#quote_${quoteKey}_product_id`).removeAttr('disabled');

            //     /* set product dropdown null when product location become null */
            //     if(typeof product_location_id === 'undefined' || product_location_id == ""){
            //         // quote.find('.badge-category-id').html("");
            //         $(`#quote_${quoteKey}_product_id`).html("<option value=''>Select Product</option>");
            //         $(`#quote_${quoteKey}_product_id`).val("").trigger('change');
            //         $(`#quote_${quoteKey}_product_id`).attr('disabled', 'disabled');
            //         return;
            //     }

            //     $.ajax({
            //         type: 'get',
            //         url: `${BASEURL}location/to/product`,
            //         data: { 'product_location_id': product_location_id, 'supplier_id' : supplier_id },
            //         success: function(response) {

            //             /* set supplier dropdown*/
            //             options += "<option value=''>Select Product</option>";
            //             $.each(response.products, function(key, value) {
            //                 options += `<option value='${value.id}' data-name='${value.name}'>${value.name}</option>`;
            //             });
            //             $(`#quote_${quoteKey}_product_id`).html(options);
                      
            //         }
            //     })

            // });

     

            /**
             * -------------------------------------------------------------------------------------
             *                                Season Manangement
             * -------------------------------------------------------------------------------------
             */

            // $('#seasons').keyup(function() {
            //     var val = $(this).val();
            //     if (val.length == 4) {
            //         $(this).val(val + '-');
            //     }
            // });


            /**
             * -------------------------------------------------------------------------------------
             *                                Quote Manangement
             * -------------------------------------------------------------------------------------
             */

            $(document).on('click', '.parent-row', function(e) {
                var parentID = $(this).data('id');
                $(`#child-row-${parentID}`).hasClass('d-none') ? $(`#child-row-${parentID}`).removeClass('d-none') : $(`#child-row-${parentID}`).addClass('d-none');
                $(this).html($(this).html() == `<span class="fa fa-minus"></span>` ? `<span class="fa fa-plus"></span>` : `<span class="fa fa-minus"></span>`);
            });

        

     
         



            // $(document).on('click', '.cancel-service', function(e) {

            //     e.preventDefault();

            //     var booking_detail_id = $(this).attr('data-bookingDetialID');

            //     if( confirm("Are you sure you want to Cancel this Service?") == true){

            //         $.ajax({
            //             headers: { 'X-CSRF-TOKEN': CSRFTOKEN },
            //             url: `${REDIRECT_BASEURL}bookings/cancel-booking-service/${booking_detail_id}/${status}`,
            //             type: 'get',
            //             success: function(data) {

            //                 setTimeout(function() {

            //                     if (data.success_message) {
            //                         alert(data.success_message);
            //                         location.reload();
            //                     }

            //                 }, 400);

            //             },
            //             error: function(reject) {}
            //         });
            //     }

            // });

       

            $(".readonly").keypress(function(evt) {
                evt.preventDefault();
            });

            $(".collapse-all-btn").removeAttr('disabled');
            $(".expand-all-btn").removeAttr('disabled');





        
            /*
            |--------------------------------------------------------------------------
            | Template Management
            |--------------------------------------------------------------------------
            */


            // template management
            $("#create_template").submit(function(event) {

                event.preventDefault();
                var url = $(this).attr('action');

                /* Send the data using post */
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');

                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {

                        $("#overlay").removeClass('overlay').html('');

                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = `${REDIRECT_BASEURL}template/index`;
                            }
                        }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);
                            
                            setTimeout(function() {

                                var flag = true;

                                $("#overlay").removeClass('overlay').html('');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    // expand quote if feild has an error
                                    $(`#${index}`).closest('.quote').removeClass('collapsed-card');
                                    $(`#${index}`).closest('.quote').find('.card-body').css("display", "block");
                                    $(`#${index}`).closest('.quote').find('.collapse-expand-btn').html(`<i class="fas fa-minus"></i>`);

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                    if (flag) {

                                        $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                        flag = false;
                                    }

                                });
                            }, 400);

                        }
                    },
                });
            });

            // template management
            $("#update_template").submit(function(event) {

                event.preventDefault();

                var url = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');

                        $("#overlay").addClass('overlay');
                        $("#overlay").html(`<i class="fas fa-2x fa-sync-alt fa-spin"></i>`);
                    },
                    success: function(data) {

                        $("#overlay").removeClass('overlay').html('');
                        setTimeout(function() {

                            if(data && data.status == 200){
                                alert(data.success_message);
                                window.location.href = `${REDIRECT_BASEURL}template/index`;
                            }
                            
                        }, 400);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#overlay").removeClass('overlay').html('');

                                jQuery.each(errors.errors, function(index, value) {

                                    index = index.replace(/\./g, '_');

                                    $(`#${index}`).addClass('is-invalid');
                                    $(`#${index}`).closest('.form-group').find('.text-danger').html(value);
                                });

                            }, 400);

                        }
                    },
                });
            });

            /*
            |--------------------------------------------------------------------------
            | End Template Management
            |--------------------------------------------------------------------------
            */

        

         

     


            // transfer report
            function createFilter(type,label,data){

                var options;

                if(label == null){
                    $('.filter-col').remove();
                    return;
                }

                $.ajax({
                    type: "GET",
                    url: `${BASEURL}category-details-filter`,
                    data: { 'type': type, 'label': label, 'data': data },
                    datatype: "json",
                    async: false,
                    success: function(response){

                        var result = '';
                        $.each(response.label_results, function(key, value) {
                            result += `<option value="${value.value}"> ${value.value} </option>`;
                        });

                        options = result;
                    }
                });

                var multipleSelect2HTML = 
                `<div class="col-md-3 filter-col">
                    <div class="d-flex bd-highlight">
                        <div class="w-100 bd-highlight"><label>${label}</label></div>
                        <div class="flex-shrink-1 bd-highlight" style="font-size: 11px;"><i class="fas fa-times text-danger border border-danger remove-col" style="padding: 4px; border-radius: 4px; cursor: pointer;"></i></div>
                    </div>
                    <select class="form-control select2-multiple" multiple name="columns[${label}][]">${options}</select>
                </div>`;
          
                return multipleSelect2HTML;
            }

 
            // transfer report
            $(document).on('change', '.transfer-detail-feild', function() {

                var feild = $(this).val();

                if(typeof feild === 'undefined' || feild == ""){
                    $('#search_transfer_detail').addClass('d-none');
                }else{
                    $('#search_transfer_detail').removeClass('d-none');
                }

                var type  = $(this).find(':selected').attr('data-optionType');
                var label = $(this).find(':selected').attr('data-optionLable');
                var data  = $(this).find(':selected').attr('data-optionData');

                $(createFilter(type,label,data)).insertBefore("#more_filter");
                reinitializedMultiDynamicFeilds();
            });

            // transfer report
            $(document).on('click', '.remove-col', function() {
                $(this).closest('.filter-col').remove();
            });



      

     
     



            $('.parent').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".child").prop('checked', true);

                } else {

                    $(".child").prop('checked', false);
                }
            });

            $('.sbp-parent').on('click', function(e) {

                if ($(this).is(':checked', true)) {

                    $(".credit").prop('checked', false);
                    $('.credit').trigger('click');

                } else {
           
                    $('.credit').trigger('click');
                    $('.total-paid-amount').val(parseFloat(0).toFixed(2));
            
                }
            });

            // Supplier Bulk Payments
            $('.credit').change(function(){

                var currencyCode          = $(this).attr('data-currencyCode');
                var value                 = parseFloat($(this).attr('data-value')).toFixed(2);
                var row                   = $(this).closest('.credit-row');

                if($(this).is(':checked')){

                    $(this).val('1');

                    row.find('.row-paid-amount').val(value);
                    row.find('.row-total-paid-amount').val(value);

                    getTotalPaidAmount();
    
                }
                else {
                
                    $(this).val('0');

                    row.find('.row-paid-amount').val((parseFloat(0).toFixed(2)));
                    row.find('.row-total-paid-amount').val((parseFloat(0).toFixed(2)));
                    getTotalPaidAmount();
                    // $('.total-paid-amount').val((parseFloat(getCheckedValues()).toFixed(2)));
                }

            });

            // Supplier Bulk Payments
            $(document).on("change", '.row-paid-amount', function(event) {

                var row                        = $(this).closest('.credit-row');
                var currentPaidAmountValue     = parseFloat($(this).val());

                var rowCreditNoteAmount        = row.find('.row-credit-note-amount').val();
                var rowTotalPaidAmount         = parseFloat(currentPaidAmountValue) + parseFloat(rowCreditNoteAmount);

                var totalOutstandingAmountLeft = parseFloat(row.find('.credit').attr('data-value'));

                row.find('.row-total-paid-amount').val(getFloat(rowTotalPaidAmount));


                if(rowTotalPaidAmount > totalOutstandingAmountLeft){
                    alert("Please Enter Correct Amount");
                    $(this).val('0.00');


                    row.find('.row-total-paid-amount').val(getFloat(rowCreditNoteAmount));
                }

                getTotalPaidAmount();

                // var value                 = parseFloat($(this).val());
                // var row                   = $(this).closest('.credit-row');
                // var outstandingAmountLeft = row.find('.credit').val();

                // if(value > outstandingAmountLeft){
                //     alert("Please Enter Correct Amount");
                //     $(this).val('0.00');
                // }

                // getTotalPaidAmount();
            });

            function getTotalPaidAmount(){

                var paidAmountValues = parseFloat(getPaidAmountValues());
                $('.total-paid-amount').val(getFloat(paidAmountValues));
            }

            function getRemainingCreditNoteAmount(){

                var totalWalletAmount     = parseFloat($('.total-credit-amount').val());
                var totalCreditNoteValues = parseFloat(getCreditNoteValues());
                var result                = parseFloat(totalWalletAmount) - parseFloat(totalCreditNoteValues);

                $('.remaining-credit-amount').html(getFloat(result));
                $('.remaining-credit-amount').val(getFloat(result));
            }

            function getPaidAmountValues(){
                var checkedValuesArray = $('.row-total-paid-amount').map((i, e) => parseFloat(e.value)).get();
                var checkedValuesTotal = checkedValuesArray.reduce((a, b) => (a + b), 0);
                return parseFloat(checkedValuesTotal).toFixed(2);
            }

            function getCreditNoteValues(){
                var checkedValuesArray = $('.row-credit-note-amount').map((i, e) => parseFloat(e.value)).get();
                var checkedValuesTotal = checkedValuesArray.reduce((a, b) => (a + b), 0);
                return parseFloat(checkedValuesTotal).toFixed(2);
            }


            function getFloat(value){
                // console.log(parseFloat(value).toFixed(2));
                return parseFloat(value).toFixed(2);
            }

            // Supplier Bulk Payments
            $(document).on("change", '.row-credit-note-amount', function(event) {

                var totalWalletAmount      = parseFloat($('.total-credit-amount').val());
                var currentCreditNoteValue = parseFloat($(this).val());

                var row                    = $(this).closest('.credit-row');
                var rowOutstandingAmount   = row.find('.credit').attr('data-value');

                var rowPaidAmount          = parseFloat(rowOutstandingAmount) - parseFloat(currentCreditNoteValue);
                var rowTotalPaidAmount     = parseFloat(rowPaidAmount) + parseFloat(currentCreditNoteValue);

                var totalCreditNoteValues = parseFloat(getCreditNoteValues());

                if(row.find('.credit').is(':checked')){

                    row.find('.row-paid-amount').val(getFloat(rowPaidAmount));
                    row.find('.row-total-paid-amount').val(getFloat(rowTotalPaidAmount));

                    if(currentCreditNoteValue > totalWalletAmount || totalCreditNoteValues > totalWalletAmount ){

                        alert("Please Enter Correct Amount");
                        $(this).val('0.00');
    
                        row.find('.row-paid-amount').val(getFloat(rowOutstandingAmount));
                        row.find('.row-total-paid-amount').val(getFloat(rowOutstandingAmount));
                    }


                    getTotalPaidAmount();
                    getRemainingCreditNoteAmount();
                }
                else {
                    $(this).val('0.00');
                }
            });

            // Supplier Bulk Payments
            $("#bulk_payment").submit(function(event) {

                event.preventDefault();
            
                var checkedValues = $('.credit:checked').map((i, e) => e.value).get();
                if (checkedValues.length == 0) {
                    alert("Please Check any Record First");
                    return;
                }

                var url = $(this).attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('input, select').removeClass('is-invalid');
                        $('.text-danger').html('');
                        $("#bulk_payment_submit").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(data) {
                        $("#bulk_payment_submit").find('span').removeClass('spinner-border spinner-border-sm');

                        setTimeout(function() {

                            if(data && data.status == true){
                                alert(data.success_message);
                                location.reload();
                            }
                        }, 200);
                    },
                    error: function(reject) {

                        if (reject.status === 422) {

                            var errors = $.parseJSON(reject.responseText);

                            setTimeout(function() {
                                $("#bulk_payment_submit").find('span').removeClass('spinner-border spinner-border-sm');

                                if (errors.hasOwnProperty("payment_error")) {
                                    alert(errors.payment_error);
                                    location.reload();

                                } else {

                                    var flag = true;

                                    jQuery.each(errors.errors, function(index, value) {

                                        index = index.replace(/\./g, '_');
                                        $(`#${index}`).addClass('is-invalid');
                                        $(`#${index}`).closest('.form-group').find('.text-danger').html(value);

                                        if (flag) {

                                            $('html, body').animate({ scrollTop: $(`#${index}`).offset().top }, 1000);
                                            flag = false;
                                        }
                                    });
                                }

                            }, 400);

 
                        }
                    },
                });
            });


           

            $('#delete_all').on('click', function(e) {
                e.preventDefault();
                var checkedValues = $('.child:checked').map((i, e) => e.value).get();

                if (checkedValues.length > 0) {
                    jQuery('#multiple_delete_modal').modal('show');
                } else {
                    alert("Please Check any Record First");
                }

            });

            $('#multiple_delete').on('click', function(e) {
                e.preventDefault();

                var checkedValues = $('.child:checked').map((i, e) => e.value).get();
                var tableName = $('.table-name').val();
                $.ajax({
                    url: REDIRECT_BASEURL + 'multiple-delete/' + checkedValues,
                    type: 'Delete',
                    dataType: "JSON",
                    data: { "checkedValues": checkedValues, "tableName": tableName },
                    beforeSend: function() {
                        $("#multiple_delete").find('span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(response) {

                        if (response.status == true) {


                            $("#multiple_delete").find('span').removeClass('spinner-border spinner-border-sm');
                            jQuery('#multiple_delete_modal').modal('hide');

                            setTimeout(function() {

                                alert(response.message);
                                location.reload();

                            }, 600);

                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            });

            $('.multiple-action').on('change', function(e) {

                var action = $(this).val();
                var checkedValues = $('.child:checked').map((i, e) => e.value).get();
                if (checkedValues.length > 0) {
                    jQuery('#multiple_delete_modal').modal('show');
                    $('.action_name').val(action);
                    $('#multiple_delete').addClass('btn btn-danger');
                    $("#multiple_delete").html(action);
                    $('#multiple_delete').removeClass();
                    $('#multiple_delete').addClass('btn btn-primary');
                    if (action == 'Delete') {
                        $('#multiple_delete').addClass('btn btn-danger');
                    }
                } else {
                    alert("Please Check any Record First");
                    $('.multiple-action').val("");
                }

                // if(action && checkedValues.length > 0){

                //     $.ajax({
                //         url: REDIRECT_BASEURL+'quotes/multiple-delete',
                //         type: 'delete',
                //         dataType: "JSON",
                //         data: { "checkedValues": checkedValues, "action": action },
                //         beforeSend: function() {
                //             $("#multiple_delete").find('span').addClass('spinner-border spinner-border-sm');
                //         },
                //         success: function (response)
                //         {

                //             if(response.status == true){


                //                 $("#multiple_delete").find('span').removeClass('spinner-border spinner-border-sm');
                //                 jQuery('#multiple_delete_modal').modal('hide');

                //                 setTimeout(function() {

                //                     alert(response.message);
                //                     location.reload();

                //                 }, 600);

                //             }
                //         },
                //         error: function(xhr) {
                //           console.log(xhr.responseText);
                //         }
                //     });


                // }

            });

            // booking incremnet and



            // tel input  start
            if ($('.phone').length > 0) {
                for (let i = 0; i < $('.phone').length; i++) {
                    if ($('.phone' + i).length != 0) {
                        intTelinput(i);
                    }
                }
            }

            if ($('#agency_contact').length > 0) {
                intTelinput('gc');
                // console.log(inTelinput);
            }

            //tel input end
            //intl-tel-input ************** Start ******************** //
            function intTelinput(key = null, inVal = null) {
                // console.log(key);
                var input = document.querySelector('.phone' + key);
                var errorMsg = document.querySelector('.error_msg' + key);
                var validMsg = document.querySelector('.valid_msg' + key);
                var iti = intlTelInput(input, {
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
                    separateDialCode: true,
                    formatOnDisplay: true,
                    initialCountry: "US",
                    nationalMode: true,
                    hiddenInput: "full_number",
                    autoPlaceholder: "polite",
                    placeholderNumberType: "MOBILE",
                });
                input.nextElementSibling.value = iti.getNumber();
                // iti.setCountry("US");
                // on blur: validate
                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
                input.addEventListener('blur', function() {
                    input.nextElementSibling.value = iti.getNumber();
                    reset();
                    if (input.value.trim()) {
                        if (iti.isValidNumber()) {
                            $('.buttonSumbit').removeAttr('disabled');
                            input.classList.add("is-valid");
                            validMsg.innerHTML = 'The number is valid';
                        } else {
                            $('.buttonSumbit').attr('disabled', 'disabled');
                            input.classList.add("is-invalid");
                            validMsg.innerHTML = '';
                            var errorCode = iti.getValidationError();
                            errorMsg.innerHTML = errorMap[errorCode];
                            errorMsg.classList.remove("hide");
                        }
                    }
                });


                var reset = function() {
                    input.classList.remove("is-invalid");
                    errorMsg.innerHTML = "";
                    errorMsg.classList.add("hide");
                };
            }
            //intl-tel-input ************** End ******************** //

            /// pax append work  start//
            $(document).on('change', '.pax-number', function() {

                        $('.nationality-select2').select2('destroy');

                        var $_val = $(this).val();
                        var agencyVal = $('.select-agency:checked').val();

                        var currentDate = curday('-');
                        var countries = $('#content').data('countries');
                        if (agencyVal == $_val) {
                            var count = 1;
                            var $v_html = `
            <div class="mb-1 appendCount" id="appendCount${count}">
                <div class="row" >
                    <div class="col-md-3 mb-2">
                        <label>Passenger #${count} Full Name </label>
                        <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="Passsenger Name" >
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Email Address </label>
                        <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="Email Address" >
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Contact Number </label>
                        <input type="tel" name="pax[${count}][contact_number]"  data-key="${count}" class="form-control phone phone${count}" >
                        <span class="text-danger error_msg${count}" role="alert"></span>
                        <span class="text-success valid_msg${count}" role="alert"></span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Date Of Birth </label>
                        <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Nationality </label>
                        <select name="pax[${count}][nationality_id]"  class="form-control nationality-select2 nationality-id">
                            <option selected value="" >Select Nationality</option>
                            ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label>Resident In</label>
                        <select name="pax[${count}][resident_in]" class="form-control nationality-select2 resident-id">
                            <option selected value="" >Select Resident</option>
                            ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                        </select>
                        <span class="text-danger" role="alert"></span>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Bedding Preference </label>
                        <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="Bedding Preferences" >
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Dietary Preferences </label>
                        <input type="text" name="pax[${count}][dietary_preferences]" class="form-control" placeholder="Dietary Preferences" >
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Medical Requirements</label>
                        <input type="text" name="pax[${count}][medical_requirement]" class="form-control" placeholder="Medical Requirements">
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Up To Date Covid Vaccination Status </label>
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="1" > Yes &nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="0" checked> No &nbsp;&nbsp;
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pax[${count}][covid_vaccinated]" class="covid-vaccinated" value="2" > Not Sure
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>`;

            // console.log($v_html);

            $('#appendPaxName').html($v_html);
            intTelinput(1);
            $('#pax_no option').first().attr('disabled', 'disabled');

        }
        if($_val > $('.appendCount').length){
            var countable = ($_val - $('.appendCount').length) - 1;
            if(agencyVal == 1){
                var countable = ($_val - $('.appendCount').length);
            }


            for (i = 1; i <= countable; ++i) {
                var count = $('.appendCount').length + 1;
                var c = count + 1;

                if(agencyVal == 1){
                    c = count;
                }
                const $_html = `
                        <div class="mb-1 appendCount" id="appendCount${count}">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="remove-pax-column btn btn-sm btn-dark float-right"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </div>
                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="mainLabel">Passenger #${c} Full Name</label>
                                        <input type="text" name="pax[${count}][full_name]" class="form-control" placeholder="Passsenger Name">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="pax[${count}][email_address]" class="form-control" placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="tel" name="pax[${count}][contact_number]" data-key="${count}" class="form-control phone phone${count}">
                                        <span class="text-danger error_msg${count}" role="alert"></span>
                                        <span class="text-success valid_msg${count}" role="alert"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input type="date" max="{{ date('Y-m-d') }}" name="pax[${count}][date_of_birth]" class="form-control" placeholder="Date Of Birth">
                                    </div>
                                </div>
            
                                <div class="col-md-3">
                                    <label>Nationality</label>
                                    <select name="pax[${count}][nationality_id]" class="form-control nationality-select2 nationality-id">
                                        <option selected value="" >Select Nationality</option>
                                        ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Resident In</label>
                                        <select name="pax[${count}][resident_in]" class="form-control nationality-select2 resident-id">
                                            <option selected value="" >Select Resident</option>
                                            ${countries.map(co => `<option value="${co.id}" >${co.name}</option>`).join("")}
                                        </select>
                                        <span class="text-danger" role="alert"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bedding Preference</label>
                                        <input type="text" name="pax[${count}][bedding_preference]" class="form-control" placeholder="Bedding Preferences" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dietary Preferences</label>
                                        <input type="text" name="pax[${count}][dietary_preferences]" class="form-control" placeholder="Dietary Preferences" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Medical Requirements</label>
                                        <input type="text" name="pax[${count}][medical_requirement]" class="form-control" placeholder="Medical Requirements">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Up To Date Covid Vaccination Status </label>
                                        <div>
                                            <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_yes_${count}" class="covid-vaccinated" value="1">
                                            <label class="radio-inline mr-half" for="pax_cv_yes_${count}">Yes</label>

                                            <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_no_${count}" class="covid-vaccinated" value="0" checked>
                                            <label class="radio-inline mr-half" for="pax_cv_no_${count}">No</label>

                                            <input type="radio" name="pax[${count}][covid_vaccinated]" id="pax_cv_not_sure_${count}" class="covid-vaccinated" value="2">
                                            <label class="radio-inline mr-half" for="pax_cv_not_sure_${count}">Not Sure</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        $('#appendPaxName').append($_html);
                        intTelinput(count);
            }
        }else{
            if(agencyVal != $_val){
                var countable = $('.appendCount').length + 1;
                for (var i = countable - 1; i >= $_val; i--) {
                    $("#appendCount"+i).remove();
                }
            }
        }
        $('.nationality-select2').select2({
            width: '100%',
            theme: "bootstrap",
        });
        getBookingAmountPerPerson();
    });

    $(document).on('click', '.add-pax-column', function () {
        var pax_value = $('#pax_no').val();
        var updateCount = (pax_value != '')? parseInt(pax_value) + 1 : 1;
        if (isNaN(updateCount)) {
            $('#pax_no').val(1).change();
        }else{
            $('#pax_no').val(updateCount).change();
        }
    });

    $(document).on('click', '.remove-pax-column', function () {
        var agency_Val =  $('.select-agency:checked').val();
        $(this).closest('.appendCount').remove();
        var pax_value = $('#pax_no').val();
        var updateCount = parseInt(pax_value) - 1;
        $('#pax_no').val(updateCount).change();

        var ids = [];
        $('.appendCount').each(function(){
            ids.push($(this).attr('id'));
        });
        let _val  = 2
        let idLength = ids.length + _val;
        if(agency_Val == 1){
            _val = 1
            idLength = ids.length + _val;
        }
        for (let i = 0; i <= ids.length; i++) {
            var count = 2 + i;
            if(agency_Val == 1){
                count = 1 + i;
            }
            $('#'+ids[i]).find('.mainLabel').text('Passenger #'+count+' Full Name');
        }
    });
    //pax appednd work end

    var btnname = null;
    //BUlk DATA DELETE
    $('.btnbulkClick').on('click', function (e) {
        btnname = $(this).attr('name');
    })

    $(".bulk-action").submit(function(e) {

        e.preventDefault();

        var url            = $(this).attr('action');
        var checkedValues  = $('.child:checked').map((i, e) => e.value ).get();
        var formData       = $(this).serializeArray();
        var message        = '';

        formData.push({name:'id', value: checkedValues});
        formData.push({name:'btn', value: btnname});

        switch(btnname) {
            case "archive":
                message = 'Are you sure you want to Archive Quotes?'
                break;
            case "unarchive":
                message = 'Are you sure you want to Revert Quotes from Archive?'
                break;
            case "quote":
                message = 'Are you sure you want to Revert Cancelled Quotes?';
                break;
            case "cancel":
                message = 'Are you sure you want to Cancel Quotes?';
        }

        if(checkedValues.length > 0){
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                confirmButtonColor: '#5cb85c',
                cancelButtonText: 'No',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: url,
                        data: $.param(formData),
                        success: function(data)
                        {
                            setTimeout(function() {
                                alert(data.message);
                                location.reload();
                            }, 600);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    ///no action here
                }
            })
        }else{
            alert('Please Check any Record First');
        }
    });

    /// Update Currency Status
    $("#currencyStatus").submit(function(e) {
        e.preventDefault();
        // console.log('run');
        var url = $(this).attr('action');
        var checkedValues  =  $('.child:checked').map((i, e) => e.value ).get();
        var formData = $(this).serializeArray();
        formData.push({name:'id', value: checkedValues});
        formData.push({name:'btn', value: btnname});
        var message = 'Are you sure you want to inactive this records?'
        if(btnname == 'active'){
            message = 'Are you sure you want to active this records?'
        }
        if(checkedValues.length > 0){
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Yes, '+btnname+' it!',
                confirmButtonColor: '#5cb85c',
                cancelButtonText: 'No, keep it',
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $.param(formData),
                        success: function(data)
                        {
                            setTimeout(function() {
                                alert(data.message);
                                location.reload();
                            }, 600);
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    ///no action here
                }
            })
        }else{
            alert('Please Check any Record First');
        }
    });
    /// Update Currency Status
    //BUlk DATA DELETE

    ///////////////// RELEVANT QUOTE FIELD

    $('#cloneRelevantquote').on('click', function() {
    $('.relevant-quote').eq(0).clone().find("input").val("") .each(function(){
                    this.name = this.name.replace(/\[(\d+)\]/, function(){
                        return '[' + ($('.quote').length) + ']';
                    });
                    this.id = this.id.replace(/\d+/g, $('.quote').length, function(){
                        return 'quote_' + parseInt($('.quote').length) + '_' + $(this).attr("data-name")
                    });
                }).end().show().insertAfter(".relevant-quote:last");
    });
    ///////////////// RELEVANT QUOTE FIELD


//////////// quote media modal close
$(document).on('click', '.QuotemediaModalClose', function () {
    $(this).closest('.modal-body').children('.input-group').find('input').val("");
    $(this).closest('.modal-body').children('.previewId').find('img').remove();
    jQuery('.modal').modal('hide');
});

// remove image work
$(document).on('click', '.remove-img', function () {

    console.log('sadas');
    // $('#previewId').html(`<img src="" class="img-fluid"></img>`);
    $(this).closest('.modal-body').children('.input-group').find('input').val("");
    $(this).parent().html(`<img src="" class="img-fluid">`);


    // console.log($(this).closest('.modal-body').find('.image').html());
});

// $(document).on('click', '#add_storeText', function () {
//     var x = document.getElementById("storedText");
//     if (x.style.display === "none") {
//         x.style.display = "block";
//         $('#selectstoretext').removeAttr('disabled');
//         console.log('show');
//         $(this).text('x Remove Stored Text')
//     } else {
//         console.log('hide');

//         x.style.display = "none";
//         $(this).text('+ Add Stored Text')
//         $('#selectstoretext').attr('disabled', true);

//     }
// })


//////////// quote media modal close

////////////////////// Stored Text

$(document).on('change', '.selectStoredText', function() {

    var slug = $(this).val();
    var quote = jQuery(this).closest('.quote');
    var key = quote.data('key');
    $.ajax({
        url: `${BASEURL}stored/${slug}/text`,
        type: 'get',
        dataType: "json",
        success: function(data) {
            console.log(key);
            var id ='#quote_'+key+'_stored_text';
            setTextEditorValue(id, data);
        },
        error: function(reject) {
            alert(reject);
        },
    });

});

$(document).on('click', '.addmodalforquote', function() {

    var quote = $(this).closest('.quote');
    var key = quote.data('key');
    var target = '.'+$(this).data('show');
    // console.log(target);
    quote.find(target).modal('show');
    quote.find(target+':input').removeAttr('disabled');
    // jQuery('#accomadation_modal').modal('show').find('input').val('');
});

/////////////////// Stored Text End

});

// CreateGroupQuote //
    var checkedQuoteValues = null;
    window.Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2200,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    //Create group quote
    $('.createGroupQuote').on('click', function (e) {
        checkedQuoteValues = $('.child:checked').map((i, e) => e.value ).get();

        /*console.log(checkedQuoteValues);
        return false;*/
        if(checkedQuoteValues.length > 1){
            jQuery('#group-quote-modal').modal('show');
        }else{
            alert('Please check atleat two records.');
        }
    });

    $(".create-group-quote").submit(function(e) {
        e.preventDefault();

        var url            = $(this).attr('action');
        /*var formData       = $(this).serializeArray();
        formData.push({name:'quote_ids', value: checkedQuoteValues});*/

        $.ajax({
            type: "POST",
            url: url,
            // data: $.param(formData),
            data: [$(this).serialize(),$.param({quote_ids: checkedQuoteValues})].join('&'),
            success: function(data)
            {
                // console.log(data);
                // return false;
                if(data.status) {
                    jQuery('#group-quote-modal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function(){
                        window.location.href = data.redirect;
                    }, 2800);

                } else {
                    new Swal(data.type, data.msg, data.icon);
                }
            }
        });
    });

$(".add-new-group-quote").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (data) {
            if (data.status) {
                Toast.fire({
                    icon: 'success',
                    title: data.msg
                });
                setTimeout(function () {
                    window.location.href = data.redirect;
                }, 2800);

            } else {
                new Swal(data.type, data.msg, data.icon);
            }
        }
    });
});


    // $(document).ready(function() {
    //    setTimeout(function() {
    //        jQuery('.alert-success').fadeOut(1500);
    //        jQuery('.alert-danger').fadeOut(1500);
    //     }, 3000);
    //     $('.booking-currency-id').on('change', function() {
    //         let url = $('#routeForGroups').val() + '/' + $(this).val();

    //         console.log(url);

    //         $.ajax({
    //             type: "GET",
    //             url: url,
    //             success:function(response) {
    //                 if(response.status) {
    //                     $('.dynamic-group').empty();
    //                     $.each(response.groups, function(value, key) {
    //                         $('.dynamic-group').append($("<option></option>").attr("value", key.id).text(key.name));
    //                     });
    //                     $('.dynamic-group').select2();
    //                 }
    //             }
    //         });
    //     });
    // });
