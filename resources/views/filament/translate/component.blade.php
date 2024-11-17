@php

    $iframeForTranslateJsTime = filemtime(public_path()."/js/app/iframe-for-translate.js");
    $resourceClass = $this->getResource();
    $resourceObj = new $resourceClass();
    if(method_exists($resourceObj, 'getTranslatableLocales')){
        $locales = $this->getTranslatableLocales();
    }else{
        $locales = filament('spatie-laravel-translatable')->getDefaultLocales();
    }
    $localesQuery = json_encode($locales);
@endphp
    <div
        ax-load
        ax-load-src="/js/app/iframe-for-translate.js?v={{ $iframeForTranslateJsTime }}"

        x-data="iframeForTranslate({
             appUrl:'{{ config("app.url") }}'
                    }, $wire)"


    >
<livewire:modal-for-translation :record="$record ?? $this->record" :$locales/>
        <?php
        $fileTime = filemtime(AUTOMATIC_TRANSLATION_ROOT_DIR.'/../resources/views/iframe.blade.php');
        ?>

        <iframe src="/admin/iframe?v={{ $fileTime }}&locales={{ $localesQuery }}" id = "iframe-for-translate"
                style="position: fixed; top:0; z-index: -1; width: 100%; height: 100%; opacity:0.00001;"

        ></iframe>

    </div>
