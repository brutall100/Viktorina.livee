<!-- 1 uzduotis -->
<!-- Kolkas palieku ramybeje,nes nezinau kaip padaryti function oldQuestionData()
Funkcija turi pagauti id=47 paprasta..Tada kazkaip ji issisaugoti ir tik kai pasikeicia id=32 tada rodyti 
praeita id=47  -->

<!-- 2 -->
<!-- Pasidaryti svaria php ir javaScript registracijos kopija githube su pasijungimu i xampp -->

<!-- 3 -->
<!-- Teisingi ir neteisingi klausimai eina i kazkoki chatuka,
turbut su duombaze kazkuram laijkui arba su scrolu iki 20 ar 30 paskutiniu irasu-->

<!-- 4 -->
<!-- Question waiting sutvarkyti, kad klausimai su upvotais pereitu i pagrindine db -->

<!-- 5 -->
<!-- a_index.php pradetu imti klausimus is pagrindines db -->

<!-- 6 -->
<!-- Padarti i statistic.php menesio top savaites top dienos top  top 10 irasysiu klausimus nusinulina 12 nakties -->

<!-- 7 -->
<!-- Full screen api ,kad vaizdas butu per visa ekrana -->

<!-- 8 -->
<!-- Css padaryti kad baigiantis laikui klausimas prades nykti ir mazeti ir nubrgs i desny kampa apacioj  -->

<!-- 9 -->
<!-- sukurti ikoneles useriams su daug litu,galima butu
nusipirkti is storo uz litus,plius gender ikoneles.Taippat galima pirkti store -->

<!-- 10 -->
<!-- Kosmetinis saito sutvarkymas .Dizaino paieskos ir.t.t -->

<!-- 11 -->
<!-- Reikia else dadeti, niekas neatsake teisingai. Kitas klausimas po 3 sekundziu -->

<!-- 12 -->
<!-- sukurti 5 geimusmus -->

<!-- 13 -->
<!-- Sutvarkyti litu galunes  Teisingai atsakė tadas: Gagarinas tadas gauna 52 litus -->

<!-- 14 -->
<!-- Raides eitu i kvadratukus,kad nurodytu raidziu kieki atsakyme -->

<!-- 15 -->
<!-- Sutvarkyti Lt raide S-š i-į ir t.t -->

<!--16 -->
<!-- Irasant klausima prideti 10 litu, ir galimas pridejimas linko i klausima ir paaiskinimas.Kad is kur klausimas ir pagrindimas -->

<!-- 17 -->
<!-- Uz klausimo irasyma 10 litu + Ikonele kokia 1 savatei klausimu irasytojas + mini taisykles -->



<!-- Recapha    apsauga -->
reCAPTCHA is a free service from Google that helps protect websites from spam and abuse. It uses advanced risk analysis techniques to tell humans and bots apart. With the new API, a significant number of your valid human users will pass the reCAPTCHA challenge without having to solve a CAPTCHA. reCAPTCHA offers more than just spam protection. It can also be used for security purposes like to prevent bots from trying to login to your site.

You can add a reCAPTCHA to your form by following these steps:

Go to the reCAPTCHA website (https://www.google.com/recaptcha/) and sign up for an API key pair for your site.

In the HTML form, add the reCAPTCHA widget by including the reCAPTCHA JavaScript API in the head of your HTML file.

Copy code
<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
In the form, add the reCAPTCHA widget by adding the following HTML element where you want the widget to appear.
Copy code
<div class="g-recaptcha" data-sitekey="your_site_key"></div>
Replace 'your_site_key' with the Site key that you obtained from the reCAPTCHA website.

In your PHP script, you will need to verify the reCAPTCHA response by making a request to the reCAPTCHA server. You can use the file_get_contents() function to get the response.

Copy code
$response = $_POST["g-recaptcha-response"];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => 'your_secret_key',
    'response' => $response
);
$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success=json_decode($verify);
if ($captcha_success->success==false) {
    // code for when the CAPTCHA fails
} else if ($captcha_success->success==true) {
    // code for when the CAPTCHA passes
}
You need to replace 'your_secret_key' with the Secret key that you obtained from the reCAPTCHA website.

This is just a basic example of how to add a reCAPTCHA to your form, you can customize it according to your requirements.

<!-- / -->
<!--           / -->