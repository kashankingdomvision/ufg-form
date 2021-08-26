<div class="modal fade transfer_modal">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Transfer Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Transfer Description </label>
            <input type="text" name="quote[{{ $key }}][category_detials][transfer][transfer_description]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->transfer_description) ? $booking_detail->getTransferDetials->transfer_description : '' }}" class="form-control transfer-description" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->transfer_description) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>
 
          <div class="form-group">
            <label>Quantity </label>
            <input type="number" name="quote[{{ $key }}][category_detials][transfer][quantity]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->quantity) ? $booking_detail->getTransferDetials->quantity : '' }}" class="form-control quantity" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->quantity) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <h4 class="bg-light mb-2 mt-1">Pickup </h4>


          <div class="form-row">
            <div class="form-group col-md-5">
              <label>Port </label>
              <input type="text" name="quote[{{ $key }}][category_detials][transfer][pickup_port]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->pickup_port) ? $booking_detail->getTransferDetials->pickup_port : '' }}" class="form-control quantity" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->pickup_port) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>

            <div class="form-group col-md-2 d-flex justify-content-center">
              OR
            </div>
             
            <div class="form-group col-md-5">
              <label>Accomodation </label>
              <input type="text" name="quote[{{ $key }}][category_detials][transfer][pickup_accomodation]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->pickup_accomodation) ? $booking_detail->getTransferDetials->pickup_accomodation : '' }}" class="form-control pickup-accomodation" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->pickup_accomodation) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-5">
              <label>Date </label>
              <input type="date" name="quote[{{ $key }}][category_detials][transfer][pickup_date]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->pickup_date) ? $booking_detail->getTransferDetials->pickup_date : '' }}" class="form-control quantity" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->pickup_date) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>

            <div class="form-group col-md-2 d-flex justify-content-center">
           
            </div>
             
            <div class="form-group col-md-5">
              <label>Time </label>
              <input type="time" name="quote[{{ $key }}][category_detials][transfer][pickup_time]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->pickup_time) ? $booking_detail->getTransferDetials->pickup_time : '' }}" class="form-control pickup-accomodation" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->pickup_time) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>
          </div>


          <h4 class="bg-light mb-2 mt-1">Drop Off </h4>

          <div class="form-row">
            <div class="form-group col-md-5">
              <label>Port </label>
              <input type="text" name="quote[{{ $key }}][category_detials][transfer][dropoff_port]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->dropoff_port) ? $booking_detail->getTransferDetials->dropoff_port : '' }}" class="form-control quantity" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->dropoff_port) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>

            <div class="form-group col-md-2 d-flex justify-content-center">
              OR
            </div>
             
            <div class="form-group col-md-5">
              <label>Accomodation </label>
              <input type="text" name="quote[{{ $key }}][category_detials][transfer][dropoff_accomodation]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->dropoff_accomodation) ? $booking_detail->getTransferDetials->dropoff_accomodation : '' }}" class="form-control pickup-accomodation" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->dropoff_accomodation) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-5">
              <label>Date </label>
              <input type="date" name="quote[{{ $key }}][category_detials][transfer][dropoff_date]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->dropoff_date) ? $booking_detail->getTransferDetials->dropoff_date : '' }}" class="form-control quantity" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->dropoff_date) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>

            <div class="form-group col-md-2 d-flex justify-content-center">
            </div>
             
            <div class="form-group col-md-5">
              <label>Time </label>
              <input type="time" name="quote[{{ $key }}][category_detials][transfer][dropoff_time]" value="{{ isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->dropoff_time) ? $booking_detail->getTransferDetials->dropoff_time : '' }}" class="form-control pickup-accomodation" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->dropoff_time) ? 'disabled' : '' }}>
              <span class="text-danger" role="alert"></span>
            </div>
          </div>

          {{-- {{ dd($booking_detail->getTransferDetials->confirmed_with_supplier) }} --}}

          <div class="form-group">
            <label>Confirmed With Supplier </label>
            <div>
              <label class="radio-inline">
                <input {{ (isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->confirmed_with_supplier) && $booking_detail->getTransferDetials->confirmed_with_supplier ==  "1") ? 'checked' : '' }}  value="1" type="radio" name="quote[{{ $key }}][category_detials][transfer][confirmed_with_supplier]" {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->confirmed_with_supplier) ? 'disabled' : '' }}> Yes
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->confirmed_with_supplier) && $booking_detail->getTransferDetials->confirmed_with_supplier ==  "0") ? 'checked' : '' }}  value="0" type="radio" name="quote[{{ $key }}][category_detials][transfer][confirmed_with_supplier]"  {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->confirmed_with_supplier) ? 'disabled' : '' }}> No
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getTransferDetials) && isset($booking_detail->getTransferDetials->confirmed_with_supplier) && $booking_detail->getTransferDetials->confirmed_with_supplier ==  "2") ? 'checked' : '' }}  value="2" type="radio" name="quote[{{ $key }}][category_detials][transfer][confirmed_with_supplier]"  {{ !isset($booking_detail->getTransferDetials) && !isset($booking_detail->getTransferDetials->confirmed_with_supplier) ? 'disabled' : '' }}> N/A
              </label>
           
            </div>
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

    <div id="overlay" class=""></div>
  </div>