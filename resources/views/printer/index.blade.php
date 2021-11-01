 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@lang('printer.printers')
         <small>@lang('printer.manage_your_printers')</small>
     </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
 </section>

 <div class="page-title hidden">
     {{ __('printer.printers') }}
 </div>

 <!-- Main content -->
 <section class="content">
     <div class="">
         <button class="add_btn btn-modal" data-href="{{ action('PrinterController@create') }}"
             data-container=".print_modal">
             <i class="fa fa-plus"></i> @lang('messages.add')
         </button>
     </div>
     <div class="table-responsive">
         <table data-title="{{ __('printer.printers') }}" class="table table-bordered table-striped"
             id="printer_table">
             <thead>
                 <tr>
                     <th>@lang('printer.name')</th>
                     <th>@lang('printer.connection_type')</th>
                     <th>@lang('printer.capability_profile')</th>
                     <th>@lang('printer.character_per_line')</th>
                     <th>@lang('printer.ip_address')</th>
                     <th>@lang('printer.port')</th>
                     <th>@lang('printer.path')</th>
                     <th>@lang('messages.action')</th>
                 </tr>
             </thead>
         </table>
     </div>

 </section>

 <div class="modal fade print_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
 </div>
 <!-- /.content -->

 <script type="text/javascript">
    function reloadEdits() {

        $(document).on('click', 'button.edit_printer_button', function() {
            $('div.printer_modal').load($(this).data('href'), function() {
                $(this).modal('show');

                $('form#edit_printer_form').submit(function(e) {
                    e.preventDefault();
                    $(this)
                        .find('button[type="submit"]')
                        .attr('disabled', true);
                    var data = $(this).serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                $('div.print_modal').modal('hide');
                                toastr.success(result.msg);
                                printer_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                });
            });
        });
    }

     $(document).ready(function() {
         var printer_table = $('#printer_table').DataTable({
             processing: true,
             serverSide: true,
             buttons: [],
             ajax: '/printers',
             bPaginate: false,
             @include("layouts.partials.datatable_plugin")
             columnDefs: [{
                 "targets": 2,
                 "orderable": false,
                 "searchable": false
             }]
         });
         $(document).on('click', 'button.delete_printer_button', function() {
             swal({
                 title: LANG.sure,
                 text: LANG.confirm_delete_printer,
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             }).then((willDelete) => {
                 if (willDelete) {
                     var href = $(this).data('href');
                     var data = $(this).serialize();

                     $.ajax({
                         method: "DELETE",
                         url: href,
                         dataType: "json",
                         data: data,
                         success: function(result) {
                             if (result.success === true) {
                                 toastr.success(result.msg);
                                 printer_table.ajax.reload();
                             } else {
                                 toastr.error(result.msg);
                             }
                         }
                     });
                 }
             });
         });
         $(document).on('click', 'button.set_default', function() {
             var href = $(this).data('href');
             var data = $(this).serialize();

             $.ajax({
                 method: "get",
                 url: href,
                 dataType: "json",
                 data: data,
                 success: function(result) {
                     if (result.success === true) {
                         toastr.success(result.msg);
                         printer_table.ajax.reload();
                     } else {
                         toastr.error(result.msg);
                     }
                 }
             });
         });

         // modal actions
         $(document).on('submit', 'form#add_printer_form', function(e) {
             e.preventDefault();
             $(this)
                 .find('button[type="submit"]')
                 .attr('disabled', true);
             var data = $(this).serialize();

             console.log(data);

             $.ajax({
                 method: 'POST',
                 url: $(this).attr('action'),
                 dataType: 'json',
                 data: data,
                 success: function(result) {
                     if (result.success == true) {
                         $('div.print_modal').modal('hide');
                         toastr.success(result.msg);
                         printer_table.ajax.reload();
                     } else {
                         toastr.error(result.msg);
                     }
                 },
             });
         });

         
         reloadEdits();
     });
 </script>
