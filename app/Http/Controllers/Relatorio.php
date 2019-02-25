<?php

namespace cadvisitante\Http\Controllers;

use Illuminate\Http\Request;
use cadvisitante\Http\Requests;
use Illuminate\Support\Facades\App as App;
use cadvisitante\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;
use cadvisitante\Models\Relatorio as RelatorioModel;
use cadvisitante\Http\Requests\Visitante as VisitanteRequest;
use cadvisitante\Models\Visitante as VisitanteModel;

class Relatorio extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('relatorio/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('relatorio/create');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
    public function edit()
    {
        return view('relatorio/edit');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    
    public function store(VisitanteRequest $request)
    {
       
    }
 
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
       $snappy = App::make('snappy.pdf.wrapper');
       
       $data = VisitanteModel::select('historico.str_nome as destino', 'historico.STR_SETOR', 'historico.STR_EVENTO', 'historico.INT_FONE', 'historico.created_at as dt_entrada', 'historico.dt_saida', 'visitante.STR_NOME as visitante', 
                        'visitante.STR_ENDERECO', 'visitante.STR_EMPRESA_ORGAO', 'tipo_documento.STR_TIPO_DOCUMENTO', 'visitante.INT_NUMERO_DOCUMENTO', 'visitante.INT_TELEFONE', 'visitante.INT_CELULAR',
                        'visitante.INT_CRACHA', 'visitante.int_codigouf', 'historico.str_sala', 'historico.str_andar' )
                    ->join('historico', 'historico.INT_CODIGO', '=', 'visitante.id') 
                    ->join('tipo_documento', 'tipo_documento.INT_TIPO_DOCUMENTO', '=', 'visitante.INT_TIPO_DOCUMENTO') 
                    ->get();   
        
        $html = ' 
              <h1 style="text-align:center">Relatório de histórico dos visitantes</h1>
              <br/>
              <table width="100%" border="1">
                  <thead>
                      <tr>
                          <th>Nome</th>
                          <th>Documento</th>
                          <th>Número</th>
                          <th>Telefone</th>
                          <th>Celular</th>
                          <th>Endereço</th>
                          <th>Empresa/Órgão</th>
                          <th>Destino</th>
                          <th>Dt entrada</th>
                          <th>Dt saída</th>
                          <th>Atend. resp. entrada</th>
                          <th>Atend. resp. saída</th>
                      </tr>
                  </thead>
                  <tbody>';
        foreach ($data as $dado){
      
        $nbr_cpf = $dado->INT_NUMERO_DOCUMENTO;
        $parte_um     = substr($nbr_cpf, 0, 3);
        $parte_dois   = substr($nbr_cpf, 3, 3);
        $parte_tres   = substr($nbr_cpf, 6, 3);
        $parte_quatro = substr($nbr_cpf, 9, 2);
        
        if( $dado->STR_TIPO_DOCUMENTO == 'CPF' ){
            $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
        }else{
            $monta_cpf = $dado->INT_NUMERO_DOCUMENTO;
        }

  
        if( $dado->dt_saida != '0000-00-00 00:00:00' ){
            $data_saida = date('d/m/Y H:i', strtotime($dado->dt_saida));
        }else{
            $data_saida = '';
        }   
        
        
        switch ($dado->int_codigouf) {
            case 1:
                $dado->int_codigouf = "AC";
                break;
            case 2:
                $dado->int_codigouf = "AL";
                break;
            case 3:
                $dado->int_codigouf = "AM";
                break;
            case 4:
                $dado->int_codigouf = "AP";
                break;
            case 5:
                $dado->int_codigouf = "BA";
                break;
            case 6:
                $dado->int_codigouf = "CE";
                break;
            case 7:
                $dado->int_codigouf = "DF";
                break;
            case 8:
                $dado->int_codigouf = "ES";
                break;
            case 9:
                $dado->int_codigouf = "GO";
                break;
            case 10:
                $dado->int_codigouf = "MA";
                break;
            case 11:
                $dado->int_codigouf = "MG";
                break;
            case 12:
                $dado->int_codigouf = "MS";
                break;
            case 13:
                $dado->int_codigouf = "MT";
                break;
            case 14:
                $dado->int_codigouf = "PA";
                break;
            case 15:
                $dado->int_codigouf = "PB";
                break;
            case 16:
                $dado->int_codigouf = "PE";
                break;
            case 17:
                $dado->int_codigouf = "PI";
                break;
            case 18:
                $dado->int_codigouf = "PR";
                break;            
            case 19:
                $dado->int_codigouf = "RJ";
                break;
            case 20:
                $dado->int_codigouf = "RN";
                break;
            case 21:
                $dado->int_codigouf = "RO";
                break;
            case 22:
                $dado->int_codigouf = "RR";
                break;
            case 23:
                $dado->int_codigouf = "RS";
                break;
            case 24:
                $dado->int_codigouf = "SC";
                break;
            case 25:
                $dado->int_codigouf = "SP";
                break;
            case 26:
                $dado->int_codigouf = "SE";
                break;
            case 27:
                $dado->int_codigouf = "TO";
                break;            
        }
        
        $html .= '
                    <tr>
                        <td> '. $dado->visitante.' </td>
                        <td>'.$dado->STR_TIPO_DOCUMENTO.'</td>
                        <td>'.$monta_cpf. '/'.$dado->int_codigouf.'</td>       
                        <td>'.$dado->INT_TELEFONE.'</td>
                        <td>'.$dado->INT_CELULAR.'</td>
                        <td>'.$dado->STR_ENDERECO.'</td>
                        <td>'.$dado->STR_EMPRESA_ORGAO.'</td>
                        <td>'.$dado->destino.' - ' .$dado->str_andar .' - ' .$dado->str_sala. ' - ' . $dado->str_andar .'</td>
                        <td>'.date('d/m/Y H:i', strtotime($dado->dt_entrada)).'</td> 
                        <td>'.$data_saida.'</td>
                        <td></td>
                        <td></td>
                    </tr>';
        }                      
                     
        $html .= ' </tbody>
              </table>
        ';
        $snappy->loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0)->setOption('encoding',  'utf-8'); 
        return $snappy->stream();
        //return $snappy->download('relatorio.pdf');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }   
    
    
}
