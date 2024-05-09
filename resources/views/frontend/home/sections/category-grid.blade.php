<section class="section-container bg-light mt-5">
    <h2 class="collection__text--main text-center pt-2 pb-4">Categories</h2>
    <div class="box-container">
        @foreach ($categories as $category)
        <div class="box">
            <a href="{{route('collections', ['category'=>$category->slug])}}" class="d-block position-relative">
                <img src="{{ asset($category->image) }}" alt="" class="img-fluid">
                <span class="position-absolute start-50 translate-middle ">{{$category->name}}</span>
            </a>
        </div>
        @endforeach
    </div>
</section>
