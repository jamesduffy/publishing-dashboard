<?php

class ArticlesController extends BaseController {

	public function getIndex()
	{
		if(! Auth::user()->can('view_articles'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		switch (Request::segment(3)) {
			case 'news':
				$data['articles'] = DB::table(DB::raw('articles as a'))
					->select(array('a.*', DB::raw('(SELECT COUNT(*) FROM posts p WHERE a.external_id = p.article_id) as num_campaigns')))
					->where('a.category', 'news')
					->orderBy('a.published_at', 'DESC')
					->paginate($pagination_count);
			break;

			case 'culture':
				$data['articles'] = DB::table(DB::raw('articles as a'))
					->select(array('a.*', DB::raw('(SELECT COUNT(*) FROM posts p WHERE a.external_id = p.article_id) as num_campaigns')))
					->where('a.category', 'culture')
					->orderBy('a.published_at', 'DESC')
					->paginate($pagination_count);
			break;

			case 'opinion':
				$data['articles'] = DB::table(DB::raw('articles as a'))
					->select(array('a.*', DB::raw('(SELECT COUNT(*) FROM posts p WHERE a.external_id = p.article_id) as num_campaigns')))
					->where('a.category', 'opinion')
					->orderBy('a.published_at', 'DESC')
					->paginate($pagination_count);
			break;

			case 'sports':
				$data['articles'] = DB::table(DB::raw('articles as a'))
					->select(array('a.*', DB::raw('(SELECT COUNT(*) FROM posts p WHERE a.external_id = p.article_id) as num_campaigns')))
					->where('a.category', 'sports')
					->orderBy('a.published_at', 'DESC')
					->paginate($pagination_count);
			break;

			case 'other':
				$data['articles'] = DB::table(DB::raw('articles as a'))
					->select(array('a.*', DB::raw('(SELECT COUNT(*) FROM posts p WHERE a.external_id = p.article_id) as num_campaigns')))
					->whereNotIn('a.category', array('news', 'culture', 'opinion', 'sports'))
					->orderBy('a.published_at', 'DESC')
					->paginate($pagination_count);
			break;

			default:
				$data['articles'] = DB::table(DB::raw('articles as a'))
					->select(array('a.*', DB::raw('(SELECT COUNT(*) FROM posts p WHERE a.external_id = p.article_id) as num_campaigns')))
					->orderBy('a.published_at', 'DESC')
					->paginate($pagination_count);
			break;
		}

		return View::make('articles.list', $data);
	}

}
