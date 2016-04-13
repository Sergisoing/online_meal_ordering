(function() {
    var CommomTool = {
        alertHandel: null,
        init: function () {
            $.fn.none = function () {
                $(this).css('display', 'none');
                return $(this);
            };
            $.fn.display = function () {
                $(this).css('display', 'block');
                return $(this);
            };
        },
        alert: function (type, content) {
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
            }, 1000);
        },
        successAlert:   function (content) { this.alert('success', content); },
        dangerAlert:    function (content) { this.alert('danger', content); },
        warningAlert:   function (content) { this.alert('warning', content); },
        infoAlert:      function (content) { this.alert('info', content); },
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
        buttonGet: function (btn, url, data, callback) { this.buttonAjax(btn, 'GET', url, data, callback) }
    };
    window.Common = CommomTool;
})();

Common.init();
