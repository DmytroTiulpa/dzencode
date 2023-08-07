<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('answers')
            ->where('parent_id', '=', null)
            ->get();
        //dd($comments);

        return view('index', [
            'comments' => $comments,
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
        $comment->user_name = $request->user_name;
        $comment->email = $request->email;
        $comment->home_page = $request->home_page;
        $comment->comment = $request->comment;
        $comment->save();

        $file = $_FILES['fileToUpload'];
        if ($file['error'] === 0) {

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            echo "Расширение файла: " . $extension . " " . PHP_EOL;

            // Каталог, в который мы будем принимать файл:
            $upload_dir = './storage/';

            if (!is_dir($upload_dir)) {
                if (mkdir($upload_dir, 0755, true) || is_dir($upload_dir)) {
                    echo 'Папка успешно создана.' . PHP_EOL;
                } else {
                    echo 'Ошибка при создании папки.' . PHP_EOL;
                }
            } else {
                echo 'Папка уже существует.' . PHP_EOL;
            }

            $upload_file = $upload_dir.basename($_FILES['fileToUpload']['name']);

            // Копируем файл из каталога для временного хранения файлов:
            if (copy($_FILES['fileToUpload']['tmp_name'], $upload_file)) {
                echo "Файл <b>{$_FILES['fileToUpload']['name']}</b> успешно загружен на сервер" . PHP_EOL;
//                EquipmentFiles::create([
//                    'equipment_id' => $id,
//                    'file_name' => $_FILES['filesToUpload']['name'][$i],
//                    'original_file_name' => $_FILES['filesToUpload']['name'][$i],
//                ]);
                die();
            } else {
                echo "<h3>Ошибка! Не удалось загрузить файл <b>{$_FILES['fileToUpload']['name']}</b> на сервер!</h3>" . PHP_EOL;
                exit;
            }

            dd($_FILES);
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

        return view('index', [
            'comments' => $comments,
            'delimiter' => 0
        ]);
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
