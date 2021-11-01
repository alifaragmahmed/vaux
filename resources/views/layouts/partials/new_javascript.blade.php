<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/formajax.js') }}"></script>
<script src="{{ url('/') }}/js/jspdf.debug.js"></script>
<script src="{{ url('/') }}/js/print.min.js"></script> 
<script src="{{ url('/') }}/js/owl.carousel.min.js"></script>  
<script src="{{ url('/') }}/js/intro.min.js"></script>  
<script>
    var loader = {
        show: function(){
            $('.loader').show();
        },
        hide: function(){
            $('.loader').hide();
        }
    };

    function editDatatable() {
        setTimeout(function() {
            $('.dataTables_wrapper').each(function() {
                try {
                    
                var _this = this;

                if ($(_this).attr('datatable-edit') == '1')
                    return 0;

                var dtButtons = $(_this).find('.dt-buttons')[0];
                if (dtButtons)
                    dtButtons.style.float = "right";

                $(_this).find('.dataTables_filter label').css('float', 'right');

                // add icons to buttons
                $(_this).find('.dt-button').addClass('new-theme-text');

                $(_this).find('.dt-buttons .buttons-copy')[0].innerHTML +=
                    "<i class='fa fa-clipboard' style='margin:4px' ></i>";
                $(_this).find('.dt-buttons .buttons-pdf')[0].innerHTML +=
                    "<i class='fa fa-file-pdf' style='margin:4px' ></i>";
                $(_this).find('.dt-buttons .buttons-excel')[0].innerHTML +=
                    "<i class='fa fa-file-excel' style='margin:4px' ></i>";
                $(_this).find('.dt-buttons .buttons-csv')[0].innerHTML +=
                    "<i class='fa fa-file-csv' style='margin:4px' ></i>";

                // datatable download button
                var ddbtn = document.createElement('button');
                ddbtn.className = "datatable-export-button";
                ddbtn.style.float = "right";
                ddbtn.style.margin = "5px";
                ddbtn.innerHTML = "<i class='fas fa-download' ></i>";

                $(ddbtn).click(function() {
                    $(_this).find('.dt-buttons').toggle(400);
                });

                // remove search word
                if ($(this).find('.dataTables_filter').find('label')[0].childNodes.length > 1) {
                    $(this).find('.dataTables_filter').find('label')[0].childNodes[0].remove();
                }

                // move button of col visiblty 
                $(_this).find('.buttons-colvis').css('float', 'right');
                $(_this).find('.dataTables_filter').append($(this).find('.buttons-colvis')[0]);

                $(_this).find('.dataTables_filter').append(ddbtn);
                $(_this).find('.dataTables_filter').append(dtButtons);

                // create table caption 
                var tableTitle = document.createElement('div');
                tableTitle.className = "w3-text-black";
                tableTitle.style.float = "left";
                tableTitle.style.margin = "5px";
                tableTitle.innerHTML = "<i class='fa fa-table' style='padding: 10px' ></i>" + $(_this)
                    .find(
                        '.dataTable').attr(
                        'data-title');
                $(_this).find('.dataTables_filter').append(tableTitle);

                // move entry count select  
                $(_this).find('.dataTables_length label').css('float', 'right');
                $(_this).find('.dataTables_length label').css('margin', '5px');
                $(_this).find('.dataTables_info').parent().append($('.dataTables_length label')[0]);

                $(_this).find('.dataTables_info').css('margin', '5px');
                $(_this).find('.dataTables_info').parent().append($('.dataTables_info')[0]);


                $(_this).find('.dataTables_info').addClass('w3-text-black');

                $(_this).find('.dataTables_info').css('float', 'right');
                $(_this).find('.dataTables_paginate').css('float', 'left');


                $(_this).find('.dataTables_filter label .form-control')
                    .addClass(
                        'datatable-search');

                // add button
                $('.glyphicon .glyphicon-edit').addClass('fa fa-edit');
                $('.glyphicon .glyphicon-trash').addClass('fa fa-trash');

                //if ($(_this).find('.pagination').length <= 0)
                //    return;

                // set pagniation angle
                $(_this).find('.pagination .next a').html('<i class="fa fa-angle-right" ></i>');
                $(_this).find('.pagination .previous a').html('<i class="fa fa-angle-left" ></i>');

                // 
                $(_this).attr('datatable-edit', '1');

                @if (request()->action_type == 'export')
                    exportData(_this);
                @endif

                @if (request()->search_key)
                    $('.datatable-search').val('{{ request()->search_key }}');
                    setTimeout(function(){$('.datatable-search').keyup();}, 1000);
                @endif
                }catch(e){} 
            });
        }, 1000);
    }

    function preModals() {
        $('.modal').each(function() {
            if ($(this).attr('data-edit') != '1') {
                $(document.body).append($(this));
                $(this).attr('data-edit', '1');
            }
        });
    }

    function activateIcheck() { 
        //return;
        // activate Icheck 
        $('input[type=checkbox]').each(function(){

            var input = this;

            if ( $(input).attr('edit') == '1')
                return;
            //input.style.display = "none";
            //var cloneInput = document.createElement('input');
            //cloneInput.type = "checkbox";
            //console.log("cloneInput : ", cloneInput);
            //$(input).parent().append(cloneInput);

            // clone the value 
            //cloneInput.value = input.value;
            //cloneInput.checked = input.checked;
             

            $(input).iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $(input).on('ifChecked', function(){
                input.checked = true;
                input.value = 1;
                // 
                $(input).change();
            });
            
            $(input).on('ifUnchecked', function(){
                input.checked = false;
                input.value = 0;
                // 
                $(input).change();
            });

            $(input).attr('edit', '1');
        });
        
        /*iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });*/

    }

    function exportData(parent) {
        $(parent).find('.buttons-{{ request()->export_option }}').click();
        window.top.close();
    }

    function makeExport(url, option='pdf') {
        var iframe = document.getElementById('exportIframe');

        if (!iframe) {
            iframe = document.createElement('iframe');
            iframe.id = "exportIframe";
            document.body.append(iframe);
        }

        // show loader 
        var html = $('#exportBtn').html();
        $('#exportBtn').html(__fa_awesome());

        $(iframe).slideUp();

        url += url.indexOf('?') >= 0? "&action_type=export" : "?action_type=export";
        url = "{{ url('/') }}/" + url + "&export_option=" + option;

        iframe.src = url;
        //window.open(url);

        // hide the loader
        iframe.onload = function(){ 
            $('#exportBtn').html(html);
        };
    }

    function changeTheme(button) {
        if (document.body.className.indexOf('dark') >= 0) {
            $(document.body).removeClass('dark');
            button.innerHTML = '<i class="fas fa-moon"></i>';
        } else {
            $(document.body).addClass('dark');
            button.innerHTML = '<i class="fas fa-lightbulb"></i>';
        }
    }

    function searchInPage() {
        var url = $('#selectSearchPage').val();
        var search = $('#inputSearchPage').val();

        url += url.indexOf('?') >= 0? "&search_key=" + search : "?search_key=" + search;
        url = "{{ url('/') }}/" + url; 

        window.location = url;
    }

    function fullScreen(element) {
        if (!element)
            element = document.querySelector("html");

        if ($(element).attr('is_full_screen') == 1 && document.fullscreenEnabled) { 
            //element = document.querySelector("html"); 
            // make the element go to full-screen mode
            document.exitFullscreen()
            .then(function() {
                    // element has entered fullscreen mode successfully
            })
            .catch(function(error) {
                    // element could not enter fullscreen mode
            }); 
            $(element).attr('is_full_screen', 0);
        } else {
            //var element = document.querySelector("html"); 
            // make the element go to full-screen mode
            element.requestFullscreen()
            .then(function() {
                    // element has entered fullscreen mode successfully
            })
            .catch(function(error) {
                    // element could not enter fullscreen mode
            });

            $(element).attr('is_full_screen', 1);
        }
    }

    function downloadImage(selector, ext) {
        var element = $(selector)[0]; // global variable
        if (!ext)
            ext = "png";

        console.log(element);
        var getCanvas; // global variable
        $(document).ready(function(){
            html2canvas(element, {
                onrendered: function (canvas) { 
                    getCanvas = canvas;
                    
                    var imageData = getCanvas.toDataURL("image/" + ext);
                    // Now browser starts downloading it instead of just showing it
                    var newData = imageData.replace(/^data:image\/ext/, "data:application/octet-stream");

                    console.log(newData); 
                    //window.open(newData, "400");
                    var link = document.createElement('a');

                    link.setAttribute("download", "image." + ext);
                    link.href = newData;
                    link.click(); 
                }
            });
        });
    }

    function printElement(id) {
        printJS({
            printable: id,
            type: 'html',
            css: ['/css/bootstrap.min.css', '/css/w3.css', '/css/style.css', '/css/custom_css.css']
        });
    }

    var MyChart = {
        FULL_SCREEN: 1,
        PRINT: 2,   
        PDF: 3,
        PNG: 4,
        JPG: 5, 
        SVG: 6,  
        export: function(selector, chartConfig){
            var id = new Date().getTime();
            if ($(selector).attr('id').length <= 0) {
                $(selector).attr('id', id);
            } else {
                id = $(selector).attr('id');
            }

            switch(chartConfig) {
                case MyChart.FULL_SCREEN : fullScreen($(selector)[0]); 
                break;
                case MyChart.PRINT : printElement(id); 
                break;
                case MyChart.PDF : downloadImage(selector, "pdf"); 
                break;
                case MyChart.PNG : downloadImage(selector, "png"); 
                break;
                case MyChart.JPG : downloadImage(selector, "jpg"); 
                break;
                case MyChart.SVG : downloadImage(selector, "svg"); 
                break;
            }
        }
    };

    function setImport(value) {
        console.log("import value ", value);
        var split = "*";
        var strings = value.split(split);
        var action = strings[0];
        var inputName = strings[1];
        var href = strings[2];
        var div = strings[3];


        $('#importForm').attr('action', action);
        $('#importDownloadLink').attr('href', href);
        $('#importForm input[type=file]').attr('name', inputName);

        console.log(action);
        console.log(inputName);
        console.log(href);
        $('#importDownloadLink').show();
        
        // hidden all notes
        $('.import_note').slideUp(300);

        // show selected note
        $('#import_note_' + div).slideDown(300);

        if (inputName != 'sales') {
            formAjax();
        } else {
            $('#importForm')[0].onsubmit = null;
        }
    }

    function createSku(prefix) {
        return (prefix? prefix + "-" : '') + new Date().getTime();
    }

    function setActiveForSidebarList() {
        var link = window.location.href
        .replace(window.location.origin, '')
        .replace('#', '')
        .replace('/', '');
        $('.sidebar-menu li').each(function(){
            var currentLink = $(this).find('a').attr('href')
            .replace(window.location.origin, '')
            .replace('#', '')
            .replace('/', '');
 
            if (currentLink == link) {
                $(this).addClass('active');
                console.log($(this).parent().parent());

                if ($(this).parent().parent()[0].className.indexOf('treeview') >= 0) {  
                    $(this).parent().parent().find('.sidemen-item-a').click();
                } 
            }
        });
    }

    $(document).ready(function() {
        formAjax();
        editDatatable();
        activateIcheck();

        setTimeout(function(){
            $('.nav-item').click(function(){
                editDatatable();
            });
        }, 2000);

        const targetNode = document.body;
        const config = {
            childList: true,
            subtree: true
        };

        const callback = function(mutationsList, observer) {

            for (let mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    preModals(); 
                    activateIcheck();
                }
            }
        };

        const observer = new MutationObserver(callback);
        observer.observe(targetNode, config);
        var shown = true;

        $('#nav-icon2').click(function(){
            if (shown) {
                $('.main-sidebar').css('left', '-3000px');
            } else {
                $('.main-sidebar').css('left', '0px');
            }

            shown = !shown; 


        });


        // run mobile sidebar
        $('.mobile-sidebar').html($('.sidebar').html());  
        $('.mobile-sidebar .treeview').each(function(){
            var self = this;
            $(this).find('.sidemen-item-a').click(function(){
                $(self).find('.treeview-menu').slideToggle(300);
            });
        });
        

        // add listner to mobile slide toggle 
        $('#mobileToggle, .sidebar-toggle-mobile').each(function(){
            this.onclick = function(){ 
                $('.mobile-sidebar').toggle();
            };
        });

        $(document).ready(function(){
            
            setActiveForSidebarList();
        });

    });
</script>
