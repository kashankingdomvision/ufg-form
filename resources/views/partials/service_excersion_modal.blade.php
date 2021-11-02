<div class="modal fade service-excursion_modal">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Service Excursion Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>Name</label>
            <input type="text" name="quote[{{ $key }}][category_detials][service_excursion][name]" value="{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->name) ? $booking_detail->getServiceExcussionDetials->name : '' }}" class="form-control arrival-date hide-arrows" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->name) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Service</label>
            <input type="text" name="quote[{{ $key }}][category_detials][service_excursion][description]" value="{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->description) ? $booking_detail->getServiceExcussionDetials->description : '' }}" class="form-control accomadation-name" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->description) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Date</label>
            <input type="date" name="quote[{{ $key }}][category_detials][service_excursion][date]" value="{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->date) ? $booking_detail->getServiceExcussionDetials->date : '' }}" class="form-control arrival-date hide-arrows" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->date) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>
       
          <div class="form-group">
            <label>Time </label>
            <input type="time" name="quote[{{ $key }}][category_detials][service_excursion][time]" value="{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->time) ? $booking_detail->getServiceExcussionDetials->time : '' }}" class="form-control pickup-accomodation" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->time) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Pax </label>
            <input type="number" name="quote[{{ $key }}][category_detials][service_excursion][quantity]" value="{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->quantity) ? $booking_detail->getServiceExcussionDetials->quantity : '' }}" class="form-control quantity" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->quantity) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Reference </label>
            <input type="text" name="quote[{{ $key }}][category_detials][service_excursion][refrence]" value="{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->refrence) ? $booking_detail->getServiceExcussionDetials->refrence : '' }}" class="form-control room-types hide-arrows" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->refrence) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Confirmed With Supplier </label>
            <div>
              <label class="radio-inline">
                <input {{ (isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->confirmed_with_supplier) && $booking_detail->getServiceExcussionDetials->confirmed_with_supplier ==  1) ? 'checked' : '' }}  value="1" type="radio" name="quote[{{ $key }}][category_detials][service_excursion][confirmed_with_supplier]" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->confirmed_with_supplier) ? 'disabled' : '' }}> Yes
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->confirmed_with_supplier) && $booking_detail->getServiceExcussionDetials->confirmed_with_supplier ==  0 ) ? 'checked' : '' }}  value="0" type="radio" name="quote[{{ $key }}][category_detials][service_excursion][confirmed_with_supplier]" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->confirmed_with_supplier) ? 'disabled' : '' }} > No
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->confirmed_with_supplier) && $booking_detail->getServiceExcussionDetials->confirmed_with_supplier ==  2 ) ? 'checked' : '' }}  value="2" type="radio" name="quote[{{ $key }}][category_detials][service_excursion][confirmed_with_supplier]"  {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->confirmed_with_supplier) ? 'disabled' : '' }}> N/A
              </label>
            </div>
          </div>

          <div class="form-group">
            <label>Note </label>
            <textarea type="text" name="quote[{{ $key }}][category_detials][service_excursion][note]" class="form-control room-types hide-arrows" {{ !isset($booking_detail->getServiceExcussionDetials) && !isset($booking_detail->getServiceExcussionDetials->note) ? 'disabled' : '' }}>{{ isset($booking_detail->getServiceExcussionDetials) && isset($booking_detail->getServiceExcussionDetials->note) ? $booking_detail->getServiceExcussionDetials->note : '' }}</textarea>
            <span class="text-danger" role="alert"></span>
          </div>
          
        </div>
  

        <div class="modal-footer justify-content-right">
          <button class="btn btn-primary" type="button" data-dismiss="modal">
            <span class="mr-2 " role="status" aria-hidden="true"></span>
            Submit
          </button>

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>

  </div>