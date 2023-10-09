<?php

namespace App\Http\Controllers;

use App\Models\Lidere;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('activacion', 1)->orderBy('name', 'asc')->simplePaginate(100);

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(User::$rules);

        $user = User::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function ActualizarFoto(Request $request)
    {
        $idUsuario = auth()->user()->usuario;
        print_r($request->archivo);die();
        $path = $request->file('archivo')->store(
            'fotoPerfil', 'public'
        );
        print_r($path);die();
        $Lidere = DB::update('update Lideres set foto = ? where cedula = ?', [$path,$idUsuario]);
        return $path;
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function CrearUsuario(Request $request)
    {
        $id = $request->id;
        //print_r($request->id);die();
        $data = DB::update("EXEC [crearUsuario] @CEDULA = N'$id';");

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $cedula = $user->usuario;  
        $consulta = DB::select("SELECT foto FROM [Lideres] where Cedula in ($cedula);"); 
        if (empty($consulta)){
            $foto = 'fotoPerfil/perfilDefault.png';
        }else{
            $foto = $consulta[0]->foto;
        };
        //print_r($consulta);die();
        //print_r($foto);die();

        return view('user.edit', compact('user','foto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Users $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (empty($request->file('archivo'))){
            $idUsuario = auth()->user()->usuario;
        }else{
            
            $idUsuario = auth()->user()->usuario;
            $path = $request->file('archivo')->store(
                'fotoPerfil', 'public'
            );
            $Lidere = DB::update('update Lideres set foto = ? where cedula = ?', [$path,$idUsuario]);
        }
        //print_r($path);die();
        request()->validate(User::$rules);
        $id = $request->usuario;
        $password = $request->password;
        if ($password == '') {
            $password =auth()->user()->password;  
        }else{
            $password = bcrypt($request->password);
        }
        $user = User::where('usuario', $id)->update(array('name' => $request->name,'email' => $request->email,'password' => $password));
        
        //return redirect($url);
        return redirect()->route('home')
            ->with('success', 'Datos actualizados correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //$user = User::find($id)->delete();
        $user = User::where('usuario', $id)->update(array('activacion' => 2,'password' => bcrypt($id)));

        return redirect()->back()
            ->with('Completo', 'El usuario fue activado correctamente!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }

}
