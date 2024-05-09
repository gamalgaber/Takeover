@extends('admin.layouts.master')


@section('content')
    <div class="container   ">
        <div class="row py-3 px-3">
            <h2>Categroy</h2>

            <div class="d-flex flex-column row">
                <div class=" p-5 col-12 col-md-12  bg-white  shadow-lg categ-section ">
                    <div class="pt-3">
                        <button class="btn my_btn" id="create_btn"><a href="{{ route('admin.category.create') }}"
                                class="text-white">Create New</a></button>
                    </div>
                    <div class=" table-responsive">
                        <table class="table table-striped nowrap custom-table w-100 ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->id }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            <img style="width: 200px; height:200px; " src=" {{ asset($category->image) }}">
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                @if ($category->status == 1)
                                                    <input class="form-check-input change-status"
                                                        data-id="{{ $category->id }}" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked" checked>
                                                @else
                                                    <input class="form-check-input change-status"
                                                        data-id="{{ $category->id }}" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" d-flex gap-1 flex-column flex-md-row">
                                                <button class="btn my_btn" id="view_btn"> <a
                                                        href="{{ route('admin.category.edit', $category->id) }}"
                                                        class=" text-white">Edit</a></button>
                                                <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                    method="POST">
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
        </div>

        @push('scripts')
            <script>
                new Datatable('#myTable', {
                    rowReader: {
                        selector: 'td:nth-child(2)',
                        responsive: true
                    },
                })
            </script>
            <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });



                    $('body').on('click', '.change-status', function() {
                        let isChecked = $(this).is(':checked');
                        let id = $(this).data('id');

                        $.ajax({
                            url: "{{ route('admin.category.change-status') }}",
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
