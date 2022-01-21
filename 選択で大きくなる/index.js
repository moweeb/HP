$(function(){
  //ボタンのイベント
  var big = 'scale(1.20)',
      normal = 'scale(0.95)';

  $(".first-box").click( function(event){
    $(this).css('transform', big);
    $(".second-box").css('transform', normal);
    $(".third-box").css('transform', normal);
    $(".text-space").html("<p>これは1のテキスト</p>");
  });
  $(".second-box").click( function(event){
    $(this).css('transform', big);
    $(".first-box").css('transform', normal);
    $(".third-box").css('transform', normal);
    $(".text-space").html("<p>これは2のテキスト</p>");

  });
  $(".third-box").click( function(event){
    $(this).css('transform', big);
    $(".second-box").css('transform', normal);
    $(".first-box").css('transform', normal);
    $(".text-space").html("<p>これは3のテキスト</p>");
  });


});
