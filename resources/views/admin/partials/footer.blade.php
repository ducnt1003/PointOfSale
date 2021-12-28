<!-- jQuery -->
<script src="/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- jQuery Knob Chart -->
<script src="/template/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/template/plugins/moment/moment.min.js"></script>
<script src="/template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/template/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<!-- SweetAlert2 -->
<script src="/template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="/template/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/template/dist/js/demo.js"></script>

<script src="/template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- Select2 -->
<script src="/template/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/template/plugins/moment/moment.min.js"></script>
<script src="/template/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- bootstrap color picker -->
<script src="/template/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Switch -->
<script src="/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    });
</script>


@yield('js')
@yield('modal')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
{{--Upload File--}}
<script>
    $('#upload').change(function (){
        const form = new FormData();
        form.append('file',$(this)[0].files[0]);
        $.ajax({
            contentType:false,
            processData: false,
            type:'POST',
            dataType:'JSON',
            data:form,
            url: '/admin/upload',
            success:function (results){
                if (results.error===false){
                    $('#image_show').html('<a href="' + results.url +'"target="_blank">'+
                        '<img class = "img-thumbnail" src="'+results.url+'" width="200px"></a>');
                    $('#photo').val(results.url);
                }else{
                    alert('Upload file lỗi');
                }
            }
        })
    })
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

    })
</script>

