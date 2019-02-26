<?php

namespace selecao\Models;

use Illuminate\Database\Eloquent\Model;
use \Config as Config;

class CSA extends Model
{

    public static function getPermissoes($login) {
        $permissoes = \DB::connection('csa')->table('cacesso.permissao p')
            ->select(['p.STR_ALIAS as PERMISSAO'])
            ->join('cacesso.perfilxpermissao prxp', 'prxp.int_codigopermissao', '=', 'p.int_codigopermissao')
            ->join('cacesso.perfilacesso pr', 'pr.int_codigoperfil', '=', 'prxp.int_codigoperfil')
            ->join('cacesso.pessoaxperfil pexpr', 'pexpr.int_codigoperfil', '=', 'pr.int_codigoperfil')
            ->join('comum.sistema s', 's.int_codigosistema', '=', 'p.int_codigosistema')
            ->join('rhmi.pessoafisica pf', 'pf.int_codigopessoafisica', '=', 'pexpr.int_codigopessoafisica')
            ->where('s.STR_SIGLA', Config::get('csa.sistema.sigla'))
            ->where('pf.STR_LOGIN', $login)
            ->get();

        $returnArray = [];

        foreach ($permissoes as $permissao) {
            $returnArray[] = $permissao->permissao;
        }

        return $returnArray;
    }
}
