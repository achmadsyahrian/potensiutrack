@props(['title', 'name'])

<style>
    .sig-canvas {
        width: 100%;
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
        touch-action: none;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <label class="form-label required">{{ $title }}</label>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <canvas id="{{ $name }}" class="sig-canvas">
           
        </canvas>
        <input type="hidden" id="sig-input" name="{{ $name }}" value="">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-info mt-2" id="sig-submitBtn">Masukkan</button>
        <button type="button" class="btn btn-default mt-2" id="sig-clearBtn">Bersihkan</button>
    </div>
</div>


<script>
    (function() {
      var title = "{{ $name }}";
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById(title);
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var newCan = document.querySelector("#" + title);
  var parentDiv = newCan.closest('.row');
  var nextRow = parentDiv.nextElementSibling; 
  var clearBtn = nextRow.querySelector("#sig-clearBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    sigText.value = '';
  }, false);

  var submitBtn = nextRow.querySelector("#sig-submitBtn");
  var sigText = newCan.nextElementSibling;
  console.log(sigText)
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    sigText.value = dataUrl;
  }, false);

})();
</script>