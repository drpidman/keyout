<?php

function baseRedirect($url) {
    # Deixe vazio caso não tenha nenhum tipo de sub pasta
    # na url da sua página, por exemplo "www.exemplo.com/"

    # Caso tenha uma sub pasta: "www.exemplo.com/sistema"
    # defina o valor de $projectUrl para: $projectUrl = "/sistema"
    $projectUrl = "";

    return $projectUrl . "/". $url;
}