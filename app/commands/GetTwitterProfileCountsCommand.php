<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetTwitterProfileCountsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'stats:twittercount';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Get and save the most recent twitter counts.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$tweets = Twitter::getUserTimeline(array('screen_name' => 'csusignal', 'count' => 1, 'format' => 'array'));
	
		$t_profile = new TwitterProfile;
		$t_profile->followers = $tweets[0]['user']['followers_count'];
		$t_profile->listed = $tweets[0]['user']['listed_count'];
		$t_profile->friends = $tweets[0]['user']['friends_count'];
		$t_profile->statuses = $tweets[0]['user']['statuses_count'];
		$t_profile->favorites = $tweets[0]['user']['favourites_count']; 
		$t_profile->save();
	}

}
