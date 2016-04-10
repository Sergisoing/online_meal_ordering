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
            }
        },
        alert: function (type, content) {
            this.alertHandel && clearTimeout(this.alertHandel);
            var alertDiv = $('#alert-div');
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
                    default:
                    break;
            }
            alertDiv.fadeIn(300).children('.alert-text').text(content);
            this.alertHandel = setTimeout(function () {
                alertDiv.fadeOut(300);
            }, 1000);
        },
        successAlert:   function (content) { this.alert('success', content); },
        dangerAlert:    function (content) { this.alert('danger', content); },
        warningAlert:   function (content) { this.alert('warning', content); },
        infoAlert:      function (content) { this.alert('info', content); }
    };
    window.Common = CommomTool;
})();

Common.init();
