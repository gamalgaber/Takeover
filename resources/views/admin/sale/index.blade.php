@extends('admin.layouts.master')

@section('content')
    <div class=" container py-3 px-3 ">

        <div class="row">
            <h2>Sale</h2>
            <div class="col-11 col-md-12  p-1  ">
                <div class=" d-flex flex-column ">
                    <div class="prodcut_input col-10 col-md-12 col-lg-12  d-flex flex-column gap-3">
                        <div class="d-flex flex-column flex-md-row  p-3 bg-white shadow-lg">
                            <form action="{{ route('admin.sale.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="">Sale End Date:</label>
                                    <input type="date" name="end_date" id="" class="w-100 w-md-auto" value="{{$sale->end_date}}">
                                    <button class="btn my_btn my-2">Save</button>
                                </div>
                            </form>
                        </div>

                        <div class="bg-white p-3 shadow-lg">
                            <form action="{{ route('admin.sale.add-product') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="">Add Product:</label>
                                    <div class="form-floating">
                                        <select name="product" id="" class=" form-select">
                                            <option value="">Select</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" d-flex flex-column flex-md-row gap-md-5">
                                    <div class="w-50">
                                        <label for="">Show At Home?:</label>
                                        <div class="form-floating">
                                            <select name="show_at_home" id="" class=" form-select">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="w-50">
                                        <label for="">Status:</label>
                                        <div class="form-floating">
                                            <select name="status" id="" class=" form-select">
                                                <option value="">Select</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn my_btn w-auto ">Save</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table--->
                <div class=" py-3  ">
                    <div class="table-responsive">
                        <table class=" table  my-3" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Show AT Home</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saleItems as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><a href="{{route('admin.products.edit', $item->product->id)}}">{{$item->product->name}}</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            @if ($item->show_at_home == 1)
                                            <input class="form-check-input change-at-home" data-id="{{$item->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                            @else
                                            <input class="form-check-input change-at-home" data-id="{{$item->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                            @endif
                                        </div>
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
                                        <div class=" d-flex gap-1  flex-md-row">
                                            <form action="{{ route('admin.sale.destroy',$item->id) }}" method="POST">
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
                    url:"{{route('admin.sale.change-status')}}",
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

            /*Change show at home*/
            $('body').on('click', '.change-at-home', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.sale.show-at-home') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
    @endsection
