<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Members</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        @yield('css-links')
    </head>

    <body>
      <!-- Begin page content -->
      <main role="main" class="container">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Subscription Level</th>
              <th scope="col">Subscription Price</th>
            </tr>
          </thead>
          <tbody id="memberData">
          </tbody>
        </table>
        <div id="subscriptionAverage">Subscription Average: </div>
      </main>
    </body>

<script>
fetch('{{URL::to("/")}}/members', {
        method: 'get'
    })
    .then(response => response.json())
    .then(jsonData => {
      let data = jsonData.data;
      let mainContainer = document.getElementById("memberData");

      data.sort((a,b) => (a.subscription_price < b.subscription_price ? 1 : -1));

      for (var i = 0; i < data.length; i++) {
        let tablerow = document.createElement("tr");
        tablerow.innerHTML = `<td> ${data[i].name} </td><td> ${data[i].email} </td><td> ${data[i].phone} </td><td>${data[i].subscription_name}</td><td>${data[i].subscription_price}</td>`;
        mainContainer.appendChild(tablerow);
      }

      let subscriptionAverageReport = document.getElementById("subscriptionAverage");
      let totalSubscriptionPriceAverage = data.reduce((previousValue, currentValue) => previousValue + parseInt(currentValue.subscription_price), 0) / data.length;

      subscriptionAverageReport.innerHTML += totalSubscriptionPriceAverage;
    })
    .catch(err => console.error('Error:', error));
</script>

</html>