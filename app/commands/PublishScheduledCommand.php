<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Jelovac\Bitly4laravel\Facades\Bitly4laravel;

class PublishScheduledCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'campaigns:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish scheduled campaigns';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$posts = DB::table('posts')
			->where('status', 'scheduled')
			->where('scheduled_at', '<', date('Y-m-d H:i:s'))
			->get();

		foreach ($posts as $post) {
			switch ($post->network) {
				case 'twitter':
					$text = $post->text;
					$link = 'http://csusignal.com/?p='.$post->article_id;

					$short_link = Bitly::shorten($link)->getResponseData();

					if (isset($post->article_id)) {
						$text = $text.' '.$short_link['data']['url'];
					}

					if (strlen($text) > 140) {
						$p = Post::findOrFail($post->id);
						$p->status = 'pending';
						$p->save();
					} else {
						$p = Post::findOrFail($post->id);
						$p->status = 'published';
						$p->published_at = date("Y-m-d H:i:s");
						$p->short_hash = $short_link['data']['hash'];
						$p->short_link = $short_link['data']['url'];
						$p->save();

						Twitter::postTweet(
							array(
								'status' => $text, 
								'format' => 'json'
							)
						);
					}

					break;
				
				default:
					
					break;
			}
		}
	}

}
