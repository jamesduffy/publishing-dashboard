<?php

class CampaignsController extends BaseController {

	public function getIndex()
	{
		if(! Auth::user()->can('view_campaigns'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');

		$pagination_count = DB::table('settings')->where('key', 'pagination_count')->pluck('value');

		switch (Request::segment(3)) {
			case 'draft':
				$data['posts'] = DB::table('posts')
					->select('posts.id', 'network', 'text', 'status', 'user_id', 'first_name', 'last_name', 'article_id', 'scheduled_at')
					->join('users', 'posts.user_id', '=', 'users.id')
					->where('status', 'draft')
					->orderBy('posts.scheduled_at', 'DESC')
					->paginate($pagination_count);
				break;

			case 'pending':
				$data['posts'] = DB::table('posts')
					->select('posts.id', 'network', 'text', 'status', 'user_id', 'first_name', 'last_name', 'article_id', 'scheduled_at')
					->join('users', 'posts.user_id', '=', 'users.id')
					->where('status', 'pending')
					->orderBy('posts.scheduled_at', 'DESC')
					->paginate($pagination_count);
				break;

			case 'approved':
				$data['posts'] = DB::table('posts')
					->select('posts.id', 'network', 'text', 'status', 'user_id', 'first_name', 'last_name', 'article_id', 'scheduled_at')
					->join('users', 'posts.user_id', '=', 'users.id')
					->where('status', 'approved')
					->orderBy('posts.scheduled_at', 'DESC')
					->paginate($pagination_count);
				break;

			case 'scheduled':
				$data['posts'] = DB::table('posts')
					->select('posts.id', 'network', 'text', 'status', 'user_id', 'first_name', 'last_name', 'article_id', 'scheduled_at')
					->join('users', 'posts.user_id', '=', 'users.id')
					->where('status', 'scheduled')
					->orderBy('posts.scheduled_at', 'DESC')
					->paginate($pagination_count);
				break;

			case 'published':
				$data['posts'] = DB::table('posts')
					->select('posts.id', 'network', 'text', 'status', 'user_id', 'first_name', 'last_name', 'article_id', 'scheduled_at')
					->join('users', 'posts.user_id', '=', 'users.id')
					->where('status', 'published')
					->orderBy('posts.scheduled_at', 'DESC')
					->paginate($pagination_count);
				break;
			
			default:
				$data['posts'] = DB::table('posts')
					->select('posts.id', 'network', 'text', 'status', 'user_id', 'first_name', 'last_name', 'article_id', 'scheduled_at')
					->join('users', 'posts.user_id', '=', 'users.id')
					->orderBy('posts.scheduled_at', 'DESC')
					->paginate($pagination_count);
				break;
		}

		return View::make('campaigns.list', $data);
	}

	public function getCreate()
	{
		if(! Auth::user()->can('create_campaign'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');

		$data['statuses'] = array(
				'draft' => 'Draft',
				'pending' => 'Pending',
				'approved' => 'Approved',
				'scheduled' => 'Scheduled'
			);

		if ($article_id = Request::segment(3)) {
			$data['article'] = DB::table('articles')->where('external_id', $article_id)->first();
		}

		return View::make('campaigns.create', $data);
	}

	public function postCreate()
	{
		if(! Auth::user()->can('create_campaign'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');

		$rules = array(
				'network' => 'required',
				'status' => 'required',
				'text' => 'required|min:5|max:110',
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('campaigns/create/'.Input::get('article_id'))->withErrors($validator);
		}

		if ($article_id = Input::get('article_id')) {
			$article = Article::find($article_id);
		}

		$scheduled_at = date('Y').'-'.Input::get('month').'-'.Input::get('day').' '.Input::get('hour').':'.Input::get('minute');

		$post = new Post;
		$post->network = Input::get('network');
		$post->status = Input::get('status');
		$post->user_id = Auth::id();
		$post->text = Input::get('text');

		$post->year = date('Y');
		$post->month = Input::get('month');
		$post->day = Input::get('day');
		$post->hour = Input::get('hour');
		$post->minute = Input::get('minute');
		$post->scheduled_at = $scheduled_at;

		if (isset($article)) {
			$post->article_id = $article->external_id;
			$post->link = $article->link;		
		}

		$post->save();

		return Redirect::to('campaigns');
	}

	public function postComment()
	{
		if(! Auth::user()->can('create_comment'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');
	}

	public function getEdit()
	{
		$data['statuses'] = array(
				'draft' => 'Draft',
				'pending' => 'Pending'
			);
		
		if( Auth::user()->can('approve_campaign') )
			$data['statuses']['approved'] = 'Approved';
		if( Auth::user()->can('schedule_campaign'))
			$data['statuses']['scheduled'] = 'Scheduled';

		$data['post'] = \Post::findOrFail( Request::segment(3) );

		if (! (Auth::user()->can('edit_campaign') AND Auth::id() == $data['post']->user_id)) {
			if(! Auth::user()->can('edit_others_campaign')) {
				return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		}

		if ($article_id = $data['post']->article_id) {
			$data['article'] = DB::table('articles')->where('external_id', $article_id)->first();
		}

		return View::make('campaigns.edit', $data);
	}

	public function postEdit()
	{
		$rules = array(
				'post_id' => 'required',
				'network' => 'required',
				'status' => 'required',
				'text' => 'required|min:5|max:110',
				'month' => 'required|digits_between:1,12',
				'day' => 'required|digits_between:1,31',
				'hour' => 'required|digits_between:0,24',
				'minute' => 'required|digits_between:0,60'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('campaigns/edit/'.Input::get('post_id'))->withErrors($validator);
		}

		$scheduled_at = date('Y').'-'.Input::get('month').'-'.Input::get('day').' '.Input::get('hour').':'.Input::get('minute');

		$post = Post::findOrFail(Input::get('post_id'));

		if (! Auth::user()->can('edit_campaign') AND Auth::id() != $post->user_id) {
			if (! Auth::user()->can('edit_others_campaigns')) {
				return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		}

		$post->network = Input::get('network');
		$post->status = Input::get('status');
		$post->text = Input::get('text');

		$post->year = date('Y');
		$post->month = Input::get('month');
		$post->day = Input::get('day');
		$post->hour = Input::get('hour');
		$post->minute = Input::get('minute');
		$post->scheduled_at = $scheduled_at;

		$post->save();

		return Redirect::to('campaigns');
	}

	public function getDelete()
	{
		if(! Auth::user()->can('delete_campaign'))
			return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');

		$post = Post::findOrFail( Request::segment(3) );

		if ($post->user_id != Auth::id()) {
			if (! Auth::user()->can('delete_others_campaigns')) {
				return Redirect::to('dashboard')->with('message', 'You do not have permission to perform this action.');
			}
		}

		$post->delete();

		return Redirect::to('campaigns')->with('message', 'Post has been deleted.');
	}

	public function getTrash()
	{

	}

	public function getRestore()
	{

	}

}
