$("#datetimepicker").change(function(){
          var current_time=$('#datetimepicker').val();
          var slectedTime = moment(current_time, 'DD/MM/YYYY H:mm');
          var now = moment();
          var difernt=  slectedTime.diff(now) // 1
          var d = moment.duration(difernt);
          if (d<=0) {
            $('.date_input').addClass('has-error');
            $('.error_ontime').html('Check time it must be greater than actual time');
          }else{
            $('.date_input').removeClass('has-error');
            $('.error_ontime').html('');
          }
          $('.date_final').val(current_time);
});

function getActualHour() {
    var d = new Date();
    var h = addZero(d.getHours());
    var m = addZero(d.getMinutes());
    // var s = addZero(d.getSeconds());
    return h + ":" + m;
}
function getActualDate() {
    var d = new Date();
    var day = addZero(d.getDate());
    var month = addZero(d.getMonth()+1);
    var year = addZero(d.getFullYear());
    return year+ "-" +month + "-" +day;
}
function whatDayisDate(date) {
    var d =new Date(date);
    var day = addZero(d.getDate());
    var month = addZero(d.getMonth()+1);
    var year = addZero(d.getFullYear());
    return year+ "-" +month + "-" +day;
}
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

  $.datetimepicker.setLocale('de');
  $('#datetimepicker').datetimepicker({
     minDate:0,
     formatDate:'DD.MM.YYYY',
     format:'d/m/Y H:i',
     onChangeDateTime:logic,
     onShow:logic,
     step:15,
  });

   var update;
   moment().local('de');
  (update = function() {
      document.getElementById("now_time_date")
      .innerHTML = moment().format('DD/MM/YYYY H:mm:ss');
  })();
  setInterval(update, 1000);