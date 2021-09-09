<div class="modal fade accommodation_modal">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Accomadation Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          {{-- <div class="form-group">
            <label>Accomadation Name </label>
            <input type="text" name="quote[{{ $key }}][category_detials][accommodation][accomadation_name]" value="{{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->accomadation_name) ? $booking_detail->getAccomodationDetials->accomadation_name : '' }}" class="form-control accomadation-name" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->accomadation_name) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div> --}}

          <div class="form-group">
            <label>Arrival Date </label>
            <input type="date" name="quote[{{ $key }}][category_detials][accommodation][arrival_date]" value="{{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->arrival_date) ? $booking_detail->getAccomodationDetials->arrival_date : '' }}" class="form-control arrival-date hide-arrows" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->arrival_date) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>
       
  
          <div class="form-group">
            <label>No. of Nights </label>
            <input type="number" name="quote[{{ $key }}][category_detials][accommodation][no_of_nights]" value="{{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->no_of_nights) ? $booking_detail->getAccomodationDetials->no_of_nights : '' }}" class="form-control no-of-nights hide-arrows" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->no_of_nights) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

            
          <div class="form-group">
            <label>No. of Rooms </label>
            <input type="number" name="quote[{{ $key }}][category_detials][accommodation][no_of_rooms]" value="{{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->no_of_rooms) ? $booking_detail->getAccomodationDetials->no_of_rooms : '' }}" class="form-control no-of-rooms hide-arrows" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->no_of_rooms) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Room Types </label>
            <input type="text" name="quote[{{ $key }}][category_detials][accommodation][room_types]" value="{{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->room_types) ? $booking_detail->getAccomodationDetials->room_types : '' }}" class="form-control room-types hide-arrows" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->room_types) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Meal Plan </label>
            <select name="quote[{{ $key }}][category_detials][accommodation][meal_plan]" class="form-control meal-plan select2single" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->room_types) ? 'disabled' : '' }}>
              <option value="">Select Meal Plan</option>
              <option value="All Inclusive" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "All Inclusive" ? 'selected' : '' }}>AI - All Inclusive</option>
              <option value="All meals as stated" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "All meals as stated" ? 'selected' : '' }}>AMS - All meals as stated</option>
              <option value="Bed Breakfast" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "Bed Breakfast" ? 'selected' : '' }}>BB - Bed Breakfast</option>
              <option value="Full Board" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "Full Board" ? 'selected' : '' }}>FB - Full Board</option>
              <option value="Half Board" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "Half Board" ? 'selected' : '' }}>HB - Half Board</option>
              <option value="Room only" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "Room only" ? 'selected' : '' }}>RO - Room only</option>
              <option value="Self Catering" {{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->meal_plan) && $booking_detail->getAccomodationDetials->meal_plan == "Self Catering" ? 'selected' : '' }} >SC - Self Catering</option>
            </select>
          </div>

          <div class="form-group">
            <label>Reference </label>
            <input type="text" name="quote[{{ $key }}][category_detials][accommodation][refrence]" value="{{ isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->refrence) ? $booking_detail->getAccomodationDetials->refrence : '' }}" class="form-control room-types hide-arrows" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->refrence) ? 'disabled' : '' }}>
            <span class="text-danger" role="alert"></span>
          </div>

          <div class="form-group">
            <label>Day Event? </label>
            <div>
              <label class="radio-inline">
                <input {{ (isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->day_event) && $booking_detail->getAccomodationDetials->day_event ==  1) ? 'checked' : '' }}  value="1" type="radio" name="quote[{{ $key }}][category_detials][accommodation][day_event]" > Yes
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->day_event) && $booking_detail->getAccomodationDetials->day_event ==  0 ) ? 'checked' : '' }}  value="0" type="radio" name="quote[{{ $key }}][category_detials][accommodation][day_event]" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->day_event) ? 'disabled' : '' }}> No
              </label>
            </div>
          </div>

          <div class="form-group">
            <label>Confirmed With Supplier </label>
            <div>
              <label class="radio-inline">
                <input {{ (isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->confirmed_with_supplier) && $booking_detail->getAccomodationDetials->confirmed_with_supplier ==  1) ? 'checked' : '' }}  value="1" type="radio" name="quote[{{ $key }}][category_detials][accommodation][confirmed_with_supplier]" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->confirmed_with_supplier) ? 'disabled' : '' }}> Yes
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->confirmed_with_supplier) && $booking_detail->getAccomodationDetials->confirmed_with_supplier ==  0 ) ? 'checked' : '' }}  value="0" type="radio" name="quote[{{ $key }}][category_detials][accommodation][confirmed_with_supplier]" {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->confirmed_with_supplier) ? 'disabled' : '' }} > No
              </label>
              <label class="radio-inline">
                <input  {{ (isset($booking_detail->getAccomodationDetials) && isset($booking_detail->getAccomodationDetials->confirmed_with_supplier) && $booking_detail->getAccomodationDetials->confirmed_with_supplier ==  2 ) ? 'checked' : '' }}  value="2" type="radio" name="quote[{{ $key }}][category_detials][accommodation][confirmed_with_supplier]"  {{ !isset($booking_detail->getAccomodationDetials) && !isset($booking_detail->getAccomodationDetials->confirmed_with_supplier) ? 'disabled' : '' }}> N/A
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

  </div>