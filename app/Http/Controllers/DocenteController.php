<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Docente;
use Session;
use Redirect;

class DocenteController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $request->user()->authorizeRoles(['admin']);
    
    if($request->user()->hasRole('admin')){
        $docentes = Docente::nombre($request->get('nombre'))
                            ->orderBy('apellidos', 'asc')
                            ->paginate(20);
        return view('admin.docentes.index',compact('docentes'));
    } 
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admin.docentes.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $docente = Docente::create($request->all());
      $docente->save;
      Session::flash('message','Docente creado correctamente!');
	    return Redirect::to('/docentes');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $docente = Docente::find($id);
    return view('admin.docentes.edit', compact('docente'));
  
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
        $docente = Docente::find($id);
	      $docente->fill($request->all());
	      $docente->save();
        Session::flash('message','Docente actualizado correctamente!');
  	    return Redirect::to('/docentes');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
        Docente::destroy($id);
		Session::flash('message','Docente eliminado correctamente!');
		return Redirect::to('/docentes');
  }
  
}

?>