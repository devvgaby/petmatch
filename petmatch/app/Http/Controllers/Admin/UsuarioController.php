<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::paginate(10);  // listagem paginada para pegar no max 10 usuarios cadastros no banco na tela
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']); 

        Usuario::create($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
{
    $data = $request->validate([
        'nome'      => 'required|string|max:255',
        'email'     => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
        'telefone'  => 'nullable|string|max:20',
        'endereco'  => 'nullable|string|max:255',
        'cep'       => 'nullable|string|max:10',
        'latitude'  => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'perfil_id' => 'nullable|exists:perfis,id',
        'password'  => 'nullable|string|min:6|confirmed',
    ]);

    if (empty($data['password'])) {
        unset($data['password']);
    } else {
        $data['password'] = bcrypt($data['password']);
    }

    $usuario->update($data);

    return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
