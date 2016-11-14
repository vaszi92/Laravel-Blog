<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

use Illuminate\Http\Request;

class ArticlesController extends Controller {
        
        //create a new articles controller instance
        public function __construct() {
            $this->middleware('auth', ['except'=>'home']);
        }

        //show all articles
        public function index() {
//            if(Auth::user()) {
                //$articles = Auth::user()->articles()->latest()->published()->get();
                $articles = Article::latest()->published()->get();
//            } else {
//                $articles = Article::latest()->published()->get();
//            }
            return view('articles.index', compact('articles'));
        }
        
        //show a single article
        public function show(Article $article) {
//            $article = Article::findOrFail($id);
//            if(is_null($article)){
//                abort(404);
//            }
            
            return view('articles.show', compact('article'));
        }
        
        //show the page to create a new article
        public function create() {
            $tags = \App\Tag::lists('name', 'id');
            return view('articles.create', compact('tags'));
        }
        
        //save a new article
        public function store(Requests\ArticleRequest $request) {
            
            $this->createArticle($request);
            
            //session()->flash('key', 'value');
//            flash()->success('Your article has been created!');
            
            return redirect('/articles')->with([
                'flash_message' => 'Your article has been created.',
                'flash_message_important' => 'true',
            ]);
            
        }
        
        //edit an existing article
        public function edit(Article $article){
            
//            $article = Article::findOrFail($id);
            $tags = \App\Tag::lists('name', 'id');
            
            return view('articles.edit', compact('article', 'tags'));
            
        } 
        
        //update an article
        public function update(Article $article, ArticleRequest $request){
            
//            $article = Article::findOrFail($id);
            
            $article->update($request->all());
            
            $this->syncTags($article, $request->input('tag_list'));
            
            return redirect('/articles')->with([
                'flash_message' => 'Your article has been updated.',
                'flash_message_important' => 'true',
            ]);
        }
        
        //delete article
        public function destroy(Article $article) {
            
            $article->delete();
            
            return redirect('articles')->with([
                'flash_message' => 'Article successfully deleted.',
                'flash_message_important' => 'true',
            ]);
        }
        
        //get the latest article
        public function latest() {
            
            $latest = \App\Article::latest()->first();
                
            return view('pages.latest', compact('latest'));
            
        }
        
        //Sync up the list of tags in the database
        private function syncTags(Article $article, array $tags) {
            
           $article->tags()->sync($tags); 
            
        }
        
        //save a new article
        private function createArticle(ArticleRequest $request){
            
            $article = Auth::user()->articles()->create($request->all());
            
            $this->syncTags($article, $request->input('tag_list'));
            
            return $article;
        } 

}
