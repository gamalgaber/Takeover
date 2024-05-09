@extends('admin.layouts.master')


@section('content')
<div class=" container my-form py-3  ">

    <div class="row  ">
        <h2>Shipping Information</h2>
        <div class=" p-3 col-9 col-md-12 table-responsive">
            <table id="myTable" class="table table-striped nowrap custom-table w-75">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippings as $shipping)
                    <tr>
                        <td>
                            {{$shipping->id}}
                        </td>
                        <td>
                            {{$shipping->name}}
                        </td>
                        <td>
                            {{$shipping->cost}}
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                @if ($shipping->status == 1)
                                <input class="form-check-input change-status" data-id="{{$shipping->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                @else
                                <input class="form-check-input change-status" data-id="{{$shipping->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class=" d-flex gap-1 flex-column flex-md-row">
                                <button class="btn my_btn" id="view_btn"><a href="{{route('admin.shipping.edit', $shipping->id)}}"class=" text-white">Edit</a></button>
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
                    url:"{{route('admin.shipping.change-status')}}",
                    method:'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr,status,error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
@endsection
