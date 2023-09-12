<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Models\Games;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosJogos = Games::All();
        return 'Jogos Encontradas' .$dadosJogos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosJogos = $request -> All();
        $valida = Validator::make($dadosJogos,[
            'nomeJogo' => 'required',
            'produtora' => 'required',
            'dataLancamento' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $RegistrarJogos = Games::create($dadosJogos);
        if($RegistrarJogos){
            return 'Jogo cadastro com sucesso.';
        }else{
            return 'Jogo não cadastrados no banco de dados.';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dadosJogos = Games::find($id);
        $contador = $dadosJogos->count();
        if($dadosJogos){
            return 'Jogos Encontrados '.$contador.' - ' .$dadosJogos.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'Noticias não Localizadas.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosJogos = $request -> All();
        $valida = Validator::make($dadosJogos,[
            'nomeJogo' => 'required',
            'produtora' => 'required',
            'dataLancamento' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }
        
        $dadosJogosBanco = Games::find($id);
        $dadosJogosBanco->nomeJogo = $dadosJogos['nomeJogo'];
        $dadosJogosBanco->produtora = $dadosJogos['produtora'];
        $dadosJogosBanco->dataLancamento = $dadosJogos['dataLancamento'];

        $envioJogo = $dadosJogosBanco->save();
        
        if($envioJogo){
            return 'O Jogo foi alterada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'O Jogo não foi alterada.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosJogos = Games::find($id);
        if($dadosJogos){
            $dadosJogos->delete();
            return 'O Jogo foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'O Jogo não foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }
}
