# LoginPage

Aplicație Web :

- 2 tabele MySQL, users (ID, user, password) si points (ID, lat, long, description)

- Pagina de login: pagina va conține două câmpuri user si password cu ajutorul cărora se verifica dacă username-ul si parola introduse de utilizator de regasesc in tabela users). Pagina de asemenea va conține alte două câmpuri user si password cu care utilizatorul se va putea înregistra și implicit scrie cele două valori într-o bază de date. Pe pagina de login se va implementa codul de completare automată cu JQuery din laboratorul 9 pentru câmpul user din secțiunea dedicată utilizatorilor deja înregistrați.

În baza unei autentificări sau a unei înregistrări reușite, se va trece la următoarea pagină, adică: 

- Pagina Google Maps. Pagina va conține cod de autentificare implementat folosind variabile de sesiune. În pagina se va afișa un mesaj care va conține numele utilizatorului autentificat (De ex.: Bine ai venit, <nume utilizator>!), precum și un link care permite dez-autentificarea (logout). Pagina va instanția o hartă Google Maps pe care se adaugă câte un marker pentru fiecare intrare din tabela points la coordonatele specificate în campurile lat si long. Marker-ele vor avea un label care va fi luat din câmpul description
