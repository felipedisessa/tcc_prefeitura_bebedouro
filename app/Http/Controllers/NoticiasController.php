<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiasController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $noticias = Noticias::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%');
        })->paginate(20);

        return view('noticias.index', compact('noticias'));
    }

    public function ApiIndex()
    {
        $noticias = Noticias::with('uploads')->get()->map(function ($noticia) {
            $noticia->image_url = $noticia->uploads->isNotEmpty()
            ? url('image/' . $noticia->uploads->first()->file_path)
            : null;
            return $noticia;
        });

        // Retorna as notícias como uma resposta JSON
        return response()->json($noticias)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }


    public function create()
{
    return view('noticias.create');
}

public function store(Request $request)
{
     $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'required|string',
         'noticia_image' => 'nullable|image|max:2048',
     ]);

    $noticia = Noticias::create([
        'user_id' => auth()->user()->id,
        'name' => $request->name,
        'description' => $request->description,
    ]);

    if ($request->hasFile('noticia_image')) {
        $image = $request->file('noticia_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('noticias', $imageName, 'public'); // Salva a imagem no diretório 'storage/app/public/noticias'

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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'noticia_image' => 'nullable|image|max:2048',
        ]);

        $noticia = Noticias::findOrFail($id);
        $noticia->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $upload = Upload::find($imageId);
                if ($upload) {
                    Storage::disk('public')->delete($upload->file_path);
                    $upload->delete();
                }
            }
        }

        if ($request->hasFile('noticia_image')) {

            $existingUpload = $noticia->uploads()->first(); // Pega a primeira imagem associada

            if ($existingUpload) {
                Storage::disk('public')->delete($existingUpload->file_path);
                $existingUpload->delete();
            }

            $image = $request->file('noticia_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('noticias', $imageName, 'public');

            $upload = new Upload([
                'file_name' => $imageName,
                'file_path' => $path,
            ]);
            $noticia->uploads()->save($upload);
        }

        return redirect()->route('noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }



    public function destroy($id)
    {
        $noticia = Noticias::findOrFail($id);
        $noticia->delete();
        return redirect()->route('noticias.index');
    }
}
