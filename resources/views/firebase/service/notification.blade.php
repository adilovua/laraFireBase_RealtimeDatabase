@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if (session('status'))
                    <h4 class="alert alert-success mb-2">{{ session('status') }}</h4>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4> Send notification
                            <a href="{{ url('/') }}" class="btn btn-sm btn-danger float-end"> Main</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('send-notification') }} " method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Title</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Body:</label>
                                <textarea name="body" class="form-control"></textarea>
                            </div>


                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
