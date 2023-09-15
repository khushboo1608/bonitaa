<!-- Custom scripts by Narayan  -->
<!-- Delete alert script -->
<script type='text/javascript'>
  var selected = $('#frmCompare :checkbox:checked').length;
  function verifCompare() {
    var agree=confirm("Are you sure to take the action...");  
    if (agree)
      return true ; 
    else  
      return false ; 
  }
  //display Red / Green Option 
  $(document).ready(function () {
    $('#frmCompare :checkbox').change(function(){
      //update selected variable
      selected = $('#frmCompare :checkbox:checked').length
      if (selected >= 1) {
        $('div#btnCompare').show(); 
      }else {
        $('div#btnCompare').hide();
      }
    });
  });
</script>

<script type='text/javascript'>
  $('document').ready(function(){
    $("#selectall").click(function () {
      $('.td').attr('checked', this.checked);
    });
    $(".td").click(function(){
      if($(".td").length == $(".td:checked").length) {
        $("#selectall").attr("checked", "checked");
      } else {
        $("#selectall").removeAttr("checked");
      }
    });
  });
</script>

<!-- Special Charactor Not Allowed Code -->
<!-- NOTE: id must be write in the input type field -->
<script type='text/javascript'>
function validateAlpha(){
    var textInput = document.getElementById("specialnotallowed").value;
    textInput = textInput.replace(/[^A-Za-z0-9]/g, "");
    document.getElementById("specialnotallowed").value = textInput;
}
</script>

<!-- Only Numbers | Alphabet not allowed  -->
<script type='text/javascript'>
  function valid(f) {
    !(/^[0-9]*$/i).test(f.value)?f.value = f.value.replace(/[^0-9]/ig,''):null;
  }
  function valida(f) {
    !(/^[A-z&.()#209;&#241;0-9]*$/i).test(f.value)?f.value = f.value.replace(/[^A-z&.()#209;&#241;0-9]/ig,''):null;
  }
</script>

<!-- Datatable script -->
<script>
  //by default all features are true
  $(function () {
    $('#example1_samy').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>

<!-- create popup script -->
<script>
  // function popupCenter(url, title, w, h) {
  function popupCenter(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
</script>

<!-- full length popup -->
<script language="JavaScript">
function Full_W_P(url) {
 params  = 'width='+screen.width;
 params += ', height='+screen.height;
 params += ', top=0, left=0'
 params += ', fullscreen=no';
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'FullWindowAll', params);
 if (window.focus) {newwin.focus()}
 return false;
}
</script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
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
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

<!-- Tiny Editor Scripts on Script page -->
<script>
  tinymce.init({
    selector: '#tinyeditor',
    plugins: ["a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed powerpaste table advtable tinymcespellchecker image advlist link image charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime nonbreaking save table directionality",
              "emoticons template paste textpattern", "hr"
          ],
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Mr. Samy',
  });
</script> 