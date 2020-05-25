<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Article\Commands\CreateArticleCommand;
use Domain\Article\Commands\DeleteArticleCommand;
use Domain\Article\Commands\UpdateArticleCommand;
use Domain\Article\Queries\GetAllArticlesQuery;
use Domain\Article\Queries\GetArticleByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Article\Requests\CreateArticleRequest;
use Domain\Article\Requests\UpdateArticleRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $articles = $this->dispatch(new GetAllArticlesQuery());

        return view('admin.articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticleRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateArticleRequest $request)
    {
        $this->dispatch(new CreateArticleCommand($request));

        return redirect(route('admin.articles.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit(int $id)
    {
        $article = $this->dispatch(new GetArticleByIdQuery($id));

        return view('admin.articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * @param $id
     * @param UpdateArticleRequest $request
     * @return RedirectResponse|Redirector
     */
    public function update(int $id, UpdateArticleRequest $request)
    {
        $this->dispatch(new UpdateArticleCommand($id, $request));

        return redirect(route('admin.articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteArticleCommand($id));

        return redirect(route('admin.articles.index'));
    }
}
