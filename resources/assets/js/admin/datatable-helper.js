(function ($, undefined) {
    /**
     * Namespace
     * @var object
     */
    var ns = namespace('datatable-helper');

    ns.dataTable = [];

    /**
     * Initializes namespace
     */
    ns.init = function() {

    }

    ns.initTable = function(tableId, ajax, columns, coloredColumns = []) {
        var $table       = $(tableId);
        var lang         = $('html').attr('lang');
        var aoSearchCols = [];

        // find default search values for aoSearchCols
        $table.find('tfoot th').each(function () {
            var default_val = $(this).data('default');

            if(typeof default_val !== 'undefined') {
                aoSearchCols.push({ "sSearch": default_val });
            } else {
                aoSearchCols.push(null);
            }
        });

        // Init datatable
        ns.dataTable[tableId] = $table.DataTable({
            language: {
                url: '/assets/datatables/i18n/' + lang + '.json'
            },
            // "scrollX":        true,
            processing:       true,
            serverSide:       true,
            ajax:             ajax,
            'aoSearchCols':   aoSearchCols,
            columns:          columns,
            'lengthMenu': [[-1, 10, 25, 50], ['', 10, 25, 50]],
            'iDisplayLength': $(tableId).data('length') ? $(tableId).data('length') : 10,
            'fnDrawCallback': function(settings) {
                namespace('common.http-method').initDataMethod();
                ns.initAjaxButtons();
            },
            createdRow: function (row, data, index) {        
                coloredColumns.forEach(function(item, i) {
                    $('td:has(' + item.condition_value + ')', row).addClass(item.class);
                });
            },
        });

        // Init search inputs/selects
        $table.find('tfoot th.searchable').each(function () {
            var title = $(this).text();

            if($(this).hasClass('searchable')) {
                var select      = $(this).data('select');
                var default_val = $(this).data('default');

                if(select) {
                    var el = '<select class="form-control search-select" style="width:100%;">';
                       // el += '<option value="" selected>- ' + $(this).text() + ' -</option>';
                       el += '<option value=""></option>';
                    for(var val in select) {
                        var selected = '';
                        if(val == default_val) {
                            selected = 'selected';
                        }

                        el += '<option value="' + val + '" ' + selected + '>' + select[val] + '</option>';
                    }
                    el    += '</select>';

                    $(this).html(el);
                } else {
                    $(this).html('<input type="text" class="form-control search-input" style="width:100%;" placeholder="' + title + '" />');
                }
            }
        });

        // Apply the search by input/selects touch
        ns.dataTable[tableId].columns().every(function (index) {
            var that  = this,
                index = $(this).get(0);

            var $elem   = $($table.find('tfoot tr th').get(index)),
                $input  = $elem.find('input'),
                $select = $elem.find('select');

            // input by keyup with timeout
            var timer;
            $input.on('keyup change', function () {
                clearTimeout(timer);

                var this2 = this;
                timer = setTimeout(function() {
                    if(that.search() !== this2.value) {
                        that.search(this2.value).draw();
                    }
                }, 300);
            }).on('keydown', function() { clearTimeout(timer); });

            // select on change
            $select.on('change', function () {
                if(that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    };

    ns.reloadTable = function(tableId) {
        ns.dataTable[tableId].ajax.reload(null, false);
    };

    ns.initAjaxButtons = function() {
        $('[data-ajax="true"]').each(function () {
            $btn = $(this);
            $btn.removeAttr('onclick');

            $(this).on('click', ns.clickAjaxButton);
        });
    };

    ns.clickAjaxButton = function(e) {
        e.preventDefault();

        var $btn    = $(e.currentTarget),
            onclick = $btn.data('onclick'),
            $form   = $btn.find('form');

        if(typeof onclick != 'undefined') {
            if(eval('(function() {' + onclick + '}())') == false) {
                return false;
            }
        }

        if($form.length) {
            var url    = $form.attr('action'),
                method = (typeof $form.attr('method') != 'undefined') ? $form.attr('method') : 'GET',
                data   = $form.serialize();
        } else {
            var url    = $btn.attr('href'),
                method = 'GET'
                data   = null;
        }

        $.ajax({
            type:    method,
            url:     url,
            data:    data,
            success: function(data) {
                ns.reloadTable('#' + $btn.parents('table').attr('id'));
            }
        });
    };


    $(ns.init);
})(jQuery);
