<div class="header {{ (isset($url)) ? 'bg-gradient-default' : 'bg-gradient-primary' }} pb-8 pt-5 pt-md-8"
     @isset($url)
     style="background-image: url({{ $url }})!important;
             background-size: cover!important;
             background-position: center top!important;
             "
    @endisset
>
    @isset($url)
    <span class="mask bg-gradient-default opacity-8"></span>
    @endisset
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-2 text-white">{{ $title }}</h1>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-5">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>