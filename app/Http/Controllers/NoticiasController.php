<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use App\Models\Upload;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    public function index()
    {
        $noticias = Noticias::all();
        return view('noticias.index', compact('noticias'));
    }

    public function ApiIndex()
    {
        $noticias = Noticias::with('uploads')->get()->map(function ($noticia) {
            $noticia->image_url = $noticia->uploads->isNotEmpty() ? url('storage/' . $noticia->uploads->first()->file_path) : null;
            return $noticia;
        });
    
        // Retorna as notícias como uma resposta JSON
        return response()->json($noticias)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }
    

    public function create()
{
    return view('noticias.create');
}

public function store(Request $request)
{
    // Validação dos campos
     $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'required|string',
         'noticia_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ajuste a validação conforme necessário
     ]);

    // Criação da notícia
    $noticia = Noticias::create([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    // Verificar se uma imagem foi enviada
    if ($request->hasFile('noticia_image')) {
        $image = $request->file('noticia_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('noticias', $imageName, 'public'); // Salva a imagem no diretório 'storage/app/public/noticias'

        // Salva a relação polimórfica com a notícia
        $upload = new Upload([
            'file_name' => $imageName,
            'file_path' => $path,
        ]);
        $noticia->uploads()->save($upload);
    }

    // Redirecionar após salvar
    return redirect()->route('noticias.index')->with('success', 'Notícia criada com sucesso!');
}

    public function edit($id)
    {
        $noticia = Noticias::with('uploads')->findOrFail($id);
    return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        // Busca e atualiza a notícia existente
        $noticia = Noticias::findOrFail($id);
        $noticia->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Retorna a notícia atualizada como resposta JSON
        return redirect()->route('noticias.index');
    }

    public function destroy($id)
    {
        $noticia = Noticias::findOrFail($id);
        $noticia->delete();
        return redirect()->route('noticias.index');
    }
}
