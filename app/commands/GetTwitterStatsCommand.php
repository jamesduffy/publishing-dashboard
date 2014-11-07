<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetTwitterStatsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'stats:twitter';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Get twitter stats and save them in the database';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$tweets = Twitter::getUserTimeline(array('screen_name' => 'csusignal', 'count' => 20, 'format' => 'array'));
	
		foreach ($tweets as $tweet) {
			$t = Tweet::findOrCreate($tweet['id']);

			$created_at = DateTime::createFromFormat('D M j G:i:s O Y' , $tweet['created_at']);

			$t->id = $tweet['id'];
			$t->text = $tweet['text'];
			$t->source = $tweet['source'];
			$t->twitter_created_at = $created_at;
			$t->retweet_count = $tweet['retweet_count'];
			$t->favorite_count = $tweet['favorite_count'];

			$t->save();
		}
	}

}
