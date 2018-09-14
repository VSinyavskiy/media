(function ($, undefined) {
    /**
     * Namespace
     * @var object
     */
    var ns = namespace('common.http-method');


    /**
     * Initializes namespace
     */
    ns.init = function() {
        ns.initDataMethod();
        ns.initAjaxCsrf();
    };

    ns.initDataMethod = function() {
        $('[data-method]').each(function () {
            var that = $(this);
            var onclick = (typeof that.attr('onclick') === 'undefined') ? '' : that.attr('onclick');
            var pdata = that.data('params');
            var params = '';

            // get params
            if(typeof pdata != 'undefined') {
                for(var name in pdata) {
                    params += '   <input type="hidden" name="' + name + '" value="' + pdata[name] + '">' + "\n";
                }
            }

            that.append(function(){
                return "\n" +
                '<form action="' + that.attr('href') + '" method="POST" style="display:none">' + "\n" +
                '   <input type="hidden" name="_method" value="' + that.attr('data-method') + '">' + "\n" +
                '   <input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">' + "\n" +
                params + "\n" +
                '</form>' + "\n";
            })
            .removeAttr('href')
            .removeAttr('data-method')
            .attr('style','cursor:pointer;')
            .attr('onclick', onclick + '$(this).find("form").submit();');
        });
    };

    ns.initAjaxCsrf = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    };

    $(ns.init);
})(jQuery);
