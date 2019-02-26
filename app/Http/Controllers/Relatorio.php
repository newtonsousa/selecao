<?php

namespace selecao\Http\Controllers;

use Illuminate\Http\Request;
use selecao\Http\Requests;
use Illuminate\Support\Facades\App as App;
use selecao\Http\Controllers\Controller;
use \Config as Config;
use \Validator as Validator;
use selecao\Models\Relatorio as RelatorioModel;
use selecao\Http\Requests\Visitante as VisitanteRequest;
use selecao\Models\Visitante as VisitanteModel;

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
    public function show($dtIni = null, $dtFim = null)
    {
        $snappy = App::make('snappy.pdf.wrapper');
        
        $data = VisitanteModel::select('historico.str_nome as destino', 'historico.str_setor', 'historico.str_evento', 'historico.int_fone', 'historico.dt_entrada as dt_entrada', 'historico.dt_saida', 'visitante.str_nome as visitante',
            'visitante.str_endereco', 'visitante.str_empresa_orgao', 'tipo_documento.str_tipo_documento', 'visitante.int_numero_documento', 'visitante.int_telefone', 'visitante.int_celular',
            'historico.int_cracha', 'visitante.int_codigouf', 'historico.str_sala', 'historico.str_andar', 'historico.str_responsavel_entrada', 'historico.str_responsavel_saida' )
            ->join('historico', 'historico.int_codigo', '=', 'visitante.id')
            ->join('tipo_documento', 'tipo_documento.int_tipo_documento', '=', 'visitante.int_tipo_documento') ;
            
            if( !is_null($dtIni) && !is_null($dtFim) ){
                $data = $data->where('historico.dt_entrada', '>=', $dtIni.'%' )
                ->where('historico.dt_saida', '<=', $dtFim.'%');
            }
            if(!is_null($dtIni) && is_null($dtFim)){
                $data = $data->where('historico.dt_entrada', 'like' , $dtIni.'%' );
            }
            if(is_null($dtFim) && !is_null($dtFim)){
                $data = $data->where('historico.dt_saida', 'like' , $dtFim.'%' );
            }
            $data = $data->get();
            
            $topo = " <img src='". dirname(__FILE__)."/../../../public/assets/img/cabecalho.jpg' > ";
            $html = '<html><head><style>'
                . 'tr { page-break-inside: avoid;}'
                    . '</style></head><body>';
                    $html .= "
              <h3 style='text-align:center'>Relatório de histórico dos visitantes</h3>
              <table width='100%' border='1'>
                <thead>
                      <tr BGCOLOR=#EAE8E8>
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
                        
                <tbody> ";
                    foreach ($data as $dado){
                        
                        //formatar o CPF
                        $nbr_cpf = $dado->int_numero_documento;
                        $parte_um     = substr($nbr_cpf, 0, 3);
                        $parte_dois   = substr($nbr_cpf, 3, 3);
                        $parte_tres   = substr($nbr_cpf, 6, 3);
                        $parte_quatro = substr($nbr_cpf, 9, 2);
                        
                        if( $dado->str_tipo_documento == 'CPF' ){
                            $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
                        }else{
                            $monta_cpf = $dado->int_numero_documento;
                        }
                        
                        //formatar o telefone
                        $num_tel = $dado->int_telefone;
                        $part_um     = substr($num_tel, 0, 2);
                        $part_dois   = substr($num_tel, 2, 4);
                        $part_tres   = substr($num_tel, 6, 8);
                        
                        if( $part_tres ){
                            $monta_tel = '('.$part_um.')'.$part_dois.'-'.$part_tres;
                        }else{
                            $monta_tel = '';
                        }
                        
                        //formatar o celular
                        $num_cel = $dado->int_celular;
                        $part_cel_um     = substr($num_cel, 0, 2);
                        $part_cel_dois   = substr($num_cel, 2, 4);
                        $part_cel_tres   = substr($num_cel, 6, 8);
                        
                        if( $part_cel_tres ){
                            $monta_cel = '('.$part_cel_um.')'.$part_cel_dois.'-'.$part_cel_tres;
                        }else{
                            $monta_cel = '';
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
                        
                        $html .= ' <tr>
                        <td> '.$dado->visitante.' </td>
                        <td>'.$dado->str_tipo_documento.'</td> ';
                        if( $dado->str_tipo_documento == 'CPF' || $dado->str_tipo_documento =='Passaporte' ){
                            $html .= ' <td>'.$monta_cpf. '</td>';
                        } else {
                            $html .= '<td>'.$monta_cpf. '/'.$dado->int_codigouf.'</td>';
                        }
                        $html .= ' <td>'.$monta_tel.'</td>
                        <td>'.$monta_cel.'</td>
                        <td>'.$dado->str_endereco.'</td>
                        <td>'.$dado->str_empresa_orgao.'</td>';
                        if( !empty($dado->destino) ){
                            $html .= ' <td>'.$dado->destino.' - ' .$dado->str_andar .' - ' .$dado->str_sala. ' - ' . $dado->str_andar .'</td>';
                        }else{
                            $html .= ' <td>'.$dado->str_setor.'' .$dado->str_evento.'</td>';
                        }
                        $html .= ' <td>'.date('d/m/Y H:i', strtotime($dado->dt_entrada)).'</td>
                        <td>'.$data_saida.'</td>
                        <td>'.$dado->str_responsavel_entrada.'</td>
                        <td>'.$dado->str_responsavel_saida.'</td>
                    </tr> ';
                    }
                    $html .= ' </tbody>
              </table>
              </body>
              </html>
        ';
                    
                    $snappy->loadHTML($topo . $html)
                    ->setPaper('a4')
                    ->setOrientation('landscape')
                    ->setOption('margin-left', '6mm')
                    ->setOption('margin-right', '6mm')
                    ->setOption('encoding', 'utf-8')
                    ->setOption('minimum-font-size', '8')
                    ->setOption('footer-center','Pag. [page] de [toPage]')
                    ->setOption('footer-font-size', '7');
                    
                    return $snappy->stream();
                    
                    
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
