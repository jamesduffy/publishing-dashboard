<?php

class DashboardController extends BaseController {

	public function getIndex()
	{
		$data['counts'] = array(
				'draft'		=> DB::table('posts')->where('status', 'draft')->count(),
				'pending'	=> DB::table('posts')->where('status', 'pending')->count(),
				'approved'	=> DB::table('posts')->where('status', 'approved')->count(),
				'scheduled' => DB::table('posts')->where('status', 'scheduled')->count(),
				'published' => DB::table('posts')->where('status', 'published')->count()
			);

		$data['articles'] = DB::table('articles')->orderBy('published_at', 'desc')->take(20)->get();

		return View::make('dashboard.main', $data);
	}

}
