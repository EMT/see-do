debug = true;

// module aliases
var Engine = Matter.Engine,
    Render = Matter.Render,
    World = Matter.World,
    Common = Matter.Common,
    Bodies = Matter.Bodies,
    Constraint = Matter.Constraint,
    Events = Matter.Events,
    MouseConstraint = Matter.MouseConstraint;

var w = window.outerWidth;
var h = window.outerHeight;
var platforms = [],
    bounds    = [],
    emojis    = [],
    mobile    = false;

// create an engine
var engine = createEngine()

  // engine.world.gravity.x = 0
  // engine.world.gravity.y = 0;

if (w <= 800) {
  mobile = true;
}

init()

function init() {

  engine.world.bounds.max.x = w;
  engine.world.bounds.max.y = h;

  addMouseInteraction();
  drawBounds(bounds);

  if (mobile) {
    setupAccelerometer()
    resizeCanvas(mobile);
    generateRandomEmojis(1, 10);
  } else {
    resizeCanvas();
    drawPlatforms(platforms);
    generateRandomEmojis(3, 15);

    setInterval(function(){
     generateRandomEmojis(2, 4, false);
    },10000)

  }
}


function generateRandomEmojis(rows, itemsPerRow, removeOnGeneration) {
  var rows = typeof rows !== 'undefined' ?  rows : 2;
  var itemsPerRow = typeof itemsPerRow !== 'undefined' ?  itemsPerRow : 15;
  var removeOnGeneration = typeof removeOnGeneration !== 'undefined' ?  removeOnGeneration : true;

  var loop = itemsPerRow * rows,
      horizontalSpacing = w / itemsPerRow,
      col = 0,
      verticalOffset = -300;

  limitBodies(emojis, 100)

  if (removeOnGeneration) {
    removeBodies(emojis);
  }

  for (var i = 0; i <= loop; i++) {
    var horizontalOffset = (horizontalSpacing * col) * getRandomInt(1.1, 1.4);
    col++;

    if (i > 0 && i % itemsPerRow == 0) {
      verticalOffset = verticalOffset + 80;
      col = 0;
    }

    switch (Math.round(Common.random(0, 1))) {
    case 0:
      var emoji = Bodies.rectangle(horizontalOffset, verticalOffset, 80, 80, {
        render: {
          sprite: {
            texture: 'http://i.imgur.com/MAFn8RF.png'
          }
        },
        restitution: 0.3
      });
      World.addBody(engine.world, emoji);
      emojis.push(emoji);
      break;
    case 1:
      var emoji = Bodies.circle(horizontalOffset, verticalOffset, 40, {
        render: {
          sprite: {
           texture: 'http://i.imgur.com/nATHDrx.png'
          }
        },
        restitution: 0.3
      });
      World.addBody(engine.world, emoji);
      emojis.push(emoji);
    }
  }
}

function removeBodies(bodies) {
  for (var i = bodies.length - 1; i >= 0; i--) {
    if (debug) console.log(bodies[i]);
    Matter.Composite.remove(engine.world, bodies[i]);
  }
}

function limitBodies(bodies, limit) {
  if (bodies.length > limit) {
    var diff = bodies.length - limit;
    if (debug) console.log(diff);
    removeBodies(bodies.splice(0, diff));
  }
}

function drawPlatforms(platforms) {

  if (debug) console.log(platforms);

  if (platforms.length) {
    removeBodies(platforms);
  }

  $('.city a h2, .city a h3, .js-site-title').each(function() {
    var width = $(this).outerWidth();
    var height = $(this).outerHeight();
    var cords = $(this).offset();
    var x = cords.left + width / 2;
    var y = cords.top + height / 2;
    var outline = '#FFFFFF';

    if (debug) {
      outline = "#FFF000"
    } else {
      outline = 'transparent'
    }

    if (debug) console.log(width, height, cords.left, cords.top)

    var platform = Bodies.rectangle(x, y, width + 25, height, {
      isStatic: true,
      render: {
        lineWidth: 0,
        strokeStyle: outline,
        fillStyle: 'transparent'
      }
    });

    platforms.push(platform);

    World.addBody(engine.world, platform);
  })
}

function drawBounds(bounds, offset) {
  var offset = typeof offset !== 'undefined' ?  offset : 20;

  if (bounds.length) {
    removeBodies(bounds);
  }

  var right = Bodies.rectangle(w + offset, h / 2, 40, h + 2 * offset, { isStatic: true, fillStyle: '#ffffff', strokeStyle: '#ffffff', lineWidth: 0 });
  var bottom = Bodies.rectangle(w / 2, h + offset, w + 2 * offset, 40, { isStatic: true, fillStyle: '#ffffff', strokeStyle: '#ffffff', lineWidth: 0 });
  var left = Bodies.rectangle(-offset, h / 2, 40, h + 2 * offset, { isStatic: true, fillStyle: '#ffffff', strokeStyle: '#ffffff', lineWidth: 0 });

  bounds.push([right,bottom,left]);
  World.add(engine.world, [right,bottom,left])
}

function addMouseInteraction() {
  var mouseConstraint = MouseConstraint.create(engine, {
    constraint: {
      render: {
        visible: true
      }
    }
  });

  World.add(engine.world, mouseConstraint)
}

function resizeCanvas() {
  window.addEventListener('resize', resizeCanvas, false);

  w = window.outerWidth;
  h = window.outerHeight;

  engine.world.bounds.max.x = w;
  engine.world.bounds.max.y = h;

  engine.render.options.width = w;
  engine.render.options.height = h;

  engine.render.canvas.width = w;
  engine.render.canvas.height = h;

  if (!mobile) {
    drawPlatforms(platforms)
  }

  drawBounds(bounds);
}

function setupAccelerometer() {
  if(window.DeviceMotionEvent){
    window.addEventListener("devicemotion", motion, false);
  }else{
    console.log("DeviceMotionEvent is not supported");
  }
}

function motion(event){
  if (debug) {
    console.log("Accelerometer: "
      + event.accelerationIncludingGravity.x + ", "
      + event.accelerationIncludingGravity.y + ", "
      + event.accelerationIncludingGravity.z
    );
  }

  engine.world.gravity.x = event.accelerationIncludingGravity.x;
  engine.world.gravity.y = -event.accelerationIncludingGravity.y;
}

function createEngine() {
  return Engine.create(document.body, {
    render: {
      options: {
         width: w,
         height: h,
         wireframes: debug,
         showAngleIndicator: debug,
         background: '#ffffff',

      }
    }
  });
}

function getRandomInt(min, max) {
  return Math.random() * (max - min) + min;
}

// run the engine
Engine.run(engine);