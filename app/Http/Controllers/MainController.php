<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
//use Image;
use Nette\Utils\Image;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comment::with('answers')
            ->where('parent_id', '=', null)
            ->get();

        if ($request->has('sorting_by') && $request->has('order')) {
            // Параметр 'sorting_by' присутствует в запросе GET
            echo "Есть параметр sorting_by<br>";
            $sortingBy = $request->input('sorting_by');
            $order = $request->input('order');
            if ($sortingBy === 'date') {
                echo "сортировка по дате<br>";
                if ($order === 'asc') $sortedComments = $comments->sortBy('created_at');
                if ($order === 'desc') $sortedComments = $comments->sortByDesc('created_at');
            }
        }

        if (isset($sortedComments)) {
            $allComments = $sortedComments;
        } else {
            $allComments = $comments;
        }

        return view('index', [
            'comments' => $allComments,
            'delimiter' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //dd($_POST);

        $comment = new Comment;
        $comment->parent_id = $request->parent_id;
        $comment->user_name = strip_tags($request->user_name);
        $comment->email = strip_tags($request->email);
        $comment->home_page = strip_tags($request->home_page);
        $comment->comment = strip_tags($request->comment);
        $comment->save();

        $file = $_FILES['fileToUpload'];
        if ($file['error'] === 0) {

            // Каталог, в который мы будем принимать файл:
            $upload_dir = './storage/';

            if (!is_dir($upload_dir)) {
                if (mkdir($upload_dir, 0755, true) || is_dir($upload_dir)) {
                    echo 'Папка успешно создана.<br>';
                } else {
                    echo 'Ошибка при создании папки.<br>';
                }
            } else {
                echo 'Папка уже существует.<br>';
            }

            $upload_file = $upload_dir.basename($_FILES['fileToUpload']['name']);

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            echo "Расширение файла: " . $extension . "<br>";

            if ($extension === "jpg" || $extension === "jpeg" || $extension === "png" || $extension === "gif") {

                //$image = Image::fromFile('path/to/image.jpg');
                $image = Image::fromFile($_FILES['fileToUpload']['tmp_name']);
                $width = $image->getWidth();
                $height = $image->getHeight();

                echo "Ширина изображения: " . $width . " пикселей<br>";
                echo "Высота изображения: " . $height . " пикселей<br>";

                $maxWidth = 340; // Максимальная ширина для уменьшенного изображения

                if ($width > $maxWidth) {
                    $image->resize($maxWidth, null, Image::FIT);
                    //$image->save('path/to/destination/image.jpg');
                    //$image->save($upload_file);
                    $image->save($upload_dir . time() . "." . $extension);
                    Comment::where('id', '=', $comment->id)
                        ->update([
                            'file_name' => time() . "." . $extension,
                            'original_file_name' => $_FILES['fileToUpload']['name'],
                        ]);
                    echo "Изображение успешно уменьшено и сохранено.<br>";
                } else {
                    //$image->save($upload_file);
                    $image->save($upload_dir . time() . "." . $extension);
                    Comment::where('id', '=', $comment->id)
                        ->update([
                            'file_name' => time() . "." . $extension,
                            'original_file_name' => $_FILES['fileToUpload']['name'],
                        ]);
                    echo "Изображение не требует уменьшения.<br>";
                }

            }

            if ($extension === "txt") {
                // Копируем файл из каталога для временного хранения файлов:
                //if (copy($_FILES['fileToUpload']['tmp_name'], $upload_file)) {
                if (copy($_FILES['fileToUpload']['tmp_name'], $upload_dir . time() . "." . $extension)) {
                    echo "Файл <b>{$_FILES['fileToUpload']['name']}</b> успешно загружен на сервер.<br>";
                    Comment::where('id', '=', $comment->id)
                        ->update([
                            'file_name' => time() . "." . $extension,
                            'original_file_name' => $_FILES['fileToUpload']['name'],
                        ]);
                } else {
                    echo "Ошибка! Не удалось загрузить файл <b>{$_FILES['fileToUpload']['name']}</b> на сервер!<br>";
                    exit;
                }

            }

        }

        // валидация
/*        $validateFields = $request->validate([
            'user_name' => 'required',
            'email' => 'required|email',
//            'home_page' => 'required',
//            'password-confirm' => 'required'
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);*/

        $comments = Comment::with('answers')
            ->where('parent_id', '=', null)
            ->get();

        /*return view('index', [
            'comments' => $comments,
            'delimiter' => 0
        ]);*/

        return redirect()->to(route('index', [
            'comments' => $comments,
            //'delimiter' => 0
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $main)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $main)
    {
        //
    }

}
