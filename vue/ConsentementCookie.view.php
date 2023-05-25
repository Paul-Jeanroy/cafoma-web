<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Message d'alerte pour les cookies</title>
  <style type="text/css">
    body {
      background-size: cover;
      background-position: center;
      font-family: sans-serif;
    }
    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: white;
      border: 1px solid black;
      text-align: center;
    }
    .popup h1 {
      font-size: 24px;
      margin-top: 0;
    }
    .popup p {
      font-size: 18px;
      margin-bottom: 20px;
    }
    .popup button {
      font-size: 16px;
      padding: 10px 20px;
      background-color: #008CBA;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button {
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    }

    button.accept {
      background-color: #008CBA;
      color: white;
    }

    button.accept:hover {
      background-color: #0077a3;
    }
  </style>
</head>
<body>
  <div class="popup">
    <h1>Informations sur les cookies</h1>
    <p>Pour créer un compte ou se connecter sur ce site, vous devez accepter les cookies.</p>
    <button class="accept" onclick="accepter()">Ok</button>
  </div>

  <script type="text/javascript">
    function accepter() {
        history.back();
    }
  </script>
</body>
</html>