if (typeof window.csbl_api == 'undefined') {
    window.csbl_api = {};

    (function () {

        'use strict';

        // Перебиваем requirejs
        var requirejs,require,define;

        // Флаги стран
        var getFlag = function(flagValue) {
            var flagsReplaceMap = {'XX' : 'RU'};
            flagValue = flagsReplaceMap[flagValue] || flagValue;
            return flagValue.toLowerCase();
        }

        //has jquery
        // Localize jQuery variable
        var jQuery;

        /******** Load jQuery if not present *********/
        if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.12.1') {
            var script_tag = document.createElement('script');
            script_tag.setAttribute("type","text/javascript");
            script_tag.setAttribute("src","https://code.jquery.com/jquery-1.12.4.min.js");
            if (script_tag.readyState) {
                script_tag.onreadystatechange = function () { // For old versions of IE
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                    scriptLoadHandler();
                }
            };
            } else { // Other browsers
              script_tag.onload = scriptLoadHandler;
            }
            // Try to find the head, otherwise default to the documentElement
            (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
        } else {
            // The jQuery version on the window is the one we want to use
            jQuery = window.jQuery;
            main(jQuery);
        }

        function scriptLoadHandler() {
            // Restore $ and window.jQuery to their previous values and store the
            // new jQuery in our local jQuery variable
            jQuery = window.jQuery.noConflict(true);
            // Call our main function
            main(jQuery);
        }

        function main($) {
            //подключаем autocomplete
            !function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports&&"function"==typeof require?require("jquery"):jQuery)}(function(a){"use strict";function b(c,d){var e=a.noop,f=this,g={ajaxSettings:{},autoSelectFirst:!1,appendTo:document.body,serviceUrl:null,lookup:null,onSelect:null,width:"auto",minChars:1,maxHeight:300,deferRequestBy:0,params:{},formatResult:b.formatResult,delimiter:null,zIndex:9999,type:"GET",noCache:!1,onSearchStart:e,onSearchComplete:e,onSearchError:e,preserveInput:!1,containerClass:"autocomplete-suggestions",tabDisabled:!1,dataType:"text",currentRequest:null,triggerSelectOnValidInput:!0,preventBadQueries:!0,lookupFilter:function(a,b,c){return-1!==a.value.toLowerCase().indexOf(c)},paramName:"query",transformResult:function(b){return"string"==typeof b?a.parseJSON(b):b},showNoSuggestionNotice:!1,noSuggestionNotice:"No results",orientation:"bottom",forceFixPosition:!1};f.element=c,f.el=a(c),f.suggestions=[],f.badQueries=[],f.selectedIndex=-1,f.currentValue=f.element.value,f.intervalId=0,f.cachedResponse={},f.onChangeInterval=null,f.onChange=null,f.isLocal=!1,f.suggestionsContainer=null,f.noSuggestionsContainer=null,f.options=a.extend({},g,d),f.classes={selected:"autocomplete-selected",suggestion:"autocomplete-suggestion"},f.hint=null,f.hintValue="",f.selection=null,f.initialize(),f.setOptions(d)}var c=function(){return{escapeRegExChars:function(a){return a.replace(/[|\\{}()[\]^$+*?.]/g,"\\$&")},createNode:function(a){var b=document.createElement("div");return b.className=a,b.style.position="absolute",b.style.display="none",b}}}(),d={ESC:27,TAB:9,RETURN:13,LEFT:37,UP:38,RIGHT:39,DOWN:40};b.utils=c,a.Autocomplete=b,b.formatResult=function(a,b){if(!b)return a.value;var d="("+c.escapeRegExChars(b)+")";return a.value.replace(new RegExp(d,"gi"),"<strong>$1</strong>").replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/&lt;(\/?strong)&gt;/g,"<$1>")},b.prototype={killerFn:null,initialize:function(){var c,d=this,e="."+d.classes.suggestion,f=d.classes.selected,g=d.options;d.element.setAttribute("autocomplete","off"),d.killerFn=function(b){a(b.target).closest("."+d.options.containerClass).length||(d.killSuggestions(),d.disableKillerFn())},d.noSuggestionsContainer=a('<div class="autocomplete-no-suggestion"></div>').html(this.options.noSuggestionNotice).get(0),d.suggestionsContainer=b.utils.createNode(g.containerClass),c=a(d.suggestionsContainer),c.appendTo(g.appendTo),"auto"!==g.width&&c.css("width",g.width),c.on("mouseover.autocomplete",e,function(){d.activate(a(this).data("index"))}),c.on("mouseout.autocomplete",function(){d.selectedIndex=-1,c.children("."+f).removeClass(f)}),c.on("click.autocomplete",e,function(){return d.select(a(this).data("index")),!1}),d.fixPositionCapture=function(){d.visible&&d.fixPosition()},a(window).on("resize.autocomplete",d.fixPositionCapture),d.el.on("keydown.autocomplete",function(a){d.onKeyPress(a)}),d.el.on("keyup.autocomplete",function(a){d.onKeyUp(a)}),d.el.on("blur.autocomplete",function(){d.onBlur()}),d.el.on("focus.autocomplete",function(){d.onFocus()}),d.el.on("change.autocomplete",function(a){d.onKeyUp(a)}),d.el.on("input.autocomplete",function(a){d.onKeyUp(a)})},onFocus:function(){var a=this;a.fixPosition(),a.el.val().length>=a.options.minChars&&a.onValueChange()},onBlur:function(){this.enableKillerFn()},abortAjax:function(){var a=this;a.currentRequest&&(a.currentRequest.abort(),a.currentRequest=null)},setOptions:function(b){var c=this,d=c.options;a.extend(d,b),c.isLocal=a.isArray(d.lookup),c.isLocal&&(d.lookup=c.verifySuggestionsFormat(d.lookup)),d.orientation=c.validateOrientation(d.orientation,"bottom"),a(c.suggestionsContainer).css({"max-height":d.maxHeight+"px",width:d.width+"px","z-index":d.zIndex})},clearCache:function(){this.cachedResponse={},this.badQueries=[]},clear:function(){this.clearCache(),this.currentValue="",this.suggestions=[]},disable:function(){var a=this;a.disabled=!0,clearInterval(a.onChangeInterval),a.abortAjax()},enable:function(){this.disabled=!1},fixPosition:function(){var b=this,c=a(b.suggestionsContainer),d=c.parent().get(0);if(d===document.body||b.options.forceFixPosition){var e=b.options.orientation,f=c.outerHeight(),g=b.el.outerHeight(),h=b.el.offset(),i={top:h.top,left:h.left};if("auto"===e){var j=a(window).height(),k=a(window).scrollTop(),l=-k+h.top-f,m=k+j-(h.top+g+f);e=Math.max(l,m)===l?"top":"bottom"}if("top"===e?i.top+=-f:i.top+=g,d!==document.body){var n,o=c.css("opacity");b.visible||c.css("opacity",0).show(),n=c.offsetParent().offset(),i.top-=n.top,i.left-=n.left,b.visible||c.css("opacity",o).hide()}"auto"===b.options.width&&(i.width=b.el.outerWidth()+"px"),c.css(i)}},enableKillerFn:function(){var b=this;a(document).on("click.autocomplete",b.killerFn)},disableKillerFn:function(){var b=this;a(document).off("click.autocomplete",b.killerFn)},killSuggestions:function(){var a=this;a.stopKillSuggestions(),a.intervalId=window.setInterval(function(){a.visible&&(a.options.preserveInput||a.el.val(a.currentValue),a.hide()),a.stopKillSuggestions()},50)},stopKillSuggestions:function(){window.clearInterval(this.intervalId)},isCursorAtEnd:function(){var a,b=this,c=b.el.val().length,d=b.element.selectionStart;return"number"==typeof d?d===c:document.selection?(a=document.selection.createRange(),a.moveStart("character",-c),c===a.text.length):!0},onKeyPress:function(a){var b=this;if(!b.disabled&&!b.visible&&a.which===d.DOWN&&b.currentValue)return void b.suggest();if(!b.disabled&&b.visible){switch(a.which){case d.ESC:b.el.val(b.currentValue),b.hide();break;case d.RIGHT:if(b.hint&&b.options.onHint&&b.isCursorAtEnd()){b.selectHint();break}return;case d.TAB:if(b.hint&&b.options.onHint)return void b.selectHint();if(-1===b.selectedIndex)return void b.hide();if(b.select(b.selectedIndex),b.options.tabDisabled===!1)return;break;case d.RETURN:if(-1===b.selectedIndex)return void b.hide();b.select(b.selectedIndex);break;case d.UP:b.moveUp();break;case d.DOWN:b.moveDown();break;default:return}a.stopImmediatePropagation(),a.preventDefault()}},onKeyUp:function(a){var b=this;if(!b.disabled){switch(a.which){case d.UP:case d.DOWN:return}clearInterval(b.onChangeInterval),b.currentValue!==b.el.val()&&(b.findBestHint(),b.options.deferRequestBy>0?b.onChangeInterval=setInterval(function(){b.onValueChange()},b.options.deferRequestBy):b.onValueChange())}},onValueChange:function(){var b=this,c=b.options,d=b.el.val(),e=b.getQuery(d);return b.selection&&b.currentValue!==e&&(b.selection=null,(c.onInvalidateSelection||a.noop).call(b.element)),clearInterval(b.onChangeInterval),b.currentValue=d,b.selectedIndex=-1,c.triggerSelectOnValidInput&&b.isExactMatch(e)?void b.select(0):void(e.length<c.minChars?b.hide():b.getSuggestions(e))},isExactMatch:function(a){var b=this.suggestions;return 1===b.length&&b[0].value.toLowerCase()===a.toLowerCase()},getQuery:function(b){var c,d=this.options.delimiter;return d?(c=b.split(d),a.trim(c[c.length-1])):b},getSuggestionsLocal:function(b){var c,d=this,e=d.options,f=b.toLowerCase(),g=e.lookupFilter,h=parseInt(e.lookupLimit,10);return c={suggestions:a.grep(e.lookup,function(a){return g(a,b,f)})},h&&c.suggestions.length>h&&(c.suggestions=c.suggestions.slice(0,h)),c},getSuggestions:function(b){var c,d,e,f,g=this,h=g.options,i=h.serviceUrl;if(h.params[h.paramName]=b,d=h.ignoreParams?null:h.params,h.onSearchStart.call(g.element,h.params)!==!1){if(a.isFunction(h.lookup))return void h.lookup(b,function(a){g.suggestions=a.suggestions,g.suggest(),h.onSearchComplete.call(g.element,b,a.suggestions)});g.isLocal?c=g.getSuggestionsLocal(b):(a.isFunction(i)&&(i=i.call(g.element,b)),e=i+"?"+a.param(d||{}),c=g.cachedResponse[e]),c&&a.isArray(c.suggestions)?(g.suggestions=c.suggestions,g.suggest(),h.onSearchComplete.call(g.element,b,c.suggestions)):g.isBadQuery(b)?h.onSearchComplete.call(g.element,b,[]):(g.abortAjax(),f={url:i,data:d,type:h.type,dataType:h.dataType},a.extend(f,h.ajaxSettings),g.currentRequest=a.ajax(f).done(function(a){var c;g.currentRequest=null,c=h.transformResult(a,b),g.processResponse(c,b,e),h.onSearchComplete.call(g.element,b,c.suggestions)}).fail(function(a,c,d){h.onSearchError.call(g.element,b,a,c,d)}))}},isBadQuery:function(a){if(!this.options.preventBadQueries)return!1;for(var b=this.badQueries,c=b.length;c--;)if(0===a.indexOf(b[c]))return!0;return!1},hide:function(){var b=this,c=a(b.suggestionsContainer);a.isFunction(b.options.onHide)&&b.visible&&b.options.onHide.call(b.element,c),b.visible=!1,b.selectedIndex=-1,clearInterval(b.onChangeInterval),a(b.suggestionsContainer).hide(),b.signalHint(null)},suggest:function(){if(!this.suggestions.length)return void(this.options.showNoSuggestionNotice?this.noSuggestions():this.hide());var b,c=this,d=c.options,e=d.groupBy,f=d.formatResult,g=c.getQuery(c.currentValue),h=c.classes.suggestion,i=c.classes.selected,j=a(c.suggestionsContainer),k=a(c.noSuggestionsContainer),l=d.beforeRender,m="",n=function(a,c){var d=a.data[e];return b===d?"":(b=d,'<div class="autocomplete-group"><strong>'+b+"</strong></div>")};return d.triggerSelectOnValidInput&&c.isExactMatch(g)?void c.select(0):(a.each(c.suggestions,function(a,b){e&&(m+=n(b,g,a)),m+='<div class="'+h+'" data-index="'+a+'">'+f(b,g,a)+"</div>"}),this.adjustContainerWidth(),k.detach(),j.html(m),a.isFunction(l)&&l.call(c.element,j,c.suggestions),c.fixPosition(),j.show(),d.autoSelectFirst&&(c.selectedIndex=0,j.scrollTop(0),j.children("."+h).first().addClass(i)),c.visible=!0,void c.findBestHint())},noSuggestions:function(){var b=this,c=a(b.suggestionsContainer),d=a(b.noSuggestionsContainer);this.adjustContainerWidth(),d.detach(),c.empty(),c.append(d),b.fixPosition(),c.show(),b.visible=!0},adjustContainerWidth:function(){var b,c=this,d=c.options,e=a(c.suggestionsContainer);"auto"===d.width&&(b=c.el.outerWidth(),e.css("width",b>0?b:300))},findBestHint:function(){var b=this,c=b.el.val().toLowerCase(),d=null;c&&(a.each(b.suggestions,function(a,b){var e=0===b.value.toLowerCase().indexOf(c);return e&&(d=b),!e}),b.signalHint(d))},signalHint:function(b){var c="",d=this;b&&(c=d.currentValue+b.value.substr(d.currentValue.length)),d.hintValue!==c&&(d.hintValue=c,d.hint=b,(this.options.onHint||a.noop)(c))},verifySuggestionsFormat:function(b){return b.length&&"string"==typeof b[0]?a.map(b,function(a){return{value:a,data:null}}):b},validateOrientation:function(b,c){return b=a.trim(b||"").toLowerCase(),-1===a.inArray(b,["auto","bottom","top"])&&(b=c),b},processResponse:function(a,b,c){var d=this,e=d.options;a.suggestions=d.verifySuggestionsFormat(a.suggestions),e.noCache||(d.cachedResponse[c]=a,e.preventBadQueries&&!a.suggestions.length&&d.badQueries.push(b)),b===d.getQuery(d.currentValue)&&(d.suggestions=a.suggestions,d.suggest())},activate:function(b){var c,d=this,e=d.classes.selected,f=a(d.suggestionsContainer),g=f.find("."+d.classes.suggestion);return f.find("."+e).removeClass(e),d.selectedIndex=b,-1!==d.selectedIndex&&g.length>d.selectedIndex?(c=g.get(d.selectedIndex),a(c).addClass(e),c):null},selectHint:function(){var b=this,c=a.inArray(b.hint,b.suggestions);b.select(c)},select:function(a){var b=this;b.hide(),b.onSelect(a)},moveUp:function(){var b=this;if(-1!==b.selectedIndex)return 0===b.selectedIndex?(a(b.suggestionsContainer).children().first().removeClass(b.classes.selected),b.selectedIndex=-1,b.el.val(b.currentValue),void b.findBestHint()):void b.adjustScroll(b.selectedIndex-1)},moveDown:function(){var a=this;a.selectedIndex!==a.suggestions.length-1&&a.adjustScroll(a.selectedIndex+1)},adjustScroll:function(b){var c=this,d=c.activate(b);if(d){var e,f,g,h=a(d).outerHeight();e=d.offsetTop,f=a(c.suggestionsContainer).scrollTop(),g=f+c.options.maxHeight-h,f>e?a(c.suggestionsContainer).scrollTop(e):e>g&&a(c.suggestionsContainer).scrollTop(e-c.options.maxHeight+h),c.options.preserveInput||c.el.val(c.getValue(c.suggestions[b].value)),c.signalHint(null)}},onSelect:function(b){var c=this,d=c.options.onSelect,e=c.suggestions[b];c.currentValue=c.getValue(e.value),c.currentValue===c.el.val()||c.options.preserveInput||c.el.val(c.currentValue),c.signalHint(null),c.suggestions=[],c.selection=e,a.isFunction(d)&&d.call(c.element,e)},getValue:function(a){var b,c,d=this,e=d.options.delimiter;return e?(b=d.currentValue,c=b.split(e),1===c.length?a:b.substr(0,b.length-c[c.length-1].length)+a):a},dispose:function(){var b=this;b.el.off(".autocomplete").removeData("autocomplete"),b.disableKillerFn(),a(window).off("resize.autocomplete",b.fixPositionCapture),a(b.suggestionsContainer).remove()}},a.fn.autocomplete=a.fn.devbridgeAutocomplete=function(c,d){var e="autocomplete";return arguments.length?this.each(function(){var f=a(this),g=f.data(e);"string"==typeof c?g&&"function"==typeof g[c]&&g[c](d):(g&&g.dispose&&g.dispose(),g=new b(this,c),f.data(e,g))}):this.first().data(e)}});

            //var uniqId =  'dop_' + Math.random().toString(36).substr(2, 9);

            var
            apiEndPoint = 'https://capi.sbl.su',
            htmlDopLath =
            '<div class="ec-calc-form-row">' +
                '<div class="ec-calc-form-dop-checks">' +
                    '<input type="checkbox" id="ecCalcCheckLathing">' +
                    '<label for="ecCalcCheckLathing" class="ec-calc-form__label">Обрешетка</label>' +
                    '<div class="ec-calc-form-dop-checks__comment">Если вам требуется жесткая упаковка груза, то поставьте галочку.</div>' +
                '</div>' +
            '</div>',
            htmlDopIns =
            '<div class="ec-calc-form-row">' +
                '<div class="ec-calc-form-dop-checks">' +
                    '<input type="checkbox" id="ecCalcCheckInsure" checked>' +
                    '<label for="ecCalcCheckInsure" class="ec-calc-form__label">Страхование <input type="text" placeholder="Сумма" id="ecCalcCheckInsureVal" class="ec-calc-form__input-small"></label>' +
                    '<div class="ec-calc-form-dop-checks__comment">Если вам требуется страховка груза, то поставьте галочку.</div>' +
                '</div>' +
            '</div>',
            htmlItem =
            '<div class="ec-calc-item">' +
                '<div class="ec-calc-item__img"></div>' +
                '<div class="ec-calc-item__title"></div>' +
                '<div class="ec-calc-item__descr"></div>' +
                '<input type="hidden" value="" class="cCalcValue">' +
                '<input type="hidden" value="" class="cCalcWeight">' +
            '</div>',
            PARAM = {
                theme: 0,
                comp: 0,
                btn: 'yes',
                pos: 'right',
                btnText: 0,
                startCt: 0,
                startCntr: 0,
                autoEnd: 0,
                autoResult: 1,
                endCt: 0,
                endCntr: 0,
                startPick: 0,
                startPickCheck: 0,
                weight: 0,
                value: 0,
                size: 0,
                sizeShow: 0,
                btnBg: '#03a9f4',
                dopLathing: 0,
                dopLathingImp: 0,
                dopInsure: 1,
                dopInsureSum: 0,
                innerDeliv: 0,
                title: 0
            },
            HTML =
            '<div class="ec-calc-layout" style="box-shadow: none;" id="ecCalcLay">'+
            '<div class="ec-calc--preload"></div>'+
            '            <div class="ec-calc"  id="ecCalc">'+
            '                <div class="ec-calc__close">x</div>'+
            '                <div class="ec-calc-form">'+
            '                    <div class="ec-calc-form-row">'+
            '                        <div class="ec-calc-form-from">'+
            '                            <div class="ec-calc-form__label">Откуда</div>'+
            '                            <input type="text" id="ecCalcCityFrom">'+
            '                            <input type="hidden" id="ecCalcCityFromHidden">'+
            '                        </div>'+
            '                        <div class="ec-calc-form-to">'+
            '                            <div class="ec-calc-form__label">Куда</div>'+
            '                            <input type="text" id="ecCalcCityTo">'+
            '                            <input type="hidden" id="ecCalcCityToHidden">'+
            '                        </div>'+
            '                    </div>'+
            '                    <div class="ec-calc-form-row">'+
            '                        <div class="ec-calc-form-pickup">'+
            '                            <input type="checkbox" id="ecCalcCheckPickup">'+
            '                            <label for="ecCalcCheckPickup" class="ec-calc-form__label">Забрать груз у отправителя</label>'+
            '                            <div class="ec-calc-form-pickup__comment">Пометьте этот пункт если Интернет магазин не доставляет товар до терминала транспортной компании.</div>'+
            '                        </div>'+
            '                        <div class="ec-calc-form-delivery">'+
            '                            <input type="checkbox" id="ecCalcCheckDelivery">'+
            '                            <label for="ecCalcCheckDelivery" class="ec-calc-form__label">Доставка до дверей</label>'+
            '                            <div class="ec-calc-form-delivery__comment">Обратите внимание у каждой компании могут быть свои условия доставки до дверей.</div>'+
            '                        </div>'+
            '                    </div>'+
            '                    <div class="ec-calc-form-clone">'+
            '                       <div class="ec-calc-form-row ec-calc-wrap-item" id="clonedInput">'+
            '                        <div class="ec-calc-form-weight">'+
            '                            <div class="ec-calc-form__label">Вес, кг</div>'+
            '                            <input type="text" id="ecCalcWeight" class="cCalcWeight" maxlength="5">'+
            '                        </div>'+
            '                        <div class="ec-calc-form-value">'+
            '                            <div class="ec-calc-form__label">Объем, м<sup>3</sup></div>'+
            '                            <input type="text" id="ecCalcValue" class="cCalcValue" maxlength="5">'+
            '                        </div>'+
            '                        <div class="ec-calc-form-size">'+
            '                            <div class="ec-calc-form__label">Размеры ДхШхВ, см</div>'+
            '                            <input type="text" id="sizeWidth" class="sizeWidth" maxlength="5">'+
            '                            <input type="text" id="sizeHeight" class="sizeHeight" maxlength="5">'+
            '                            <input type="text" id="sizeLong" class="sizeLong" maxlength="5">'+
            '                        </div>'+
            '                        <div class="ec-calc-form-clone-btn">' +
            '                            <div class="cCalcItemClose">Удалить</div>' +
            '                            <div class="cCalcItemAdd">Добавить место</div>' +
            '                        </div>' +
            '                       </div>'+
            '                    </div>'+
            '                    <div class="ec-calc-form-dop"></div>'+
            '                    <button class="ec-calc-form-submit" id="acCalcGetResult">Рассчитать</button>'+
            '                </div>'+
            '                <div class="ec-calc-border">'+
            '                    <div class="ec-calc-border-load-bar">'+
            '                        <div class="ec-calc-border-bar"></div>'+
            '                        <div class="ec-calc-border-bar"></div>'+
            '                        <div class="ec-calc-border-bar"></div>'+
            '                    </div>'+
            '                </div>'+
            '                <div class="ec-calc-preload"></div>'+
            '                <div class="ec-calc-error"></div>'+
            '                <div class="ec-calc-result" id="ecCalcResult">'+
            '                    <div class="ec-calc-result__header">Результат</div>'+
            '                    <table class="ec-calc-result-table">'+
            '                        <thead>'+
            '                            <tr>'+
            '                                <th>Компании</th>'+
            '                                <th>Перевозка</th>'+
            '                                <th>Стоимость</th>'+
            '                            </tr>'+
            '                        </thead>'+
            '                        <tbody id="ecCalcResultTbody">'+
            '                        </tbody>'+
            '                    </table>'+
            '                </div>'+
            '            <div class="ec-calc-agree">Стоимость является <span title="Окончательная стоимость уточняется на складе при обмере груза. Обратите внимание, возможный платный въезд на терминал может быть не учтен.">ориентировочной</span></div>'+
            '            </div>'+
            '        </div>';


            //Получаем настроенные параметры
            var getParamsScript = function(){
                var
                src = $('#dcsbl').attr("src").split("?"),
                args = src[src.length-1], // выбираем последнюю часть src после ?
                args = args.split("&"), // разбиваем параметры &
                parameters = {};
                for(var i=args.length-1; i>=0; i--) // заносим параметры в результирующий объект
                {
                    var parameter = args[i].split("=");
                    parameters[parameter[0]] = parameter[1];
                }
                return parameters;
            };

            //Убираем все, кроме точек и цифр
            var replaceValidValue = function(_this) {
                _this.value = this.value.replace(/[^\d.]*/g, '')
                    .replace(/([.])[.]+/g, '$1')
                    .replace(/^[^\d]*(\d+([.]\d{0,5})?).*$/g, '$1');
            }

            // Собираем значения
            var summAllValue = function () {
                var a = '';
                $('[id^="clonedInput"]').each(function (i, elem) {
                    var
                    w =  $(this).find('.cCalcWeight').val() == '' ? 0 :  $(this).find('.cCalcWeight').val(),
                    v =  $(this).find('.cCalcValue').val() == '' ? 0 :  $(this).find('.cCalcValue').val(),  
                    b =  $('#ecCalcCheckLathing').is(':checked') ? 1 : 0;
                    a += '&hsw[]=0&weights[]=' + w + '&volumes[]=' + v + '&quantities[]=1&palletize[]=0&lathing[]=' + b + ''; 
                });
                return a;
            }
            //Общий расчет и отрисовка результата
            var getCalcResult = function() {
                var 
                    fromCity = $('#ecCalcCityFrom').val(),
                    fromCountry = $('#ecCalcCityFromHidden').val(),
                    toCity = $('#ecCalcCityTo').val(),
                    toCountry = $('#ecCalcCityToHidden').val(),
                    sumValue = summAllValue(),
                    // value = $('#ecCalcValue').val() == '' || Number($('#ecCalcValue').val()) < 0.01 ? 0 : Number($('#ecCalcValue').val().replace(/,/g, '.')).toFixed(2),
                    // weight = $('#ecCalcWeight').val() == '' ? 0 : $('#ecCalcWeight').val(),
                    pickup = $('#ecCalcCheckPickup').is(':checked') || PARAM.startPickCheck == 1 ? 1 : 0,
                    deliv = $('#ecCalcCheckDelivery').is(':checked') ? 1 : 0,
                    lathing = $('#ecCalcCheckLathing').is(':checked') ? 1 : 0,
                    insure = $('#ecCalcCheckInsure').is(':checked') ? 1 : 0,
                    priceCargo = $('#ecCalcCheckInsureVal').val() == '' ? 0 : $('#ecCalcCheckInsureVal').val(),
                    filterCompany = PARAM.comp != 0 ? PARAM.comp.split(',')  : 0 ,
                    filterCompanyString = '',
                    filterPremiumRandom = Number((Math.random()*4).toFixed(0)),
                    sizeBoolean = $('#sizeWidth').val() > 0 && $('#sizeHeight').val() > 0 && $('#sizeLong').val() > 0;

                //Фильтрация компаний
                if ( filterCompany !== 0 && filterCompany.indexOf('0') == -1 ) {
                    for (var i = filterCompany.length - 1; i >= 0; i--) {
                        filterCompanyString += '&clientIds[]=' + filterCompany[i];
                    }

                    // if (filterPremiumRandom === 4) {
                    //     filterCompanyString += '&clientIds[]=3';
                    // }
                } else {
                    filterCompanyString = '';
                }

                //Проверка полей 
                if ( fromCity.length && !fromCountry.length ) return dump({'Ошибка' : 'Город отправки не найден или не корректно введён.'}); 
                if ( !fromCity.length || !fromCountry.length ) return dump({'Ошибка' : 'Не указан город отправки.'}); 
                if ( toCity.length && !toCountry.length ) return dump({'Ошибка' : 'Город прибытия не найден или не корректно введён.'}); 
                if ( !toCity.length || !toCountry.length ) return dump({'Ошибка' : 'Не указан город прибытия.'}); 
                // if ( PARAM.sizeShow == 1 ) {
                //     if (!sizeBoolean && !weight.length) return dump({'Ошибка':'Заполните поле вес или размеры ДШВ.'});
                //     if ( lathing == 1 ) {
                //         if ( !value.length || !sizeBoolean ) return dump({'Ошибка' : 'Для обрешётки требуется указать все параметры груза: вес и размеры ДШВ.'}); 
                //     }
                // }
                // if ( lathing == 1 ) {
                //     if ( !value.length || !weight.length ) return dump({'Ошибка' : 'Для обрешётки требуется указать все параметры груза: вес и объем.'}); 
                // }
                //if(!value.length && !weight.length) return dump({'Ошибка':'Заполните поле вес или объем.'});

                //Вес и объем
                if ( $('[id^="clonedInput"]').length >= 2 ) {
                    var booleanReturn = true;
                    $('[id^="clonedInput"]').each(function () {
                        if ( $(this).find('.cCalcWeight').val() == '' || $(this).find('.cCalcValue').val() == '' ) {
                            booleanReturn =  false;
                            return dump({'Ошибка' : 'Если у вас несколько мест, укажите вес и объем каждого места.'});
                        }
                    });
                    if ( !booleanReturn ) return booleanReturn;
                } else {
                    if ( $('.cCalcWeight').val() == '' && $('.cCalcValue').val() == '' || $('.cCalcWeight').val() == 0 && $('.cCalcValue').val() == 0) { 
                        return dump({'Ошибка' : 'Заполните поле вес или объем.'}); 
                    }
                    if ( lathing == 1 ) {
                        if ( $('.cCalcWeight').val() != '' && $('.cCalcValue').val() != '' ) {
                            console.log('proccesing');
                        } else {
                            return dump({'Ошибка' : 'Для опции обрешетки заполните поля вес и объем (размеры).'});
                        }
                    }
                }

                $('.ec-calc-border-load-bar').fadeIn();

                $.getJSON( apiEndPoint +'/calc/place?from-country=' + encodeURIComponent(fromCountry) + '&from-city=' + encodeURIComponent(fromCity) + '&to-country=' + encodeURIComponent(toCountry) + '&to-city=' + encodeURIComponent(toCity) + '' + sumValue + '&need-pickup=' + pickup + '&need-deliver=' + deliv + '&widget=dostavka&palletize[]=0&need-insuring=' + insure + '&cargo-price=' + priceCargo + '&need-labeling=0' + filterCompanyString)
                .done(function(data, status) {

                    //Проверка на ошибки калькулятора
                    if(data.errors || ! data.result[0] ) {
                        dump(data.errors);
                        setTimeout(function() {
                            $('.ec-calc-border-load-bar').fadeOut();
                            $('.ec-calc-form, .ec-calc-border, .ec-calc__header').show();
                         }, 1000);
                        return false;
                    }

                    $('#ecCalcResultTbody tr').remove(); 

                    for (var i = 0; i < data.result.length; i++) {

                        var nfc = data.result[i].nearby_from_city == null ? '' : '<div>' + data.result[i].nearby_from_city + ' - ' + data.result[i].from_city + ' <strong>' + data.result[i].nearby_pickup_rate + ' руб.</strong></div>',

                        premium = data.result[i].status == 'premium' ? true : false,
                        tr_auto = data.result[i].auto_transit == null || data.result[i].auto_transit == 0 ? '' : '<div>' + data.result[i].from_city + ' - ' + data.result[i].to_city + ' <strong>' + data.result[i].auto_transit + ' руб.</strong> (авто) </div>',
                        tr_rail = data.result[i].rail_transit == null || data.result[i].rail_transit == 0 ? '' : '<div>' + data.result[i].from_city + ' - ' + data.result[i].to_city + ' <strong>' + data.result[i].rail_transit + ' руб.</strong> (жд) </div>',
                        tr_air = data.result[i].air_transit == null || data.result[i].air_transit == 0 ? '' : '<div>' + data.result[i].from_city + ' - ' + data.result[i].to_city + ' <strong>' + data.result[i].air_transit + ' руб.</strong> (авиа) </div>',
                        ntc = data.result[i].nearby_to_city == null ? '' : '<div>' + data.result[i].to_city + ' - ' + data.result[i].nearby_to_city + ' <strong>' + data.result[i].nearby_deliver_rate + ' руб.</strong></div>',
                        pr = pickup == 0  || data.result[i].pickup_rate == 0 || data.result[i].pickup_rate == null ? '' : '<div class="ec-calc-result__insurin">+ забор - <b>' + data.result[i].pickup_rate + ' руб.</b></div>',
                        dr = deliv == 0 || data.result[i].deliver_rate == 0 || data.result[i].deliver_rate == null ? '' : '<div class="ec-calc-result__insurin">+ доставка - <b>' + data.result[i].deliver_rate+ ' руб.</b></div>',
                        lath = data.result[i].boarding_sum != 0 && lathing == 1 ? '<div class="ec-calc-result__insurin">+ обрешетка - <b>' + data.result[i].boarding_sum + ' руб.</b></div>': '',
                        insur = data.result[i].insure_sum != 0 ? '<div class="ec-calc-result__insurin">+ страховка - <b>' + data.result[i].insure_sum + ' руб.</b></div>': '',
                        termTo = data.result[i].to_filial_entry_rate != 0 && pickup == 0 ? '<div class="ec-calc-result__insurin">+ <b>' + data.result[i].to_city + '</b>: въезд на терминал - <b>' + data.result[i].to_filial_entry_rate + ' руб.</b></div>': '',
                        termFrom = data.result[i].from_filial_entry_rate != 0 && deliv == 0 ? '<div class="ec-calc-result__insurin">+ <b>' + data.result[i].from_city + '</b>: въезд на терминал - <b>' + data.result[i].from_filial_entry_rate + ' руб.</b></div>': '',
                        cn = data.result[i].company_name,
                        p_auto = data.result[i].auto_period == -1||data.result[i].auto_period==0 ? '' : '<span class="ec-calc-result-table__days">- ' + data.result[i].auto_period + ' дн.</span>',
                        p_rail = data.result[i].rail_period == -1||data.result[i].rail_period==0 ? '' : '<span class="ec-calc-result-table__days">- ' + data.result[i].rail_period + ' дн.</span>',
                        p_air = data.result[i].air_period == -1||data.result[i].air_period==0 ? '' : '<span class="ec-calc-result-table__days">- ' + data.result[i].air_period + ' дн.</span>',
                        tt_auto = data.result[i].auto_transit == null || data.result[i].auto_transit == 0 ? '' : '<div class="ec-calc-result-table__rouble">' + data.result[i].auto_total + ' руб. (авто) '+p_auto+'</div>',
                        tt_rail = data.result[i].rail_transit == null || data.result[i].rail_transit == 0 ? '' : '<div class="ec-calc-result-table__rouble">' + data.result[i].rail_total + ' руб. (жд) '+p_rail+'</div>',
                        tt_air = data.result[i].air_transit == null || data.result[i].air_transit == 0 ? '' : '<div class="ec-calc-result-table__rouble">' + data.result[i].air_total + ' руб. (авиа) '+p_air+'</div>',

                        st = "https://c.sbl.su/company/" + data.result[i].client_id;

                        if ( pr == '' && pickup ) continue;
                        if ( dr == '' && deliv ) continue;
                        if ( lath == 0 && lathing ) continue;

                        $('#ecCalcResultTbody').append('<tr '+(premium?'premium':'')+'><td><a target="_blank" href="' + st + '">' + cn + '</a></td>' +
                        '<td id="ecCalcResultRoute">' + nfc + tr_auto + tr_rail + tr_air + ntc + pr + dr + lath + insur + termTo + termFrom + '</td>' +
                        '<td>' + tt_auto + tt_rail + tt_air + '</td></tr>');
                    };

                    $('#ecCalcResultTbody').text().length < 30 ? $('#ecCalcResultTbody').html('<tr><td colspan="3">Таких маршрутов у компаний нету :(</td></tr>') : '';

                    $('.ec-calc-error').hide();
                    setTimeout(function() {
                        $('#ecCalcResult').show();
                        $('.ec-calc-border-load-bar').fadeOut();

                        //Вызываем функцию custom после подсчета
                        try {csblCustomFuncResult($);} catch(e){}

                     }, 1000);

                }).fail(function () {
                    $('.ec-calc-border-load-bar').fadeOut();
                    dump({'Ошибка': 'Похоже сервер не отвечает, попробуйте через 1 минуту'});
                    $('.ec-calc-form, .ec-calc-border, .ec-calc__header').show();
                });
            };


            //для ошибок
            function dump(obj) {
                $('.ec-calc-border-load-bar').fadeIn();
                var out = '';
                for (var i in obj) {
                    out += obj[i] + "\n";
                }
                $('#ecCalcResult').hide();
                $('.ec-calc-error').text(out);
                $('.ec-calc-error').fadeIn();
                $('.ec-calc-border-load-bar').fadeOut();

                return false;
            }

            jQuery(document).ready(function($) {

                try {$.extend(PARAM, getParamsScript()); } catch(e){}//load param

                //load style
                var css;
                if ( PARAM.theme == 'simple' ) {
                    css = 'delivery-simple';
                } else {
                    css = 'delivery';
                }

                $("<link>", {
                    rel: "stylesheet",
                    type: "text/css",
                    href: '/css/delivery.css?94055' 
                }).appendTo('head');

                //проверяем какой шаблон, в окне или вложенный
                if ( PARAM.innerDeliv == 0 ) {
                    $('body').append(HTML); //Генерим шаблон
                    //Генерим кнопку, если необходимо
                    if (PARAM.btn === 'yes') {
                        $('body').append('<div class="ec-calc--call call-ec-widget">Рассчитать доставку</div>').find('.ec-calc--call').css('background', PARAM.btnBg);
                        PARAM.pos === 'left' ? $('.ec-calc--call').addClass('ec-calc--call--left') : ''; // устанавливаем сторону где вывести виджет
                        //Делаем текст для кнопки
                        if ( PARAM.btnText != 0 ) {
                            $('.ec-calc--call').text(PARAM.btnText);
                        }
                    }
                } else {
                    $('.ec-delivery:eq(0)').html(HTML);
                }

                //Проверяем на новый заголовок
                if (PARAM.title !== 0) {
                    $('.ec-calc__header__text').text(PARAM.title);
                }

                //Проверка на динамический город
                if ( PARAM.startCt === 0 ) {
                    if ( $('.ecStartCity').text() != '' ) {
                        try {
                            var text = $('.ecStartCity').text().split(',');
                            $('#ecCalcCityFrom').val(text[0]);
                            $('#ecCalcCityFromHidden').val(text[1].replace(' ',''));
                        } catch(e){console.log(e);}
                    }
                }

                //Начальные значения города
                if (PARAM.startCntr && PARAM.startCt) {
                    $('#ecCalcCityFrom').val(PARAM.startCt)
                    $('#ecCalcCityFromHidden').val(PARAM.startCntr);
                    //Начальные значения забора
                    if (PARAM.startPick == 1) { 
                        $('#ecCalcCheckPickup').prop('checked', false);
                        $('.ec-calc-form-from, .ec-calc-form-pickup').hide();
                    }
                }

                //Если есть параметры вставляем их
                if ( PARAM.dopLathing == 1 ) {
                    $('.ec-calc-form-dop').append(htmlDopLath);
                }
                if (PARAM.dopLathingImp == 1) {
                    $('#ecCalcCheckLathing').prop('checked', true);
                }
                if ( PARAM.dopInsure == 1 ) {
                    $('.ec-calc-form-dop').append(htmlDopIns);
                    if ( PARAM.dopInsureSum != 0 ) {
                        $('#ecCalcCheckInsure').prop('checked', true);
                        $('#ecCalcCheckInsureVal').val(PARAM.dopInsureSum);
                    }
                }

                //Проверка на использование размера или объема
                if ( PARAM.sizeShow == 1 ) {
                    $('.ec-calc-form-value').hide();
                    $('.ec-calc-form-size').css('display', 'block');
                }

                //Проверяем на товары
                var
                    $thisProduct = $('body').find('[itemtype="http://schema.org/Product"]').first(),
                    $thisName = $thisProduct.find('[itemprop="name"]').text(),
                    $thisImg = $thisProduct.find('[itemprop="image"]').attr('src'),
                    $thisDescr = $thisProduct.find('[itemprop="description"]').text().slice(0, 128),
                    $thisWeight = $thisProduct.find('[itemprop="weight"]').text(),
                    $thisVolume = $thisProduct.find('[itemprop="volume"]').text();

                if ( $thisProduct.length >= 1 && $thisWeight.length >= 1 && $thisVolume.length >= 1 ) {

                    $('.ec-calc-wrap-item').html(htmlItem);

                    $('.ec-calc-item__title').text($thisName);
                    $('.ec-calc-item__descr').text($thisDescr != '' ? $thisDescr + ' ...' : '' );
                    $('.cCalcValue').val($thisVolume);
                    $('.cCalcWeight').val($thisWeight);
                    if ( $thisImg ) $('.ec-calc-item__img').html('<img src="' + $thisImg + '">');
                }

                //Проверяем на параметры через параметры %)
                if ( PARAM.weight != 0 ) {
                    $('#ecCalcWeight').val(PARAM.weight);
                }
                if ( PARAM.value != 0) {
                    $('#ecCalcValue').val(PARAM.value);
                } else if ( PARAM.value == 0 && PARAM.size != 0) {
                    var size = PARAM.size.split(','), sum = 1;
                    if ( size.length == 3 ) {
                        for (var i=0;i<size.length;i++){
                            $('.ec-calc-form-size input')[i].value = parseInt(size[i]);
                            sum = sum * (parseInt(size[i])*0.01);
                        }
                        $('#ecCalcValue').val(sum<0.01 ? 0.01 : sum.toFixed(3));
                    }
                }

                //Проверяем стоит ли автоматическое определение города?
                if ( PARAM.autoEnd == 1 ) {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src = "https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU";
                    $("head").append(s);
                    setTimeout(function () {
                        try {
                            ymaps.ready(function() {
                                var country = ymaps.geolocation.country;
                                var city = ymaps.geolocation.city;

                                switch(country) {
                                    case 'Белоруссия':
                                        country = 'BY';
                                        break;

                                    case 'Казахстан':
                                        country = 'KZ';
                                        break;

                                    default:
                                        country = 'RU';
                                        break;
                                }

                                $('#ecCalcCityTo').val(city);
                                $('#ecCalcCityToHidden').val(country);

                                //Дубль
                                if ( $('#ecCalcCityTo').val() != '' && $('#ecCalcWeight').val() > 0 && $('#ecCalcValue').val() > 0  && PARAM.startCntr && PARAM.startCt && PARAM.autoResult == 1 ) {
                                    $('.ec-calc--preload').css('position','relative').fadeIn();
                                    $('.ec-calc-form, .ec-calc-border, .ec-calc__header').hide();
                                    getCalcResult();
                                    $('#ecCalcResult').append('<a href="#" class="ec-calc-again">Рассчитать с другими параметрами</a>');
                                    $('body').on('click', '.ec-calc-again', function (e) {
                                        e.preventDefault();
                                        $('.ec-calc-form, .ec-calc-border, .ec-calc__header').show();
                                        $(this).hide();
                                        $('#ecCalcResult').hide();
                                    });
                                    setTimeout(function () {
                                        $('.ec-calc--preload').css('position','absolute').fadeOut();
                                        $('#ecCalc').fadeIn();
                                    }, 3000);
                                }
                            });
                        } catch (e) {
                            console.log(e);
                        }
                    }, 2000);
                }

                //Проверяем, может установлен конечный пункт?
                if ( PARAM.endCt != 0 && PARAM.endCntr != 0) {
                    $('#ecCalcCityTo').val(PARAM.endCt);
                    $('#ecCalcCityToHidden').val(PARAM.endCntr); 
                    if ( (Number($('#ecCalcValue').val()) > 0 || Number($('#ecCalcWeight').val()) > 0) && PARAM.autoResult == 1 ) { 
                        $('.ec-calc-form, .ec-calc-border, .ec-calc__header').hide();
                        getCalcResult();
                        $('#ecCalcResult').append('<a href="#" class="ec-calc-again">Рассчитать с другими параметрами</a>');
                        $('body').on('click', '.ec-calc-again', function (e) {
                            e.preventDefault();
                            $('.ec-calc-form, .ec-calc-border, .ec-calc__header').show();
                            $(this).hide();
                        });
                    }
                    setTimeout(function () {
                        $('.ec-calc--preload').css('position','absolute').fadeOut();
                        $('#ecCalc').fadeIn();
                    }, 5000);
                } 

                //Вызываем функцию custom
                try {csblCustomFunc($);} catch(e){}

                // устанавливаем класс для адаптации
                setTimeout(function () {
                    var csblWidget = $('#ecCalcLay'),
                          iWidthWrap = csblWidget.innerWidth();

                    if (iWidthWrap >= 650) {
                        csblWidget.addClass('ec-calc-widget--650');
                    } else if (iWidthWrap >= 500) {
                        csblWidget.addClass('ec-calc-widget--500');
                    } else {
                        csblWidget.addClass('ec-calc-widget--mobile');
                    }

                    // Если нету параметров на конечный город
                    if ( PARAM.endCt == 0 || PARAM.endCntr == 0 ) { 
                        $('.ec-calc--preload').css('position','absolute').fadeOut();
                        $('#ecCalc').fadeIn();
                    } 
                }, 500);

                //init autocomplete
                $('#ecCalcCityFrom').autocomplete({
                    serviceUrl: apiEndPoint + '/city/from-group',
                    minChars: 1,
                    dataType : "json",
                    paramName: 'from-city-like',
                    deferRequestBy: 300,
                    transformResult: function(response, originalQuery) {
                            return {
                                suggestions: $.map(response.cities, function(dataItem) {
                                var text = dataItem[2].toUpperCase();
                                if ( text.match(originalQuery.toUpperCase()) ) {
                                    return { value: dataItem[2], data: dataItem[0], other: dataItem[1] };
                                }
                            })
                        };
                    },
                    onSelect: function (suggestion) {
                        $('#ecCalcCityFromHidden').val(suggestion.data);
                    },
                    formatResult: function (suggestion, currentValue) {
                        return '<i class="csblflags_' + getFlag(suggestion.data) + '"></i>' + suggestion.value + ', <span>' + suggestion.other + '</span>';
                    },
                    showNoSuggestionNotice: true,
                    noSuggestionNotice: "Такого маршрута в базе не найдено."
                });
                $('#ecCalcCityTo').autocomplete({
                    noCache: true,
                    serviceUrl: function (el, query){
                        return apiEndPoint + '/city/to-group?from-country=' + encodeURIComponent($('#ecCalcCityFromHidden').val()) + '&from-city=' + encodeURIComponent($('#ecCalcCityFrom').val()) + '';
                    },
                    minChars: 1,
                    dataType : "json",
                    paramName: 'to-city-like',
                    deferRequestBy: 300,
                    transformResult: function(response, originalQuery) {
                            return {
                                suggestions: $.map(response.cities, function(dataItem) {
                                var text = dataItem[2].toUpperCase();
                                if ( text.match(originalQuery.toUpperCase()) ) {
                                    return { value: dataItem[2], data: dataItem[0], other: dataItem[1] };
                                }
                            })
                        };
                    },
                    onSelect: function (suggestion) {
                        $('#ecCalcCityToHidden').val(suggestion.data);
                    },
                    formatResult: function (suggestion, currentValue) {
                        return '<i class="csblflags_' + getFlag(suggestion.data) + '"></i>' + suggestion.value + ', <span>' + suggestion.other + '</span>';
                    },
                    showNoSuggestionNotice: true,
                    noSuggestionNotice: "Такого маршрута в базе не найдено."
                });

                //Событие на расчет результата
                $('#acCalcGetResult').on('click', function (e) {
                    e.preventDefault();
                    getCalcResult();
                });

                // Не даем ввести ничего кроме числа в вес или объем
                $(document).on('keyup' ,'#ecCalcWeight, #ecCalcValue, .ec-calc-form-size input', function () {
                this.value = this.value.replace(/[^\d.|,]*/g, '')
                                 .replace(/([.|,])[.|,]+/g, '$1')
                                 .replace(/^[^\d]*(\d+([.|,]\d{0,5})?).*$/g, '$1');
                });

                // Событие для размеров и конвертацию в объем
                $('.ec-calc-form-size input').on('keyup', function () {
                    var
                        a = $(this).parent('.ec-calc-form-size').find('.sizeWidth').val(),
                        b = $(this).parent('.ec-calc-form-size').find('.sizeHeight').val(),
                        c = $(this).parent('.ec-calc-form-size').find('.sizeLong').val();

                    $(this).parents('.ec-calc-wrap-item').find('.cCalcValue').val( (parseFloat(a*b*c)*0.000001).toFixed(3) );
                });

                if ( PARAM.innerDeliv == 0 ) {
                    //Событие для открытия
                    $('.call-ec-widget').on('click', function (e) {
                        e.preventDefault();
                        $('#ecCalcLay').fadeIn();
                        $('html').addClass('ec-lock');
                    });
                }

                //Закрытие окна
                $('.ec-calc-layout, .ec-calc__close').on('click', function (e) {
                    if (e.target !== this) return;
                    $('#ecCalcLay').fadeOut();
                    $('html').removeClass('ec-lock');
                });

                // Clone
                function btn_remove () {
                    if ($(".ec-calc-wrap-item").length == 1) {
                        $('.cCalcItemClose').hide();
                    } else {
                        $('.cCalcItemClose').show();
                    }
                }
                var cloneIndex = $(".ec-calc-wrap-item").length;
                btn_remove();
                function clone(){
                    $(this).parents(".ec-calc-wrap-item").clone()
                        .appendTo(".ec-calc-form-clone")
                        .attr("id", "clonedInput" +  cloneIndex)
                        .find("*")
                        .each(function() {
                            var id = this.id || "";
                            $(this).val('');
                            if ( $(this).attr('class') === 'cCalcCountItem' ) $(this).val(1);
                            if( $(this).is('label') ) {
                                $(this).attr( 'for', $(this).attr('for') + cloneIndex );
                            }
                            if (id.length != 0) {
                                this.id += (cloneIndex);
                            }
                        });
                    cloneIndex++;
                    btn_remove();
                }

                function remove(){
                    $(this).parents(".ec-calc-wrap-item").remove();
                    btn_remove();
                }

                $(document).on("click", "div.cCalcItemAdd", clone);
                $(document).on("click", "div.cCalcItemClose", remove);

                //Показываем кнопку
                setTimeout(function() {
                    $('.ec-calc--call').fadeIn(); 
                }, 500);

            }); // end ready
        }; //main

    }());
}