<div>
    {{ $this->mainForm }}
    @if($isFieldsAreTranslating)
        <div class="my-4">
            {{ __("Переведено") }} <span class="percent-of-translated">0%</span>
        </div>
    @endif
    <div class="my-4">
        <x-filament::button
            wire:click="translate"
            color="primary"
        >
            {{ __("automatic-translation::forms.fields.submit") }}
        </x-filament::button>
    </div>

    @script
    <script>
        const appUrl  = '{{ env("APP_URL") }}';
        Livewire.on('request_for_translation', (e) => {
            let iframeForTranslate = document.getElementById("iframe-for-translate")
            iframeForTranslate.style.width = "100%";
            iframeForTranslate.style.height = "100%";
            iframeForTranslate.contentWindow.postMessage(JSON.stringify({
                dataType:"dataForTranslate",
                dataForTranslate:e.dataForTranslate,
                translateFromLanguage:e.translate_from,
                translateToLanguage:e.translate_to
            }), appUrl)
        });


    </script>
    @endscript


</div>
