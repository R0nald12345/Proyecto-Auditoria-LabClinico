<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class LandingPageController extends Controller
{
    
    public function index()
    {
        $Comentarios = Comentario::latest()->take(4)->get();
        return view('landingpage.index', compact('Comentarios'));

    }

    public function solicitud()
    {
        return view('landingpage.solicitud');
    }

    public function comentarios()
    {
        $comentarios = Comentario::latest()->with('user')->paginate(10);
        
        if($comentarios->count() == 0){
            $comments = null;
        }

        return view('landingpage.comentarios', compact('comentarios'));
    }

    public function aboutUs()
    {
        return view('landingpage.aboutUs');
    }

    public function contactUs()
    {
        return view('landingpage.contactUs');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'comentario' => 'required'
            ]);
             
            Comentario::create([
                'body' => $request->comentario,
                'user_id' => auth()->user()->id
            ]);
               
            return redirect()->route('LandingPage.comentarios')->with('success', 'Comentario agregado correctamente');
        }catch (\Exception $e) 
        {
            return redirect()->route('LandingPage.comentarios')->with('error', 'No se pudo agregar el comentario');
        }
    }





    public function destroy($id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            $comentario->delete();
            return redirect()->route('LandingPage.comentarios')->with('success', 'Comentario eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('LandingPage.comentarios')->with('error', 'No se pudo eliminar el comentario');
        }
    }




}
