// module aliases
var Engine = Matter.Engine,
    Render = Matter.Render,
    World = Matter.World,
    Common = Matter.Common,
    Bodies = Matter.Bodies,
    Constraint = Matter.Constraint,
    Events = Matter.Events,
    MouseConstraint = Matter.MouseConstraint;


var w = $(window).width();
var h = $(window).height();

// create an engine
var engine = Engine.create(document.body, {
  render: {
    options: {
       width: w,
       height: h,
       wireframes: false,
       background: '#ffffff'
    }
  }
});

// engine.timing.timeScale = 0;

// engine.world.gravity.x = 0;
// engine.world.gravity.y = 0;

engine.world.bounds.max.x = w;
engine.world.bounds.max.y = h;

var mouseConstraint = MouseConstraint.create(engine, {
  constraint: {
    render: {
      visible: false
    }
  }
});
World.add(engine.world, mouseConstraint)

// var platform_one = Bodies.rectangle(400, 575, 810, 60, {
//   isStatic: true,
//   render: {
//     lineWidth: 3,
//     strokeStyle: '#000000',
//     fillStyle: '#FFFFFF'
//   }
// });

// var platform_two = Bodies.rectangle(w - 300, 625, 810, 60, {
//   isStatic: true,
//   angle: -0.2,
//   render: {
//     lineWidth: 3,
//     strokeStyle: '#000000',
//     fillStyle: '#FFFFFF'
//   }
// });
//

$('.city a h2').each(function() {
  var width = $(this).width();
  var height = $(this).height();
  var cords = $(this).offset();
  var x = cords.left + width / 2;
  var y = cords.top + height / 2;

  console.log(width, height, cords.left, cords.top)

  var platform = Bodies.rectangle(x, y, width + 30, height + 10, {
    isStatic: true,
    render: {
      lineWidth: 0,
      strokeStyle: '#FFFFFF',
      fillStyle: '#FFFFFF'
    }
  });

  World.addBody(engine.world, platform);
})

var rows = 2;
var itemsPerRow = 15;

var loop = itemsPerRow * rows;
var horizontalSpacing = w / itemsPerRow;
var col = 0;
var verticalOffset = 50;

for (var i = 0; i <= loop; i++) {
  var horizontalOffset = horizontalSpacing * col;
  col++;

  if (i > 0 && i % itemsPerRow == 0) {
    verticalOffset = verticalOffset + 80;
    col = 0;
  }

  switch (Math.round(Common.random(0, 1))) {
  case 0:
    World.addBody(engine.world, Bodies.rectangle(horizontalOffset, verticalOffset, 80, 80, {
      render: {
        sprite: {
          texture: 'http://i.imgur.com/MAFn8RF.png'
        }
      }
    }));
    break;
  case 1:
    World.addBody(engine.world, Bodies.circle(horizontalOffset, verticalOffset, 40, {
      render: {
        sprite: {
         texture: 'http://i.imgur.com/nATHDrx.png'
        }
      }
    }));
  }
}

var offset = 20;
// Top
World.addBody(engine.world, Bodies.rectangle(w / 2, -offset - 2, w + 2 * offset, 40, { isStatic: true, fillStyle: '#ffffff', lineWidth: 0 }));
// Right
World.addBody(engine.world, Bodies.rectangle(w + offset, h / 2, 40, h + 2 * offset, { isStatic: true, fillStyle: '#ffffff', lineWidth: 0 }));
// Left
World.addBody(engine.world, Bodies.rectangle(-offset, h / 2, 40, h + 2 * offset, { isStatic: true, fillStyle: '#ffffff', lineWidth: 0 }));
// Bottom
World.addBody(engine.world, Bodies.rectangle(w / 2, h + offset, w + 2 * offset, 40, { isStatic: true, fillStyle: '#ffffff', lineWidth: 0 }));


// add all of the bodies to the world
World.add(engine.world, []);

// run the engine
Engine.run(engine);