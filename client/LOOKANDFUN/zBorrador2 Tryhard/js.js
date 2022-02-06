
$(function () {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right'
  }, function (start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});

$('#catList').change(function descCerca() {
  var catList = this.value;
  $.ajax({
    type: "GET",
    url: "getPosters.php",
    data: 'catList=' + catList,
    success: function posterList(result) {
      $("#taula").html(result);
    }
  });

});


$('#cerca').keyup(function descCerca() {
  var descr = $('#cerca').val();
  var catList = $('#catList').val();
  $.ajax({
    type: "GET",
    url: "getPosters.php",
    data: { descr: descr, catList: catList },
    success: function posterList(result) {
      $("#taula").html(result);
    }
  });

});

window.onload = function () {
  
  var x = document.getElementById("myTopnav");
  var y = document.getElementById('toggler');
  y.addEventListener('click', function () {


    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  });


  var select = document.getElementById('catList');
  select.addEventListener('change', function () {
    document.getElementById('cerca').value = '';
  })

  var home = document.getElementById('backtotop');
  home.addEventListener('click', function () {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  })

  // ORGANITZADORS

  // Get the modal
  var modal = document.getElementById("organitzadorsModal");

  // Get the button that opens the modal
  var btn = document.getElementById("organitzadors");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function () {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }
}

// LOGIN

  // Get the modal
  var modal = document.getElementById("loginModal");

  // Get the button that opens the modal
  var btn = document.getElementById("login");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[1];

  // When the user clicks the button, open the modal 
  btn.onclick = function () {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }