@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4> Contact list
                            <a href="{{ url('contacts') }}" class="btn btn-sm btn-danger float-end"> Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('add-contact') }} " method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Phone number:</label>
                                <input type="tel" name="phone_number" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>E-mail:</label>
                                <input type="e-mail" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

