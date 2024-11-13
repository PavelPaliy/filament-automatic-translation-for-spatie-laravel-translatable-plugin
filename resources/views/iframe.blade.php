<!DOCTYPE html>
<html>
<body>

@php
    $includedLanguages = "ru,uk,en";
@endphp
<div id="google_translate_element"></div>
<div id = "fields">

</div>

<script type="text/javascript">
    let translateToLanguage = null;
    let dataForTranslate = null;
    let translateFromLanguage = null;


    window.addEventListener("message", function(event) {
        try{
            let obj = JSON.parse(event.data);
            translateFromLanguage = obj.translateFromLanguage;
            let allText = "";
            if(event.origin === "{{ config("app.url") }}" && obj.dataType === "dataForTranslate") {

                dataForTranslate = obj.dataForTranslate;
                for(let field in dataForTranslate) {
                    if(dataForTranslate[field] && dataForTranslate[field]){
                        if (!document.querySelector("#fields #" + field)) {
                            let div = document.createElement("div");
                            div.setAttribute("id", field);
                            div.innerHTML = dataForTranslate[field];
                            document.querySelector("#fields").appendChild(div)
                        }else{
                            let div = document.querySelector(`#fields #${field}`)
                            div.innerHTML = dataForTranslate[field];
                        }
                        allText = document.querySelector("#fields").innerHTML;
                    }
                }
                translateToLanguage = obj.translateToLanguage;


                let intervalSelectLanguageForTranslate = setInterval(function () {
                    if (document.querySelector(`.goog-te-combo option[value='${translateToLanguage}']`)) {
                        selectLanguageForTranslate(translateToLanguage);
                        clearInterval(intervalSelectLanguageForTranslate);
                    }
                }, 1000)


                let scrollHeight = 0;
                let scrollIframeToBottomIndex = 0;
                let scrollIframeToBottomInterval = setInterval(function (){
                    if(scrollHeight<document.body.scrollHeight){
                        scrollHeight = scrollHeight + window.innerHeight;
                        window.scrollTo(0, scrollHeight);
                        scrollIframeToBottomIndex++;
                        let percent = (scrollHeight/document.body.scrollHeight)*100;

                        if(scrollIframeToBottomIndex%5===0){
                            sendPercentOfTranslatedTextToParent(percent)
                        }
                    }else{
                        sendPercentOfTranslatedTextToParent(100)
                        clearInterval(scrollIframeToBottomInterval)
                        checkIsTextTranslated(allText)
                    }
                }, 3000)


            }
        }catch (e){
            console.log(e)
        }

    });
    let libJs = document.createElement("script");
    libJs.setAttribute("src", "https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit")
    libJs.setAttribute("id", "translate_lib")
    document.querySelector("body").append(libJs);

    function googleTranslateElementInit() {
        let obj = {
            includedLanguages: '{{ $includedLanguages }}',
            autoDisplay: false
        };
        let translateFromLanguage = '{{ isset($_GET["translateFrom"]) ? $_GET["translateFrom"] : "empty" }}';
        if(translateFromLanguage!='empty'){
            obj["pageLanguage"] = translateFromLanguage;
        }
        const gt = new google.translate.TranslateElement(obj, 'google_translate_element');

    }

    function checkIsTextTranslated(allText)
    {
        let checkIsTextTranslatedInterval = setInterval(function (){

            if(allText!==document.querySelector("#fields").innerHTML){
                sendTranslatedTextToParent()
                clearInterval(checkIsTextTranslatedInterval)
            }
        }, 1000)
    }

    function sendPercentOfTranslatedTextToParent(percent)
    {
        window.top.postMessage(JSON.stringify({
            percent: percent,
            dataType: "percentOfTranslatedText"
        }), "{{ config("app.url") }}");
    }

    function selectLanguageForTranslate(language)
    {
        document.querySelector(`.goog-te-combo option[value='${language}']`).setAttribute("selected", "selected")
        var event = new Event('change');
        document.querySelector(".goog-te-combo").dispatchEvent(event)
    }

    function sendTranslatedTextToParent()
    {
        console.log('dataForTranslate sendTranslatedTextToParent', dataForTranslate)
        for(let field in dataForTranslate) {
            let html = document.querySelector(`#fields #${field}`).innerHTML.replaceAll('<font style="vertical-align: inherit;">', "");
            html = html.replaceAll("</font>", "")
            dataForTranslate[field] = html;
        }
        window.top.postMessage(JSON.stringify({
            content: JSON.stringify(dataForTranslate),
            dataType: "translatedText",
            translateToLanguage:translateToLanguage
        }), "{{ config("app.url") }}");
    }


</script>
