var crack = function(){
    $("#cimg1 img").addClass('image10');
      $("#cimg2 img").addClass('image11');
      $("#cimg3 img").addClass('image12');
  
      var image10 = $(".image10").attr('src').slice(14, -4);
      var image11 = $(".image11").attr('src').slice(14, -4);
      var image12 = $(".image12").attr('src').slice(14, -4);
  
      var expected_value = image10+image11+image12;
      $("#expected_value").val(expected_value);
      
      dosub();
  }
  
  setInterval(()=>{crack();}, 100);