@extends('admin.layouts.master')


@section('content')
<div class=" container my-form py-3 ">

    <div class="row  ">
        <h2>Home Page Settings</h2>
        <div class=" p-3 col-12 bg-white">
            <table id="myTable" class="table table-striped nowrap custom-table w-100">
                <thead>
                    <tr>
                        <th>Products Title</th>
                        <th>Filter Categories Title</th>
                        <th>Categories Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($homePage as $item)
                    <tr>
                        <td>
                            {{$item->products_title}}
                        </td>
                        <td>
                            {{$item->filter_categories_title}}
                        </td>
                        <td>
                            {{$item->categories_title}}
                        </td>
                        <td>
                            <div class=" d-flex gap-1 flex-column flex-md-row">
                                <button class="btn my_btn" id="view_btn"><a href="{{route('admin.home-page-settings.edit',$item->id)}}"class=" text-white">Edit</a></button>
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
@endpush
@endsection
