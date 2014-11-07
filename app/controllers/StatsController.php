<?php

class StatsController extends BaseController {

	public function getIndex()
	{
		if ( Auth::user()->can('schedule_campaigns') )
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['tweets'] = DB::table('twitter_stats')
					->orderBy('twitter_created_at', 'DESC')
					->paginate(15);

		$data['counts'] = DB::table('twitter_profile_stats')
					->orderBy('created_at', 'DESC')
					->get();

		return View::make('stats.overview', $data);
	}

}
