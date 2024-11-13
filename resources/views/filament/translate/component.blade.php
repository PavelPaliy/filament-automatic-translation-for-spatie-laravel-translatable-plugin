@php

    $iframeForTranslateJsTime = filemtime(public_path()."/js/app/iframe-for-translate.js");
@endphp
    <div
        ax-load
        ax-load-src="/js/app/iframe-for-translate.js?v={{ $iframeForTranslateJsTime }}"

        x-data="iframeForTranslate({
             appUrl:'{{ config("app.url") }}'
                    }, $wire)"


    >
<livewire:modal-for-translation :record="$record ?? $this->record"/>
        <?php
        $fileTime = filemtime(AUTOMATIC_TRANSLATION_ROOT_DIR.'/../resources/views/iframe.blade.php');
        ?>

        <iframe src="/admin/iframe?v={{ $fileTime }}" id = "iframe-for-translate"

                style="position: fixed; top:0; z-index: -1; width: 100%; height: 100%; opacity:0.00001;"

        ></iframe>

    </div>
