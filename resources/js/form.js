$(document).ready(function() {

    let url = window.location.origin + "/api/getweather/";
    let form = $('#form');
    let token = $('input[name="token"]');
    let city = $('input[name="city"]');
    let tabHead = $('#myTab');
    let tabContent = $('#myTabContent');
    let $tabId = 0;
    let currentCities = [];

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
        return $.inArray(value.toLowerCase(), currentCities);
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
                url: url,
                method: "GET",
                data: {
                    token: token[0].value.toLowerCase(),
                    city: city[0].value.toLowerCase(),
                },
                success: function(response){
                    console.log(JSON.parse(response).name);
                    //Covert response to javascript object.
                    let data = JSON.stringify(response);
                    //Pass data to new tab.
                    populateTabs(JSON.parse(response).name, data);
                    //Add new city to cities list so we could filter out dublicates.
                    currentCities.push(city[0].value.toLowerCase());
                },
                error: function(response){
                    //ToDo error message in the frontend.
                    console.log(response);
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
        tabContent.append('<div class="tab-pane fade" id="tab' + $tabId + '">' + data + '</div>')

        //Activate new tab
        $('#tab' + $tabId).tab('show');
        
        //Used for unique tab naming
        $tabId++;
    
        //Initiate tab event everytime we add new element.
        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    }

});

