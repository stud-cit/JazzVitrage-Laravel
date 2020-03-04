/*!***************************************************
 * google-translate.js v1.0.2
 * https://Get-Web.Site/
 * author: L2Banners
 *****************************************************/

const googleTranslateConfig = {
    lang: "uk",
    // domain: "fest.jazz.sumy.ua"
};

if(window.location.search.replace( '?', '') == "hl=en") {
    TranslateCookieHandler("/" + googleTranslateConfig.lang + "/en", googleTranslateConfig.domain);
    document.location.href = "/";
} else if(window.location.search.replace( '?', '') == "hl=uk") {
    TranslateCookieHandler(null, googleTranslateConfig.domain);
    document.location.href = "/";
}

function TranslateInit() {

    // Инициализируем виджет с языком по умолчанию
    new google.translate.TranslateElement({
        pageLanguage: googleTranslateConfig.lang,
    });

    // Вешаем событие  клик на флаги
    TranslateEventHandler('click', '[data-google-lang]', function (e) {
        if (e.getAttribute("data-google-lang") == "en") {
            TranslateCookieHandler("/" + googleTranslateConfig.lang + "/en");
            window.location.reload();
        } else {
            TranslateCookieHandler(null, googleTranslateConfig.domain);
            window.location.reload();
        }
    });
}

function TranslateCookieHandler(val) {
    Cookies.set('googtrans', val);
}

function TranslateEventHandler(event, selector, handler) {
    document.addEventListener(event, function (e) {
        let el = e.target.closest(selector);
        if (el) handler(el);
    });
}
