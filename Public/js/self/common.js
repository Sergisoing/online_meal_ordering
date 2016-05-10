(function() {
    var CommomTool = {
        alertHandel: null,
        dialogHandel: null,
        init: function () {
            $.fn.none = function () {
                $(this).css('display', 'none');
                return $(this);
            };
            $.fn.display = function () {
                $(this).css('display', 'block');
                return $(this);
            };

            window._type = function (o) {
                var str = Object.prototype.toString.call(o);
                return str.match(/\[object (.*)\]/)[1].toLowerCase();
            };
            [
                'Null',
                'Number',
                'Undefined',
                'String',
                'Array',
                'Boolean',
                'RegExp'
            ].forEach(function (t) {
                _type['is' + t] = function (o) {
                    return _type(o) ===  t.toLowerCase();
                }
            });

            // 对Date的扩展，将 Date 转化为指定格式的String
            // 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
            // 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
            // 例子：
            // (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
            // (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18
            Date.prototype.Format=function(fmt){var o={"M+":this.getMonth()+1,"d+":this.getDate(),"h+":this.getHours(),"m+":this.getMinutes(),"s+":this.getSeconds(),"q+":Math.floor((this.getMonth()+3)/3),"S":this.getMilliseconds()};if(/(y+)/.test(fmt))fmt=fmt.replace(RegExp.$1,(this.getFullYear()+"").substr(4-RegExp.$1.length));for(var k in o)if(new RegExp("("+k+")").test(fmt))fmt=fmt.replace(RegExp.$1,(RegExp.$1.length==1)?(o[k]):(("00"+o[k]).substr((""+o[k]).length)));return fmt};String.prototype.padLeft=function(nSize,ch){var len=0;var s=this?this:"";ch=ch?ch:'0';len=s.length;while(len<nSize){s=ch+s;len++}return s};String.prototype.padRight=function(nSize,ch){var len=0;var s=this?this:"";ch=ch?ch:'0';len=s.length;while(len<nSize){s=s+ch;len++}return s};String.prototype.movePointLeft=function(scale){var s,s1,s2,ch,ps,sign;ch='.';sign='';s=this?this:"";if(scale<=0)return s;ps=s.split('.');s1=ps[0]?ps[0]:"";s2=ps[1]?ps[1]:"";if(s1.slice(0,1)=='-'){s1=s1.slice(1);sign='-'}if(s1.length<=scale){ch="0.";s1=s1.padLeft(scale)}return sign+s1.slice(0,-scale)+ch+s1.slice(-scale)+s2};String.prototype.movePointRight=function(scale){var s,s1,s2,ch,ps;ch='.';s=this?this:"";if(scale<=0)return s;ps=s.split('.');s1=ps[0]?ps[0]:"";s2=ps[1]?ps[1]:"";if(s2.length<=scale){ch='';s2=s2.padRight(scale)}return s1+s2.slice(0,scale)+ch+s2.slice(scale,s2.length)};String.prototype.movePoint=function(scale){if(scale>=0)return this.movePointRight(scale);else return this.movePointLeft(-scale)};Number.prototype.toFixed=function(scale){var s,s1,s2,start;s1=this+"";start=s1.indexOf(".");s=s1.movePoint(scale);if(start>=0){s2=Number(s1.substr(start+scale+1,1));if(s2>=5&&this>=0||s2<5&&this<0){s=Math.ceil(s)}else{s=Math.floor(s)}}return s.toString().movePoint(-scale)};
        },
        alert: function (type, content, callback) {
            var alertDiv = $('#alert-div');
            this.alertHandel && clearTimeout(this.alertHandel);
            alertDiv.removeClass('alert-success alert-warning alert-info alert-danger ');
            alertDiv.children('.m-right-xs').removeClass('fa-check-circle fa-exclamation-circle fa-times-circle');
            switch (type) {
                case 'success': alertDiv.addClass('alert-success').children('.m-right-xs').addClass('fa-check-circle');
                    break;
                case 'warning': alertDiv.addClass('alert-warning').children('.m-right-xs').addClass('fa-exclamation-circle');
                    break;
                case 'danger': alertDiv.addClass('alert-danger ').children('.m-right-xs').addClass('fa-times-circle');
                    break;
                case 'info': alertDiv.addClass('alert-info').children('.m-right-xs').addClass('fa-exclamation-circle');
                    break;
                    default:
            }
            alertDiv.fadeIn(300).children('.alert-text').text(content);
            this.alertHandel = setTimeout(function () {
                alertDiv.fadeOut(300);
                if (callback) {
                    callback();
                }
            }, 1000);
        },
        successAlert:   function (content, callback) { this.alert('success', content, callback); },
        dangerAlert:    function (content, callback) { this.alert('danger', content, callback); },
        warningAlert:   function (content, callback) { this.alert('warning', content, callback); },
        infoAlert:      function (content, callback) { this.alert('info', content, callback); },
        buttonAjax: function (btn ,type, url, data, callback) {
            var originButton = null;
            originButton = btn.html();
            if (/Loading/.test(originButton)) {
                return false;
            }
            $.ajax({
                url: url,
                type: type,
                dataType: 'json',
                data: data,
                beforeSend: function () {
                    btn.html('<i class="fa fa-spinner fa-spin m-right-xs"></i>Loading');
                }
            })
            .done(function(res) {
                callback(res);
            })
            .fail(function() {
                Common.warningAlert('网络错误，请稍后再试');
                return false;
            })
            .always(function() {
                btn.html(originButton);
            });
        },
        buttonPost: function (btn, url, data, callback) { this.buttonAjax(btn, 'POST', url, data, callback) },
        buttonGet: function (btn, url, data, callback) { this.buttonAjax(btn, 'GET', url, data, callback) },
        lSave: function (key, value) {
            var typeKey = _type(key);
            if (typeKey == 'string') {
                localStorage.setItem(key, JSON.stringify(value));
            } else if (typeKey == 'object') {
                for (var k in key) {
                    localStorage.setItem(k, JSON.stringify(key[k]));
                }
            }
        },
        lRead: function (key) {
            return JSON.parse(localStorage.getItem(key));
        },
        get: function (bashUrl, key) {
            var getArr = location.pathname.replace(bashUrl, '').split('/');
            for (var k in getArr) {
                if (k % 2 == 0 && getArr[k] == key) {
                    break;
                }
            }
            return getArr[1+parseInt(k)];
        },
        isEmptyObject: function (obj) {
            for (var n in obj) {
                return false;
            }
            return true;
        },
        dialogConflig: function () {
            if ($('#confirmDialog').css('display') == 'block') {
                $('#confirmDialog').modal('hide');
            }
            if ($('#alertDialog').css('display') == 'block') {
                $('#alertDialog').modal('hide');
            }
        },
        confirmDialog: function (body, confirmCallback, closeCallback ,title) {
            this.dialogConflig();
            $('#confirmDialog').find('.modal-body').text(body);
            if (confirmCallback) {
                $('#confirmDialog').find('._confirm').on('click', function () {
                    setTimeout(confirmCallback, 1000);
                    $('#confirmDialog').find('._confirm').off('click');
                });
            }
            if (closeCallback) {
                $('#confirmDialog').find('._close').on('click', function () {
                    setTimeout(closeCallback, 1000);
                    $('#confirmDialog').find('._close').off('click');
                });
            }
            $('#confirmDialog').find('.modal-title').text(title);
            $('#confirmDialog').modal('toggle');
        },
        alertDialog: function (body, callback, title) {
            this.dialogConflig();
            $('#alertDialog').find('.modal-body').text(body);
            if (callback) {
                $('#alertDialog').find('._close').on('click', function () {
                    setTimeout(callback, 1000);
                    $('#alertDialog').find('._close').off('click');
                });
            }
            if (title) {
                $('#alertDialog').find('.modal-title').text(title);
            }
            $('#alertDialog').modal('toggle');
        },
    };
    window.Common = CommomTool;
})();

Common.init();
