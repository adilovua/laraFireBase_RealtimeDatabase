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
                                <label for="email">E-mail:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter email address"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter the password"/>
                            </div>

                            <button type="submit" class="btn btn-dark text-white mt-4">Login</button>
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
        alert('Hello there');
    })
</script>
@endpush
