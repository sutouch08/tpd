var HOME = `${BASE_URL}report/customer_status/`;

function getReport() {      
  load_in();

  $.ajax({
    url:`${HOME}get_report`,
    type:'GET',
    cache:false,    
    success:function(rs) {
      load_out();
      if(isJson(rs)) {
        var data = $.parseJSON(rs);
        var source = $('#report-template').html();
        var output = $('#result');
        render(source, data, output);
      }
      else {
        showError(rs);
      }
    },
    error:function(rs) {
      showError(rs);
    }
  });
}


function doExport() {  
  var token = $('#token').val();
  get_download(token);
  $('#reportForm').submit();
}
