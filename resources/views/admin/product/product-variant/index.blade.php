@extends('admin.layouts.master')


@section('content')
    <div class="row container my-form py-3 ">

        <div class=" p-3 col-8 col-md-12 bg-white  ">
            <h2>Product Variant</h2>
            <div class="pt-3">
                <button class="btn my_btn" id="create_btn"><a href="{{route('admin.products.index')}}" class="text-white">Back</a></button>
            </div>
            <div class="pt-3">
                <button class="btn my_btn" id="create_btn"><a href="{{route('admin.product-variants.create', ['product' => $product->id])}}" class="text-white">Create</a></button>
            </div>

            <div class="  ">
                <table id="myTable" class="table table-striped nowrap custom-table w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productVariants as $variant)
                        <tr>
                            <td>
                                {{$variant->id}}
                            </td>
                            <td>
                                {{$variant->name}}
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    @if ($variant->status == 1)
                                    <input class="form-check-input change-status" data-id="{{$variant->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    @else
                                    <input class="form-check-input change-status" data-id="{{$variant->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class=" d-flex gap-1 flex-column flex-md-row">
                                    <button class="btn my_btn" id="view_btn"> <a href="{{route('admin.product-variants.edit', $variant->id)}}"class=" text-white">Edit</a></button>
                                    <form action="{{ route('admin.product-variants.destroy', $variant->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn my_btn">Delete</button>
                                    </form>
                                    <button class="btn my_btn" id="view_btn"> <a href="{{route('admin.product-variant-item.index', ['productId' => request()->product, 'variantId' => $variant->id])}}"class=" text-white">Items</a></button>

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
                        url:"{{route('admin.product-variants.change-status')}}",
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
