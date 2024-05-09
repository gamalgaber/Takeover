<section class="Landing">
    <div class="position-relative ">
        <div>
            <img src="{{asset($loadingPhoto->banner)}}" alt="LandingPicture" class="img-fluid landing__image" id="image">
        </div>
        <div class="landing__text--position">
            <h1 class="landing__text text-white-50 ">{!!$loadingPhoto->title!!}</h1>
            <a href="{{$loadingPhoto->button_url}}" class="landing__button ">shop now</a>
        </div>
    </div>
</section>
