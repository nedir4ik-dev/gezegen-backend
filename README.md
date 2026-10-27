# ✈️ Gezegen Backend API (Ticket Module)

<p align="center">
  <b>Uçuş dolandyryş ulgami üçin döredilen RESTful API taslamasy (Laravel 13)</b>
</p>

<p align="center">
  <a href="#-esasy-aýratynlyklar">Aýratynlyklar</a> •
  <a href="#-brunoda-http-metody-bilen-barlamak">Bruno Guide</a> •
  <a href="#-api-endpointleri">Endpointler</a> •
  <a href="#-gurmak-we-işletmek">Gurnama</a>
</p>

---

## 🚀 Esasy Aýratynlyklar

- **Framework:** Laravel 13 (Modern PHP Attributes `#[Fillable(...)]` ulanmak bilen).
- **API Prefix:** `/api/v1/`
- **Maglumat Çeşmesi:** Factory ulanylman, gönüden-göni hakyky maglumatlar (Real Data) we aýratyn Seederler arkaly doldurulan maglumat bazasy.
- **Test Gurallary:** Bruno API Client arkaly dolandyryş we barlag.

---

## 🧪 Bruno-da HTTP Metodlary Nädip Ulanylmaly?

Taslamanyň API-lerini barlamak üçin **Bruno** programmasyny ulanýarys. Ähli requestler üçin esasy salgy (Base URL):

> `http://127.0.0.1:8000/api/v1`

Bruno-da her bir HTTP metodyny ulanmak üçin aşakdaky ädimleri berjaý ediň:

1. **GET (Maglumatlary almak):**
    - Metody `GET` edip saýlaň.
    - URL ýerine barlajak endpointiňizi ýazyň (meselem: `http://127.0.0.1:8000/api/v1/tickets`).
    - **Send** düwmäni basyň. Jogap `200 OK` statusy bilen JSON formatda çykar.

2. **POST (Täze maglumat goşmak):**
    - Metody `POST` edip üýtgediň.
    - URL ýerine endpointi ýazyň (meselem: `http://127.0.0.1:8000/api/v1/tickets`).
    - **Headers** bölegine `Content-Type: application/json` we `Accept: application/json` goşuň (eger awtomatiki goşulmadyk bolsa).
    - **Body** tabyna geçip, **JSON** formatyny saýlaň we iberdiljek maglumatlary ýazyň (aşakdaky mysallar ýaly).
    - **Send** düwmäni basyň (`201 Created` ýa-da `200 OK` gelmeli).

3. **PUT / PATCH (Maglumatlary üýtgetmek):**
    - Metody `PUT` ýa-da `PATCH` saýlaň.
    - ID görkezmek bilen URL ýazyň (meselem: `http://127.0.0.1:8000/api/v1/tickets/1`).
    - **Body** (JSON) arkaly üýtgetmek isleýän maglumatlaryňyzy iberiň.

4. **DELETE (Maglumat pozmak):**
    - Metody `DELETE` saýlaň.
    - URL: `http://127.0.0.1:8000/api/v1/tickets/1` görnüşinde ýazyp **Send** basyň.

---

## 📡 API Endpointleri we Mysallar

### 🌍 1. Howa Menzilleri (Airports)

| HTTP Metody | Endpoint                | Düşündiriş                             |
| :---------- | :---------------------- | :------------------------------------- |
| `GET`       | `/api/v1/airports`      | Ähli howa menzilleriniň sanawyny almak |
| `POST`      | `/api/v1/airports`      | Täze howa menzilini goşmak             |
| `GET`       | `/api/v1/airports/{id}` | Belli bir howa menzilini görmek        |

- **POST Request Body (Mysal):**

```json
{
    "name": "Ashgabat International Airport",
    "code": "ASB",
    "city": "Ashgabat",
    "country": "Turkmenistan"
}
```

---

### ✈️ 2. Uçuşlar (Flights)

| HTTP Metody | Endpoint               | Düşündiriş                    |
| :---------- | :--------------------- | :---------------------------- |
| `GET`       | `/api/v1/flights`      | Ähli uçuşlaryň sanawyny almak |
| `POST`      | `/api/v1/flights`      | Täze uçuş döretmek            |
| `GET`       | `/api/v1/flights/{id}` | Belli bir uçuşy görmek        |

- **POST Request Body (Mysal):** _(Bellik: `arrival_time` zerur däl, `airline` bolsa awiakompaniýa adyny görkezmek üçin ulanylýar)_

```json
{
    "flight_number": "T5-875",
    "airline": "Türkmenhowaýollary",
    "departure_airport_id": 1,
    "arrival_airport_id": 2,
    "departure_time": "2026-11-01 10:00:00",
    "price": 350.0,
    "available_seats": 120
}
```

---

### 👤 3. Ýolagçylar (Passengers)

| HTTP Metody | Endpoint                  | Düşündiriş                 |
| :---------- | :------------------------ | :------------------------- |
| `GET`       | `/api/v1/passengers`      | Ähli ýolagçylary almak     |
| `POST`      | `/api/v1/passengers`      | Täze ýolagçy goşmak        |
| `GET`       | `/api/v1/passengers/{id}` | Belli bir ýolagçyny görmek |

- **POST Request Body (Mysal):**

```json
{
    "first_name": "Aman",
    "last_name": "Myradow",
    "email": "aman@gmail.com",
    "phone": "+99365112233",
    "passport_number": "I-AG7712398"
}
```

---

### 🎫 4. Biletler (Tickets)

| HTTP Metody | Endpoint               | Düşündiriş                                                   |
| :---------- | :--------------------- | :----------------------------------------------------------- |
| `GET`       | `/api/v1/tickets`      | Ähli biletleri (Flight we Passenger baglanyşygy bilen) almak |
| `POST`      | `/api/v1/tickets`      | Täze bilet sargyt etmek                                      |
| `GET`       | `/api/v1/tickets/{id}` | Belli bir biletiň jikme-jik maglumatyny görmek               |
| `PUT`       | `/api/v1/tickets/{id}` | Bileti üýtgetmek / täzelemek                                 |
| `DELETE`    | `/api/v1/tickets/{id}` | Bileti pozmak / ýatyrmak                                     |

- **POST Request Body (Mysal):**

```json
{
    "flight_id": 1,
    "passenger_id": 1,
    "seat_number": "12A",
    "ticket_code": "TCK-99182",
    "status": "confirmed"
}
```

- **GET /api/v1/tickets - Response (200 OK):**

```json
[
    {
        "id": 1,
        "flight_id": 1,
        "passenger_id": 1,
        "seat_number": "12A",
        "ticket_code": "TCK-99182",
        "status": "confirmed",
        "flight": {
            "id": 1,
            "flight_number": "T5-421"
        },
        "passenger": {
            "id": 1,
            "first_name": "Aman",
            "last_name": "Myradow"
        }
    }
]
```

---

## ⚠️ HTTP Status Kodlary we Jogap Mysallary (Responses)

|          Status Kod           | Düşündiriş                                                |
| :---------------------------: | :-------------------------------------------------------- |
|          **200 OK**           | Sorag üstünlikli ýerine ýetirildi (GET / PUT)             |
|        **201 Created**        | Täze maglumat ýa-da sargyt üstünlikli döredildi (POST)    |
|      **400 Bad Request**      | Iberilen maglumatlar nädogry ýa-da şertlere gabat gelmedi |
|     **401 Unauthorized**      | Ulanyjy autensifikasiýadan geçmedik                       |
|       **403 Forbidden**       | Bu amaly ýerine ýetirmäge ygtyýar ýok                     |
|       **404 Not Found**       | Gözlenen resurs, uçar ýa-da bilet tapylmady               |
| **422 Unprocessable Entity**  | Maglumatlar barlagdan (Validation) geçip bilmedi          |
| **500 Internal Server Error** | Serwer tarapynda garaşylmadyk näsazlyk ýüze çykdy         |
|  **503 Service Unavailable**  | Serwer wagtlaýyn elýeterli däl                            |

---

### 🟢 1. Üstünlikli Jogaplar (Success Responses)

#### `200 OK`

```json
{
    "success": true,
    "message": "Maglumatlar üstünlikli alyndy.",
    "data": {
        "id": 1,
        "flight_number": "T5-875",
        "airline": "Türkmenhowaýollary"
    }
}
```

#### `201 Created`

```json
{
    "success": true,
    "message": "Täze resource üstünlikli döredildi.",
    "data": {
        "id": 15,
        "flight_number": "T5-875"
    }
}
```

---

### 🟡 2. Klient Tarapdaky Ýalňyşlyklar (Client Errors)

#### `400 Bad Request`

```json
{
    "success": false,
    "message": "Nädogry ýa-da kemis sorag (Bad Request)."
}
```

#### `401 Unauthorized`

```json
{
    "success": false,
    "message": "Ulanyjy autensifikasiýadan geçmedik."
}
```

#### `403 Forbidden`

```json
{
    "success": false,
    "message": "Bu amaly ýerine ýetirmäge ygtyýaryňyz ýok."
}
```

#### `404 Not Found`

```json
{
    "success": false,
    "message": "Gözlenen resource tapylmady."
}
```

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "flight_number": ["The flight number field is required."],
        "price": ["The price must be a number."]
    }
}
```

---

### 🔴 3. Serwer Tarapdaky Ýalňyşlyklar (Server Errors)

#### `500 Internal Server Error`

```json
{
    "success": false,
    "message": "Serwerde garaşylmadyk näsazlyk ýüze çykdy.",
    "error": "QueryException: Database connection failed."
}
```

#### `503 Service Unavailable`

```json
{
    "success": false,
    "message": "Serwer wagtlaýyn elýeterli däl. Soňrak synanyşyň."
}
```

## 🛠️ Gurmak we İşletmek (Installation)

Proýekti öz kompýuteriňizde işledmek üçin şu ädimleri ýerine ýetiriň:

1. Repozitoriýany klonirläň:
    ```bash
    git clone https://github.com/nedir4ik-dev/gezegen-backend.git
    ```
2. Baglanyşyklary ýükledin:
    ```bash
    cd gezegen-backend
    composer install
    ```
3. Daşky gurşaw faýlyny dörediň:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Maglumat bazasyny migrasiýa edip, hakyky seeder maglumatlary ýükleyin:
    ```bash
    php artisan migrate:fresh --seed
    ```
5. Lokal serweri işledin:
    ```bash
    php artisan serve
    ```
