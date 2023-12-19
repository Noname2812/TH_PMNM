
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Food</title>
    <link rel="stylesheet" type="text/css" href="styles/home.css" />
    <link rel="stylesheet" href="reponsive.css" />
  </head>
  <body>
  <?php 
    include "./components/cartNav.php";
    include "./components/header.php";
    ?>
    <section id="hero">
      <div class="container flex">
        <div>
          <h3>Easy way to make an order</h3>
          <h1>
            <span>HURRY?</span> Just wait <br />
            food at <span> your door</span>
          </h1>
          <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum
            consequuntur eligendi iure eaque!
          </p>
          <div>
            <button><a href="#" onclick="playMusic()">Order now ></a></button>
            <button><a href="./foods.php">See all foods</a></button>
          </div>
          <div class="flex">
            <div class="flex hero-service">
              <img src="./images/icons/shipping-icon.png" alt="shipping-icon" />
              <p>No shipping charge</p>
            </div>
            <div class="flex hero-service">
              <img
                src="./images/icons/icons8-shield-24.png"
                alt="icons8-shield-24"
              />
              <p>100% secure checkout</p>
            </div>
          </div>
        </div>
        <div>
          <img src="./images/hero.png" alt="hero-img" />
        </div>
      </div>
    </section>
    <section id="menu-foods">
      <div class="container flex">
        <?php
        require_once "./config.php";
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql="select * from loai";
           $re=$pdo->query($sql);
           $data=$re->fetchAll(PDO::FETCH_ASSOC);
           foreach ($data as $key => $value){
            echo "<form action='./foods.php' method='post'>";
            echo "<button type='submit''>";
            echo "<div class='item-food'>";
            echo "<div><img src='./images/upload/{$value['image']}' alt='' /></div>";
            echo "<div><h3>{$value['tenloai']}</h3></div>";
            echo "</div>";
            echo "</button>";
            echo "<input type='hidden' name='category_id' value='{$value['maloai']}'/>";
            echo "</form>"; 
           }
         ?>
      </div>
    </section>
    <section>
      <div class="container">
        <div id="content-service">
          <h3>What we serve</h3>
          <h1>
            Just sit back at home <br />
            We will <span> take care</span>
          </h1>
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Asperiores, quod! <br />
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Consequuntur, quia.
          </p>
        </div>
        <div class="flex">
          <div class="feature-item">
            <img src="./images/icons/driver.png" alt="" />
            <h3>Quick Delivery</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero,
              saepe?
            </p>
          </div>
          <div class="feature-item">
            <img src="./images/icons/din-in.png" alt="" />
            <h3>Super Dine In</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero,
              saepe?
            </p>
          </div>
          <div class="feature-item">
            <img src="./images/icons/pick-up.png" alt="" />
            <h3>Easy Pick Up</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero,
              saepe?
            </p>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container flex" id="why-choose-us">
        <div>
          <img src="./images/location.png" alt="" />
        </div>
        <div>
          <h1>Why <span> Tasty Treat?</span></h1>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia
            laboriosam fugiat, cupiditate ducimus alias vero amet facilis
            aspernatur laborum veniam nihil saepe natus odit explicabo accusamus
            repellat. Maxime, molestias sed?
          </p>
          <ul>
            <li class="content-choose">
              <img src="./images/icons/checkbox.png" alt="" />
              <h4>Fresh and tasty foods</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo,
                dicta?
              </p>
            </li>
            <li class="content-choose">
              <img src="./images/icons/checkbox.png" alt="" />
              <h4>Fresh and tasty foods</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo,
                dicta?
              </p>
            </li>
            <li class="content-choose">
              <img src="./images/icons/checkbox.png" alt="" />
              <h4>Fresh and tasty foods</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo,
                dicta?
              </p>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <section id="hot-items">
      <div class="container">
        <h1>Hot Pizza</h1>
        <div class="flex menu-items-food">
          <div>
            <div class="item-sells">
              <img src="./images/items/product_2.1.f1538554.jpg" alt="" />
              <h4>Vegetarian Pizza</h4>
              <div>
                <span>$115</span>
                <button onclick="addCart()">Add to cart</button>
              </div>
            </div>
          </div>
          <div>
            <div class="item-sells">
              <img src="./images/items/product_2.2.4967c9cb.jpg" alt="" />
              <h4>Double Cheese Margherita</h4>
              <div>
                <span>$110</span>
                <button onclick="addCart()">Add to cart</button>
              </div>
            </div>
          </div>
          <div>
            <div class="item-sells">
              <img src="./images/items/product_3.1.9c207cdf.jpg" alt="" />
              <h4>Maxican Green Wave</h4>
              <div>
                <span>$110</span>
                <button onclick="addCart()">Add to cart</button>
              </div>
            </div>
          </div>
          <div>
            <div class="item-sells">
              <img src="./images/items/product_4.1.3c8ecc49.jpg" alt="" />
              <h4>Seafood Pizza</h4>
              <div>
                <span>$115</span>
                <button onclick="addCart()">Add to cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="testimonial">
      <div class="container flex">
        <div>
          <div class="persons">
            <h3>Testimonial</h3>
            <h1>What our <span>customers</span> are saying</h1>
            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Recusandae porro nisi officia labore soluta repudiandae quaerat
              cumque dolore quod dicta!
            </p>
            <div id="sticks-list">
              <div class="sticks-item" id="testimonial-0">
                <p>
                  "Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Porro possimus facilis nihil, voluptate ad, alias quaerat odit
                  ratione nisi voluptas doloribus consectetur sit dolorum minus
                  blanditiis quam eum ea? Tenetur."
                </p>
                <img src="./images/ava-3.14420750.jpg" alt="" />
                <h4>Mitchell Marsh</h4>
              </div>
              <div class="sticks-item" id="testimonial-1">
                <p>
                  "Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Porro possimus facilis nihil, voluptate ad, alias quaerat odit
                  ratione nisi voluptas doloribus consectetur sit dolorum minus
                  blanditiis quam eum ea? Tenetur."
                </p>
                <img src="./images/ava-1.c185d772.jpg" alt="" />
                <h4>Jonh Doe</h4>
              </div>
              <div class="sticks-item" id="testimonial-2">
                <p>
                  "Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                  Porro possimus facilis nihil, voluptate ad, alias quaerat odit
                  ratione nisi voluptas doloribus consectetur sit dolorum minus
                  blanditiis quam eum ea? Tenetur."
                </p>
                <img src="./images/ava-2.11e918c6.jpg" alt="" />
                <h4>Kawasaki Jun</h4>
              </div>
            </div>
          </div>
          <ul class="flex">
            <li><button></button></li>
            <li><button></button></li>
            <li><button></button></li>
          </ul>
        </div>
        <div>
          <img style="height: 546px" src="./images/network.png" alt="anh" />
        </div>
      </div>
    </section>
    <?php
    include "./components/footer.php"; ?>
  </body>
  <script src="./index.js"></script>
  <script src="./cart.js"></script>
</html>
