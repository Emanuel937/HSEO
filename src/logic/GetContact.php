<?php

class GetContact
{
    public ?array  $scrapperData = [
        ["email"=>null, "site"=>null]
    ];
    public ?string $email;
    public ?string $site;
    public ?string $tel;
    private $init_curl ;

    public function __construct(){
        $this->init_curl= curl_init();
    }
    final public function startGettingData($linksOrLink): array
    {

        // GET DATA FROM WEBSITE
        $curl_init = $this->init_curl;
        curl_setopt($curl_init, CURLOPT_URL, $linksOrLink);
        curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_init, CURLOPT_TIMEOUT, 60); // Temps d'exécution en secondes
        curl_setopt($curl_init, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl_init, CURLOPT_MAXREDIRS, 5); // Nombre maximal de redirections à suivre

        $response = curl_exec($curl_init);

        if (curl_errno($curl_init)) {
            curl_close($curl_init);
            return [];
        } else {
            //curl_close($curl_init);
           $this->scrapingWebsite($response, $linksOrLink);
            var_dump($this->scrapperData);
            return $this->scrapperData;
        }
    }
    final public function isSingleSite($data): void
    {
        $param_type = get_debug_type($data);
        if ($param_type == "string") {
            // it is a single website
            $this->startGettingData($data);
        } elseif ($param_type == "array") {
            // MAKE HTTP REQUEST THEN GET DATA
            foreach ($data as $links) {
                $this->startGettingData($links);

            }
        }
    }
    final public function scrapingWebsite($dom, $url)
    {
        $domDocument = new DOMDocument();
        libxml_use_internal_errors(true);
        $domDocument->loadHTML($dom);
        libxml_clear_errors();
        // Récupérer tous les liens de la page
        $links = $domDocument->getElementsByTagName('a');
        $domain = parse_url($url, PHP_URL_HOST);
        $primaryEmail = null;
        $emailRegex = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';
        // Parcourir tous les liens
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            preg_match($emailRegex, $href, $matches);
            if (!empty($matches)) {
                $primaryEmail = $matches[0];
                break;
            }
        }
        // Afficher l'adresse e-mail principale si elle est trouvée
        if ($primaryEmail !== null)
        {
            $this->email = $primaryEmail;
            $this->site  = $domain;

                    $this->scrapperData [] = [
                        "email" => $this->email,
                        "site" => $domain
                    ];
                }
            }
        }