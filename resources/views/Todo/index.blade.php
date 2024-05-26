@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- validation error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- validation error -->
        <!--  error message -->
        @include('Todo.procted.massage')
        <!--  error message -->

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4 d-flex justify-content-between">
                    <div class="card-header  ">
                   <h5>  complite : {{ $complete }}</h5>
                   <h5>  incomplete : {{ $incomplete }}</h5>

                    </div>
                </div>

                </div>
                <div class="card">
                    <div class="card-header  d-flex justify-content-between">{{ __('Todo List') }}
                        <div class="card_btn">
                            <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                               data-bs-target="#staticBackdrop">Add Todo</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($todos as $key => $data)
                                <tr id="{{$data->id}}">
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->description ?? 'N/A'}}</td>
                                    <td> <a href="{{route('todo.status', $data->id)}}" class="btn btn-{{($data->status == 1 ? 'success' : 'danger')}}">{{($data->status == 1 ? 'Complete' : 'Pending')}}</a> </td>
                                    <td data-id="{{$data->id}}">
                                        <form method="post" action="{{route('todo.destroy', $data->id)}}">
                                            @csrf
                                            @method('delete')
                                        <button type="button" class="btn btn-primary edit-btn" id="edit"    data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop1"> Edit</button>
                                        <button type="submit" class="btn btn-danger" >Delete</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('Todo.procted.model')
    @include('Todo.procted.Edit')

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('click', '#edit', function () {
                    var id = $(this).closest('tr').attr('id');
                    $.ajax({
                        type: "GET",
                        url: "{{route('todo.edit', ':id')}}".replace(':id', id),
                        success: function (response) {
                            console.log(response);
                            $('#edit_title').val(response.title);
                            $('#edit_description').val(response.description);
                            $('#id').val(response.id);
                            $("#form_update").attr("action", "{{route('todo.update', ':id')}}".replace(':id', id));

                        }
                    });
                });

            });


            // });
        </script>
    @endsection


@endsection
