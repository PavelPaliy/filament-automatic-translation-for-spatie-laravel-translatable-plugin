export default function iframeForTranslate({ appUrl }, wire) {
    return {

        visible:false,
        init: function () {
            window.onmessage = function(event) {
                try{

                    let obj = JSON.parse(event.data)
                    if(event.origin === appUrl && obj.dataType === "translatedText"){
                        wire.translatedFields =  JSON.parse(obj.content);
                        wire.updateTranslatedFields()
                        wire.translateToLanguage = obj.translateToLanguage
                        document.querySelector(".translate-fields-modal .fi-modal-close-btn").click()
                    }else if(event.origin === appUrl && obj.dataType === "percentOfTranslatedText"){
                        let percent = parseInt(JSON.parse(obj.percent))
                        if(percent>100) percent = 100
                        document.querySelector(".percent-of-translated").innerText = percent+"%"
                    }
                }catch (e){
                    console.log(e)
                }

            };
        }
    }
}
