<?php
include_once '../../core/HttpClienteInterce.php';
class Request implements HttpClienteInterce{
    public function post($uri, $headers, $body){
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        try {
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new Exception('Erro na requisição: ' . curl_error($ch));
            }

            return $response;
        } catch (Exception $e) {
            throw new Exception('Erro na requisição: ' . $e->getMessage());
        } finally {
            curl_close($ch);
        }
    }
    }
