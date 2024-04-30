<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //список для всех категорий
        $categories = Category::orderBy('name','asc')->get();

        return view('categories.index',compact('categories'));
    }

    public function listMenu()
    {
        $categories = Category::orderBy('name','asc')->get();
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('news.index', compact('categories','tasks'));
    }

    public function newsByCategory(Category $category)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $tasks = Task::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
        return view('news.newsByCategory', compact('categories', 'tasks', 'category'));

    }
//----------redirect ->new route
    public function search(Request $request)
    {

        //Get the search value from the request
        $search = $request->input('search');
        return redirect('/catalog/'.$search);

    }
//----------search by news title, news title, news date, news content
    public function catalog($search) //это читаем текст в URL переданный из формы
    {
        //Search in the title description updated_at
        $tasks = Task::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orderBy('updated_at','asc')
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('updated_at', 'LIKE', "%{$search}%")
            ->paginate(2);

        //-------categories
        $categories = DB::table('categories')
            ->leftJoin('tasks','categories.id', '=','tasks.category_id')
            ->select('categories.id', 'categories.name', DB::raw('COUNT(tasks.id) AS countTasks'))
            ->groupBy('categories.id')
            ->groupBy('categories.name')
            ->get();
        //----------

    // ...

    $sortinglist = array('all', 'data asc', 'data desc', 'title asc', 'title desc');
        //Return the search view with the results compacted
        return view('categories.news_category', compact('categories', 'tasks','sortinglist', 'search'));
    }
    public function newsBySort(Request $request)

    {
        $tasksQuery = Task::orderBy('created_at', 'desc');

        $selectedSort = $request->input('sort_by', 'all');

    switch ($selectedSort) {
        case 'data asc':
            $tasksQuery->orderBy('updated_at', 'asc');
            break;
        case 'data desc':
            $tasksQuery->orderBy('updated_at', 'desc');
            break;
        case 'title asc':
            $tasksQuery->orderBy('title', 'asc');
            break;
        case 'title desc':
            $tasksQuery->orderBy('title', 'desc');
            break;
        default:
            // По умолчанию, если 'all' или другой неизвестный вариант
            // Не применять дополнительную сортировку
    }

    $tasks = $tasksQuery->get();

    $sortinglist = array('all', 'data asc', 'data desc', 'title asc', 'title desc');

    return view('news.index', compact('tasks', 'sortinglist', 'selectedSort'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Category::create($request->all());
        return redirect('/categorylist');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('Categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category->update($request->all());
            return redirect('/categorylist');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categorylist');
    }
}
