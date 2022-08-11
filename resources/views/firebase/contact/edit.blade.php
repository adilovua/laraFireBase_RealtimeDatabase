@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4> Edit contact
                            <a href="{{ url('contacts') }}" class="btn btn-sm btn-danger float-end"> Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-contact/'.$id) }} " method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $contact['first_name']  }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $contact['last_name']  }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Phone number:</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $contact['phone_number']  }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>E-mail:</label>
                                <input type="e-mail" name="email" class="form-control" value="{{ $contact['email']  }}">
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
