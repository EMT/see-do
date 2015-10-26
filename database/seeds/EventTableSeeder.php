<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = User::first();

        Event::create([
        	'title' => 'Northern Soul: The Film',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'CoderDojo at The Sharp Project',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Design How Talks',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Loz’s Birthday Party',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Introduction to Arduino',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Made You Look Documentary a Film About the Digital Age',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'CoderDojo at The Sharp Project Hackday',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Film How - Northern Soul / Factory',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Manchester Moleskine® Talks, Exhibition',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Manchester Worker Bee Exhibition',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Festival of the Spoken Nerd: Just for Graphs Comedy',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Back to the Future at Manchester Cathederal Film',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Biospheric Studio presents Urban Naturalist Workshop',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'The Hitchhiker’s Guide to the Solar System Exhibition',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Homeless Film festival - Waste Land Film',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Both sides now: It was the best of times, it was the worst of times? Exhibition',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

		Event::create([
			'title' => 'Places',
            'time_start' => '2015-10-30-19-00-00',
            'time_end' => '2015-10-30-22-30-00',
            'content' => 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Vivamus sagittis lacus vel augue laoreet rutrum link style auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget Link style sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
        	'venue' => '70 Oxford Street, M1 5NH',
            'user_id' => $user->id,
        ]);

    }
}
