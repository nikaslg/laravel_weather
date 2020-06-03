$(document).ready(function() {

    let url = window.location.origin + "/api/getweather/";
    let form = $('#form');
    let token = $('input[name="token"]');
    let city = $('input[name="city"]');
    let tabHead = $('#myTab');
    let tabContent = $('#myTabContent');
    let $tabId = 0;
    let currentCities = [];
    let errorMessage = 'Invalid input, check your api key and city for typos.';

    //Form validator rules for compatability with bootstrap
    jQuery.validator.setDefaults({
        highlight: function(element) {
            jQuery(element).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function(element) {
            jQuery(element).closest('.form-control').removeClass('is-invalid');
        },
        errorElement: 'span',
        errorClass: 'label label-danger',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    jQuery.validator.addMethod("unique", function(value, element) {
        return $.inArray(value.toLowerCase(), currentCities) === -1;
      }, "City already in the list");

    //Set form input validation rules
    form.validate({
        rules: {
            token: {
                required: true,
                minlength: 16,
                maxlength: 34
            },
            city: {
                required: true,
                minlength: 1,
                maxlength: 20,
                unique: true
            }
        },
        //If validation is passed, execute this.
        submitHandler: function() {

            //Ajax call to the backend.
            $.ajax({
                headers: {
                    Accept : "application/json"
                  },
                url: url,
                method: "GET",
                data: {
                    token: token[0].value.toLowerCase(),
                    city: city[0].value.toLowerCase(),
                },
                success: function(response){

                    if(response.code !== 200){
                        printError(response.data.message);
                        return false;
                    };

                    //Pass data to new tab.
                    populateTabs(response.city, response);
                    //Add new city to cities list so we could filter out dublicates.
                    currentCities.push(city[0].value.toLowerCase());
                },
                error: function(response){
                        printError(response.message);
                }
            });

            //Validation plugin doesn't pass event so we use false as a measure to prevent form submission.
            return false;
        }
    });

    function populateTabs(city, data){

        //Create new tab
        tabHead.append('<li class="nav-item"><a class="nav-link" href="#tab' + $tabId + '">' + city + '</a></li>');

        //Create tab content pane
        tabContent.append('<div class="tab-pane fade" id="tab' + $tabId + '"><h6>' + data.city  + '</h6><p>Temperature: ' + data.main.temp + '</p><br><p>Weather ' + data.weather.main + '</p></div>')

        //Initiate tab event everytime we add new element.
        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })

        //Activate new tab
        $('#myTab a[href="#tab' + $tabId + '"]').tab('show');

        //Used for unique tab naming
        $tabId++;
    }

    function printError(message = errorMessage){
        let errorMsgSelector = $('#error-msg');
        errorMsgSelector.html(message);
        errorMsgSelector.removeClass('collapse');
    }



});

