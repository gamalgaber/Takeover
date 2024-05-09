@extends('admin.layouts.master')


@section('content')
<div class=" container my-form py-3 ">

    <div class="row  ">
        <h2>Loading Photo Information</h2>
        <div class="pt-3">
            <button class="btn my_btn" id="create_btn"><a href="{{route('admin.Loading-photo.create')}}" class="text-white">Create New</a></button>
        </div>
        <div class=" p-3 col-12 bg-white">
            <table id="myTable" class="table table-striped nowrap custom-table w-100">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loadingPhotos as $loadingPhoto)
                    <tr>
                        <td>
                            {{$loadingPhoto->id}}
                        </td>
                        <td>
                            <img src="{{asset($loadingPhoto->banner)}}" >
                        </td>
                        <td>
                            {{$loadingPhoto->title}}
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                @if ($loadingPhoto->status == 1)
                                <input class="form-check-input change-status" data-id="{{$loadingPhoto->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                @else
                                <input class="form-check-input change-status" data-id="{{$loadingPhoto->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class=" d-flex gap-1 flex-column flex-md-row">
                                <button class="btn my_btn" id="view_btn"><a href="{{route('admin.Loading-photo.edit',$loadingPhoto->id)}}"class=" text-white">Edit</a></button>
                                <form action="{{ route('admin.Loading-photo.destroy',$loadingPhoto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn my_btn">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        new Datatable('#myTable',{
            rowReader: {
                selector: 'td:nth-child(2)',
                responsive: true
            },
        })
    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');

                    $.ajax({
                        url: "{{ route('admin.Loading-photo.change-status') }}",
                        method: 'PUT',
                        data: {
                            status: isChecked,
                            id: id
                        },
                        success: function(data) {
                            toastr.success(data.message)
                        },
                        error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                    })
                })
        })
    </script>
@endpush
@endsection
