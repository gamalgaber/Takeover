@extends('admin.layouts.master')


@section('content')
    <div class=" container my-form py-3 ">

        <div class="row  ">
            <h2>Variant: {{$variant->name}}</h2>
            <div class="pt-3">
                <button class="btn my_btn" id="create_btn"><a href="{{route('admin.product-variants.index', ['product' => $product->id])}}" class="text-white">Back</a></button>
            </div>
            <div class="pt-3">
                <button class="btn my_btn" id="create_btn"><a href="{{route('admin.product-variant-item.create', ['productId'=>$product->id , 'variantId'=>$variant->id])}}" class="text-white">Create</a></button>
            </div>
            <div class=" p-3 col-12 bg-white">
                <table id="myTable" class="table table-striped nowrap custom-table w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Variant</th>
                            <th>Is_default</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($variantItems as $item)
                        <tr>
                            <td>
                                {{$item->id}}
                            </td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>
                                {{$variant->name}}
                            </td>
                            <td>
                                @if ($item->is_default === 1)
                                <p class=" my_btn  fw-bold delivered text-center rounded-4">Default</p>
                                @elseif ($item->is_default === 0)
                                <p class=" my_btn fw-bold shipped text-center rounded-4">Not Default</p>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    @if ($item->status == 1)
                                    <input class="form-check-input change-status" data-id="{{$item->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    @else
                                    <input class="form-check-input change-status" data-id="{{$item->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class=" d-flex gap-1 flex-column flex-md-row">
                                    <button class="btn my_btn" id="view_btn"> <a href="{{route('admin.product-variant-item.edit', $item->id)}}"class=" text-white">Edit</a></button>
                                    <form action="{{ route('admin.product-variant-item.destroy', $item->id) }}" method="POST">
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


                $('body').on('click','.change-status',function(){
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');

                    $.ajax({
                        url:"{{route('admin.product-variant-item.change-status')}}",
                        method:'PUT',
                        data: {
                            status: isChecked,
                            id: id
                        },
                        success: function(data){
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
