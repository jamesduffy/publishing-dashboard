<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetArticlesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'articles:get';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Retreive the latest articles from the RSS Feed in settings';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$rss_feed_url = DB::table('settings')->where('key', 'rss_feed')->pluck('value');
		$feed = FeedReader::read($rss_feed_url);
		$raw_feed_tags = $feed->get_feed_tags('', 'channel');

		foreach ($raw_feed_tags[0]['child']['']['item'] as $item) {
			$article_id = str_replace('http://www.csusignal.com/?p=','',$item['child']['']['guid'][0]['data']);
			
			if(DB::table('articles')->where('external_id', $article_id)->count() == 0)
			{
				if ($article_id > 0) {
					$article = new Article;

					$article->external_id = $article_id;
					$article->title = $item['child']['']['title'][0]['data'];
					$article->link = $item['child']['']['link'][0]['data'];
					$article->author = $item['child']['http://purl.org/dc/elements/1.1/']['creator'][0]['data'];
					$article->published_at = date('Y-m-d H:i:s', strtotime($item['child']['']['pubDate'][0]['data']));
					$article->category = $item['child']['']['category'][0]['data'];
					$article->description = $item['child']['']['description'][0]['data'];

					$article->save();
				}
			}
		}
	}

}
