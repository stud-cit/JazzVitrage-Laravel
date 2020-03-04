<script type="text/javascript">
    document.ondragstart = noselect;
    // запрет на перетаскивание
    document.onselectstart = noselect;
    // запрет на выделение элементов страницы
    document.oncontextmenu = noselect;
    // запрет на выведение контекстного меню
    function noselect() {return false;}
</script>
<script src="{{ asset('js/site.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="js/googleTr.js"></script>
<script src="//translate.google.com/translate_a/element.js?cb=TranslateInit"></script>
