// module aliases
var Engine = Matter.Engine,
    Render = Matter.Render,
    World = Matter.World,
    Body = Matter.Body,
    Bodies = Matter.Bodies,
    Composite = Matter.Composite,
    Composites = Matter.Composites,
    Common = Matter.Common,
    Constraint = Matter.Constraint,
    Events = Matter.Events,
    MouseConstraint = Matter.MouseConstraint;

var w = $(window).width();
var h = $(window).height();

// create an engine
var engine = Engine.create({
	render: {
		element: document.body,
	    options: {
	      width: w,
	      height: h,
	      wireframes: false,
	      background: '#ffffff'
	    }
	}
});

engine.timing.timeScale = 1;

engine.world.gravity.x = 0;
engine.world.gravity.y = 1;

engine.world.bounds.max.x = w;
engine.world.bounds.max.y = h;

// add a mouse controlled constraint
var mouseConstraint = MouseConstraint.create(engine);
World.add(engine.world, mouseConstraint);

var sceneEvents =[];

var explosion = function(engine) {
    var bodies = Composite.allBodies(engine.world);

    for (var i = 0; i < bodies.length; i++) {
        var body = bodies[i];

        if (!body.isStatic) {
            var forceMagnitude = 0.01* body.mass;

            Body.applyForce(body, body.position, {
                x: (forceMagnitude + Common.random() * forceMagnitude) * Common.choose([1, -1]),
                y: (forceMagnitude + Common.random() * forceMagnitude)  * Common.choose([1, -1])
            });
        }
    }
};

 var timeScaleTarget = 1,
            counter = 0;

        sceneEvents.push(
            Events.on(engine, 'afterUpdate', function(event) {
                // tween the timescale for bullet time slow-mo
                engine.timing.timeScale += (timeScaleTarget - engine.timing.timeScale) * 0.05;

                counter += 1;

                // every 1.5 sec
                if (counter >= 60 * 30) {


                    // create some random forces
                    explosion(engine);

                    // reset counter
                    counter = 0;
                }
            })
        );

var offset = 5;

// Top
World.addBody(engine.world, Bodies.rectangle(w / 2, -offset - 2, w + 2 * offset, 10, { isStatic: true }));
// Right
World.addBody(engine.world, Bodies.rectangle(w + offset, h / 2, 10, h + 2 * offset, { isStatic: true }));
// Left
World.addBody(engine.world, Bodies.rectangle(-offset, h / 2, 10, h + 2 * offset, { isStatic: true }));
// Bottom
World.addBody(engine.world, Bodies.rectangle(w / 2, h + offset, w + 2 * offset, 10, { isStatic: true }));

var emojis = [];

var joypad = Bodies.rectangle((w / 2), (w / 2), 80, 63, {
  restitution: 0.5,
  render: {
     sprite: {
        texture: 'http://i.imgur.com/FeI6266.png'
    }
  }
})

var painting = Bodies.rectangle((w / 2), (w / 2), 80, 80, {
  restitution: 0.5,
  render: {
    sprite: {
        texture: 'http://i.imgur.com/MAFn8RF.png'
    }
  }
})

var laugh = Bodies.circle(750, 200, 46, {
  restitution: 0.5,
  render: {
    sprite: {
        texture: 'http://i.imgur.com/nATHDrx.png'
    }
  }
});

var beer = Bodies.rectangle((w / 2), (w / 2), 66, 66, {
  restitution: 0.5,
  render: {
    sprite: {
      texture: 'http://i.imgur.com/ApqxXZu.png'
    }
  }
});

var film = Bodies.rectangle((w / 2), (w / 2), 80, 73, {
  restitution: 0.5,
  render: {
    sprite: {
      texture: 'http://seeanddo.dev/assets/img/homepage/film.png'
    }
  }
});

// add all of the bodies to the world
World.add(engine.world, [painting, laugh, beer, film, joypad]);

// run the engine
Engine.run(engine);