@extends('admin.layouts.master')


@section('content')
    <div class="container py-3 px-4 ">
        <h2>Image Gallery</h2>
        <div class="row bg-white p-2 bg-opacity-75 col-11 col-md-12 col-lg-12 shadow-lg ">
            <h6>Product: {{ $product->name }}</h6>
            <div class="px-1  " id="div_2">
                <div class=" d-flex flex-column  justify-content-center align-content-center ">
                    <form action="{{ route('admin.product-image-gallery.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="prodcut_input d-flex flex-column">
                            <div>
                                <label for="">Image <code>(Multiple image supported!)</code></label>
                                <input type="file" name="image[]" id="" multiple>
                                <input type="hidden" value="{{ $product->id }}" name="product">
                            </div>
                            <div class="pt-3">
                                <button class="btn my_btn " id="create_btn">Upload</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <div  class="row bg-white p-2 bg-opacity-75 col-9 col-md-12 col-lg-12 shadow-lg mt-2 table-responsive ">
                    <table id="myTable" class="table table-striped nowrap custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productImages as $image)
                    <tr>
                        <td>
                            {{$image->id}}
                        </td>
                        <td>
                            <img src="{{asset($image->image)}}" alt="">
                        </td>
                        <td>
                            <form action="{{ route('admin.product-image-gallery.destroy', $image->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn my_btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    @push('scripts')
        <script>
            new Datatable('#myTable',{
                rowReader: {

                    responsive: true
                },
            })
        </script>
    @endpush
@endsection
