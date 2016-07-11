debug = false;

// module aliases
var Engine = Matter.Engine,
    Render = Matter.Render,
    World = Matter.World,
    Common = Matter.Common,
    Bodies = Matter.Bodies,
    Constraint = Matter.Constraint,
    Events = Matter.Events,
    MouseConstraint = Matter.MouseConstraint;

var w = $(document).outerWidth();
var h = $(document).outerHeight(true);
var platforms = [],
    bounds    = [],
    emojis    = [],
    mobile    = false;

// Define the different kinds of Emojis that can spawn.
//
// The following basic shapes have methods to create them. Triangle
// can be used for more complex polygon shapes by just adding more
// points to the array.
//
// Circle:
//  name: String
//  shape: 'circle'
//  radius: Integer
//  sprite: String - file location
//
// Rectangle
//  name: String
//  shape: 'rectangle'
//  width: Integer
//  height: Integer
//  sprite: String - file location
//
// Triangle
//  name: String
//  shape: 'triangle'
//  points: Array of x/y co-ordinates.
//  sprite: String - file location

var emojiTypes = [
  {
    name: 'Laugh',
    shape: 'circle',
    radius: 38.75,
    sprite: 'http://i.imgur.com/9Nj59hX.png'
  },
  {
    name: 'Picture',
    shape: 'rectangle',
    width: 80,
    height: 65,
    sprite: 'http://i.imgur.com/MAFn8RF.png'
  },
  {
    name: 'Love',
    shape: 'circle',
    radius: 38.75,
    sprite: 'http://i.imgur.com/IOADJCL.png'
  },
  {
    name: 'Pizza',
    shape: 'triangle',
    points: [
      { x: 0, y: 0 }, { x: -40, y: -80 }, { x: -80, y: 0 }
    ],
    sprite: 'http://i.imgur.com/AbJKujs.png'
  }
]

// create an engine
var engine = Engine.create(document.body, {
  render: {
    options: {
       width: w,
       height: h,
       wireframes: debug,
       showAngleIndicator: debug,
       background: '#ffffff'
    }
  }
});

if (w <= 800) {
  mobile = true;
}

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
   if (document.hasFocus()) {
     generateRandomEmojis(2, 4, false);
   }
  },10000)

}

function generateRandomEmojis(rows, itemsPerRow, removeOnGeneration) {
  var rows = typeof rows !== 'undefined' ?  rows : 2;
  var itemsPerRow = typeof itemsPerRow !== 'undefined' ?  itemsPerRow : 15;
  var removeOnGeneration = typeof removeOnGeneration !== 'undefined' ?  removeOnGeneration : true;

  var loop = itemsPerRow * rows,
      horizontalSpacing = w / itemsPerRow,
      col = 0,
      verticalOffset = -300;

  if (mobile) {
    verticalOffset = 50;
  }

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

    var randomNumber = Math.floor(getRandomInt(0, emojiTypes.length))
    var randomAngle = Math.floor(getRandomInt(0, 360))

    if (debug) console.log('New Emoji ['+randomNumber+'] :', emojiTypes[randomNumber]);

    if (emojiTypes[randomNumber].shape === 'circle') {
      var emoji = Bodies.circle(horizontalOffset, verticalOffset, emojiTypes[randomNumber].radius, {
        render: {
          sprite: {
           texture: emojiTypes[randomNumber].sprite
          }
        },
        restitution: 0.3,
        angle: randomAngle
      });
    }

    if (emojiTypes[randomNumber].shape === 'rectangle') {
      var emoji = Bodies.rectangle(horizontalOffset, verticalOffset, emojiTypes[randomNumber].width, emojiTypes[randomNumber].height, {
        render: {
          sprite: {
            texture: emojiTypes[randomNumber].sprite
          }
        },
        restitution: 0.3,
        angle: randomAngle
      });
    }

    if (emojiTypes[randomNumber].shape === 'triangle') {
      var emoji = Bodies.fromVertices(horizontalOffset, verticalOffset, emojiTypes[randomNumber].points, {
        render: {
          sprite: {
            texture: emojiTypes[randomNumber].sprite
          }
        },
        restitution: 0.3
      })
    }

    World.addBody(engine.world, emoji);
    emojis.push(emoji);
  }
}

function removeBodies(bodies, fall) {
  var fall = typeof fall !== 'undefined' ?  fall : false;

  for (var i = bodies.length - 1; i >= 0; i--) {
    if (debug) console.log('Removing : ', bodies[i]);
    var body = bodies[i];

    if (bodies[i].collisionFilter && fall) {
      bodies[i].collisionFilter.mask = 2

      setTimeout(function() {
        Matter.Composite.remove(engine.world, body);
      },2000)
    } else {
      Matter.Composite.remove(engine.world, body);
    }
  }
}

function limitBodies(bodies, limit) {
  if (bodies.length > limit) {
    var diff = bodies.length - limit;
    if (debug) console.log(diff);
    removeBodies(bodies.splice(0, diff), true);
  }
}

function drawPlatforms(platforms) {

  if (debug) console.log('New Platforms : ', platforms);

  if (platforms.length) {
    removeBodies(platforms);
  }

  $('.city a h2, .city a h3, .js-site-title').each(function() {
    var width = $(this).width();
    var height = $(this).height();
    var cords = $(this).offset();
    var x = cords.left + width / 2;
    var y = cords.top + height / 2;
    var outline = 'transparent';

    if (debug) {
      outline = "#FFF000"
    }

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

  if (mobile) {
    var top = Bodies.rectangle(w / 2, -offset - 2, w + 2 * offset, 40, { isStatic: true, fillStyle: '#ffffff', lineWidth: 0 });
    bounds.push(top);
    World.add(engine.world, top);
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
        visible: debug
      }
    }
  });

  World.add(engine.world, mouseConstraint)
  if (debug) console.log('MouseConstraint added');
}

function resizeCanvas() {
  window.addEventListener('resize', resizeCanvas, false);

  w = $(document).outerWidth();
  h = $(document).outerHeight(true);

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
  engine.world.gravity.x = event.accelerationIncludingGravity.x;
  engine.world.gravity.y = -event.accelerationIncludingGravity.y;
}

function getRandomInt(min, max) {
  return Math.random() * (max - min) + min;
}

// run the engine
Engine.run(engine);