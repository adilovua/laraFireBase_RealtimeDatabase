@extends('firebase.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h4 class="alert alert-warning mb-2">{{ session('status') }}</h4>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h4> Contact list <span style="color:gray;">Total: {{ $total_contacts }} contacts</span>
                            <a href="{{ url('add-contact') }}" class="btn btn-sm btn-primary float-end"> Add contact</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First name</th>
                                    <th>last name</th>
                                    <th>Phone</th>
                                    <th>E-mail</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                                @forelse($contacts as $key=>$item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item['first_name'] }}</td>
                                    <td>{{ $item['last_name'] }}</td>
                                    <td>{{ $item['phone_number'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td><a href="{{ url('edit-contact/'.$key) }}" class="btn btn-sm btn-success">Edit</a></td>
                                    <td>
                                        <form action="{{ url('delete-contact/'.$key) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No Rec found</td>
                                </tr>
                                @endforelse
                            </tbody>
                            </tn>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
