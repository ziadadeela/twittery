<?php

namespace Bandago\Foundation\DataTables;


use Yajra\DataTables\Html\Builder;

class BaseBuilder extends Builder
{
    public function assets()
    {

        static::DataTableScripts();

    }

    public static function DataTableScripts()
    {
        \Assets::add(asset('assets/bandago/plugins/datatables.net-bs/css/dataTables.bootstrap4.min.css'));
        \Assets::add(asset('assets/bandago/plugins/datatables.net/js/jquery.dataTables.min.js'));
        \Assets::add(asset('assets/bandago/plugins/datatables.net-bs/js/dataTables.bootstrap4.min.js'));
        \Assets::add(asset('assets/bandago/plugins/datatables-buttons/js/dataTables.buttons.min.js'));
        \Assets::add(asset('assets/bandago/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'));
        \Assets::add(asset('assets/bandago/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'));
        \Assets::add(asset('assets/bandago/plugins/datatables.net/js/buttons.server-side.js'));
        \Assets::add(asset('assets/bandago/plugins/handlebars/handlebars.js'));

    }

    /**
     * @param null $script
     * @param array $attributes
     * @return \Illuminate\Support\HtmlString
     * @throws \Exception
     */
    public function scripts($script = null, array $attributes = ['type' => 'text/javascript'])
    {
        $tableId = $this->getTableAttribute('id');

        $script = $script ?: $this->generateScripts();

        $options = $this->options;
        if ($this->bulkActions()) {
            $script .= "
            $(document).on('change', '#{$tableId} .datatable-check-all', function(event){
                if($(this).prop('checked')){
                    $('#{$tableId} .datatable-row-checkbox').prop('checked',true).iCheck('update');
                }else{
                    $('#{$tableId} .datatable-row-checkbox').prop('checked',false).iCheck('update');
                }
            });
            
            $(document).on('change', '#{$tableId} .datatable-row-checkbox', function(event){
                var checkboxes = $('#{$tableId} .datatable-row-checkbox');
                
                if (checkboxes.length == checkboxes.filter(':checked').length) {
                    $('#{$tableId} .datatable-check-all').prop('checked', 'checked').iCheck('update');
                } else {
                    $('#{$tableId} .datatable-check-all').prop('checked', false).iCheck('update');
                }
            });
            
            $(document).on('click', '#bulk_actions_{$tableId} a', function(event){
                event.preventDefault();
                var confirmation_message = $(this).data('confirmation');
                var action = $(this).data('action');
				if(confirmation_message){
					themeConfirmation(
						bandago.confirmation.title,
						confirmation_message,
						'warning',
						bandago.confirmation.yes,
						bandago.confirmation.cancel,
						function () {
                            do_bulk_action_{$tableId}(action);
                        }
					)
            
				}else{
                     do_bulk_action_{$tableId}(action);
				}  
			});
         
        function do_bulk_action_{$tableId}(action , data_table ){

            checked_ids = $('#$tableId tbody input:checkbox:checked').map(function () {
                return $(this).val();
            }).get();

        
            $.ajax({
                url: '" . $options['resource_url'] . "/bulk-action',
                type: 'POST',
                data: { selection:  JSON.stringify(checked_ids) , action : action , _token: '" . csrf_token() . "'},
                dataType: 'json',
                success: function (json) {
                $('#$tableId').DataTable().ajax.reload(); // now refresh datatable
                $.each(json, function (key, msg) {
                    themeNotify(msg);
                });
            }
            });
        } 
            
            ";
        }


        if ($this->row_details_template) {


            $script .= "    
            var template = Handlebars.compile($('#{$tableId}-details-template').html());
                // Add event listener for opening and closing details
                var table = $('#{$tableId}').DataTable();

                $('#{$tableId} tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row( tr );
            
                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child( template(row.data()) ).show();
                        tr.addClass('shown');
                    }
                });";
        }
        if (isset($options['ordering']) && $options['ordering']) {
            $script .= "
            var table = $('#{$tableId}').DataTable();
            
            table.on('row-reorder', function (e, diff, edit) {
                var orderArray = [];
                for (var i = 0, ien = diff.length; i < ien; i++) {
                    var rowData = table.row(diff[i].node).data();
                    orderArray.push({
                        id: rowData.id,			// record id from datatable
                        position: diff[i].newPosition		// new position
                    });
                }
                var jsonString = JSON.stringify(orderArray);
                $.ajax({
                    url: '" . $options['resource_url'] . "/reorder',
                    type: 'POST',
                    data: jsonString,
                    dataType: 'json',
                    success: function (json) {
                    $('#{$tableId}').DataTable().ajax.reload(); // now refresh datatable
                    $.each(json, function (key, msg) {
                        themeNotify(msg);
                    });
                }
                });
            });";
        }

        return parent::scripts($script, $attributes);
    }

}
