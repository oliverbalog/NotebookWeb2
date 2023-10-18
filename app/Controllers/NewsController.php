<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\RouteCollection;
use App\Models\News;
use App\Models\Rating;
use App\Models\User;
use DateTime;

class NewsController extends Controller
{
    protected $folder = 'news';
    public function __construct(RouteCollection $routes)
    {
        parent::__construct($routes);
    }

    public function index()
    {
        if (!auth()->check()) {
            return redirect(route($this->routes->get('home')));
        }

        $news = News::query()
            ->raw("
            SELECT news.*, users.name as username
            FROM news
            INNER JOIN users on news.created_by = users.id;
        ");

        return $this->view('index', [
            'news' => $news,
            'ratings' => Rating::query()->getAll(),
            'users' => User::query()->getAll()
        ]);
    }

    public function rate(int $id)
    {
        abort_if(!auth()->check());

        try {
            $validated["news_id"] = $id;
            $validated["rated_by"] = auth()::id();
            $validated["text_rate"] = $_POST["text_rate"];
            $validated["rating"] = $_POST["rating"];

        } catch (Exception $e) {

        }

        Rating::query()->insert($validated);

        return redirect(route($this->routes->get('news.index')), 'Véleményezve!');
    }

    public function store()
    {
        abort_if(!auth()->check());

        try {
            $validated["created_by"] = auth()::id();
            $validated["content"] = $_POST["content"];
            $validated["title"] = $_POST["title"];
            $validated["created_at"] = (new DateTime())->format("y-m-d");

        } catch (Exception $e) {

        }

        News::query()->insert($validated);

        return redirect(route($this->routes->get('news.index')), 'Hír beküldve!');
    }

    private function rules(): array
    {
        return [
        ];
    }
}