<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cars Showroom</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" />
  <style>
    /* FadeUp animation */
    .animate-fade-up {
      animation: fadeUp 1s ease-out both;
    }
    @keyframes fadeUp {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Hide scrollbar */
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    /* Hero slider styles */
    #hero-slider {
      position: relative;
      width: 100%;
      max-width: 1200px;
      height: 600px;
      margin: auto;
      overflow: hidden;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    #hero-slider .slides {
      display: flex;
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
      height: 100%;
    }

    #hero-slider .slide {
      min-width: 100%;
      height: 100%;
      position: relative;
      user-select: none;
    }

    #hero-slider .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
      border-radius: 16px;
    }

    #hero-slider .slide:hover img {
      transform: scale(1.05);
    }

    /* Dots navigation */
    #hero-slider .dots {
      position: absolute;
      bottom: 18px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 12px;
      z-index: 21;
    }
    #hero-slider .dots button {
      width: 14px;
      height: 14px;
      border-radius: 50%;
      border: none;
      background-color: rgba(255, 255, 255, 0.6);
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    #hero-slider .dots button.active,
    #hero-slider .dots button:hover {
      background-color: #dc2626;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Navbar -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-red-600">CLASSIC SHOWROOM</h1>
      <nav class="space-x-6 text-sm font-semibold">
        <a href="#" class="hover:text-red-600">Home</a>
        <a href="#models" class="hover:text-red-600">Models</a>
        <a href="#booking" class="hover:text-red-600">Booking</a>
        <a href="#services" class="hover:text-red-600">Services</a>
        <a href="#Add customer" class="hover:text-red-600">Add customer</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section with Big Animated Slider -->
  <section class="relative bg-gray-900 py-12">
    <div id="hero-slider" class="animate-fade-up">
      <div class="slides">
        <div class="slide">
          <img 
            src="https://carfromjapan.com/wp-content/uploads/2018/03/various-cars-e1719904880682.jpg"
            alt="Toyota Camry Sedan in sleek silver color parked with city background"
            draggable="false"
          />
        </div>
        <div class="slide">
          <img
            src="https://www.hyundaicanada.com/-/media/hyundai/coming-soon/2024-sonata/full_bleed/desktop/img_001.jpg?h=2160&w=3840&hash=0139FF96C2927827D4075EA02E58F4FF"
            alt="Honda Accord Sedan in vibrant green shown on scenic mountain road"
            draggable="false"
          />
        </div>
        <div class="slide">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/da8499f1-968e-4383-9932-e67825466974.png"
            alt="Ford Mustang Coupe in bright yellow with sleek aerodynamic design"
            draggable="false"
          />
        </div>
        <div class="slide">
          <img
            src="https://cdn.cheapism.com/images/iStock-1387705225_lZoHoqL.max-784x410.jpg"
            alt="Tesla Model S electric vehicle in red"
            draggable="false"
          />
        </div>
        <div class="slide">
          <img
            src="https://www.shutterstock.com/image-photo/row-different-color-cars-on-600nw-2166302623.jpg"
            draggable="false"
          />
        </div>
        <div class="slide">
          <img
            src="https://electromobili.ru/images/easyblog_articles/231/tesla-roadster-2020-ilon-mask-smyagchaet-ozhidaniya-po-srokam-proizvodstva.jpg"
            alt="Audi Q5 SUV in purple"
            draggable="false"
          />
        </div>
      </div>

      <!-- Dots navigation -->
      <div class="dots" role="tablist" aria-label="Slider navigation">
        <button class="dot active" role="tab" aria-selected="true" aria-controls="slide1" tabindex="0"></button>
        <button class="dot" role="tab" aria-selected="false" aria-controls="slide2" tabindex="-1"></button>
        <button class="dot" role="tab" aria-selected="false" aria-controls="slide3" tabindex="-1"></button>
        <button class="dot" role="tab" aria-selected="false" aria-controls="slide4" tabindex="-1"></button>
        <button class="dot" role="tab" aria-selected="false" aria-controls="slide5" tabindex="-1"></button>
        <button class="dot" role="tab" aria-selected="false" aria-controls="slide6" tabindex="-1"></button>
      </div>
    </div>
  </section>

  <!-- Car Video Advertisement Section -->
  <section class="py-10 bg-gray-200 text-center">
    <h2 class="text-3xl font-bold mb-4">New Car Advertisement</h2>
    <img 
     src="https://as1.ftcdn.net/jpg/05/58/09/16/1000_F_558091628_bmhUCnj2ofwazRJ7yGVlfJ18h65xJxA6.jpg"
     alt="Car Reveal" 
     class="mx-auto rounded-lg shadow-lg" 
     width="800" 
     height="450"
    />
  </section>

  <!-- Lottie Animation Section -->
  <section class="py-10 bg-white">
    <div class="container mx-auto px-4 text-center">
      <lottie-player
        src="https://assets10.lottiefiles.com/packages/lf20_ydo1amjm.json"
        background="transparent"
        speed="1"
        style="width: 300px; height: 300px; margin: auto"
        loop
        autoplay
      ></lottie-player>
      <h3 class="text-2xl font-bold mt-4">Leading Innovation</h3>
      <p class="text-gray-600">Toyota brings the future to you.</p>
    </div>
  </section>
   <!-- Featured Models with Horizontal Slider -->
  <section id="models" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 max-w-7xl">
      <h3 class="text-3xl font-bold mb-8 text-center">Popular Models</h3>
      <div class="relative">
        <!-- Slider Container -->
        <div id="model-slider" class="flex overflow-x-auto gap-6 no-scrollbar scroll-smooth snap-x snap-mandatory">
  <!-- Model Cards -->
  <div class="snap-start flex-shrink-0 w-80 bg-white rounded-xl shadow-lg overflow-hidden group" onclick="showModal('Toyota Camry', 'Silver', '123456', 'Toyota', '$25,000')">
    <div class="relative overflow-hidden">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/7274faf1-0fc0-4d1f-a65e-63cde44a358c.png"
        class="w-full transition-transform duration-300 group-hover:scale-105"
        alt="Toyota Camry Sedan in sleek silver color"
      />
    </div>
    <div class="p-4">
      <h4 class="text-xl font-semibold mb-2">Toyota Camry</h4>
      <p class="text-sm mb-3">A reliable and fuel-efficient sedan for everyday use.</p>
      <a href="#" class="text-red-600 font-semibold hover:underline">Learn More →</a>
    </div>
  </div>
  
  <div class="snap-start flex-shrink-0 w-80 bg-white rounded-xl shadow-lg overflow-hidden group" onclick="showModal('Honda Accord', 'Green', '654321', 'Honda', '$30,000')">
    <div class="relative overflow-hidden">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/623f1f2e-b190-49d7-bb6b-8323399afefe.png"
        class="w-full transition-transform duration-300 group-hover:scale-105"
        alt="Honda Accord Sedan in vibrant green"
      />
    </div>
    <div class="p-4">
      <h4 class="text-xl font-semibold mb-2">Honda Accord</h4>
      <p class="text-sm mb-3">Sporty design and advanced technology for a thrilling drive.</p>
      <a href="#" class="text-red-600 font-semibold hover:underline">Learn More →</a>
    </div>
  </div>

  <div class="snap-start flex-shrink-0 w-80 bg-white rounded-xl shadow-lg overflow-hidden group" onclick="showModal('Ford Mustang', 'Yellow', '789012', 'Ford', '$40,000')">
    <div class="relative overflow-hidden">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2a46ab90-9adc-4298-96aa-656198f5d9cb.png"
        class="w-full transition-transform duration-300 group-hover:scale-105"
        alt="Ford Mustang Coupe in bright yellow"
      />
    </div>
    <div class="p-4">
      <h4 class="text-xl font-semibold mb-2">Ford Mustang</h4>
      <p class="text-sm mb-3">An iconic American muscle car with powerful performance.</p>
      <a href="#" class="text-red-600 font-semibold hover:underline">Learn More →</a>
    </div>
  </div>

  <div class="snap-start flex-shrink-0 w-80 bg-white rounded-xl shadow-lg overflow-hidden group" onclick="showModal('Tesla Model S', 'Red', '345678', 'Tesla', '$70,000')">
    <div class="relative overflow-hidden">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/cda24de6-fa53-4608-b0e2-77e60763f2a2.png"
        class="w-full transition-transform duration-300 group-hover:scale-105"
        alt="Tesla Model S in modern red"
      />
    </div>
    <div class="p-4">
      <h4 class="text-xl font-semibold mb-2">Tesla Model S</h4>
      <p class="text-sm mb-3">Electric performance with innovative technology.</p>
      <a href="#" class="text-red-600 font-semibold hover:underline">Learn More →</a>
    </div>
  </div>

  <div class="snap-start flex-shrink-0 w-80 bg-white rounded-xl shadow-lg overflow-hidden group" onclick="showModal('BMW X5', 'Blue', '901234', 'BMW', '$60,000')">
    <div class="relative overflow-hidden">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/bbecf7a7-4832-48c5-bfff-23bb06a8dda2.png"
        class="w-full transition-transform duration-300 group-hover:scale-105"
        alt="BMW X5 SUV in sleek blue"
      />
    </div>
    <div class="p-4">
      <h4 class="text-xl font-semibold mb-2">BMW X5</h4>
      <p class="text-sm mb-3">Luxury SUV with spacious interior and smooth ride.</p>
      <a href="#" class="text-red-600 font-semibold hover:underline">Learn More →</a>
    </div>
  </div>

  <div class="snap-start flex-shrink-0 w-80 bg-white rounded-xl shadow-lg overflow-hidden group" onclick="showModal('Audi Q5', 'Purple', '567890', 'Audi', '$55,000')">
    <div class="relative overflow-hidden">
      <img
        src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/399ab231-332f-455b-94da-06d0ebb267b9.png"
        class="w-full transition-transform duration-300 group-hover:scale-105"
        alt="Audi Q5 SUV in purple"
      />
    </div>
    <div class="p-4">
      <h4 class="text-xl font-semibold mb-2">Audi Q5</h4>
      <p class="text-sm mb-3">Compact luxury SUV with great performance and style.</p>
      <a href="#" class="text-red-600 font-semibold hover:underline">Learn More →</a>
    </div>
  </div>
</div>

<!-- Modal for Car Details -->
<div id="carModal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
  <div class="modal-content bg-white p-6 rounded-lg" style="width: 400px; height: auto;">
    <h2 class="text-2xl font-bold mb-2" id="modalModel"></h2>
    <p><strong>Color:</strong> <span id="modalColor"></span></p>
    <p><strong>Chase Number:</strong> <span id="modalChaseNumber"></span></p>
    <p><strong>Brand:</strong> <span id="modalBrand"></span></p>
    <p><strong>Price:</strong> <span id="modalPrice"></span></p>
    <button onclick="closeModal()" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Close</button>
  </div>
</div>

<script>
  function showModal(model, color, chaseNumber, brand, price) {
    document.getElementById('modalModel').innerText = model;
    document.getElementById('modalColor').innerText = color;
    document.getElementById('modalChaseNumber').innerText = chaseNumber;
    document.getElementById('modalBrand').innerText = brand;
    document.getElementById('modalPrice').innerText = price;
    document.getElementById('carModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('carModal').classList.add('hidden');
  }
</script>

  <!-- Add customer -->
  <!-- Add Customer Section -->
<section id="Add customer" class="py-16 bg-gray-200">
<?php
  // Use a dedicated connection for Add Customer
  $conn_customer = new mysqli("localhost", "root", "03120453586", "cars");

  if ($conn_customer->connect_error) {
    die("Connection failed: " . $conn_customer->connect_error);
  }

  if (isset($_POST['add_customer'])) {
    $name = $_POST['customername'];
    $contact = $_POST['contactnumber'];
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $gender = $_POST['gender'];
    $dob = $_POST['dateofbirth'];
    $address = $_POST['address'];

    $sql = "INSERT INTO customer (customername, contactnumber, email, cnic, gender, dateofbirth, address)
            VALUES ('$name', '$contact', '$email', '$cnic', '$gender', '$dob', '$address')";

    if ($conn_customer->query($sql)) {
      echo "<p class='text-green-700 text-center font-semibold mt-6'>✅ Customer added successfully.</p>";
    } else {
      echo "<p class='text-red-600 text-center font-semibold mt-6'>❌ Error: " . $conn_customer->error . "</p>";
    }
  }
?>
  <div class="container mx-auto px-4 max-w-3xl bg-white rounded-lg shadow-lg p-8">
    <h3 class="text-3xl font-bold mb-6 text-center text-blue-700">📋 Add Customer Form</h3>

    <form method="post" class="grid gap-4">
      <input type="text" name="customername" placeholder="Name" required class="border border-gray-300 p-2 rounded w-full" />
      
      <input type="text" name="contactnumber" placeholder="Contact Number" required class="border border-gray-300 p-2 rounded w-full" />
      <input type="email" name="email" placeholder="Email" class="border border-gray-300 p-2 rounded w-full" />
      <input type="text" name="cnic" placeholder="CNIC" required class="border border-gray-300 p-2 rounded w-full" />
      
      <select name="gender" required class="border border-gray-300 p-2 rounded w-full">
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>

      <input type="text" name="dateofbirth" placeholder="Date of Birth (e.g. 05-Jan-2000)" required class="border border-gray-300 p-2 rounded w-full" />
      <input type="text" name="address" placeholder="Address" class="border border-gray-300 p-2 rounded w-full" />

      <div class="flex justify-center items-center pt-2">
        <input type="submit" name="add_customer" value="Add Customer" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700" />
      </div>
    </form>
  </div>
</section>



  <!-- Services Section -->
  <section id="services" class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-7xl text-center">
      <h3 class="text-3xl font-bold mb-8">Our Services</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-100 p-4 rounded-lg shadow">
          <h4 class="text-xl font-semibold mb-2">Maintenance</h4>
          <p>Regular maintenance to keep your vehicle in top condition.</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
          <h4 class="text-xl font-semibold mb-2">Repair</h4>
          <p>Expert repairs for all Toyota models by certified technicians.</p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg shadow">
          <h4 class="text-xl font-semibold mb-2">Parts & Accessories</h4>
          <p>Genuine Toyota parts and accessories for your vehicle.</p>
        </div>
      </div>
    </div>
  </section>

  
  
  
<!-- Booking Section -->
<section id="booking" class="py-16 bg-gray-100">
  <div class="container mx-auto px-4 max-w-3xl text-center">
    <h3 class="text-3xl font-bold mb-4">Add Car Booking</h3>
    <p class="mb-4">Fill out the form below to book a car.</p>

    <?php
    // Separate connection for Booking
    $conn_booking = new mysqli("localhost", "root", "03120453586", "cars");

    if ($conn_booking->connect_error) {
      die("Connection failed: " . $conn_booking->connect_error);
    }

    if (isset($_POST['add_booking'])) {
      $carChaseNumber = $_POST['carchasenumber'];
      $carColor = $_POST['carcolor'];
      $bookingDate = $_POST['bookingdate'];

      $sql = "INSERT INTO booking (carchasenumber, carcolor, bookingdate)
              VALUES ('$carChaseNumber', '$carColor', '$bookingDate')";

      if ($conn_booking->query($sql)) {
        echo "<p class='text-green-700 text-center font-semibold mt-6'>✅ Car booked successfully.</p>";
      } else {
        echo "<p class='text-red-600 text-center font-semibold mt-6'>❌ Error: " . $conn_booking->error . "</p>";
      }
    }
    ?>

    <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 text-left">
      <div class="mb-4">
        <label class="block text-gray-700">Car Chase Number:</label>
        <input type="text" name="carchasenumber" required class="border border-gray-300 p-2 w-full rounded" />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Car Color:</label>
        <input type="text" name="carcolor" required class="border border-gray-300 p-2 w-full rounded" />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Booking Date:</label>
        <input type="text" name="bookingdate" placeholder="e.g. 6-Oct" required class="border border-gray-300 p-2 w-full rounded" />
      </div>
      <div class="text-center">
        <input type="submit" name="add_booking" value="Book Car" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700" />
      </div>
    </form>
  </div>
</section>



  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-4">
    <div class="container mx-auto text-center">
      <p>&copy; 2025 Classic Pakistan. All rights reserved.</p>
    </div>
  </footer>
      </div>
  </footer>

  <script>
    const slidesContainer = document.querySelector("#hero-slider .slides");
    const dots = document.querySelectorAll("#hero-slider .dots button");
    const totalSlides = slidesContainer.children.length;
    let currentIndex = 0;

    function showSlide(index) {
      slidesContainer.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach(dot => dot.classList.remove("active"));
      if (dots[index]) dots[index].classList.add("active");
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % totalSlides;
      showSlide(currentIndex);
    }

    let autoSlide = setInterval(nextSlide, 4000);

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        currentIndex = index;
        showSlide(currentIndex);
        clearInterval(autoSlide); // reset auto slide timer
        autoSlide = setInterval(nextSlide, 4000);
      });
    });

    showSlide(currentIndex);
  </script>
</body>
</html>


