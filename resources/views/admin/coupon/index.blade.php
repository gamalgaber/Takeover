@extends('admin.layouts.master')


@section('content')
<div class=" container my-form py-3 ">

    <div class="row  ">
        <h2>Coupons Information</h2>
        <div class="pt-3">
            <button class="btn my_btn" id="create_btn"><a href="{{route('admin.coupon.create')}}" class="text-white">Create New</a></button>
        </div>
        <div class=" p-3 col-12  bg-white ">
            <table id="myTable" class="table table-striped nowrap custom-table w-100">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Discount Type</th>
                        <th>Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                    <tr>
                        <td>
                            {{$coupon->id}}
                        </td>
                        <td>
                            {{$coupon->name}}
                        </td>
                        <td>
                            {{$coupon->code}}
                        </td>
                        <td>
                            {{$coupon->discount_type}}
                        </td>
                        <td>
                            {{$coupon->discount}}
                        </td>
                        <td>
                            {{$coupon->start_date}}
                        </td>
                        <td>
                            {{$coupon->end_date}}
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                @if ($coupon->status == 1)
                                <input class="form-check-input change-status" data-id="{{$coupon->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                @else
                                <input class="form-check-input change-status" data-id="{{$coupon->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class=" d-flex gap-1 flex-column flex-md-row">
                                <button class="btn my_btn" id="view_btn"><a href="{{route('admin.coupon.edit', $coupon->id)}}"class=" text-white">Edit</a></button>
                                <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST">
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
<script src="{{ asset('Backend/assets/icons/all.min.js') }}"></script>
<script src="{{asset('Backend/vendors/jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('Backend/vendors/jquery/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/vendors/dataTables/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('Backend/vendors/dataTables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('Backend/vendors/dataTables/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('Backend/vendors/bootstrap.min.js')}}"></script>
<script src="{{asset('Backend/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('Backend/assets/js/script.js') }}"></script>


    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#myTable').DataTable({
                responsive: true
            });
            $('body').on('click','.change-status',function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url:"{{route('admin.coupon.change-status')}}",
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
