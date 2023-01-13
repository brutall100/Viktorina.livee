let firstNames = ["Aldas","Justė", "AKiss", "Ąžuolas", "Kamilė", "Dalia", "Saulius", "Juratė", "Lukas", "Dovydas", "Ignas", "Inga", "Laura", "Kristina", 
"Valdelis", "Marius", "Tania", "Rūta", "Gintarė", "Tomas", "Erlandas", "Giedrius", "Viktorija", "Ramas", "Efka", "Reno", "Rex", "Mama", "Tete", 
"Sese", "Teta", "Egidijus", "Auksė", "Virgilijus", "Rokas", "Gintautas", "Elvyra", "Martyna", "Tomas", "Birutė", "Edvardas", "Aistė", "Eglė", 
"Darius", "Paulius", "Dangiras", "Daiva", "Jurga", "Mindaugas", "Jolanta", "Giedrė", "Mantas", "Raimonda", "Eimantas", "Almira", "Stasys", "Vida", 
"Gediminas", "Viktoras", "Jolita", "Greta", "Gertrūda", "Antanas", "Birutė", "Arūnas", "Evelina", "Nerijus", "Darius", "Monika", "Egidijus", 
"Rūta", "Ausra", "Jolita", "Paulius", "Saulius", "Linas", "Justina", "Zita", "Egle", "Ramunė", "Irena", "Rimantas", "Egidijus", "Virginijus", 
"Darius", "Rūta", "Elena", "Jolanta", "Gediminas", "Jurga", "Martynas", "Vytautas", "Rokas", "Algirdas", "Tomas", "Dalia", "Gintarė", "Birutė", 
"Rimantas", "Jolanta", "Vytautas", "Augustė", "Eglė", "Mindaugas", "Marija", "Daiva", "Jonas", "Rūta", "Rimantas", "Birutė", "Darius", 
"Jūratė", "Dainius", "Greta", "Vilhelmas", "Evelina", "Kęstutis", "Laima", "Arūnas", "Giedrė", "Tautvydas", "Dovilė", "Andrius", "Jovita", 
"Virginija", "Viktoras", "Dalius", "Saulė", "Ema", "Linas", "Gintarė", "Vaidotas", "Mantas", "Laura", "Marius", "Reda", "Aušra", "Vaidas", 
"Zita", "Justas", "Rimvydas", "Rasa", "Simona", "Modestas", "Laimutė", "Danguolė", "Kazys", "Inga", "Dovydas", "Viktorija", "Algirdas", "Neringa", 
"Laurynas", "Edita", "Alvydas", "Jurga", "Aistė", "Petras", "Asta", "Gediminas", "Viktoras", "Irena", "Ausra", "Rimas", "Rūta", "Vitalijus", 
"Audronė", "Stasys", "Aušrinė", "Eligijus", "Milda", "Genovaitė", "Darius", "Virginijus", "Tadas", "Ramūnas", "Zita", "Deimantė", "Gintaras", 
"Žygimantas", "Inga", "Bronislovas", "Vilma", "Mantas", "Rimantė", "Vida", "Kęstutis", "Jovita", "Kristina", "Daumantas", "Eglė", "Ignas", 
"Rūta", "Rita", "Marius", "Gabrielė", "Tomas", "Laima", "Živilė", "Gediminas", "Kristijonas", "Viktorija", "Vilhelmina", "Ramūnas", "Egidijus", 
"Sigita", "Algimantas","Emily", "Hannah", "Sarah", "Lauren", "Amber", "Brianna", "Jordan", "Victoria", "Haley", "Megan", "Kayla", "Heather", 
"Abby", "Kaitlyn", "Allison", "Alexis", "Morgan", "Bailey", "Savannah", "Samantha", "Rachel", "Sydney", "Mackenzie", "Madeline", "Katie", "Erin", 
"Olivia", "Emma", "Brooke", "Danielle", "Katherine", "Lily", "Hailey", "Jenna", "Chloe", "Isabella", "Mia", "Grace", "Taylor", "Leah" ];

let secondNames = ["Uoga","Pupa","Super","Linksmuolis","Bambalinis","Kukli","Paprastutė","Generolas","Nuolanki","Trapi","Išmintinga","Kietasis",
"1","2","3","69","99","4","","Sasiska","Puikioji","Išmanusis","Piktas","Rusas","Kiškis","Genijus","Babulė","Dundukas","Siaubūnas", "Protinguolis", "Afigienas", 
"Beprotis", "Juokingas", "Tikintis", "Storulis", "Beprotis", "Pilotas", "Trumparegis", "Mamos", "Koldūnas", "Sliekas", "Baršiasriubis", "Gudrus", 
"Gerasis", "Išprotejusi", "Karšta", "Gudri", "Putiovas","Digimonas", "Pokemonas", "Gražioji", "auskleidžiantis", "nepaprastas", "paprastas", 
"stiprus", "silpnas", "ištikimas", "neištikimas", "geras", "blogas", "niekšingas", "švelnus", "stiprus", "ryžtingas", "atsargus", "neatsargus", "ramus", 
"neramus", "puikus", "prastas", "gražus", "negražus", "malonus", "nemalonus", "didelis", "mažas", "stambus", "mažytis", "ilgas", "trumpas", 
"platus", "siauras", "aukštas", "žemas", "storegtas", "apvalus", "kvadratinis", "apvalus","švelnus", "naujas", "didžiulis", "mažas", "lengvas", 
"ryškus", "sunkus", "aukštas", "ilgas", "siauras", "trumpas", "storas", "plonas", "gyvas", "miręs", "kvailas", "protingas", "gražus", "negražus", 
"šiltas", "šaltas", "sveikas", "ligotas", "baltas", "juodas", "raudonas", "geltonas", "melynas", "žalias", "oranžinis", "violetinis", "rožinis", 
"mėlynas", "rudas", "sidabrinis", "auksinis", "brangus", "pigus", "geras", "blogas", "greitas", "lėtas", "jaunas", "senas", "linksmas", "liūdnas", 
"nerimastingas", "ramus", "didelis", "mažas", "galingas", "silpnas", "daugelis", "mažai", "šviesus", "tamsus", "nepaprastas", "įprastas", 
"nepaprastas", "įdomus", "nuobodus", "sveikas", "ligotas", "pilnas", "tuščias", "didelis", "mažas", "įtarus", "draugiškas", "priešiškas", 
"nepaklusnus", "paklusnus", "šiltas", "šaltas", "atviras", "uždarytas", "geras", "blogas", "teisingas", "neteisingas", "patikimas", 
"nepatikimas", "drąsus", "bijantis", "patogus", "nepatogus", "patrauklus", "nepatrauklus", "prieinamas", "neprieinamas", "patvarus", 
"nepatvarus", "paslaugus", "nepaslaugus", "greitas", "lėtas", "tiesus", "kreivas", "siauras", "platus", "apvalus","Balta", "Mėlyna", "Žalia", 
"Geltona", "Raudona", "Violetinė", "Auksinė", "Ruda", "Minkšta", "Tamsi", "Ryški", "Drėgnos", "Baltos", "Sviesios", "Tamsios", "Šviesios", 
"Vėsios", "Karštos", "Sviestos", "Kvepiančios", "Saldžios", "Sūrios", "Šarminės", "Aitrios", "Grietinėlės", "Saulės", "Saldžių", "Sūrių", 
"Sviestų", "Šaltų", "Karštų", "Gėlių", "Vaisių", "Pieno", "Medaus", "Miltų", "Vandens", "Debesų", "Dangaus", "Žemės", "Vėjo", "Žalios", "Mėlynos", 
"Rudos", "Baltos", "Žalios", "Raudonos", "Violetinės", "Auksinės", "Juodos", "Baltos","juoda", "Balta", "raudona", "geltona", "žalia", "mėlyna", 
"purpurinė", "tamsiai mėlyna", "tamsiai raudona", "tamsiai geltona", "tamsiai žalia", "tamsiai purpurinė", "sidabrinė", "auksinė", "bronzinė", 
"persikų", "rožinė", "rožinė", "citrinų", "oranžinė", "žali", "tamsiai oranžinė", "tamsiai žali", "tamsiai citrinų", "tamsiai persikų", 
"tamsiai rožinė", "tamsiai rožinė", "mėlynai raudona", "mėlynai geltona", "mėlynai žalia", "mėlynai purpurinė", "mėlynai citrinų", 
"mėlynai persikų", "mėlynai rožinė", "mėlynai rožinė", "žaliojo gintaro", "žaliojo smaragdo", "žaliojo sardžio", "žaliojo topazo", 
"žaliojo turkio", "raudonojo akmens", "raudonojo granato", "raudonojo rubino", "raudonojo sardžio", "raudonojo topazo","Darbininkas",
"Statybininkas","Medikas","Gydytojas","Mokytojas","Programuotojas","Inžinierius","Mokslininkas","Rašytojas","Dailininkas","Muzikantas","Fotografas",
"Kirpėjas","Konditeris","Vairuotojas","Statybos vadybininkas","Statybos inžinierius","Analitikas","Verslininkas","Policininkas","Gaisrininkas",
"Herojus","Žurnalistas","Buhalteris","Techninis direktorius","Kompiuterių technikas","Vadybininkas","Sprendimų priėmėjas",
"Kirpėjas","Konditerio padėjėjas","Statybos darbininkas","Finansininkas", "Vadybininkas","Adminas","Policijos", "Komisaras","Gaisrininkas",
"Režisierius","Žiniasklaidininkas","Buhalterė","Specialistas","Prognozuotojas","Superman","Batman","Wonder Woman",
"The Flash","Green Lantern","Spider-Man","Iron Man","Captain America","Black Widow","Hulk","Thor","Aquaman","The X-Men","Cyclops","Storm","Wolverine",
"Rogue","Gambit","Nightcrawler","Daredevil","The Punisher","The Green Arrow","Black Canary","Starfire","Raven","Beast Boy","Wonder Girl","Black Lightning",
"Martian","","","","","","","","","","","","","",""];


let getRandomNumber = (max) => Math.floor(Math.random() * max);

let getRandomName = () => 
  `${firstNames[getRandomNumber(firstNames.length)]} ${secondNames[getRandomNumber(secondNames.length)]}`;

  let setRandomName = () => {
    const randomName = getRandomName();
    document.getElementById('random-name').innerText = randomName
    document.getElementById("name-input").value = randomName
    navigator.clipboard.writeText(randomName)
  }

document.getElementById('generuoti-varda')
.addEventListener('click', setRandomName)




document.getElementById('generate-pasword')
.addEventListener('click',function generatePassword() {
  var password = ""
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=[]{};':" + "\\|,.<>/?`~"

  for (var i = 0; i < 10; i++) {
    password += possible.charAt(Math.floor(Math.random() * possible.length))
  }

  document.getElementById("password").innerHTML = password
  document.getElementById("password-input").value = password

  // check if the execCommand function is supported
  if (document.queryCommandSupported('copy')) {
    // create a temporary input element to hold the password
    var tempInput = document.createElement("input");
    // set the value of the input to the password
    tempInput.value = password;
    // add the input to the page
    document.body.appendChild(tempInput);
    // select the input element
    tempInput.select();
    // copy the selected text to the clipboard
    document.execCommand('copy');
    // remove the input element
    document.body.removeChild(tempInput);
  }
})



