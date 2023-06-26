<style>


.pricing-table{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  width: min(1600px, 100%);
  margin: auto;
}

.pricing-card{
  flex: 1;
  max-width: 360px;
  background-color: #fff;
  margin: 20px 10px;
  text-align: center;
  cursor: pointer;
  overflow: hidden;
  color: #2d2d2d;
  transition: .3s linear;
}

.pricing-card-header{
  background-color: #0fbcf9;
  display: inline-block;
  color: #fff;
  padding: 12px 30px;
  border-radius: 0 0 20px 20px;
  font-size: 16px;
  text-transform: uppercase;
  font-weight: 600;
  transition: .4s linear;
}

.pricing-card:hover .pricing-card-header{
  box-shadow: 0 0 0 26em #0fbcf9;
}

.price{
  font-size: 32px;
  color: #0fbcf9;
  margin: 40px 0;
  transition: .2s linear;
}

.price sup, .price span{
  font-size: 22px;
  font-weight: 700;
}

.pricing-card:hover ,.pricing-card:hover .price{
  color: #fff;
}

.pricing-card li{
  font-size: 16px;
  padding: 10px 0;
  text-transform: uppercase;
}

.order-btn{
  display: inline-block;
  margin-bottom: 40px;
  margin-top: 80px;
  border: 2px solid #0fbcf9;
  color: #0fbcf9;
  padding: 18px 40px;
  border-radius: 8px;
  text-transform: uppercase;
  font-weight: 500;
  transition: .3s linear;
}

.order-btn:hover{
  background-color: #0fbcf9;
  color: #fff;
}

@media screen and (max-width:1100px){
  .pricing-card{
    flex: 50%;
  }
}

.grid-row .pricing-table{
    background-color: #e6f3ff;
}

#popup {
  width: 50%;
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    z-index: 9999;
  }

  /* Popup form styles */
  #popup form {
    margin-bottom: 20px;
    padding: 1em;
  }

  #popup label {
    display: block;
    margin-bottom: 5px;
  }

  #closeBtn {
    position: absolute;
    top: 0px;
    right: 10px;
    padding: 5px;
    color: #ffffff;
    border: none;
    cursor: pointer;
  }

  #popup input[type="text"],
  #popup input[type="email"],
  #popup textarea {
    width: 100%;
    padding: 5px;
  }

  #popup button[type="button"] {
    padding: 5px 10px;
    background-color: #13326d;
    color: #ffffff;
    border: none;
    cursor: pointer;
  }

  #popup button[type="button"]:hover {
    background-color: #13326de6;
  }

  input, textarea{
    border: 1px solid #0a2357;
    margin-bottom: 20px !important;
  }

  #background-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 9998;
  }
</style>


<div class="pricing-table">
  <div id="background-overlay"></div>
  <div class="pricing-card">
    <h3 class="pricing-card-header">Monthly</h3>
    <div class="price">5,000 <span>INR</span><span>/MO</span></div>
    <ul>
      <li>Live Rates</li>
      <li> Forward Rate Calculator</li>
      <li>Price Alerts</li>
      <li>Risk Management Tool</li>
    </ul>
    <button onclick="showPopup()" class="order-btn">Order Now</button>
  </div>

  <div class="pricing-card">
    <h3 class="pricing-card-header">Half Yearly</h3>
    <div class="price">25,000 <span>INR</span><span>/HY</span></div>
    <ul>
      <li>Live Rates</li>
      <li> Forward Rate Calculator</li>
      <li>Price Alerts</li>
      <li>Risk Management Tool</li>
    </ul>
    <button onclick="showPopup()" class="order-btn">Order Now</button>
  </div>

  <div class="pricing-card">
    <h3 class="pricing-card-header">Yearly</h3>
    <div class="price">50,000 <span>INR</span><span>/YR</span></div>
    <ul>
      <li>Live Rates</li>
      <li> Forward Rate Calculator</li>
      <li>Price Alerts</li>
      <li>Risk Management Tool</li>
    </ul>
    <button onclick="showPopup()" class="order-btn">Order Now</button>
  </div>

  <div id="popup" style="display: none;">
  <button id="closeBtn" onclick="closePopup()"><strong>X</strong></button>

  <form>
    <label for="name">Name:</label>
    <input type="text" id="name" required>
    <label for="mobile">Mobile Number:</label>
    <input type="text" id="mobile" required>
    <label for="email">Email:</label>
    <input type="email" id="email" required>
    <label for="comments">Comments:</label>
    <textarea id="comments" rows="4" required></textarea>
    <button type="button" onclick="submitForm()">Submit</button>
  </form>
</div>


</div>

<script>
  function showPopup() {
  var popup = document.getElementById("popup");
  var backgroundOverlay = document.getElementById("background-overlay");
  popup.style.display = "block";
  backgroundOverlay.style.display = "block";
}

function submitForm() {
  var popup = document.getElementById("popup");
  popup.style.display = "none";
  var backgroundOverlay = document.getElementById("background-overlay");
  backgroundOverlay.style.display = "none";
}


function closePopup() {
  var popup = document.getElementById("popup");
  popup.style.display = "none";
  var backgroundOverlay = document.getElementById("background-overlay");
  backgroundOverlay.style.display = "none";
}

</script>