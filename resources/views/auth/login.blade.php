@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="text-center">Login</h4>
                    </div>
                    <div class="card-body">
                        <form>
                        @csrf
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter email address"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter the password"/>
                            </div>

                            <button type="submit" class="btn btn-dark text-white mt-4" id="login">Login</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function (){
        $('#login').click(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            var token = $("input[name='_token']").val();
            alert(token);
            $.ajax({
                url: 'user_login',
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: token
                },
                success: function(data){
                    if ($.isEmtpyObject(data.error)) {
                        if (data.success){
                            $('#notifDiv').fadeIn();
                            $('#notifDiv').css('background', 'green');
                            $('#notifDiv').text('User logged in successfully');
                            setTimeout(()=>{
                                $('#notifDiv').fadeOut();
                            }, 3000);
                            window.location = "{{ route('mainPage') }};"
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
                }

            });
        });
    });

</script>
@endpush
