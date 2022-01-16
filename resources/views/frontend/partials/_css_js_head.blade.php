<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="{{asset('frontend/echallan/assets/img/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{asset('frontend/echallan/assets/img/favicon.ico')}}" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/sweetalert2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('select2/css/select2.css')}}">
<link rel="stylesheet" href="{{asset('select2/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>@yield('title')</title>

<script src="{{asset('frontend/cdn.jsdelivr.net/npm/popperjs/core/dist/umd/popper.min.js')}}" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('frontend/maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css')}}">
<style>
    .required:after {
        content:" *";
        color: red;
    }
    input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
        color: #fff;
        position: relative;
    }

    input[type="date"]::-webkit-datetime-edit-year-field {
        position: absolute !important;
        border-left: 1px solid #8c8c8c;
        padding: 2px;
        color: #000;
        left: 56px;
    }

    input[type="date"]::-webkit-datetime-edit-month-field {
        position: absolute !important;
        border-left: 1px solid #8c8c8c;
        padding: 2px;
        color: #000;
        left: 26px;
    }


    input[type="date"]::-webkit-datetime-edit-day-field {
        position: absolute !important;
        color: #000;
        padding: 2px;
        left: 4px;

    }
</style>
<script src="{{asset('frontend/ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
<script src="{{asset('frontend/maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/toastr.min.js')}}"></script>
<script src="{{asset('frontend/js/sweetalert2.js')}}"></script>

<script>
    // $(document).ready(function(){
    //     load_json_data('pre_division','0');
    //     load_json_data('per_division','0');

    //     function load_json_data(id, parent_id)
    //     {
    //         var html_code = '';
    //         $.getJSON("{{asset('frontend')}}/file/bangladesh.json", function(data){
    //             if (id=='pre_division' ||id=='per_division' ) {
    //                 html_code += '<option value="">Select Division</option>';
    //             }else if(id=='pre_district' || id=='per_district'){
    //                 html_code += '<option value="">Select District</option>';
    //             }else{
    //                 html_code += '<option value="">Select Upazila</option>';
    //             }

    //             $.each(data, function(key, value){
    //                 if(id == 'pre_division')
    //                 {
    //                     if(value.parent_id == '0')
    //                     {
    //                         html_code += '<option value="'+value.id+'">'+value.name+'</option>';
    //                     }
    //                 }
    //                 else
    //                 {
    //                     if(value.parent_id == parent_id)
    //                     {

    //                         html_code += '<option value="'+value.id+'">'+value.name+'</option>';
    //                     }
    //                 }
    //             });
    //             $('#'+id).html(html_code);
    //         });
    //     }

    //     $(document).on('change', '#pre_division', function(){
    //         var country_id = $(this).val();
    //         if(country_id != '')
    //         {
    //             load_json_data('pre_district', country_id);
    //         }
    //         else
    //         {
    //             $('#pre_district').html('<option value="">Select Division</option>');
    //             $('#pre_upozila').html('<option value="">Select District</option>');
    //         }
    //     });
    //     $(document).on('change', '#pre_district', function(){
    //         var state_id = $(this).val();
    //         if(state_id != '')
    //         {
    //             load_json_data('pre_upozila', state_id);
    //         }
    //         else
    //         {
    //             $('#pre_upozila').html('<option value="">Select Upazila</option>');
    //         }
    //     });

    //     $( "#pre_upozila" ).change(function() {
    //         var selected_pre_division=$("#pre_division option:selected").text();
    //         var selected_pre_district=$("#pre_district option:selected").text();
    //         var selected_pre_upazilla=$("#pre_upozila option:selected").text();
    //         $("#selected_pre_division").val(selected_pre_division);
    //         $("#selected_pre_district").val(selected_pre_district);
    //         $("#selected_pre_upazilla").val(selected_pre_upazilla);
    //     });
    //     $(document).on('change', '#per_division', function(){
    //         var country_id = $(this).val();
    //         if(country_id != '')
    //         {
    //             load_json_data('per_district', country_id);
    //         }
    //         else
    //         {
    //             $('#per_district').html('<option value="">Select Division</option>');
    //             $('#per_upozila').html('<option value="">Select District</option>');
    //         }
    //     });
    //     $(document).on('change', '#per_district', function(){
    //         var state_id = $(this).val();
    //         if(state_id != '')
    //         {
    //             load_json_data('per_upozila', state_id);
    //         }
    //         else
    //         {
    //             $('#per_upozila').html('<option value="">Select Upazila</option>');
    //         }
    //     });

    //     $( "#per_upozila" ).change(function() {
    //         var selected_per_division=$("#per_division option:selected").text();
    //         var selected_per_district=$("#per_district option:selected").text();
    //         var selected_per_upazilla=$("#per_upozila option:selected").text();
    //         $("#selected_per_division").val(selected_per_division);
    //         $("#selected_per_district").val(selected_per_district);
    //         $("#selected_per_upazilla").val(selected_per_upazilla);
    //     });

    //     $("#address_same").click(function(){
    //         if (this.checked == true){
    //             // alert(sel.options[sel.selectedIndex].text);
    //             var vil = $("#pre_village").val();
    //             var road = $("#pre_road").val();
    //             var divis = $("#pre_division option:selected").text();
    //             var dist = $("#pre_district option:selected").text();
    //             var upaz = $("#pre_upozila option:selected").text();
    //             var postc = $("#pre_post_code").val();

    //             $("#per_village").val(vil);
    //             $("#per_road").val(road);
    //             $("#per_division").html('<option value="'+divis+'">'+divis+'</option>');
    //             $("#per_district").html('<option value="'+dist+'">'+dist+'</option>');
    //             $("#per_upozila").html('<option value="'+upaz+'">'+upaz+'</option>');
    //             $("#per_post_code").val(postc);

    //             $("#selected_per_division").val(divis);
    //             $("#selected_per_district").val(dist);
    //             $("#selected_per_upazilla").val(upaz);

    //         }else{
    //             $("#per_village").val('');
    //             $("#per_road").val('');
    //             load_json_data('per_division','0');
    //             $("#per_district").html('<option value="">Select District</option>');
    //             $("#per_upozila").html('<option value="">Select Upazila</option>');
    //             $("#per_post_code").val('');
    //         }
    //     });
    // });

    function validateFileType() {
        var fileInput = document.getElementById('image');
        var filePath = fileInput.value;
        // Allowing file type
        var allowedExtensions = 
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;   
        if (!allowedExtensions.exec(filePath)) {
            alert('Opps! Invalid file type, Only jpg,png,jpeg image file accept');
            fileInput.value = '';
            return false;
        }   
    }


</script>
<script type="text/javascript">
    function change( el )
    {
        if ( el.value === "English" )
            el.value = "Bangla";
        else
            el.value = "English";
    }
</script>

<!--<link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
<link href="/assets/css/jquery-ui.min.css" rel="stylesheet" media="all">
<link href="/assets/css/font-awesome.min.css" rel="stylesheet" media="all">
<link href="/assets/css/animate.min.css" rel="stylesheet" media="all">
<link href="/assets/css/style.css" rel="stylesheet" media="all">
<link href="/assets/css/datatables.min.css" rel="stylesheet" media="all">-->

<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->

<script src="{{asset('frontend/echallan/assets/js/api.min.js')}}"></script>

<!-- Minified style -->
<link href="{{asset('frontend/echallan/assets/css/combined.min.css')}}" rel="stylesheet" media="all">
@yield('stylesheet')