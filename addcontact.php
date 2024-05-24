<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/style.css">
  <title>Telefon Rehberi</title>
</head>

<body class="h-100 d-flex flex-column">
  <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #003285;">
    <div class="container">
      <a href="index.html" class="navbar-brand">
        <i class="fa-solid fa-phone"></i>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobile">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="mobile" class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto ms-2">
          <li class="nav-item ms-2">
            <a href="index.html" class="nav-link">Anasayfa</a>
          </li>
          <li class="nav-item ms-2">
            <a href="#" class="nav-link">Hakkımızda</a>
          </li>
          <li class="nav-item ms-2">
            <a href="#" class="nav-link">İletişim</a>
          </li>
        </ul>
        <form class="d-flex">
          <a href="login.html" type="button" class="btn btn-outline-light btn-md" type="submit">Giriş</a>
          <a href="register.html" type="button" class="btn btn-light btn-md ms-2" type="submit">Kayıt Ol</a>
        </form>
      </div>
    </div>
  </nav>


  <main>
    <section>
      <h1 class="display-4 fw-bold text-center mt-5">Yeni Kişi Ekle</h1>
      <div class="pt-5 mt-2 px-4 border-bottom">
        <div class="col-lg-6 mx-auto mb-4">
          <form class="row g-3" action="handleAddContact.php" method="post" enctype="multipart/form-data">
            <div class="col-12">
              <label for="name" class="form-label">İsim *</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-12">
              <label for="surname" class="form-label">Soyad *</label>
              <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="col-12">
              <label for="phone" class="form-label">Telefon *</label>
              <input type="tel" class="form-control" id="phone" name="phone" minlength="10" required>
            </div>
            <div class="col-12">
              <label for="inputEmail" class="form-label">E-posta</label>
              <input type="email" class="form-control" id="inputEmail" name="email">
            </div>
            <div class="col-md-4">
              <label for="inputCountry" class="form-label">Ülke</label>
              <input type="text" class="form-control" id="inputCountry" name="country">
            </div>
            <div class="col-md-4">
              <label for="inputCity" class="form-label">İl</label>
              <input type="text" class="form-control" id="inputCity" name="city">
            </div>
            <div class="col-md-4">
              <label for="inputDistrict" class="form-label">İlçe</label>
              <input type="text" class="form-control" id="inputDistrict" name="district">
            </div>
            <div class="col-12">
              <label for="address" class="form-label">Adres</label>
              <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Fotoğraf Ekle</label>
              <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="col-12">
              <button href="#" type="submit" class="btn btn-primary">Ekle</button>
            </div>

          </form>
        </div>
      </div>
    </section>
  </main>


  <footer class="py-2 bg-dark text-white mt-auto">
    <div class="container text-center">
      <span>Bütün Hakları Saklıdır. @2024</span>
    </div>
  </footer>


  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>