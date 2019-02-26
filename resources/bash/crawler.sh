#!/usr/bin/env bash

# URLs para efetuar a requisição
declare -r uri_base='https://sta.tesouro.fazenda.gov.br/pcasp/'
declare -r uri_index=$uri_base'index.asp'
declare -r uri_post=$uri_base'index.asp?sub=1'
declare -r uri_listing=$uri_base'SEW_ListarDiretorio.asp?pstrInicio=s'
declare -r uri_captcha=$uri_base'SEW_Gerador.aspx'
declare -r uri_download=$uri_base'SEW_Download.asp?arq='


if [ -z "$1" ] && [ -z "$2" ]; then
    echo 'CPF e senha devem ser informados!'
    exit
else

    declare -r cpf=$(echo "$1" | base64 --decode | openssl rsautl -decrypt -inkey ../keys/private-key.pem)
    declare -r password=$(echo "$2" | base64 --decode | openssl rsautl -decrypt -inkey ../keys/private-key.pem)
    declare -r temp_dir=$(mktemp -d)

    echo 'Diretorio temporario criado: '$temp_dir

    curl --silent -X GET $uri_index -k -c $temp_dir/cookie_index.txt > /dev/null

    # Grava a imagem CAPTCHA enviada pelo servidor e armazena os cookies da requisição
    curl --silent -X GET $uri_captcha -k -b $temp_dir/cookie_index.txt -c $temp_dir/cookie_captcha.txt > $temp_dir/captcha.jpeg

    if [ $(file $temp_dir/captcha.jpeg --mime-type | awk '{print $2}') = "image/jpeg" ]; then
        # Converte a imagem para tons de cinza e aumenta sua resolução
        convert $temp_dir/captcha.jpeg -colorspace Gray -depth 8 -resample 200x200 $temp_dir/prepared_captcha.tif

        # OCeRiza a imagem para capturar os caracteres e prepará-los para a requisição
        tesseract $temp_dir/prepared_captcha.tif $temp_dir/result_tesseract -s

        if [ -f $temp_dir/result_tesseract.txt ]; then
            declare -r captcha=$(cat $temp_dir/result_tesseract.txt | sed -r 's/\s+//g')
            declare -r captcha_cookie=$(awk 'FNR==6 { print $7}' $temp_dir/cookie_captcha.txt | sed 's/randomica=//')

            # Verifica se o que foi capturado pela ocerizacao
            if [ $captcha = $captcha_cookie ]; then

                # Efetua o login no site do SERPRO
                declare -r  login_response=$(curl -X POST $uri_post \
                    -k \
                    --silent \
                    -d "QueryString='hidMensagemErroTransacao=&er=1&ctx=0&txtCPF=$cpf&txtSenha=$password&txtTextoImagem=$captcha&cmbTransacao=Download" \
                    -b $temp_dir/cookie_captcha.txt \
                    -c $temp_dir/cookie_login.txt)

                # Possui no response o move para a pagina de transacao?
                if grep -q 'SEW_menu.asp?pstrTransacao=Download' <<< $login_response; then

                    #  Recupera todos os downloads disponíveis
                    declare -r list_of_files=$(curl --silent \
                        -X GET $uri_listing \
                        -k \
                        -b $temp_dir/cookie_login.txt | sed -n  's/.*\(SEW_Download.*\)\"/\1/p'| sed 's/>//')

                        for filename in $list_of_files; do
                            declare uri=$(echo $uri_base$filename | tr -d '\r\n')
                            declare file=$(echo $filename | sed 's/SEW_Download.asp?arq=//g' | tr -d '\r\n')

                            # Faz o download dos arquivos disponiveis
                            curl --silent \
                                -X GET $uri \
                                -k \
                                -b $temp_dir/cookie_login.txt > $temp_dir/$file

                            # Efetua a contagem de linhas
                            case $(file $temp_dir/$file --mime-type | awk '{print $2}') in
                                'inode/x-empty')
                                    echo -e 0'\t\t'$file
                                ;;
                                'application/gzip')
                                    echo -e $(gunzip -c $temp_dir/$file  | wc -l)'\t\t'$file
                                ;;
                                'text/plain' | 'application/octet-stream')
                                    echo -e $(cat $temp_dir/$file | wc -l)'\t\t'$file
                                ;;
                                *)
                                    echo 'NOVO mime-type'
                                ;;
                            esac

                            # Move o arquivo baixado para o servidor de arquivos do SIAFI.
                            # Este procedimento utiliza chaves assimétricas para mover os arquivos entre os servidores
                            # scp -Bq $temp_dir/$file  siafi@misrv35:/opt/pobox/sta/
                        done
                else
                    if grep -q 'SEW_TratarExcecao.Asp' <<< $login_response; then
                        echo -e 'Credenciais incorretas\n'
                    fi

                    if grep -q 'index.asp?msg=5' <<< $login_response; then
                        echo -e 'Verificação do CAPTCHA falhou!\n'
                    fi
                fi
            else
                echo -e "OCR: $captcha\nCOOKIE: $captcha_cookie"
            fi

            # Remove o diretório temporário
            rm -rf $temp_dir
        fi
    fi
fi

