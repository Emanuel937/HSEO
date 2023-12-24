<?php
$ch = curl_init();
$url = 'https://www.adveris.fr/'; 
// Remplacez par l'URL de votre choix
$domaine = parse_url($url, PHP_URL_HOST);
// Vérification et ajout d'un / à la fin de l'URL de base si nécessaire
if (substr($url, -1) !== '/') {
    $url .= '/';
}
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
$all_links  =  [];
$info_contact = [
    [],
    [],
    [],
];

// Fermeture de la session cURL
curl_close($ch);
// Compter les liens internes
$dom = new DOMDocument();
@$dom->loadHTML($response);
$links = $dom->getElementsByTagName('a');
foreach($links as $link){
    $link = $link->getAttribute('href');
    if(!in_array($link, $all_links)){
        $all_links[] = $link;
    }
}   

var_dump($all_links);
/*
$internalLinks = [];
foreach ($links as $link) {
    $href = $link->getAttribute('href');
    // Vérification des liens internes sans ancres, sans adresses e-mail, et sans liens externes, puis ajout au tableau
    if (strpos($href, '#') === false && !preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/', $href)) {
        if (strpos($href, 'http') !== false) {
            $linkDomain = parse_url($href, PHP_URL_HOST);
            if ($linkDomain === $domaine) {
                $internalLinks[] = $href;
            }
        } else {
            $internalLinks[] = $href;
        }
    }
}*/
/*
$internalLinkCount = count($internalLinks);
echo "Le nombre de liens internes sur la page $url est : $internalLinkCount\n";
echo "Liens internes trouvés : \n";
foreach ($internalLinks as $internalLink) {
    echo $internalLink . "<br>";
}

private function extractLinks($dom):void{
    $links = $dom->getElementsByTagName('a');
    foreach ($links as $link) {
        $href = $link->getAttribute('href');
        $resolvedLink = realpath($href);
        if ($resolvedLink && strpos($resolvedLink, $this->domainName) !== false && !in_array($resolvedLink, self::$links) && !strpos($resolvedLink, '#')) {
            self::$links[] = $resolvedLink;
        }
    }
}

private function extractEmail( $response):void{
    // Extraction de l'adresse e-mail
    $matches = [];
    preg_match_all("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i", $response, $matches);
    $email = $matches[0] ? $matches[0][0] : "Non trouvé";
    //var_dump($matches);
}*/
?>
