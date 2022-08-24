@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="text-center">R E G I S T R A T I O N</h4>
                    </div>
                    <div class="card-body ">
                        <form>
                        @csrf
                            <div class="form-group">
                                <label for="fname">First name:</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter first name"/>
                            </div>

                            <div class="form-group">
                                <label for="lname">Last name:</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter last name"/>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter email address"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter the password"/>
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm Password:</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm the password"/>
                            </div>

                            <button type="submit" class="btn btn-dark text-white mt-4" id="save_form">Register</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#save_form').on('click', function () {
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            var form = $(this).parents('form');
            $(form).validate({
                rules: {
                    fname:{
                        required: true
                    },
                    lname:{
                        required: true
                    },
                    email:{
                        required: true
                    },
                    password:{
                        required: true,
                        minlength: 6
                    },
                    cpassword:{
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    fname: "First name is required",
                    lname: "Last name is required",
                    email: "Email is required",
                    password: "Password is required",
                    cpassword: {
                        equelTo: "confirm password not matched"
                    },
                },
                highlight: function (element) {
                    $(element).addClass('error');
                },
                submitHandler: function() {
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: 'save_user',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function (data) {
                             if(data.exists) {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background', 'red');
                                $('#notifDiv').text('Email already exists');
                                setTimeout(()=>{
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                             } else if (data.success) {
                                     $('#notifDiv').fadeIn();
                                     $('#notifDiv').css('background', 'green');
                                     $('#notifDiv').text('User registered successfully');
                                     setTimeout(()=>{
                                         $('#notifDiv').fadeOut();
                                     }, 3000);
                                    $('[name="fname"]').val('');
                                    $('[name="lname"]').val('');
                                    $('[name="email"]').val('');
                                    $('[name="password"]').val('');
                                    $('[name="cpassword"]').val('');
                                 }
                                 else {
                                     $('#notifDiv').fadeIn();
                                     $('#notifDiv').css('background', 'red');
                                     $('#notifDiv').text('An error occured. Please try later');
                                     setTimeout(()=>{
                                         $('#notifDiv').fadeOut();
                                     }, 3000);
                                 }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
