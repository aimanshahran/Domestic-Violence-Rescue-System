<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    <i class="fa fa-language" aria-hidden="true"></i>&nbsp;{!! __('nav.switch') !!}
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale != $current_locale)
            <a class="ml-1 underline ml-2 mr-2" style="color: white" href="language/{{ $available_locale }}">
                <span>{{ $locale_name }}</span>
            </a>
        @endif
    @endforeach
</div>
