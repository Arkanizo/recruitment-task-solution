<?php
    echo "<h1 class='starting-title'>Nice to see you too! &#128075;</h1>";
    echo '<body style="font-family: Arial;">';

    // Funkcja do odczytu danych z pliku JSON
    function getContacts()
    {
        $users = file_get_contents('dataset/users.json');
        $contacts = json_decode($users, true);
        return $contacts;
    }

    // Funkcja do zapisu danych do pliku JSON
    function saveContacts($contacts)
    {
        file_put_contents('dataset/users.json', json_encode($contacts));
    }

    // Sprawdzenie, czy został wysłany formularz dodawania
    if (isset($_POST['add'])) {
        $newContact = array(
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'address' => array(
                'street' => $_POST['street'],
                'suite' => $_POST['suite'],
                'city' => $_POST['city'],
                'zipcode' => $_POST['zipcode'],
                'geo' => array(
                    'lat' => $_POST['lat'],
                    'lng' => $_POST['lng']
                )
            ),
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'company' => array(
                'name' => $_POST['company_name'],
                'catchPhrase' => $_POST['catchPhrase'],
                'bs' => $_POST['bs']
            )
        );

        // Dodanie nowego kontaktu do listy
        $contacts = getContacts();
        $contacts[] = $newContact;
        saveContacts($contacts);

        // Przekierowanie na bieżącą stronę, aby nie zdublować wysłania formularza
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Sprawdzenie, czy został wysłany formularz usuwania
    if (isset($_POST['delete'])) {
        $index = $_POST['delete'];

        // Usunięcie wiersza o podanym indeksie
        $contacts = getContacts();
        if (isset($contacts[$index])) {
            unset($contacts[$index]);
            $contacts = array_values($contacts); // Przearan¿owanie indeksów tablicy
            saveContacts($contacts);
        }

        // Przekierowanie na bieżącą stronę, aby nie zdublować wysłania formularza
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Odczytanie danych z pliku JSON
    $contacts = getContacts();

    // Wyłączenie pamięci podręcznej przeglądarki
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

    // Wyświetlanie danych w tabeli HTML
    echo '<table>';
    echo '<tr><th>Name</th><th>Username</th><th>Email</th><th>Address</th><th>Phone</th><th>Company</th><th></th></tr>';
    foreach ($contacts as $index => $contact) {
        echo '<tr>';
        echo '<td>' . $contact['name'] . '</td>';
        echo '<td>' . $contact['username'] . '</td>';
        echo '<td>' . $contact['email'] . '</td>';
        echo '<td>' . $contact['address']['street'] . ', ' . $contact['address']['suite'] . ', ' . $contact['address']['city'] . ', ' . $contact['address']['zipcode'] . '</td>';
        echo '<td>' . $contact['phone'] . '</td>';
        echo '<td>' . $contact['company']['name'] . '</td>';
        echo '<td>';
        echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
        echo '<input type="hidden" name="delete" value="' . $index . '">';
        echo '<input type="submit" value="Delete">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
	
// Formularz dodawania nowego kontaktu
echo '<h2 style="text-align: center; background-image: linear-gradient(to right, violet, indigo, blue, green, yellow, orange, red); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 18px; font-weight: bold; align-items: c;">Add New Contact</h2>';
echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" style="border: 1px solid black; padding: 10px; text-align: center; background-color: lightblue; width: 20%; margin: 0 auto; border-radius: 10px;">';

echo '<label style="display: block; margin-bottom: 5px; margin-top: 5px; ">Name:</label>';
echo '<input type="text" name="name" required><br>';
echo '<label style="display: block; margin-bottom: 5px; margin-top: 5px; ">Username:</label>';
echo '<input type="text" name="username" required><br>';
echo '<label style="display: block; margin-bottom: 5px; margin-top: 5px; ">Email:</label>';
echo '<input type="email" name="email" required><br>';
echo '<label style="display: block; margin-bottom: 5px; margin-top: 5px; ">Address:</label>';

// Ulica
echo '<input type="text" name="street" required placeholder="Street"><br>';

// Apartament
echo '<input type="text" name="suite" required placeholder="Suite"><br>';

// Miasto
echo '<input type="text" name="city" required placeholder="City"><br>';

// Kod pocztowy
echo '<input type="text" name="zipcode" required placeholder="Zip Code"><br>';

// Pozostałe

echo '<label style="display: block; margin-bottom: 5px; margin-top: 5px; ">Phone:</label>';
echo '<input type="text" name="phone" required><br>';
echo '<label style="display: block; margin-bottom: 5px; margin-top: 5px; ">Company Name:</label>';
echo '<input type="text" name="company_name" required><br>'; // Dodano stylowanie do inputu
echo '<input type="submit" name="add" value="Add Contact" class="submit-button">';
echo '</form>';

// Dodanie skryptu ikony globusa
echo '<a href="https://cv.mentoz.pl" style="position: fixed; right: 20px; bottom: 20px; display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #002147;">';
echo '<img src="arrow.png" alt="Arrow" style="width: 40px; height: 40px;">';
echo '<span style="font-size: 14px; font-weight: bold; color: #002147;">Arkadiusz Dobrowolski</span>';
echo '</a>';
