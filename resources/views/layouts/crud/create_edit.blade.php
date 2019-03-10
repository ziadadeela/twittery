@extends('layouts.master')

@section('css')
@endsection

@section('title', $title_singular)

@section('js')
    <script src="{{ Theme::asset('global/plugins/colorpicker/spectrum.min.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ Settings::get("google_address_api_key") }}&libraries=places"></script>

    <script>
        function initAddressAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            let addressAutoCompleteElements = document.querySelectorAll('.address-autocomplete');

            addressAutoCompleteElements.forEach(function (element) {
                let id = element.getAttribute('id');

                let autoCompleteField = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */
                    (element),
                    {
                        types: ['(regions)'],
                        componentRestrictions: {country: 'us'}
                    });

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                google.maps.event.addListener(autoCompleteField, 'place_changed', function () {
                    fillInAddress.call(autoCompleteField, id)
                });
            });
        }

        function fillInAddress(id) {
            let addressComponentForm = {
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                administrative_area_level_2: 'long_name',
                country: 'short_name',
                postal_code: 'short_name'
            };

            let place = this.getPlace();

            for (let component in addressComponentForm) {
                if (!$('#' + id + '_' + component).length) {
                    continue;
                }

                document.getElementById(id + '_' + component).value = '';
                document.getElementById(id + '_' + component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (let i = 0; i < place.address_components.length; i++) {

                let addressType = place.address_components[i].types[0];

                if (addressComponentForm[addressType]) {
                    let val = place.address_components[i][addressComponentForm[addressType]];
                    if (addressType === 'administrative_area_level_1' && $("#" + id + "_administrative_area_level_1").length) {
                        $("#" + id + "_administrative_area_level_1").val(val).trigger("change");
                    } else if (addressType === 'country' && $("#" + id + "_country").length) {
                        $("#" + id + "_country").val(val).trigger("change");
                    } else if ($('#' + id + "_" + addressType).length) {
                        document.getElementById(id + "_" + addressType).value = val;
                    }
                }
            }
        }

        function stopAddressEnterKey(event) {
            if ((event.keyCode === 13) && event.target && $(event.target).hasClass('address-autocomplete')) {
                return false;
            }
        }

        document.onkeypress = stopAddressEnterKey;

        google.maps.event.addDomListener(window, 'load', initAddressAutocomplete);
    </script>
@endsection
