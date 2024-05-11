<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PayPal JS + PHP - SDK Standard Integration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    #container {
      width: 100%;
      max-width: 1280px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      grid-gap: 0.5rem;
      gap: 0.5rem;
    }
  </style>
</head>

<body>
  <div id="container">
    <h1>PayPal JS + PHP - SDK Standard Integration</h1>
    <div id="paypal-button-container"></div>
    <p id="result-message"></p>
  </div>

  <!-- Initialize the JS-SDK -->
  <script
    src="https://www.paypal.com/sdk/js?client-id=AUksmPOioOda8-HoG1Wkh5jk4IpkZ5b1PJwuWcEe-v27rW1YZgb7yN93ypgqEJZZ9hD4zaM46SCE7ahb&currency=EUR&components=buttons&enable-funding=venmo"
    data-sdk-integration-source="developer-studio"></script>
  <script src="checkout.js"></script>

</body>

</html>